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

use \ZendService\ZendServerAPI\DataTypes\MessageList,
    \ZendService\ZendServerAPI\DataTypes\ServerInfo as ServerInfoData;

/**
 * ServerInfo datatype adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ServerInfo extends \ZendService\ZendServerAPI\Adapter\Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                          $xml
     * @return \ZendService\ZendServerAPI\DataTypes\ServerInfo
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $this->setContent($xml);
        
        $xmlServerInfo = $this->getElement("//serverInfo");

        $server = new ServerInfoData();
        $server->setId((int) $xmlServerInfo->id);
        $server->setName((string) $xmlServerInfo->name);
        $server->setAddress((string) $xmlServerInfo->address);
        $server->setStatus((string) $xmlServerInfo->status);

        $messageList = new MessageList();
        if (isset($xmlServerInfo->messageList->error)) {
            $messageList->setError((string) $xmlServerInfo->messageList->error);
        }
        if (isset($xmlServerInfo->messageList->info)) {
            $messageList->setInfo((string) $xmlServerInfo->messageList->info);
        }
        if (isset($xmlServerInfo->messageList->warning)) {
            $messageList->setWarning((string) $xmlServerInfo->messageList->warning);
        }
        $server->setMessageList($messageList);

        return $server;
    }
}
