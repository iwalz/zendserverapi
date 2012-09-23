<?php
namespace ZendServerAPI\Factories;

class WebApiVersionFactory
{
    protected $config = null;
    
    public function getCommandFactory()
    {
        if($this->config->getApiVersion() == "1.0")
        {
            return new \ZendServerAPI\Factories\ApiVersion10CommandFactory();
        }
        elseif($this->config->getApiVersion() == "1.1")
        {
            return new \ZendServerAPI\Factories\ApiVersion11CommandFactory();
        }
        elseif($this->config->getApiVersion() == "1.2")
        {
            return new \ZendServerAPI\Factories\ApiVersion12CommandFactory();
        }
    }
    
    public function setConfig($config)
    {
        $this->config = $config;
    }
    
    public function getConfig()
    {
        return $this->config;
    }
}

?>