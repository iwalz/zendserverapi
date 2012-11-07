<?php
/*
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
 */

namespace ZendServerAPI;

class Config
{
    /**
     * Host for the server connection
     * @var string
     */
    protected $host = null;
    /**
     * Port for the connection
     * @var int
     */
    protected $port = '10081';
    /**
     * ApiKey for the current connection
     * @var \ZendServerAPI\ApiKey
     */
    protected $apiKey = null;
    /**
     * Api Version
     * @var string
     */
    protected $apiVersion = null;
    /**
     * Proxy host.
     * @var string
     */
    protected $proxyHost = null;
    /**
     * Proxy port.
     * @var int
     */
    protected $proxyPort = null;


    /**
     * Construct for ZendServerAPI\Config
     */
    public function __construct()
    {

    }

    /**
     * Set the API Version
     *
     * @param string Api Version
     */
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }

    /**
     * Get the api version
     *
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * The api key for the current connection
     *
     * @param \ZendServerAPI\ApiKey $apiKey
     */
    public function setApiKey(ApiKey $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Set the host name for the http connection
     *
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * Port for the connection
     *
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * Get the host for the connection
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Get the port
     *
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Returns the api key
     *
     * @return \ZendServerAPI\ApiKey
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

	/**
     * @return the $proxyHost
     */
    public function getProxyHost()
    {
        return $this->proxyHost;
    }

	/**
     * @return the $proxyPort
     */
    public function getProxyPort()
    {
        return $this->proxyPort;
    }

	/**
     * @param string $proxyHost
     */
    public function setProxyHost($proxyHost)
    {
        $this->proxyHost = $proxyHost;
    }

	/**
     * @param number $proxyPort
     */
    public function setProxyPort($proxyPort)
    {
        $this->proxyPort = $proxyPort;
    }



}
