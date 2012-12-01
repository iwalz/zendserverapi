<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI\Adapter;

use \ZendService\ZendServerAPI\DataTypes\LicenseInfo,
    \ZendService\ZendServerAPI\DataTypes\MessageList as MessageListData,
    \ZendService\ZendServerAPI\DataTypes\SystemInfo as SystemInfoData;

/**
 * MessageList datatype adapter implementation
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class MessageList extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                           $xml
     * @return \ZendService\ZendServerAPI\DataTypes\MessageList
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
