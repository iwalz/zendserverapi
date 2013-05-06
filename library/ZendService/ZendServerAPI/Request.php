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

use Zend\Http\Headers;
use Zend\Log\LoggerAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZendService\ZendServerAPI\Method\ZS6LinkBreakInterface;
use ZendService\ZendServerAPI\Method\ZS6VersionBreakInterface;

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
class Request implements ServiceLocatorAwareInterface, LoggerAwareInterface, PluginInterface
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
     * Adapter for testing
     * @var \Zend\Http\Client\Adapter\AdapterInterface
     */
    private $adapter = null;
    /**
     * The service locator
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
    private $sl = null;

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
     * @param \Zend\Log\LoggerInterface $logger
     */
    public function setLogger(\Zend\Log\LoggerInterface $logger)
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
        if($this->config === null)
            $this->config = $this->sl->get("config");

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
     * Set an adapter to the Zend Http Client.
     * Most likely for testing
     *
     * @param  \Zend\Http\Client\Adapter\AdapterInterface $adapter
     * @return void
     */
    public function setClientAdapter(\Zend\Http\Client\Adapter\AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Get the Zend Http Client adapter interface
     *
     * @return \Client\Adapter\AdapterInterface|null
     */
    public function getClientAdapter()
    {
        return $this->adapter;
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
            $this->client = $this->sl->get("http_client");

            if ($this->adapter !== null) {
                $this->client->setAdapter($this->adapter);
            }
        } else {
            $this->client->resetParameters();
        }

        if($this->config === null)
            $this->config = $this->sl->get("config");

        if ($this->config->getApiVersion() == \ZendService\ZendServerAPI\Version::ZS6) {
            if ($this->action instanceof ZS6LinkBreakInterface) {
                $this->action->enableZS6Link();
            }
        }

        // prepare the request & set headers
        $request = $this->client->getRequest();
        $this->prepareRequest($request);
        $header = $request->getHeaders();
        $request->setHeaders($this->addHeaders($header));
        $request->setMethod($this->action->getMethod());

        if ($this->action->getMethod() === 'POST') {

            $request->setMethod('POST');
            $content = $this->action->getContent();
            $request->setContent($content);

            // prepare statement for file upload
            $postFiles = $this->action->getPostFiles();
            if (count($postFiles) > 0) {
                foreach ($postFiles as $field => $postValue) {
                    $fileName = $postValue['fileName'];
                    $contentType = $postValue['contentType'];
                    $this->client->setFileUpload(
                            $fileName, $field, file_get_contents($fileName), $contentType
                    );
                }
                $this->client->setEncType($this->action->getContentType(), 'bla');

            } else {
                $this->client->setEncType($this->action->getContentType());
            }

            $contentValues = $this->getAction()->getContentValues();
            if (count($contentValues) > 0) {
                $this->client->setParameterPost($contentValues);
            }

        }

        $this->getLogger()->debug($request);
        foreach ($this->getAction()->getContentValues() as $key => $value) {
            if(!is_array($value))
                $this->getLogger()->debug($key . ': ' . $value);
        }

        try {
            // Perform the request and validate the response
            $this->client->setRequest($request);
            $response = $this->client->send();
            $this->getLogger()->debug($response);
            $this->getAction()->setResponse($response);

            $statusCode = $response->getStatusCode();

            if($statusCode >= 400 && $statusCode <= 499)
                throw new Exception\ClientSide($response->getBody(), $statusCode);
            elseif($statusCode >= 500 && $statusCode <= 599)
                throw new Exception\ServerSide($response->getBody(), $statusCode);

        } catch (\Zend\Http\Exception\ExceptionInterface $exception) {
            $this->getLogger()->err($exception->getMessage());
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
     * Prepare the request
     *
     * @param  \Zend\Http\Request $request
     * @return \Zend\Http\Request
     */
    private function prepareRequest(\Zend\Http\Request $request)
    {
        $request->getUri()->setHost($this->config->getHost());
        $request->getUri()->setPort($this->config->getPort());
        $scheme = $this->config->getProtocol();
        $request->getUri()->setScheme($scheme);
        if ($scheme == "https") {
            $this->client->setOptions(array(
                    'adapter'      => 'Zend\Http\Client\Adapter\Socket',
                    'ssltransport' => 'tls',
                    'sslverify_peer' => false
            ));
        }
        $request->getUri()->setScheme($this->config->getProtocol());
        $request->getUri()->setPath($this->getBasePath() . $this->action->getLink());

        return $request;
    }

    /**
     * Returns the base path to ZendServer GUI.
     *
     * @return string
     */
    public function getBasePath()
    {
        if ($this->config->getApiVersion() >= Version::ZS6  ) {

            return '/ZendServer';
        }

        return '/ZendServerManager';
    }

    /**
     * Set the headers
     *
     * @param  \Zend\Http\Headers $header
     * @return \Zend\Http\Headers
     */
    private function addHeaders(Headers $header)
    {
        $header->addHeaderLine('Host', $this->config->getHost() . ':' . $this->config->getPort());
        $header->addHeaderLine('X-Zend-Signature', $this->config->getApiKey()->getName().';'.$this->generateRequestSignature($this->getDate()));
        if ($this->config->getApiVersion() >= Version::ZS6 && $this->action instanceof ZS6VersionBreakInterface) {
            $header->addHeaderLine('Accept', $this->action->getZS6Version());
        } else {
            $header->addHeaderLine('Accept', $this->action->getAcceptHeader());
        }
        $header->addHeaderLine('Date', $this->getDate());
        $header->addHeaderLine('User-Agent', $this->userAgent);

        return $header;
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
                $this->getBasePath() .
                $this->action->getFunctionPath() . ":" .
                $this->userAgent . ":" .
                $date;

        return hash_hmac('sha256', $data, $this->config->getApiKey()->getKey());
    }

    /**
     * Set the service manager
     *
     * @param \Zend\ServiceManager\ServiceLocatorInterface
     * @return void
     */
    public function setServicelocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->sl = $serviceLocator;
    }

    /**
     * @return null|\Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->sl;
    }
}
