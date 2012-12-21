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

/**
 * CodetracingList datatype adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class CodetracingList extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                               $xml
     * @return \ZendService\ZendServerAPI\DataTypes\CodetracingList
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $this->setContent($xml);
        
        $xmlTraceList = $this->getElements("//codeTrace");

        $codetracingList = new  \ZendService\ZendServerAPI\DataTypes\CodetracingList();
        foreach ($xmlTraceList as $xmlCodetrace) {
            $codetrace = new  \ZendService\ZendServerAPI\DataTypes\CodeTrace();
            $codetrace->setId((string) $xmlCodetrace->id);
            $codetrace->setDate((string) $xmlCodetrace->date);
            $codetrace->setUrl((string) $xmlCodetrace->url);
            $codetrace->setCreatedBy((string) $xmlCodetrace->createdBy);
            $codetrace->setFileSize((string) $xmlCodetrace->fileSize);
            $codetrace->setApplicationId((string) $xmlCodetrace->applicationId);

            $codetracingList->addCodeTrace($codetrace);
        }

        return $codetracingList;
    }
}
