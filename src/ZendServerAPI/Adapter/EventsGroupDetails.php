<?php
/**
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * <http://www.rubber-duckling.net>
 * 
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Adapter
 */

namespace ZendServerAPI\Adapter;

/**
 * EventsGroupDetails datatype adapter implementation
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Adapter
 */
class EventsGroupDetails extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param string $xml
     * @return \ZendServerAPI\DataTypes\EventsGroupDetails
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $eventsGroupDetails = new \ZendServerAPI\DataTypes\EventsGroupDetails();
        $eventsGroupDetails->setIssueId((string) $xml->responseData->eventsGroupDetails->issueId);

        $eventsGroup = new \ZendServerAPI\DataTypes\EventsGroup();
        $eventsGroup->setEventsGroupId((string) $xml->responseData->eventsGroupDetails->eventsGroup->eventsGroupId);
        $eventsGroup->setEventsCount((string) $xml->responseData->eventsGroupDetails->eventsGroup->eventsCount);
        $eventsGroup->setStartTime((string) $xml->responseData->eventsGroupDetails->eventsGroup->startTime);
        $eventsGroup->setServerId((string) $xml->responseData->eventsGroupDetails->eventsGroup->serverId);
        $eventsGroup->setClass((string) $xml->responseData->eventsGroupDetails->eventsGroup->class);
        $eventsGroup->setUserData((string) $xml->responseData->eventsGroupDetails->eventsGroup->userData);
        $eventsGroup->setJavaBacktrace((string) $xml->responseData->eventsGroupDetails->eventsGroup->javaBacktrace);
        $eventsGroup->setExecTime((string) $xml->responseData->eventsGroupDetails->eventsGroup->execTime);
        $eventsGroup->setAvgExecTime((string) $xml->responseData->eventsGroupDetails->eventsGroup->avgExecTime);
        $eventsGroup->setMemUsage((string) $xml->responseData->eventsGroupDetails->eventsGroup->memUsage);
        $eventsGroup->setAvgMemUsage((string) $xml->responseData->eventsGroupDetails->eventsGroup->avgMemUsage);
        $eventsGroup->setAvgOutputSize((string) $xml->responseData->eventsGroupDetails->eventsGroup->avgOutputSize);
        $eventsGroup->setLoad((string) $xml->responseData->eventsGroupDetails->eventsGroup->load);

        $eventsGroupDetails->setEventsGroup($eventsGroup);

        $event = new \ZendServerAPI\DataTypes\Event();
        $event->setEventsGroupId((string) $xml->responseData->eventsGroupDetails->event->eventsGroupId);
        $event->setType((string) $xml->responseData->eventsGroupDetails->event->type);
        $event->setDescription((string) $xml->responseData->eventsGroupDetails->event->description);

        $superglobal = new \ZendServerAPI\DataTypes\SuperGlobals();
        if (isset($xml->responseData->eventsGroupDetails->event->superGlobals->cookie->parameter)) {
            foreach ($xml->responseData->eventsGroupDetails->event->superGlobals->cookie->parameter as $cookie) {
                $superglobal->addCookieParameter(trim((string) $cookie->name), trim((string) $cookie->value));
            }
        }

        if (isset($xml->responseData->eventsGroupDetails->event->superGlobals->server->parameter)) {
            foreach ($xml->responseData->eventsGroupDetails->event->superGlobals->server->parameter as $server) {
                $superglobal->addServerParameter(trim((string) $server->name), trim((string) $server->value));
            }
        }

        if (isset($xml->responseData->eventsGroupDetails->event->superGlobals->get->parameter)) {
            foreach ($xml->responseData->eventsGroupDetails->event->superGlobals->get->parameter as $get) {
                $superglobal->addGetParameter(trim((string) $get->name), trim((string) $get->value));
            }
        }

        if (isset($xml->responseData->eventsGroupDetails->event->superGlobals->post->parameter)) {
            foreach ($xml->responseData->eventsGroupDetails->event->superGlobals->post->parameter as $post) {
                $superglobal->addPostParameter(trim((string) $post->name), trim((string) $post->value));
            }
        }

        if (isset($xml->responseData->eventsGroupDetails->event->superGlobals->session->parameter)) {
            foreach ($xml->responseData->eventsGroupDetails->event->superGlobals->session->parameter as $session) {
                $superglobal->addSessionParameter(trim((string) $session->name), trim((string) $session->value));
            }
        }

        $event->setSuperglobals($superglobal);
        $event->setSeverity((string) $xml->responseData->eventsGroupDetails->event->severity);
        $eventsGroupDetails->setEvent($event);

        foreach ($xml->responseData->eventsGroupDetails->event->backtrace->step as $xmlStep) {
            $step = new \ZendServerAPI\DataTypes\Step();
            $step->setClass(trim((string) $xmlStep->class));
            $step->setFile(trim((string) $xmlStep->file));
            $step->setFunction(trim((string) $xmlStep->function));
            $step->setLine(trim((string) $xmlStep->line));
            $step->setNumber(trim((string) $xmlStep->number));
            $step->setObject(trim((string) $xmlStep->object));
            $event->addStep($step);
        }

        $eventsGroupDetails->setCodeTracing((string) $xml->responseData->eventsGroupDetails->event->codeTracing);

        return $eventsGroupDetails;
    }
}
