<?php

namespace AGTI\Bling\Infrastructure\Service\Api\AGTI;

use AGTI\IoPay\Entity\AgIoPayApiRequest;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\ServerException;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Stopwatch\Stopwatch;

abstract class BaseService
{
    const API_BASE = "https://www.agti.eng.br/module/agblingintermediator";

    private $serializer;
    private $request;
    private $isSandbox;
    private $watch;
    private $http;

    public function __construct(CurlHttpClient $http, Stopwatch $watch, bool $isSandbox, Serializer $serializer)
    {
        $this->http = $http;
        $this->watch = $watch;
        $this->isSandbox = $isSandbox;
        $this->serializer = $serializer;
    }

    abstract function getApiEndpoint();

    /**
     * @return ApiRequest
     */
    protected function send($method, $querystring=[], $bodyData=null, $extraHeaders = []): AgIoPayApiRequest
    {
        $url = self::API_BASE . $this->getApiEndpoint();
        $headers = [
            'Accept: application/json',
            'Content-Type: application/json'
        ];
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

        $ret = new AgIoPayApiRequest;
        $ret->setDateAdd(new \DateTime);

        try {
            $info = $r->getInfo();
            $ret->setEndpoint($info['url'])
                ->setHeaders($headers)
                ->setMethod($info['http_method'])
                ->setBody($bodyData)
                ->setHttpCode($r->getStatusCode())
                ->setTimeSpent($event->getDuration())
                ->setResponse($r->getContent());
        } catch (ServerException $e) {
            $ret->setResponse($r->getContent(false));
        } catch (ClientException $e) {
            $ret->setResponse($r->getContent(false));
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
}