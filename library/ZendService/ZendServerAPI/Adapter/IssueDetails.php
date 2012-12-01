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

namespace ZendService\ZendServerAPI\Adapter;

/**
 * IssueDetails datatype adapter implementation
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Adapter
 */
class IssueDetails extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                $xml
     * @return \ZendServerAPI\DataTypes\IssueDetails
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $issueDetails = new \ZendServerAPI\DataTypes\IssueDetails();

        $issue = new \ZendServerAPI\DataTypes\Issue();
        $issue->setId((string) $xml->responseData->issueDetails->issue->id);
        $issue->setRule((string) $xml->responseData->issueDetails->issue->rule);
        $issue->setCount((string) $xml->responseData->issueDetails->issue->count);
        $issue->setLastOccurance((string) $xml->responseData->issueDetails->issue->lastOccurance);
        $issue->setSeverity((string) $xml->responseData->issueDetails->issue->severity);
        $issue->setStatus((string) $xml->responseData->issueDetails->issue->status);

        $generalDetails = new \ZendServerAPI\DataTypes\GeneralDetails();
        $generalDetails->setUrl((string) $xml->responseData->issueDetails->issue->generalDetails->url);
        $generalDetails->setSourceFile((string) $xml->responseData->issueDetails->issue->generalDetails->sourceFile);
        $generalDetails->setSourceLine((string) $xml->responseData->issueDetails->issue->generalDetails->sourceLine);
        $generalDetails->setFunction((string) $xml->responseData->issueDetails->issue->generalDetails->function);
        $generalDetails->setAggregationHint((string) $xml->responseData->issueDetails->issue->generalDetails->aggregationHint);
        $generalDetails->setErrorString((string) $xml->responseData->issueDetails->issue->generalDetails->errorString);
        $generalDetails->setErrorType((string) $xml->responseData->issueDetails->issue->generalDetails->errorType);
        $issue->setGeneralDetails($generalDetails);

        if (isset($xml->responseData->issueDetails->issue->routeDetails->routeDetail)) {
            foreach ($xml->responseData->issueDetails->issue->routeDetails->routeDetail as $xmlRouteDetail) {
                $routeDetails = new \ZendServerAPI\DataTypes\RouteDetail();
                $routeDetails->setKey($xmlRouteDetail->key);
                $routeDetails->setValue($xmlRouteDetail->value);
                $issue->addRouteDetails($routeDetails);
            }
        }
        $issueDetails->setIssue($issue);

        if (isset($xml->responseData->issueDetails->eventsGroups->eventsGroup)) {
            foreach ($xml->responseData->issueDetails->eventsGroups->eventsGroup as $xmlEventsGroup) {
                $eventsGroup = new \ZendServerAPI\DataTypes\EventsGroup();
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
