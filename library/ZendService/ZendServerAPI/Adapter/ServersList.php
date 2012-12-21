<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\Adapter;

use ZendService\ZendServerAPI\DataTypes\ServerInfo as ServerInfoData,
    ZendService\ZendServerAPI\DataTypes\MessageList as MessageListType,
    ZendService\ZendServerAPI\DataTypes\ServersList as ServersListData;

/**
 * ServersList datatype adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ServersList extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                           $xml
     * @return \ZendService\ZendServerAPI\DataTypes\ServersList
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $this->setContent($xml);
        
        $xmlServersList = $this->getElements("//serverInfo");

        $serversList = new ServersListData();

        foreach ($xmlServersList as $serverInfo) {
            $server = new ServerInfoData();
            $server->setId((int) $serverInfo->id);
            $server->setName((string) $serverInfo->name);
            $server->setAddress((string) $serverInfo->address);
            $server->setStatus((string) $serverInfo->status);

            $messageList = new MessageListType();
            $messageList->setError((string) $serverInfo->messageList->error);
            $messageList->setInfo((string) $serverInfo->messageList->info);
            $messageList->setWarning((string) $serverInfo->messageList->warning);
            $server->setMessageList($messageList);

            $serversList->addServerInfo($server);
        }

        return $serversList;
    }
}
