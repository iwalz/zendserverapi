<?php
namespace ZendServerAPI;

class ConfigValidator
{
    private $ini = null;
    private $fileName = null;
    
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
        $this->ini = \Zend\Config\Factory::fromFile($this->fileName);
    }
    
    public function getConfig($name)
    {
        $this->validate($name);    
        return $this->ini[$name];
    }
    
    private function validate($name)
    {
        // Couldn't parse config
        if(!isset($this->ini[$name]))
            throw new \InvalidArgumentException("Configuration part '".$name."' not found in: " . $this->fileName);
        
        // Check for apikeys in the configfile
        if(
                isset($this->ini[$name]['fullApiKey']) &&
                $this->ini[$name]['fullApiKey'] !== ""
        )
        {
            $state = ApiKey::FULL;
            $key = $this->ini[$name]['fullApiKey'];
        }
        elseif(
                isset($this->ini[$name]['readApiKey']) &&
                $this->ini[$name]['readApiKey'] !== ""
        )
        {
            $state = ApiKey::READONLY;
            $key = $this->ini[$name]['readApiKey'];
        }
        else
            throw new \InvalidArgumentException($name . " does not seem to have an apikey included");
        
        $this->checkForValidAPIKey($key);
        
         $this->ini[$name]['key'] = $key;
         $this->ini[$name]['state'] = $state;
         
         if(!isset($this->ini[$name]['apiName']))
             throw new \InvalidArgumentException("apiName is not part of the config from " . $name);
    }
    
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
        
        foreach($invalidCharacters as $invalidCharacter)
        {
            if(strpos($apiKey, $invalidCharacter) !== FALSE)
                throw new \InvalidArgumentException("Character '".$invalidCharacter."' detected in API Key");
        }
        
        // Check size
        if(strlen($apiKey) !== 64)
            throw new \InvalidArgumentException("API Key must contains 64 characters");
    }
    
}

?>