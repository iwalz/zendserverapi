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
 */

namespace ZendServerAPI;

class Startup
{
    /**
     * Name for the used config section
     * @var string
     */
    protected static $name = null;
    /**
     * Path to config file
     * @var string
     */
    protected static $configPath = null;
    /**
     * Disable logging
     * @var boolean
     */
    protected static $disableLogging = null;

    /**
     * Generate base request based on a config section
     *
     * @param  string                 $name
     * @return \ZendServerAPI\Request
     */
    public static function getRequest($name = null)
    {
        return self::setUpRequest($name);
    }

    /**
     * Configure request object
     *
     * @param  string                 $name
     * @return \ZendServerAPI\Request
     */
    private static function setUpRequest($name = null)
    {
        $request = new Request();

        self::configureApiKey($name, $request);
        self::configureProxy($request);
        self::setUpLogger($request);

        return $request;
    }

    /**
     * Configure request logger
     *
     * @param \ZendServerAPI\Request $request
     */
    private static function setUpLogger(\ZendServerAPI\Request $request)
    {
        if(!is_dir(__DIR__.'/../../logs'))
            mkdir(__DIR__.'/../../logs');

        $validator = new ConfigValidator(self::getConfigPath());
        $conf = $validator->getSettings();

        $filter = new \Zend\Log\Filter\Priority($conf['loglevel']);
        $logger = new \Zend\Log\Logger();

        if (self::$disableLogging) {
            $logWriter = new \Zend\Log\Writer\Mock();
        } else {
            $logWriter = new \Zend\Log\Writer\Stream(__DIR__.'/../../logs/request.log');
        }
        $logWriter->addFilter($filter);
        $logger->addWriter($logWriter);

        $request->setLogger($logger);
    }

    /**
     * Configure the api key for the request
     *
     * @param string                 $name
     * @param \ZendServerAPI\Request $request
     */
    private static function configureApiKey($name, \ZendServerAPI\Request $request)
    {
        if(null === $name)
            self::$name = "general";
        else
            self::$name = $name;

        $validator = new ConfigValidator(self::getConfigPath());
        $conf = $validator->getConfig(self::$name);

        $apiKey = new ApiKey($conf['apiName'], $conf['key'], $conf['state']);
        $config = new Config();
        $config->setHost($conf['host']);
        $config->setPort($conf['port']);
        $config->setApiVersion($conf['version']);
        $config->setApiKey($apiKey);

        $request->setConfig($config);

    }

    private static function configureProxy(\ZendServerAPI\Request $request)
    {
        $validator = new ConfigValidator(self::getConfigPath());
        $conf = $validator->getSettings();
        if (isset($conf['proxyHost'])) {
            $port = isset($conf['proxyPort']) ? $conf['proxyPort'] : 8080;
            $request->getConfig()->setProxyHost($conf['proxyHost']);
            $request->getConfig()->setProxyPort($port);
        }
    }

    /**
     * Set the config path
     *
     * @param string $configPath
     */
    public static function setConfigPath($configPath)
    {
        self::$configPath = $configPath;
    }

    /**
     * Get the config path
     *
     * @return string
     */
    public static function getConfigPath()
    {
        if(null === self::$configPath)
            self::$configPath = __DIR__.'/../../config/config.php';

        return self::$configPath;
    }

    /**
     * Disable logging
     */
    public static function disableLogging()
    {
        self::$disableLogging = true;
    }

    /**
     * Enable logging
     */
    public static function enableLogging()
    {
        self::$disableLogging = false;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public static function getName()
    {
        return self::$name;
    }
}
