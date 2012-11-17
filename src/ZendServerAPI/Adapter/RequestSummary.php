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
 * RequestSummary datatype adapter implementation
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Adapter
 */
class RequestSummary extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param string $xml
     * @return \ZendServerAPI\DataTypes\RequestSummary
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $requestSummary = new \ZendServerAPI\DataTypes\RequestSummary();
        $requestSummary->setEventsCount((string) $xml->responseData->requestSummary->eventsCount);
        $requestSummary->setCodeTracing((string) $xml->responseData->requestSummary->codeTracing);

        foreach ($xml->responseData->requestSummary->events->event as $xmlEvent) {
            $event = new \ZendServerAPI\DataTypes\Event();
            $event->setType((string) $xmlEvent->type);
            $event->setDescription((string) $xmlEvent->description);

            $superglobal = new \ZendServerAPI\DataTypes\SuperGlobals();
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
                $step = new \ZendServerAPI\DataTypes\Step();
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
