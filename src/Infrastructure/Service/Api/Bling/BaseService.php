<?php

namespace AGTI\Bling\Infrastructure\Service\Api\Bling;

use AGTI\Bling\Entity\AgBlingApiRequest;
use AGTI\Bling\Infrastructure\Service\Api\Bling\Exception\ApiRateException;
use AGTI\Bling\ValueObject\ApiToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\ServerException;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Stopwatch\Stopwatch;

abstract class BaseService
{
    const API_BASE = "https://www.bling.com.br/Api/v3/";

    private $serializer;
    private $request;
    private $isSandbox;
    private $watch;
    private $http;
    private $token;
    private $em;

    public function __construct(CurlHttpClient $http, Stopwatch $watch, bool $isSandbox, Serializer $serializer, EntityManagerInterface $em)
    {
        $this->http = $http;
        $this->watch = $watch;
        $this->isSandbox = $isSandbox;
        $this->serializer = $serializer;
        $this->em = $em;
    }

    abstract function getApiEndpoint();

    /**
     * @return ApiRequest
     */
    protected function send($method, $querystring=[], $bodyData=null, $extraHeaders = []): AgBlingApiRequest
    {
        $semId = ftok(__FILE__, "s");
        $sem = sem_get($semId, 1);

        sem_acquire($sem);

        //aplica o limite de, no máximo, 3 requisições por segundo
        usleep(333333);

        //aplica o limite de, no máximo, 120000 requisições por dia

        $repo = $this->em->getRepository(AgBlingApiRequest::class);
        $count = $repo->createQueryBuilder('r')
            ->select('count(r.id)')
            ->where('r.dateAdd >= :date')
            ->setParameter('date', new \DateTime('today'))
            ->getQuery()
            ->getSingleScalarResult();

        if ($count >= 120000) {
            throw new ApiRateException;
        }
        
        
        $this->watch->start('checking rate limit');

        $url = self::API_BASE . $this->getApiEndpoint();
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        if (isset($this->token)) {
            $headers['Authorization'] = 'Bearer ' . $this->getToken()->getToken();
        }

        $headers = array_merge($headers, $extraHeaders);

        $this->watch->openSection();
        $this->watch->start('triggering request');

        $r = $this->http->request(
            $method,
            $url,
            [
                'query' => $querystring,
                'body' => $bodyData,
                'headers' => $headers,
            ]
        );

        $event = $this->watch->stop('triggering request');

        $ret = new AgBlingApiRequest;
        $ret->setDateAdd(new \DateTime);

        try {
            $info = $r->getInfo();
            $ret->setEndpoint($info['url'])
                ->setHeaders($headers)
                ->setMethod($info['http_method'])
                ->setBody($bodyData)
                ->setHttpCode($r->getStatusCode())
                ->setTimeSpent($event->getDuration())
                ->setResponse($r->getContent())
                ->setHeadersResponse($r->getHeaders());
        } catch (ServerException $e) {
            $ret->setResponse($r->getContent(false))
                ->setHeadersResponse($r->getHeaders(false));
        } catch (ClientException $e) {
            $ret->setResponse($r->getContent(false))
                ->setHeadersResponse($r->getHeaders(false));
        } catch (\Exception $e){}

        $ret->setStackTrace((new \Exception)->getTraceAsString());

        $this->request = $ret;
        return $ret;
    }

    /**
     * Get the value of isSandbox
     */ 
    private function getIsSandbox()
    {
        return $this->isSandbox;
    }

    /**
     * Get the value of request
     */ 
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the value of request
     *
     * @return  self
     */ 
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of serializer
     */ 
    public function getSerializer()
    {
        return $this->serializer;
    }
}