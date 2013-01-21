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
 * <b>MonitoringRules Methods</b>
 *
 *
 *
 * <ul>
 * <li></li>
 * </ul>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class MonitoringRules extends BaseAPI
{
    /**
     * <b>The monitorExportRules Method</b>
     *
     * <pre></pre>
     *
     * @param  string $   <p></p>
     * @return \ZendService\ZendServerAPI\DataTypes\IssueDetails
     */
    public function monitorExportRules($applicationId)
    {
        $this->pluginManager->get('request')->setAction(
            $this->pluginManager->get('monitorExportRules')->setArgs($applicationId)
        );

        return $this->pluginManager->get('request')->send();
    }
}
