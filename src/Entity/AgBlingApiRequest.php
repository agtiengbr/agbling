<?php
namespace AGTI\Bling\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class AgBlingApiRequest
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id_ag_bling_request")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="endpoint", type="string")
     */
    private $endpoint;

    /**
     * @var string
     *
     * @ORM\Column(name="headers", type="array")
     */
    private $headers;

    /**
     * @var string
     *
     * @ORM\Column(type="array")
     */
    private $headersResponse;

    /**
     * @var string
     *
     * @ORM\Column(name="method", type="string")
     */
    private $method;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="json")
     */
    private $body;

    /**
     * @var int
     *
     * @ORM\Column(name="http_code", type="integer")
     */
    private $httpCode;

    /**
     * @var string
     *
     * @ORM\Column(name="response", type="string")
     */
    private $response;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $dateAdd;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $timeSpent;

    /**
     * @ORM\Column(type="string")
     */
    private $stackTrace;

    /************* GETTERS AND SETTERS *********************/
    /**
     * Get the value of body
     */ 
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @return  self
     */ 
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of httpCode
     */ 
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * Set the value of httpCode
     *
     * @return  self
     */ 
    public function setHttpCode($httpCode)
    {
        $this->httpCode = $httpCode;

        return $this;
    }

    /**
     * Get the value of response
     */ 
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set the value of response
     *
     * @return  self
     */ 
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get the value of dateAdd
     */ 
    public function getDateAdd()
    {
        return $this->dateAdd;
    }

    /**
     * Set the value of dateAdd
     *
     * @return  self
     */ 
    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Get the value of timeSpent
     */ 
    public function getTimeSpent()
    {
        return $this->timeSpent;
    }

    /**
     * Set the value of timeSpent
     *
     * @return  self
     */ 
    public function setTimeSpent($timeSpent)
    {
        $this->timeSpent = $timeSpent;

        return $this;
    }

    /**
     * Get the value of method
     */ 
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the value of method
     *
     * @return  self
     */ 
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get the value of headers
     */ 
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set the value of headers
     *
     * @return  self
     */ 
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get the value of endpoint
     */ 
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Set the value of endpoint
     *
     * @return  self
     */ 
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Get the value of stackTrace
     */ 
    public function getStackTrace()
    {
        return $this->stackTrace;
    }

    /**
     * Set the value of stackTrace
     *
     * @return  self
     */ 
    public function setStackTrace($stackTrace)
    {
        $this->stackTrace = $stackTrace;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of headersResponse
     */ 
    public function getHeadersResponse()
    {
        return $this->headersResponse;
    }

    /**
     * Set the value of headersResponse
     *
     * @param   $headersResponse
     *
     * @return  self
     */ 
    public function setHeadersResponse($headersResponse)
    {
        $this->headersResponse = $headersResponse;

        return $this;
    }
}