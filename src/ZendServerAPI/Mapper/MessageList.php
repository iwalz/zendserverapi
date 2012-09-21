<?php
namespace ZendServerAPI\Mapper;

use \ZendServerAPI\DataTypes\LicenseInfo,
    \ZendServerAPI\DataTypes\MessageList as MessageListData,
    \ZendServerAPI\DataTypes\SystemInfo as SystemInfoData;

class MessageList extends Mapper
{
    /**
     * @see \ZendServerAPI\Mapper\Mapper::parse()
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $messageList = new MessageListData();
        if(isset($xml->error))
            $messageList->setError((string) $xml->error);
        if(isset($xml->info))
            $messageList->setInfo((string) $xml->info);
        if(isset($xml->warning))
            $messageList->setWarning((string) $xml->warning);

        return $messageList;
    }
}
