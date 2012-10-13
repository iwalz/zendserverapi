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

class ConfigValidator
{
    /**
     * The config for the connections
     * @var array
     */
    private $config = null;
    /**
     * Path to config
     * @var string
     */
    private $fileName = null;

    /**
     * Constructor for ConfigValidation
     *
     * @param string $fileName
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
        $this->config = include $fileName;
    }

    /**
     * Get the config array
     *
     * @param  string $name Name for the current config
     * @return array
     */
    public function getConfig($name)
    {
        $this->validate($name);

        return $this->config['servers'][$name];
    }

    /**
     * Get settings array
     *
     * @return array
     */
    public function getSettings()
    {
        $this->validateSettings($this->config);

        return $this->config['settings'];
    }

    /**
     * Test for existing settings section and valid values
     *
     * @throws \RuntimeException If settings section is missing
     */
    private function validateSettings(&$config)
    {
        if(!isset($config['settings']))
            throw new \RuntimeException('settings section in config file is missing');

        if (isset($config['settings']['loglevel'])) {
            $validEntries = array(
                    \Zend\Log\Logger::ALERT,
                    \Zend\Log\Logger::CRIT,
                    \Zend\Log\Logger::DEBUG,
                    \Zend\Log\Logger::EMERG,
                    \Zend\Log\Logger::ERR,
                    \Zend\Log\Logger::INFO,
                    \Zend\Log\Logger::NOTICE,
                    \Zend\Log\Logger::WARN);

            if (!in_array($config['settings']['loglevel'], $validEntries, true)) {
                throw new \RuntimeException($config['settings']['loglevel'] . ' is not a valid entry for the loglevel');
            }
        } else {
            $config['settings']['loglevel'] = \Zend\Log\Logger::CRIT;
        }
    }

    /**
     * Validate all required parameters for the Zend Server API connection
     *
     * @param  string                    $name Name for the config section to use
     * @throws \InvalidArgumentException If error in config array
     */
    private function validate($name)
    {
        // Couldn't parse config
        if(!isset($this->config['servers'][$name]))
            throw new \InvalidArgumentException("Configuration part '".$name."' not found in: " . $this->fileName);

        // Check for apikeys in the configfile
        if(
                isset($this->config['servers'][$name]['fullApiKey']) &&
                $this->config['servers'][$name]['fullApiKey'] !== ""
        )
        {
            $state = ApiKey::FULL;
            $key = $this->config['servers'][$name]['fullApiKey'];
        } elseif(
                isset($this->config['servers'][$name]['readApiKey']) &&
                $this->config['servers'][$name]['readApiKey'] !== ""
        )
        {
            $state = ApiKey::READONLY;
            $key = $this->config['servers'][$name]['readApiKey'];
        } else
            throw new \InvalidArgumentException($name . " does not seem to have an apikey included");

        $this->checkForValidAPIKey($key);

         $this->config['servers'][$name]['key'] = $key;
         $this->config['servers'][$name]['state'] = $state;

         if(
                 !isset($this->config['servers'][$name]['apiName']) ||
                 !$this->config['servers'][$name]['apiName']
            )
             throw new \InvalidArgumentException("apiName is not part of the config from " . $name);

         if(
                 !isset($this->config['servers'][$name]['host']) ||
                 !$this->config['servers'][$name]['host']
         )
             throw new \InvalidArgumentException("host not specified in " . $name);
    }

    /**
     * api key value validation
     *
     * @param  string                    $apiKey
     * @throws \InvalidArgumentException
     */
    private function checkForValidAPIKey($apiKey)
    {
        // Check invalid characters
        $invalidCharacters = array(
                '(',
                ')',
                '<',
                '>',
                ',',
                ';',
                ':',
                '\\',
                ',',
                '/',
                '[',
                ']',
                '?',
                '=',
                '{',
                '}'
        );

        foreach ($invalidCharacters as $invalidCharacter) {
            if(strpos($apiKey, $invalidCharacter) !== FALSE)
                throw new \InvalidArgumentException("Character '".$invalidCharacter."' detected in API Key");
        }

        // Check size
        if(strlen($apiKey) !== 64)
            throw new \InvalidArgumentException("API Key must contains 64 characters");
    }

}
