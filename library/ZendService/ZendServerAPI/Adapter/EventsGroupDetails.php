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
 * EventsGroupDetails datatype adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class EventsGroupDetails extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                                  $xml
     * @return \ZendService\ZendServerAPI\DataTypes\EventsGroupDetails
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $this->setContent($xml);
        
        $xmlEventsGroupDetails = $this->getElement("//eventsGroupDetails");

        $eventsGroupDetails = new  \ZendService\ZendServerAPI\DataTypes\EventsGroupDetails();
        $eventsGroupDetails->setIssueId((string) $xmlEventsGroupDetails->issueId);

        $eventsGroup = new  \ZendService\ZendServerAPI\DataTypes\EventsGroup();
        $eventsGroup->setEventsGroupId((string) $xmlEventsGroupDetails->eventsGroup->eventsGroupId);
        $eventsGroup->setEventsCount((string) $xmlEventsGroupDetails->eventsGroup->eventsCount);
        $eventsGroup->setStartTime((string) $xmlEventsGroupDetails->eventsGroup->startTime);
        $eventsGroup->setServerId((string) $xmlEventsGroupDetails->eventsGroup->serverId);
        $eventsGroup->setClass((string) $xmlEventsGroupDetails->eventsGroup->class);
        $eventsGroup->setUserData((string) $xmlEventsGroupDetails->eventsGroup->userData);
        $eventsGroup->setJavaBacktrace((string) $xmlEventsGroupDetails->eventsGroup->javaBacktrace);
        $eventsGroup->setExecTime((string) $xmlEventsGroupDetails->eventsGroup->execTime);
        $eventsGroup->setAvgExecTime((string) $xmlEventsGroupDetails->eventsGroup->avgExecTime);
        $eventsGroup->setMemUsage((string) $xmlEventsGroupDetails->eventsGroup->memUsage);
        $eventsGroup->setAvgMemUsage((string) $xmlEventsGroupDetails->eventsGroup->avgMemUsage);
        $eventsGroup->setAvgOutputSize((string) $xmlEventsGroupDetails->eventsGroup->avgOutputSize);
        $eventsGroup->setLoad((string) $xmlEventsGroupDetails->eventsGroup->load);

        $eventsGroupDetails->setEventsGroup($eventsGroup);

        $event = new  \ZendService\ZendServerAPI\DataTypes\Event();
        $event->setEventsGroupId((string) $xmlEventsGroupDetails->event->eventsGroupId);
        $event->setType((string) $xmlEventsGroupDetails->event->type);
        $event->setDescription((string) $xmlEventsGroupDetails->event->description);

        $superglobal = new  \ZendService\ZendServerAPI\DataTypes\SuperGlobals();
        if (isset($xmlEventsGroupDetails->event->superGlobals->cookie->parameter)) {
            foreach ($xmlEventsGroupDetails->event->superGlobals->cookie->parameter as $cookie) {
                $superglobal->addCookieParameter(trim((string) $cookie->name), trim((string) $cookie->value));
            }
        }

        if (isset($xmlEventsGroupDetails->event->superGlobals->server->parameter)) {
            foreach ($xmlEventsGroupDetails->event->superGlobals->server->parameter as $server) {
                $superglobal->addServerParameter(trim((string) $server->name), trim((string) $server->value));
            }
        }

        if (isset($xmlEventsGroupDetails->event->superGlobals->get->parameter)) {
            foreach ($xmlEventsGroupDetails->event->superGlobals->get->parameter as $get) {
                $superglobal->addGetParameter(trim((string) $get->name), trim((string) $get->value));
            }
        }

        if (isset($xmlEventsGroupDetails->event->superGlobals->post->parameter)) {
            foreach ($xmlEventsGroupDetails->event->superGlobals->post->parameter as $post) {
                $superglobal->addPostParameter(trim((string) $post->name), trim((string) $post->value));
            }
        }

        if (isset($xmlEventsGroupDetails->event->superGlobals->session->parameter)) {
            foreach ($xmlEventsGroupDetails->event->superGlobals->session->parameter as $session) {
                $superglobal->addSessionParameter(trim((string) $session->name), trim((string) $session->value));
            }
        }

        $event->setSuperglobals($superglobal);
        $event->setSeverity((string) $xmlEventsGroupDetails->event->severity);
        $eventsGroupDetails->setEvent($event);

        foreach ($xmlEventsGroupDetails->event->backtrace->step as $xmlStep) {
            $step = new  \ZendService\ZendServerAPI\DataTypes\Step();
            $step->setClass(trim((string) $xmlStep->class));
            $step->setFile(trim((string) $xmlStep->file));
            $step->setFunction(trim((string) $xmlStep->function));
            $step->setLine(trim((string) $xmlStep->line));
            $step->setNumber(trim((string) $xmlStep->number));
            $step->setObject(trim((string) $xmlStep->object));
            $event->addStep($step);
        }

        $eventsGroupDetails->setCodeTracing((string) $xmlEventsGroupDetails->event->codeTracing);

        return $eventsGroupDetails;
    }
}
