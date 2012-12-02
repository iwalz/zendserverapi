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

/**
 * ApplicationList datatype adapter implementation
 *
 * @license	    http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
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
        $codetrace = new  \ZendService\ZendServerAPI\DataTypes\CodeTrace();
        $codetrace->setId((string) $xml->responseData->codeTrace->id);
        $codetrace->setDate((string) $xml->responseData->codeTrace->date);
        $codetrace->setUrl((string) $xml->responseData->codeTrace->url);
        $codetrace->setCreatedBy((string) $xml->responseData->codeTrace->createdBy);
        $codetrace->setFileSize((string) $xml->responseData->codeTrace->fileSize);
        $codetrace->setApplicationId((string) $xml->responseData->codeTrace->applicationId);

        return $codetrace;
    }
}
