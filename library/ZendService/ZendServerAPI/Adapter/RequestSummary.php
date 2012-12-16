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
 * RequestSummary datatype adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class RequestSummary extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                              $xml
     * @return \ZendService\ZendServerAPI\DataTypes\RequestSummary
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $requestSummary = new  \ZendService\ZendServerAPI\DataTypes\RequestSummary();
        $requestSummary->setEventsCount((string) $xml->responseData->requestSummary->eventsCount);
        $requestSummary->setCodeTracing((string) $xml->responseData->requestSummary->codeTracing);

        foreach ($xml->responseData->requestSummary->events->event as $xmlEvent) {
            $event = new  \ZendService\ZendServerAPI\DataTypes\Event();
            $event->setType((string) $xmlEvent->type);
            $event->setDescription((string) $xmlEvent->description);

            $superglobal = new  \ZendService\ZendServerAPI\DataTypes\SuperGlobals();
            if (isset($xmlEvent->superGlobals->cookie->parameter)) {
                foreach ($xmlEvent->superGlobals->cookie->parameter as $cookie) {
                    $superglobal->addCookieParameter(trim((string) $cookie->name), trim((string) $cookie->value));
                }
            }

            if (isset($xmlEvent->superGlobals->server->parameter)) {
                foreach ($xmlEvent->superGlobals->server->parameter as $server) {
                    $superglobal->addServerParameter(trim((string) $server->name), trim((string) $server->value));
                }
            }

            if (isset($xmlEvent->superGlobals->get->parameter)) {
                foreach ($xmlEvent->superGlobals->get->parameter as $get) {
                    $superglobal->addGetParameter(trim((string) $get->name), trim((string) $get->value));
                }
            }

            if (isset($xmlEvent->superGlobals->post->parameter)) {
                foreach ($xmlEvent->superGlobals->post->parameter as $post) {
                    $superglobal->addPostParameter(trim((string) $post->name), trim((string) $post->value));
                }
            }

            if (isset($xmlEvent->superGlobals->session->parameter)) {
                foreach ($xmlEvent->superGlobals->session->parameter as $session) {
                    $superglobal->addSessionParameter(trim((string) $session->name), trim((string) $session->value));
                }
            }

            $event->setSuperglobals($superglobal);
            $event->setSeverity((string) $xmlEvent->severity);
            $event->setDebugUrl((string) $xmlEvent->debugUrl);

            foreach ($xmlEvent->backtrace->step as $xmlStep) {
                $step = new  \ZendService\ZendServerAPI\DataTypes\Step();
                $step->setNumber((string) $xmlStep->number);
                $step->setObject((string) $xmlStep->object);
                $step->setClass((string) $xmlStep->class);
                $step->setFunction((string) $xmlStep->function);
                $step->setFile((string) $xmlStep->file);
                $step->setLine((string) $xmlStep->line);

                $event->addStep($step);
            }

            $requestSummary->addEvents($event);
        }

        return $requestSummary;
    }
}
