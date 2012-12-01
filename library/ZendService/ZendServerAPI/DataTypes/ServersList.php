<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI\DataTypes;

/**
 * ServersList model implementation.
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class ServersList extends DataType implements \Countable, \IteratorAggregate
{
    /**
     * Internal container for ServerInfo storage
     * @var array
     */
    private $serverInfos = array();

    /**
     * Get the internal ServerInfo container
     *
     * @return array
     */
    public function getServerInfos()
    {
        return $this->serverInfos;
    }

    /**
     * Set ServerInfo container
     *
     * @param  array $serverInfos
     * @return void
     */
    public function setServerInfos(array $serverInfos)
    {
        $this->serverInfos = $serverInfos;
    }

    /**
     * Add ServerInfo to container
     *
     * @param  ServerInfo $serverInfo
     * @return void
     */
    public function addServerInfo(\ZendService\ZendServerAPI\DataTypes\ServerInfo $serverInfo)
    {
        $this->serverInfos[] = $serverInfo;
    }

    /**
     * Returns the ServerInfo by a given Zend Server ID
     *
     * @param  int                                                   $serverId
     * @return \ZendService\ZendServerAPI\DataTypes\ServerInfo|false
     */
    public function getServerStatusById($serverId)
    {
        foreach ($this->serverInfos as $serverInfo) {
            if($serverInfo->getId() === $serverId)

                return $serverInfo;
        }

        return false;
    }

    /**
     * Returns the ServerInfo by a given Zend Server Name
     *
     * @param  string                                                $serverName
     * @return \ZendService\ZendServerAPI\DataTypes\ServerInfo|false
     */
    public function getServerStatusByName($serverName)
    {
        foreach ($this->serverInfos as $serverInfo) {
            if($serverInfo->getName() === $serverName)

                return $serverInfo;
        }

        return false;
    }

    /**
     * Returns the first ServerInfo object
     *
     * @return \ZendService\ZendServerAPI\DataTypes\ServerInfo
     */
    public function getFirst()
    {
       if(count($this->serverInfos) === 0)
           throw new \Exception("No server in list");

       return $this->serverInfos[0];
    }

    /**
     * Implementation for traversable
     *
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new \ArrayIterator($this->serverInfos);
    }

    /**
     * Implementation for countable
     *
     * @see Countable::count()
     * @return void
     */
    public function count ()
    {
        return count($this->getIterator());
    }
}
