<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI;

/**
 * <b>Request implementation</b>
 *
 * This class represents the http request for the zend server api.
 * Takes care of a method and builds the request from the given information.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Request
{
    /**
     * Method class for the request
     * @var \ZendService\ZendServerAPI\Method\Method
     */
    private $action = null;
    /**
     * Useragent for the request
     * @var string
     */
    private $userAgent = 'Zend HTTP';
    /**
     * Config for the connection
     * @var \ZendService\ZendServerAPI\Config
     */
    private $config = null;
    /**
     * Client to use for real http requests
     * @var \Zend\Http\Client
     */
    private $client = null;
    /**
     * Internal logger
     * @var \Zend\Log\Logger
     */
    private $logger = null;

    /**
     * Set method implementation object
     *
     * @param  \ZendService\ZendServerAPI\Method\Method $action
     * @return \ZendService\ZendServerAPI\Request
     */
    public function setAction(\ZendService\ZendServerAPI\Method\Method $action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Set request logger
     *
     * @param \Zend\Log\Logger $logger
     */
    public function setLogger(\Zend\Log\Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Set the user agent used by the request
     *
     * @param string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * Get the used config object
     *
     * @param \ZendService\ZendServerAPI\Config $config
     */
    public function setConfig(\ZendService\ZendServerAPI\Config $config)
    {
        $this->config = $config;
    }

    /**
     * Return the current action object
     *
     * @return \ZendService\ZendServerAPI\Method\Method
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Returns the user agent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Returns the currently used config
     *
     * @return \ZendService\ZendServerAPI\Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Get request logger
     *
     * @return \Zend\Log\Logger $logger
     */
    public function getLogger()
    {
        if ($this->logger === null) {
            $this->logger = new \Zend\Log\Logger();
            $mockWriter = new \Zend\Log\Writer\Mock();
            $this->logger->addWriter($mockWriter);
        }

        return $this->logger;
    }

    /**
     * Get HTTP client
     *
     * @return \Zend\Http\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the client for requests
     *
     * @param \Zend\Http\Client $client
     */
    public function setClient(\Zend\Http\Client $client)
    {
        $this->client = $client;
    }

    /**
     * This method performs the real REST call
     *
     * @throws \ZendService\ZendServerAPI\Exception\ClientSide
     * @throws \ZendService\ZendServerAPI\Exception\ServerSide
     * @throws \Exception
     */
    public function send()
    {
        if (!$this->client) {

            if ($this->config->getProxyHost() !== null) {
                $options = array_merge(
                        array('curl.options' =>
                                array(CURLOPT_PROXY => 'http://'.$this->config->getProxyHost().':'.$this->config->getProxyPort())
                        ), $options
                );
            }

            $this->client = new \Zend\Http\Client();
        }
        
        $host = $this->config->getProtocol() . '://' . 
            $this->config->getHost() . ':' . $this->config->getPort();
        $request = $this->client->getRequest();
        $request->setUri($host . $this->action->getLink());
        $header = $request->getHeaders();
        
        if ($this->action->getMethod() === 'GET') {
            $request->setMethod('GET');
        } elseif ($this->action->getMethod() === 'POST') {
            $request->setMethod('POST');
            $content = $this->action->getContent();
            $request->setContent($content);
            if(strlen($content) > 0) {
                $header->addHeaderLine('Content-Type', $this->action->getContentType());
                $header->addHeaderLine('Content-Length', strlen($this->action->getContent()));
            }
        }

        $postFiles = $this->action->getPostFiles();
        if (count($postFiles) > 0) {
            foreach ($postFiles as $field => $postValue) {
                $fileName = $postValue['fileName'];
                $contentType = $postValue['contentType'];
                $this->client->setFileUpload($fileName, $field, file_get_contents($fileName), $contentType);
            }
        }

        $contentValues = $this->getAction()->getContentValues();
        if (count($contentValues) > 0) {
            $this->client->setParameterPost($contentValues);
        }
        

        $header->addHeaderLine('X-Zend-Signature', $this->config->getApiKey()->getName().';'.$this->generateRequestSignature($this->getDate()));
        $header->addHeaderLine('Accept', $this->action->getAcceptHeader());
        $header->addHeaderLine('Date', $this->getDate());
        $header->addHeaderLine('User-Agent', $this->userAgent);
        $request->setHeaders($header);
        
        /* @var \Guzzle\Http\Message\Request $requests */
//         $requests->setHeader('X-Zend-Signature', $this->config->getApiKey()->getName().';'.$this->generateRequestSignature($this->getDate()));
//         $requests->setHeader('Accept', $this->action->getAcceptHeader());
//         $requests->setHeader('lookInCupboard', 'true');
//         $requests->setHeader('Date', $this->getDate());
//         $requests->setHeader('User-Agent', $this->userAgent);
//         $requests->removeHeader('Expect');

        $this->getLogger()->debug($request);
        foreach ($this->getAction()->getContentValues() as $key => $value) {
            $this->getLogger()->debug($key . ': ' . $value);
        }

        try {
            $response = $this->client->send($request);
            $this->getLogger()->debug($response);
            $this->getAction()->setResponse($response);
            
            $statusCode = $response->getStatusCode();
            if($statusCode >= 400 && $statusCode <= 499)
                throw new Exception\ClientSide($response->getBody(), $statusCode);
            elseif($statusCode >= 500 && $statusCode <= 599)
                throw new Exception\ServerSide($response->getBody(), $statusCode);
            
        } catch (\Zend\Http\Exception\ExceptionInterface $exception) {
            $this->getLogger()->err($exception->getMessage());
            var_dump($exception->getMessage());
            /* @var \Zend\Http\Exception\ExceptionInterface $exception */
            if ($exception->getMessage() !== null) {
                $statusCode = $exception->getCode();
                if($statusCode >= 400 && $statusCode <= 499)
                    throw new Exception\ClientSide($exception->getMessage(), $exception->getCode());
                elseif($statusCode >= 500 && $statusCode <= 599)
                throw new Exception\ServerSide($exception->getMessage(), $exception->getCode());
                else
                    throw new \InvalidArgumentException($exception->getMessage(), $exception->getCode());
            } else {
                throw $exception;
            }
        }

        return $this->getAction()->parseResponse();
    }

    /**
     * Get a special formatted date string, needed by the server api
     *
     * @return string
     */
    private function getDate()
    {
        $date = gmdate('D, d M Y H:i:s e');
        $date = str_replace('UTC', 'GMT', $date);

        return $date;
    }

    /**
     * Calculate the request signature used for authentification
     *
     * @param  string $date
     * @return string
     */
    private function generateRequestSignature($date)
    {
        $data = $this->config->getHost() . ":".$this->config->getPort().":" .
                $this->action->getFunctionPath() . ":" .
                $this->userAgent . ":" .
                $date;

        return hash_hmac('sha256', $data, $this->config->getApiKey()->getKey());
    }
}
