<?php
/**
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * <http://www.rubber-duckling.net>
 * 
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI
 */

namespace ZendServerAPI;

use Guzzle\Service\Client;

/**
 * <b>Request implementation</b>
 *
 * This class represents the guzzle request for the zend server api.
 * Takes care of a method and builds the request from the given information.
 * 
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI
 */
class Request
{
    /**
     * Method class for the request
     * @var \ZendServerAPI\Method
     */
    private $action = null;
    /**
     * Useragent for the request
     * @var string
     */
    private $userAgent = 'Guzzle';
    /**
     * Config for the connection
     * @var \ZendServerAPI\Config
     */
    private $config = null;
    /**
     * Client to use for real http requests
     * @var \Guzzle\Http\Client
     */
    private $client = null;
    /**
     * Internal logger
     * @var \Zend\Log\Logger
     */
    private $logger = null;

    /**
     * Constructor for the request class
     */
    public function __construct()
    {

    }

    /**
     * Set method implementation object
     *
     * @param  \ZendServerAPI\Method  $action
     * @return \ZendServerAPI\Request
     */
    public function setAction(\ZendServerAPI\Method $action)
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
     * @param \ZendServerAPI\Config $config
     */
    public function setConfig(\ZendServerAPI\Config $config)
    {
        $this->config = $config;
    }

    /**
     * Return the current action object
     *
     * @return \ZendServerAPI\Method
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
     * @return \ZendServerAPI\Config
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
     * @return \Guzzle\Http\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the client for requests
     *
     * @param \Guzzle\Http\Client $client
     */
    public function setClient(\Guzzle\Http\Client $client)
    {
        $this->client = $client;
    }

    /**
     * This method performs the real REST call
     *
     * @throws \ZendServerAPI\Exception\ClientSide
     * @throws \ZendServerAPI\Exception\ServerSide
     * @throws \Exception
     */
    public function send()
    {
        if (!$this->client) {
            $options = array(
                            'host' => $this->config->getHost(),
                            'port' => $this->config->getPort(),
                            'protocol' => $this->config->getPort());

            if ($this->config->getProxyHost() !== null) {
                $options = array_merge(
                        array('curl.options' =>
                                array(CURLOPT_PROXY => 'http://'.$this->config->getProxyHost().':'.$this->config->getProxyPort())
                        ), $options
                );
            }

            $this->client = new Client(
                    '{protocol}://{host}:{port}', $options
            );
        }

        if ($this->action->getMethod() === 'GET') {
            $requests = $this->client->get($this->action->getLink());
        } elseif ($this->action->getMethod() === 'POST') {
            $content = $this->action->getContent();

            $requests = $this->client->post(
                    $this->action->getLink(),
                    array(
                            'Content-length' => strlen($content),
                            'Content-type' => $this->action->getContentType()
                    ),
                    $content
            );

        }

        $postFiles = $this->action->getPostFiles();
        if (count($postFiles) > 0) {
            foreach ($postFiles as $field => $postValue) {
                $fileName = $postValue['fileName'];
                $contentType = $postValue['contentType'];
                $requests->addPostFile($field, $fileName, $contentType);
            }
        }

        $contentValues = $this->getAction()->getContentValues();
        if (count($contentValues) > 0) {
                $requests->addPostFields($contentValues);
        }

        /*
         * @var \Guzzle\Http\Message\Request $requests
         */
        $requests->setHeader('X-Zend-Signature', $this->config->getApiKey()->getName().';'.$this->generateRequestSignature($this->getDate()));
        $requests->setHeader('Accept', $this->action->getAcceptHeader());
        $requests->setHeader('lookInCupboard', 'true');
        $requests->setHeader('Date', $this->getDate());
        $requests->setHeader('User-Agent', $this->userAgent);
        $requests->setHeader('Expect', '');

        $this->getLogger()->debug($requests);

        try {
            $response = $this->client->send($requests);
            $this->getLogger()->debug($response);

            $this->getAction()->setResponse($response);
        } catch (\Guzzle\Http\Exception\CurlException $exception) {
            $this->getLogger()->err($exception->getMessage());
            throw $exception;
        } catch (\Guzzle\Http\Exception\BadResponseException $exception) {
            $this->getLogger()->err($exception->getMessage());

            if ($exception->getResponse() !== null) {
                $statusCode = $exception->getResponse()->getStatusCode();
                if($statusCode >= 400 && $statusCode <= 499)
                    throw new Exception\ClientSide($exception->getResponse()->getBody(), $statusCode);
                elseif($statusCode >= 500 && $statusCode <= 599)
                    throw new Exception\ServerSide($exception->getResponse()->getBody(), $statusCode);
                else
                    throw new \InvalidArgumentException($exception->getResponse()->getBody(), $statusCode);
            } elseif ($exception->getMessage() !== null) {
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
