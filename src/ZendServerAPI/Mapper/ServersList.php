<?php
namespace ZendServerAPI\Mapper;

use ZendServerAPI\DataTypes\ServerInfo as ServerInfoData,
    ZendServerAPI\DataTypes\MessageList,
    ZendServerAPI\DataTypes\ServersList as ServersListData;

class ServersList extends Mapper
{
    /**
     * @see \ZendServerAPI\Mapper\Mapper::parse()
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $serversList = new ServersListData();

        foreach ($xml->responseData->serversList->serverInfo as $serverInfo) {
            $server = new ServerInfoData();
            $server->setId((int) $serverInfo->id);
            $server->setName((string) $serverInfo->name);
            $server->setAddress((string) $serverInfo->address);
            $server->setStatus((string) $serverInfo->status);

            $messageList = new MessageList();
            $messageList->setError((string) $serverInfo->messageList->error);
            $messageList->setInfo((string) $serverInfo->messageList->info);
            $messageList->setWarning((string) $serverInfo->messageList->warning);
            $server->setMessageList($messageList);

            $serversList->addServerInfo($server);
        }

        return $serversList;
    }
}
