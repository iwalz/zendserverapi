<?php
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

        return $this->config[$name];
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
        if(!isset($this->config[$name]))
            throw new \InvalidArgumentException("Configuration part '".$name."' not found in: " . $this->fileName);

        // Check for apikeys in the configfile
        if(
                isset($this->config[$name]['fullApiKey']) &&
                $this->config[$name]['fullApiKey'] !== ""
        )
        {
            $state = ApiKey::FULL;
            $key = $this->config[$name]['fullApiKey'];
        } elseif(
                isset($this->config[$name]['readApiKey']) &&
                $this->config[$name]['readApiKey'] !== ""
        )
        {
            $state = ApiKey::READONLY;
            $key = $this->config[$name]['readApiKey'];
        } else
            throw new \InvalidArgumentException($name . " does not seem to have an apikey included");

        $this->checkForValidAPIKey($key);

         $this->config[$name]['key'] = $key;
         $this->config[$name]['state'] = $state;

         if(
                 !isset($this->config[$name]['apiName']) ||
                 !$this->config[$name]['apiName']
            )
             throw new \InvalidArgumentException("apiName is not part of the config from " . $name);

         if(
                 !isset($this->config[$name]['host']) ||
                 !$this->config[$name]['host']
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
