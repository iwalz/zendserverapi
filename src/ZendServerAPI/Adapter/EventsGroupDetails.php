<?php
namespace ZendServerAPI\Adapter;

class EventsGroupDetails extends Adapter
{
    /**
     * @see \ZendServerAPI\Adapter\Adapter::parse()
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $eventsGroupDetails = new \ZendServerAPI\DataTypes\EventsGroupDetails();
        $eventsGroupDetails->setIssueId((string)$xml->responseData->eventsGroupDetails->issueId);
        
        $eventsGroup = new \ZendServerAPI\DataTypes\EventsGroup();
        $eventsGroup->setEventsGroupId((string)$xml->responseData->eventsGroupDetails->eventsGroup->eventsGroupId);
        $eventsGroup->setEventsCount((string)$xml->responseData->eventsGroupDetails->eventsGroup->eventsCount);
        $eventsGroup->setStartTime((string)$xml->responseData->eventsGroupDetails->eventsGroup->startTime);
        $eventsGroup->setServerId((string)$xml->responseData->eventsGroupDetails->eventsGroup->serverId);
        $eventsGroup->setClass((string)$xml->responseData->eventsGroupDetails->eventsGroup->class);
        $eventsGroup->setUserData((string)$xml->responseData->eventsGroupDetails->eventsGroup->userData);
        $eventsGroup->setJavaBacktrace((string)$xml->responseData->eventsGroupDetails->eventsGroup->javaBacktrace);
        $eventsGroup->setExecTime((string)$xml->responseData->eventsGroupDetails->eventsGroup->execTime);
        $eventsGroup->setAvgExecTime((string)$xml->responseData->eventsGroupDetails->eventsGroup->avgExecTime);
        $eventsGroup->setMemUsage((string)$xml->responseData->eventsGroupDetails->eventsGroup->memUsage);
        $eventsGroup->setAvgMemUsage((string)$xml->responseData->eventsGroupDetails->eventsGroup->avgMemUsage);
        $eventsGroup->setAvgOutputSize((string)$xml->responseData->eventsGroupDetails->eventsGroup->avgOutputSize);
        
        $eventsGroupDetails->setEventsGroup($eventsGroup);
        
        $event = new \ZendServerAPI\DataTypes\Event();
        $event->setEventsGroupId((string)$xml->responseData->eventsGroupDetails->event->eventsGroupId);
        $event->setType((string)$xml->responseData->eventsGroupDetails->event->type);
        $event->setDescription((string)$xml->responseData->eventsGroupDetails->event->description);
        
        $superglobal = new \ZendServerAPI\DataTypes\SuperGlobals();
        if(isset($xml->responseData->eventsGroupDetails->event->superGlobals->cookie->parameter))
        {
            foreach($xml->responseData->eventsGroupDetails->event->superGlobals->cookie->parameter as $cookie)
            {
                $superglobal->addCookieParameter(trim((string)$cookie->name), trim((string)$cookie->value));    
            }
        }
        
        if(isset($xml->responseData->eventsGroupDetails->event->superGlobals->server->parameter))
        {
            foreach($xml->responseData->eventsGroupDetails->event->superGlobals->server->parameter as $server)
            {
                $superglobal->addServerParameter(trim((string)$server->name), trim((string)$server->value));
            }
        }
        
        if(isset($xml->responseData->eventsGroupDetails->event->superGlobals->get->parameter))
        {
            foreach($xml->responseData->eventsGroupDetails->event->superGlobals->get->parameter as $get)
            {
                $superglobal->addGetParameter(trim((string)$get->name), trim((string)$get->value));
            }
        }
        
        if(isset($xml->responseData->eventsGroupDetails->event->superGlobals->post->parameter))
        {
            foreach($xml->responseData->eventsGroupDetails->event->superGlobals->post->parameter as $post)
            {
                $superglobal->addPostParameter(trim((string)$post->name), trim((string)$post->value));
            }
        }
        
        if(isset($xml->responseData->eventsGroupDetails->event->superGlobals->session->parameter))
        {
            foreach($xml->responseData->eventsGroupDetails->event->superGlobals->session->parameter as $session)
            {
                $superglobal->addSessionParameter(trim((string)$session->name), trim((string)$session->value));
            }
        }
        
        $event->setSuperglobals($superglobal);
        $event->setSeverity((string)$xml->responseData->eventsGroupDetails->event->severity);
        $eventsGroupDetails->setEvent($event);
        
        /*foreach ($xml->responseData->issueDetails->issue as $xmlIssue) {
            $issue = new \ZendServerAPI\DataTypes\EventsGroupDetails();
            $issue->setId((string) $xmlIssue->id);
            $issue->setRule((string) $xmlIssue->rule);
            $issue->setCount((string) $xmlIssue->count);
            $issue->setLastOccurance((string) $xmlIssue->lastOccurance);
            $issue->setSeverity((string) $xmlIssue->severity);
            $issue->setStatus((string) $xmlIssue->status);

            $generalDetail = new \ZendServerAPI\DataTypes\GeneralDetails();
            $generalDetail->setUrl((string) $xmlIssue->generalDetails->url);
            $generalDetail->setSourceFile((string) $xmlIssue->generalDetails->sourceFile);
            $generalDetail->setSourceLine((string) $xmlIssue->generalDetails->sourceLine);
            $generalDetail->setFunction((string) $xmlIssue->generalDetails->function);
            $generalDetail->setAggregationHint((string) $xmlIssue->generalDetails->aggregationHint);
            $generalDetail->setErrorString((string) $xmlIssue->generalDetails->errorString);
            $generalDetail->setErrorType((string) $xmlIssue->generalDetails->errorType);

            $issue->setGeneralDetails($generalDetail);
            
            foreach($xmlIssue->generalDetails as $xmlGeneralDetails)
            {
                $routeDetail = new \ZendServerAPI\DataTypes\RouteDetail();
                $routeDetail->setKey((string) $$xmlGeneralDetails->generalDetail->key);
                $routeDetail->setValue((string) $$xmlGeneralDetails->generalDetail->value);
                
                $issue->addRouteDetail($routeDetail);
            }

            $issueList->addIssue($issue);
        }*/

        return $eventsGroupDetails;
    }
}
