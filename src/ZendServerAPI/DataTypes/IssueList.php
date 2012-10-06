<?php
namespace ZendServerAPI\DataTypes;

class IssueList
{
    /**
     * Internal issue storage
     * @var array
     */
    protected $issues = array();

    /**
     * Add Issue to container
     *
     * @param \ZendServerAPI\DataTypes\Issue $issue
     */
    public function addIssue(\ZendServerAPI\DataTypes\Issue $issue)
    {
        $this->issues[] = $issue;
    }

    /**
     * Get issue array
     *
     * @return array
     */
    public function getIssues()
    {
        return $this->issues;
    }
}
