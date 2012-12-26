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
 * ApplicationList datatype adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Codetrace extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                         $xml
     * @return \ZendService\ZendServerAPI\DataTypes\CodeTrace
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $this->setContent($xml);

        $xmlTrace = $this->getElement("//codeTrace");

        $codetrace = new  \ZendService\ZendServerAPI\DataTypes\CodeTrace();
        $codetrace->setId((string) $xmlTrace->id);
        $codetrace->setDate((string) $xmlTrace->date);
        $codetrace->setUrl((string) $xmlTrace->url);
        $codetrace->setCreatedBy((string) $xmlTrace->createdBy);
        $codetrace->setFileSize((string) $xmlTrace->fileSize);
        $codetrace->setApplicationId((string) $xmlTrace->applicationId);

        return $codetrace;
    }
}
