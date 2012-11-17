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

/**
 * <b>Class for server configuration</b>
 *
 * <pre>This is the config model, that is parsed from config.php.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI
 */
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
     * @var ApiKey
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
     * Protocol (http/https)
     * @var string
     */
    protected $protocol = null;

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
     * @param ApiKey $apiKey
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
        $this->port = (int)$port;
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
     * @return ApiKey
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Return the host that is used to proxy the connection
     *
     * @return string
     */
    public function getProxyHost()
    {
        return $this->proxyHost;
    }

    /**
     * Set the proxy port
     *
     * @return int
     */
    public function getProxyPort()
    {
        return $this->proxyPort;
    }
    
    /**
     * Get the protocol (http/https)
     * 
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Set the host to proxy the requests
     *
     * @param  string $proxyHost
     * @return void
     */
    public function setProxyHost($proxyHost)
    {
        $this->proxyHost = $proxyHost;
    }

    /**
     * Set the proxy port
     *
     * @param int
     */
    public function setProxyPort($proxyPort)
    {
        $this->proxyPort = (int) $proxyPort;
    }
    
    /**
     * Set the protocol (http/https)
     * 
     * @param string
     * @return void
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }
    

}
