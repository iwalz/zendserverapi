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
 * <b>Studio-Integration Methods</b>
 *
 * The following is a list of methods available for the Studio-Integration feature:
 *
 * <ul>
 * <li>studioStartDebug</li>
 * <li>studioStartProfile</li>
 * </ul>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Studio extends BaseAPI
{
    /**
     * <b>The studioStartDebug Method</b>
     *
     * <pre>Start a debug session for a specific issue</pre>
     *
     * @param string $issueId       <p>The issue identifier</p>
     * @param string $eventsGroupId <p>The issue event group identifier</p>
     * @param string $noRemote      <p>Use server's own local files for debug display.
     * Default: true. Setting to false will use local files from studio if available</p>
     * @param string $overrideHost <p>Override the host address sent to Zend Server for
     * initiating a Debug session. This is used to point Zend Server at the right address
     * where Studio is executed</p>
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function studioStartDebug($issueId, $eventsGroupId = null, $noRemote = null, $overrideHost = null)
    {
        if ($eventsGroupId === null) {
            $eventsGroupId = $this->getFirstEventGroupsIdByIssueId($issueId);
        }

        $this->request->setAction($this->apiFactory->factory('studioStartDebug', $eventsGroupId, $noRemote, $overrideHost));

        return $this->request->send();
    }

    /**
     * <b>The studioStartProfile Method</b>
     *
     * <pre>Start a profiling session with Zend Studio's integration
     * using an events group identifier</pre>
     *
     * @param string $issueId       <p>The issue identifier</p>
     * @param string $eventsGroupId <p>The issue event group identifier</p>
     * @param string $overrideHost  <p>Override the host address sent to
     * Zend Server for initiating a Debug session. This is used to point Zend Server
     * at the right address where Studio is executed</p>
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function studioStartProfile($issueId, $eventsGroupId = null, $overrideHost = null)
    {
        if ($eventsGroupId === null) {
            $eventsGroupId = $this->getFirstEventGroupsIdByIssueId($issueId);
        }

        $this->request->setAction($this->apiFactory->factory('studioStartProfile', $eventsGroupId, $overrideHost));

        return $this->request->send();
    }

}
