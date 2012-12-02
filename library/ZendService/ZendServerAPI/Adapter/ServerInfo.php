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

        $server = new ServerInfoData();
        $server->setId((int) $xml->responseData->serverInfo->id);
        $server->setName((string) $xml->responseData->serverInfo->name);
        $server->setAddress((string) $xml->responseData->serverInfo->address);
        $server->setStatus((string) $xml->responseData->serverInfo->status);

        $messageList = new MessageList();
        if (isset($xml->responseData->serverInfo->messageList->error)) {
            $messageList->setError((string) $xml->responseData->serverInfo->messageList->error);
        }
        if (isset($xml->responseData->serverInfo->messageList->info)) {
            $messageList->setInfo((string) $xml->responseData->serverInfo->messageList->info);
        }
        if (isset($xml->responseData->serverInfo->messageList->warning)) {
            $messageList->setWarning((string) $xml->responseData->serverInfo->messageList->warning);
        }
        $server->setMessageList($messageList);

        return $server;
    }
}
