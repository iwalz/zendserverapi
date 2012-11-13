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
 */

namespace ZendServerAPI\Adapter;

/**
 * IssueList datatype adapter implementation
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class IssueList extends Adapter
{
    /**
     * @see \ZendServerAPI\Adapter\Adapter::parse()
     * @return \ZendServerAPI\DataTypes\IssueList
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $issueList = new \ZendServerAPI\DataTypes\IssueList();
        foreach ($xml->responseData->issues->issue as $xmlIssue) {
            $issue = new \ZendServerAPI\DataTypes\Issue();
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

            $issueList->addIssue($issue);
        }

        return $issueList;
    }
}
