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
 * Issue datatype adapter implementation
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class Issue extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                     $xml
     * @return \ZendService\ZendServerAPI\DataTypes\Issue
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $issue = new  \ZendService\ZendServerAPI\DataTypes\Issue();
        $issue->setId((string) $xml->responseData->issue->id);
        $issue->setRule((string) $xml->responseData->issue->rule);
        $issue->setCount((string) $xml->responseData->issue->count);
        $issue->setLastOccurance((string) $xml->responseData->issue->lastOccurance);
        $issue->setSeverity((string) $xml->responseData->issue->severity);
        $issue->setStatus((string) $xml->responseData->issue->status);

        $generalDetails = new  \ZendService\ZendServerAPI\DataTypes\GeneralDetails();
        $generalDetails->setUrl((string) $xml->responseData->issue->generalDetails->url);
        $generalDetails->setSourceFile((string) $xml->responseData->issue->generalDetails->sourceFile);
        $generalDetails->setSourceLine((string) $xml->responseData->issue->generalDetails->sourceLine);
        $generalDetails->setFunction((string) $xml->responseData->issue->generalDetails->function);
        $generalDetails->setAggregationHint((string) $xml->responseData->issue->generalDetails->aggregationHint);
        $generalDetails->setErrorString((string) $xml->responseData->issue->generalDetails->errorString);
        $generalDetails->setErrorType((string) $xml->responseData->issue->generalDetails->errorType);
        $issue->setGeneralDetails($generalDetails);

        if (isset($xml->responseData->issue->routeDetails->routeDetail)) {
            foreach ($xml->responseData->issue->routeDetails->routeDetail as $xmlRouteDetail) {
                $routeDetails = new  \ZendService\ZendServerAPI\DataTypes\RouteDetail();
                $routeDetails->setKey($xmlRouteDetail->key);
                $routeDetails->setValue($xmlRouteDetail->value);
                $issue->addRouteDetails($routeDetails);
            }
        }

        return $issue;
    }
}
