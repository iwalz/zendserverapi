<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\Factories;

/**
 * Factory for the WebApiVersionFactories.
 * Gets a config object injected to identify the version
 * and returns the correct factory for this version
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class WebApiVersionFactory
{
    /**
     * Config object for that request
     * @var \ZendService\ZendServerAPI\Config
     */
    protected $config = null;

    /**
     * Get the Command factory for the corrent webapi version.
     * If config object is null, it will return the first version 1.0
     *
     * @return \ZendService\ZendServerAPI\Factories\CommandFactory
     */
    public function getCommandFactory()
    {
        if($this->config === null ||
           $this->config->getApiVersion() == "1.0") {
            return new  \ZendService\ZendServerAPI\Factories\ApiVersion10CommandFactory();
        } elseif ($this->config->getApiVersion() == "1.1") {
            return new  \ZendService\ZendServerAPI\Factories\ApiVersion11CommandFactory();
        } elseif ($this->config->getApiVersion() == "1.2") {
            return new  \ZendService\ZendServerAPI\Factories\ApiVersion12CommandFactory();
        }
    }

    /**
     * Set the config
     *
     * @param  \ZendService\ZendServerAPI\Config $config
     * @return void
     */
    public function setConfig(\ZendService\ZendServerAPI\Config $config)
    {
        $this->config = $config;
    }

    /**
     * Get the config
     *
     * @return \ZendService\ZendServerAPI\Config
     */
    public function getConfig()
    {
        return $this->config;
    }
}
