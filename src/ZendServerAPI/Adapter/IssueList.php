<?php
namespace ZendServerAPI\Adapter;

class IssueList extends Adapter
{
    /**
     * @see \ZendServerAPI\Adapter\Adapter::parse()
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
