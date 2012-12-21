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
 * Issue datatype adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Issue extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                     $xml
     * @return \ZendService\ZendServerAPI\DataTypes\Issue
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $this->setContent($xml);
        
        $xmlIssue = $this->getElement("//issue");

        $issue = new  \ZendService\ZendServerAPI\DataTypes\Issue();
        $issue->setId((string) $xmlIssue->id);
        $issue->setRule((string) $xmlIssue->rule);
        $issue->setCount((string) $xmlIssue->count);
        $issue->setLastOccurance((string) $xmlIssue->lastOccurance);
        $issue->setSeverity((string) $xmlIssue->severity);
        $issue->setStatus((string) $xmlIssue->status);

        $generalDetails = new  \ZendService\ZendServerAPI\DataTypes\GeneralDetails();
        $generalDetails->setUrl((string) $xmlIssue->generalDetails->url);
        $generalDetails->setSourceFile((string) $xmlIssue->generalDetails->sourceFile);
        $generalDetails->setSourceLine((string) $xmlIssue->generalDetails->sourceLine);
        $generalDetails->setFunction((string) $xmlIssue->generalDetails->function);
        $generalDetails->setAggregationHint((string) $xmlIssue->generalDetails->aggregationHint);
        $generalDetails->setErrorString((string) $xmlIssue->generalDetails->errorString);
        $generalDetails->setErrorType((string) $xmlIssue->generalDetails->errorType);
        $issue->setGeneralDetails($generalDetails);

        if (isset($xmlIssue->routeDetails->routeDetail)) {
            foreach ($xmlIssue->routeDetails->routeDetail as $xmlRouteDetail) {
                $routeDetails = new  \ZendService\ZendServerAPI\DataTypes\RouteDetail();
                $routeDetails->setKey($xmlRouteDetail->key);
                $routeDetails->setValue($xmlRouteDetail->value);
                $issue->addRouteDetails($routeDetails);
            }
        }

        return $issue;
    }
}
