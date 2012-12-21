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
 * IssueList datatype adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class IssueList extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                         $xml
     * @return \ZendService\ZendServerAPI\DataTypes\IssueList
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $this->setContent($xml);
        
        $xmlIssueList = $this->getElements("//issue");

        $issueList = new  \ZendService\ZendServerAPI\DataTypes\IssueList();
        foreach ($xmlIssueList as $xmlIssue) {
            $issue = new  \ZendService\ZendServerAPI\DataTypes\Issue();
            $issue->setId((string) $xmlIssue->id);
            $issue->setRule((string) $xmlIssue->rule);
            $issue->setCount((string) $xmlIssue->count);
            $issue->setLastOccurance((string) $xmlIssue->lastOccurance);
            $issue->setSeverity((string) $xmlIssue->severity);
            $issue->setStatus((string) $xmlIssue->status);

            $generalDetail = new  \ZendService\ZendServerAPI\DataTypes\GeneralDetails();
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
