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
 * IssueDetails datatype adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class IssueDetails extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                            $xml
     * @return \ZendService\ZendServerAPI\DataTypes\IssueDetails
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $this->setContent($xml);

        $xmlIssueDetails = $this->getElement("//issueDetails");

        $issueDetails = new  \ZendService\ZendServerAPI\DataTypes\IssueDetails();

        $issue = new  \ZendService\ZendServerAPI\DataTypes\Issue();
        $issue->setId((string) $xmlIssueDetails->issue->id);
        $issue->setRule((string) $xmlIssueDetails->issue->rule);
        $issue->setCount((string) $xmlIssueDetails->issue->count);
        $issue->setLastOccurance((string) $xmlIssueDetails->issue->lastOccurance);
        $issue->setSeverity((string) $xmlIssueDetails->issue->severity);
        $issue->setStatus((string) $xmlIssueDetails->issue->status);

        $generalDetails = new  \ZendService\ZendServerAPI\DataTypes\GeneralDetails();
        $generalDetails->setUrl((string) $xmlIssueDetails->issue->generalDetails->url);
        $generalDetails->setSourceFile((string) $xmlIssueDetails->issue->generalDetails->sourceFile);
        $generalDetails->setSourceLine((string) $xmlIssueDetails->issue->generalDetails->sourceLine);
        $generalDetails->setFunction((string) $xmlIssueDetails->issue->generalDetails->function);
        $generalDetails->setAggregationHint((string) $xmlIssueDetails->issue->generalDetails->aggregationHint);
        $generalDetails->setErrorString((string) $xmlIssueDetails->issue->generalDetails->errorString);
        $generalDetails->setErrorType((string) $xmlIssueDetails->issue->generalDetails->errorType);
        $issue->setGeneralDetails($generalDetails);

        if (isset($xmlIssueDetails->issue->routeDetails->routeDetail)) {
            foreach ($xmlIssueDetails->issue->routeDetails->routeDetail as $xmlRouteDetail) {
                $routeDetails = new  \ZendService\ZendServerAPI\DataTypes\RouteDetail();
                $routeDetails->setKey($xmlRouteDetail->key);
                $routeDetails->setValue($xmlRouteDetail->value);
                $issue->addRouteDetails($routeDetails);
            }
        }
        $issueDetails->setIssue($issue);

        if (isset($xmlIssueDetails->eventsGroups->eventsGroup)) {
            foreach ($xmlIssueDetails->eventsGroups->eventsGroup as $xmlEventsGroup) {
                $eventsGroup = new  \ZendService\ZendServerAPI\DataTypes\EventsGroup();
                $eventsGroup->setEventsGroupId((string) $xmlEventsGroup->eventsGroupId);
                $eventsGroup->setEventsCount((string) $xmlEventsGroup->eventsCount);
                $eventsGroup->setStartTime((string) $xmlEventsGroup->startTime);
                $eventsGroup->setServerId((string) $xmlEventsGroup->serverId);
                $eventsGroup->setClass((string) $xmlEventsGroup->class);
                $eventsGroup->setUserData((string) $xmlEventsGroup->userData);
                $eventsGroup->setJavaBacktrace((string) $xmlEventsGroup->javaBacktrace);
                $eventsGroup->setExecTime((string) $xmlEventsGroup->execTime);
                $eventsGroup->setAvgExecTime((string) $xmlEventsGroup->avgExecTime);
                $eventsGroup->setMemUsage((string) $xmlEventsGroup->memUsage);
                $eventsGroup->setAvgMemUsage((string) $xmlEventsGroup->avgMemUsage);
                $eventsGroup->setAvgOutputSize((string) $xmlEventsGroup->avgOutputSize);
                $eventsGroup->setLoad((string) $xmlEventsGroup->load);

                $issueDetails->addEventsGroup($eventsGroup);
            }
        }

        return $issueDetails;
    }
}
