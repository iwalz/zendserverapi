<?php
namespace ZendServerAPI\Mapper;

use \ZendServerAPI\DataTypes\MessageList,
    \ZendServerAPI\DataTypes\ServerInfo as ServerInfoData;

class ServerInfo extends \ZendServerAPI\Mapper\Mapper
{
    /**
     * @see \ZendServerAPI\Mapper\Mapper::parse()
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
