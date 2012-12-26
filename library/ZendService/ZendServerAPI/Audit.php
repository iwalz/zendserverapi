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
 * <b> Audit Methods</b>
 *
 * The following is a list of methods available for the Audit feature:
 *
 * <ul>
 * <li>The auditGetList Method</li>
 * <li>The auditGetDetails Method </li>
 * <li> The auditSetSettings Method </li>
 * </ul>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Audit extends BaseAPI
{
    /**
     * <b>The auditGetList Method </b>
     *
     * <pre>Get a list of audit entries.</pre>
     *
     * @param  int     $limit <p>The number of rows to retrieve. Default lists all audit
     * entries up to an arbitrary limit set by the system </p>
     * @param  int     $offset <p>A paging offset to begin the list from. Default: 0</p>
     * @param  string  $order <p>Column identifier for sorting the result set (audit_id, node_id, time).
     * Default: audit_id</p>
     * @param  array   $filters <p>Add filter parameters in an ad-hoc manner. These filters will be added
     * to the predefined filter that was passed. This parameter is an array with a predefined set of
     * parameters that accept strings or arrays to hold multiple values:
     * from: string, a timestamp to use for retrieving audit rows
     * to: string, a timestamp to use for retrieving audit rows
     * freeText: string
     * auditTypes: array, a list of auditTypes-
     * AUDIT_APPLICATION_DEPLOY, AUDIT_APPLICATION_REMOVE, AUDIT_APPLICATION_UPGRADE, AUDIT_APPLICATION_ROLLBACK,
     * AUDIT_APPLICATION_REDEPLOY, AUDIT_APPLICATION_REDEPLOY_ALL, AUDIT_APPLICATION_DEFINE, AUDIT_DIRECTIVES_MODIFIED,
     * AUDIT_EXTENSION_ENABLED, AUDIT_EXTENSION_DISABLED, AUDIT_RESTART_DAEMON, AUDIT_RESTART_PHP,
     * AUDIT_GUI_AUTHENTICATION, AUDIT_GUI_CHANGE_PASSWORD, AUDIT_GUI_AUTHORIZATION,
     * AUDIT_GUI_AUTHENTICATION_LOGOUT, AUDIT_GUI_AUDIT_SETTINGS_SAVE, AUDIT_GUI_BOOTSTRAP_CREATEDB,
     * AUDIT_GUI_BOOTSTRAP_SAVELICENSE, AUDIT_SERVER_JOIN, AUDIT_SERVER_ADD, AUDIT_SERVER_ENABLE,
     * AUDIT_SERVER_DISABLE, AUDIT_SERVER_REMOVE, AUDIT_SERVER_REMOVE_FORCE, AUDIT_SERVER_RENAME,
     * AUDIT_SERVER_SETPASSWORD, AUDIT_CODETRACING_CREATE, AUDIT_CODETRACING_DELETE,
     * AUDIT_CODETRACING_DEVELOPER_ENABLE, AUDIT_CODETRACING_DEVELOPER_DISABLE, AUDIT_JOBQUEUE_REQUEUE,
     * AUDIT_JOBQUEUE_DELETE, AUDIT_MONITOR_RULES_ENABLE, AUDIT_MONITOR_RULES_DISABLE, AUDIT_MONITOR_RULES_SAVE,
     * AUDIT_MONITOR_RULES_REMOVE, AUDIT_STUDIO_DEBUG, AUDIT_STUDIO_PROFILE, AUDIT_STUDIO_SOURCE,
     * AUDIT_CLEAR_OPTIMIZER_PLUS_CACHE, AUDIT_CLEAR_DATA_CACHE_CACHE, AUDIT_CLEAR_PAGE_CACHE_CACHE,
     * AUDIT_PAGE_CACHE_SAVE_RULE, AUDIT_PAGE_CACHE_DELETE_RULES, AUDIT_JOB_QUEUE_SAVE_RULE,
     * AUDIT_JOB_QUEUE_DELETE_RULES, AUDIT_JOB_QUEUE_DELETE_JOBS, AUDIT_JOB_QUEUE_REQUEUE_JOBS,
     * AUDIT_JOB_QUEUE_RESUME_RULES,AUDIT_JOB_QUEUE_DISABLE_RULES, AUDIT_JOB_QUEUE_RUN_NOW_RULE
     * @return \ZendService\ZendServerAPI\DataTypes\AuditMessages
     */
    public function auditGetList($limit = null, $offset = null, $order = null, $direction = null, $filters = array())
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('auditGetList')->setArgs($limit, $offset, $order, $direction, $filters)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The auditGetDetails Method</b>
     *
     * <pre>Get all details available on a particular audit item.</pre>
     *
     * @param  string                                            $auditId <p>Audit ID to get all details for</p>
     * @return \ZendService\ZendServerAPI\DataTypes\AuditMessageDetails
     */
    public function auditGetDetails($auditId)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('auditGetDetails')->setArgs($auditId)
        );

        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The auditSetSettings Method </b>
     *
     * <pre>Save settings of audit history and triggers.</pre>
     *
     * @param  array     $history <p>Name of filter.</p>
     * @param  array  $email   <p></p>
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function auditSetSettings($history, $email = null, $callbackUrl = null)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('auditSetSettings')->setArgs($history, $email, $callbackUrl)
        );

        return $this->pluginManager->get('request')->send();
    }
}
