<?php
namespace ZendServerAPI\Method;
use ZendServerAPI\DataTypes\ServersList,
    ZendServerAPI\DataTypes\ServerInfo,
    ZendServerAPI\DataTypes\MessageList;

class ClusterGetServerStatus  extends \ZendServerAPI\Method
{
    public function configure()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/clusterGetServerStatus');
    }
    
    public function parseResponse($xml)
    {
        $xml = simplexml_load_string($xml);
        
        $serversList = new ServersList();

        foreach($xml->responseData->serversList->serverInfo as $serverInfo)
        {
            $server = new ServerInfo();
            $server->setId(
                    (int)$serverInfo->id
            );
            $server->setName(
                    (string)$serverInfo->name
            );
            $server->setAddress(
                    (string)$serverInfo->address
            );
            $server->setStatus(
                    (string)$serverInfo->status
            );

            $messageList = new MessageList();
            $messageList->setError(
                    (string)$serverInfo->messageList->error
            );
            $messageList->setInfo(
                    (string)$serverInfo->messageList->info
            );
            $messageList->setWarning(
                    (string)$serverInfo->messageList->warning
            );
            $server->setMessageList($messageList);
            
            $serversList->addServerInfo($server);
        }
        
        return $serversList;
    }
}

?>