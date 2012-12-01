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
 * Issue datatype adapter implementation
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Adapter
 */
class Issue extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                         $xml
     * @return \ZendServerAPI\DataTypes\Issue
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $issue = new \ZendServerAPI\DataTypes\Issue();
        $issue->setId((string) $xml->responseData->issue->id);
        $issue->setRule((string) $xml->responseData->issue->rule);
        $issue->setCount((string) $xml->responseData->issue->count);
        $issue->setLastOccurance((string) $xml->responseData->issue->lastOccurance);
        $issue->setSeverity((string) $xml->responseData->issue->severity);
        $issue->setStatus((string) $xml->responseData->issue->status);

        $generalDetails = new \ZendServerAPI\DataTypes\GeneralDetails();
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
                $routeDetails = new \ZendServerAPI\DataTypes\RouteDetail();
                $routeDetails->setKey($xmlRouteDetail->key);
                $routeDetails->setValue($xmlRouteDetail->value);
                $issue->addRouteDetails($routeDetails);
            }
        }

        return $issue;
    }
}
