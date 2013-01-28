<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\DataTypes;

/**
 * JobInfo model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class JobInfo extends DataType
{
    /**
     * @var Job
     */
    protected $job = null;
    /**
     * @var JobDetails
     */
    protected $jobDetails = null;

    /**
     * @param \ZendService\ZendServerAPI\DataTypes\Job $job
     */
    public function setJob($job)
    {
        $this->job = $job;
    }

    /**
     * @return \ZendService\ZendServerAPI\DataTypes\Job
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param $jobDetails
     */
    public function setJobDetails($jobDetails)
    {
        $this->jobDetails = $jobDetails;
    }

    /**
     * @return null|JobDetails
     */
    public function getJobDetails()
    {
        return $this->jobDetails;
    }
}
