<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\Method;

/**
 * <b>Method studioStartProfile Method</b>
 *
 * <pre>Start a profiling session with Zend Studio's integration
 * using an event-group's identifier.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class StudioStartProfile extends Method
{
    /**
     * Events group identifier
     * @var string
     */
    protected $eventsGroupId = null;
    /**
     * Override the host address sent to Zend Server for
     * initiating a Debug session. This is used to point Zend
     * Server at the right address where Studio is executed
     * @var boolean
     */
    protected $overrideHost = null;

    /**
     * Set arguments for studioStartDebug
     *
     * @param string      $eventsGroupId Events group ID
     * @param string|null $overrideHost  Override the host address sent to Zend Server
     */
    public function setArgs($eventsGroupId, $overrideHost = null)
    {
        $this->eventsGroupId = $eventsGroupId;
        if($overrideHost === null)
            $this->overrideHost = "127.0.0.1";
        else
            $this->overrideHost = $overrideHost;

        $this->configure();

        return $this;
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/Api/studioStartProfile');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\DebugRequest());
    }

    /**
     * Returns the accept header
     *
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        return "eventGroupId=".$this->eventsGroupId.
            "&overrideHost=".$this->overrideHost;
    }
}
