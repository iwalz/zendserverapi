<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI;

/**
 * <b>Jobqueue Methods</b>
 *
 * Job Queue API actions provide external actors with ways to query and manipulate jobs and their recurring definitions.
 * The following is a list of methods available for the Job Queue feature:
 *
 * <ul>
 * <li>The jobqueueStatistics Method</li>
 * <li>The jobqueueListJobs Method</li>
 * <li>The jobqueueJobInfo Method</li>
 * <li>The jobqueueDeleteJob Method</li>
 * <li>The jobqueueRequeueJob Method</li>
 * <li>The jobqueueListRules Method</li>
 * <li>The jobqueueRuleInfo Method</li>
 * <li>The jobqueueSaveRule Method</li>
 * <li>The jobqueueSuspendRules Method</li>
 * <li>The jobqueueResumeRules Method</li>
 * <li>The jobqueueDeleteRules Method</li>
 * <li>The jobqueueRunNowRule Method</li>
 * </ul>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Jobqueue extends BaseAPI
{
    /**
     * <b>The jobqueueListJobs Method </b>
     *
     * <pre></pre>
     *
     * @param  int   $limit <p></p>
     * @param  int   $offset <p></p>
     * @param  string   $orderBy <p></p>
     * @param  string   $direction <p></p>
     * @return \ZendService\ZendServerAPI\DataTypes\
     */
    public function jobqueueListJobs($limit = null, $offset = null, $orderBy = null, $direction = null)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('jobqueueListJobs')->setArgs($limit, $offset, $orderBy, $direction)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The jobqueueStatistics Method </b>
     *
     * <pre></pre>
     *
     * @return \ZendService\ZendServerAPI\DataTypes\
     */
    public function jobqueueStatistics()
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('jobqueueStatistics')->setArgs()
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The jobqueueJobInfo Method </b>
     *
     * <pre></pre>
     *
     * @param  int   $id <p>job id</p>
     * @return \ZendService\ZendServerAPI\DataTypes\
     */
    public function jobqueueJobInfo($id)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('jobqueueJobInfo')->setArgs($id)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The jobqueueDeleteJob Method </b>
     *
     * <pre></pre>
     *
     * @param  int   $id <p></p>
     * @return \ZendService\ZendServerAPI\DataTypes\
     */
    public function jobqueueDeleteJob($id)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('jobqueueDeleteJob')->setArgs($id)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The  Method </b>
     *
     * <pre></pre>
     *
     * @param  array   $jobs <p>Array of Job ids</p>
     * @return \ZendService\ZendServerAPI\DataTypes\
     */
    public function jobqueueRequeueJob($jobs)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('jobqueueRequeueJob')->setArgs($jobs)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The jobqueueListRules Method </b>
     *
     * <pre></pre>
     *
     * @param  int   $limit <p>Row limit to retrieve, defaults to value defined in zend-user-user.ini </p>
     * @param  int   $offset <p>The page offset to be displayed, defaults to 0 </p>
     * @param  string $orderBy <p>Column to sort the result by (), defaults to Date </p>
     * @param  string $direction <p>Sorting direction , defaults to Desc</p>
     * @return \ZendService\ZendServerAPI\DataTypes\
     */
    public function jobqueueListRules($limit = null, $offset = null, $orderBy = null, $direction = null)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('jobqueueListRules')->setArgs($limit, $offset, $orderBy, $direction)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The jobqueueRuleInfo Method </b>
     *
     * <pre></pre>
     *
     * @param  int   $id <p></p>
     * @return \ZendService\ZendServerAPI\DataTypes\
     */
    public function jobqueueRuleInfo($id)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('jobqueueRuleInfo')->setArgs($id)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The jobqueueSaveRule Method </b>
     *
     * <pre></pre>
     *
     * @param  string   $url <p>A URL for the job.</p>
     * @param  array    $options <p>Rule options. (e.g array('schedule' => '*******')</p>
     * @param  array    $vars    <p>Variables for the rule.</p>
     * @return \ZendService\ZendServerAPI\DataTypes\
     */
    public function jobqueueSaveRule($url, $options, $vars = array())
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('jobqueueSaveRule')->setArgs()
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The jobqueueSuspendRules Method </b>
     *
     * <pre></pre>
     *
     * @param  array   $rules <p>an array of rule ids</p>
     * @return \ZendService\ZendServerAPI\DataTypes\
     */
    public function jobqueueSuspendRules($rules)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('jobqueueSuspendRules')->setArgs($rules)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The jobqueueResumeRules Method </b>
     *
     * <pre></pre>
     *
     * @param  array   $rules <p>an array of rule ids</p>
     * @return \ZendService\ZendServerAPI\DataTypes\
     */
    public function jobqueueResumeRules($rules)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('jobqueueResumeRules')->setArgs($rules)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The jobqueueDeleteRules Method </b>
     *
     * <pre></pre>
     *
     * @param  array   $rules <p>an array of rule ids</p>
     * @return \ZendService\ZendServerAPI\DataTypes\
     */
    public function jobqueueDeleteRules($rules)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('jobqueueDeleteRules')->setArgs($rules)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The jobqueueRunNowRule Method </b>
     *
     * <pre></pre>
     *
     * @param  int   $id <p>The rule id to run</p>
     * @return \ZendService\ZendServerAPI\DataTypes\
     */
    public function jobqueueRunNowRule($id)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('jobqueueRunNowRule')->setArgs($id)
        );

        return $this->pluginManager->get('request')->send();
    }
}
