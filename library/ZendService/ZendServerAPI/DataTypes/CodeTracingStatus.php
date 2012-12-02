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
 * CodeTracingStatus model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class CodeTracingStatus extends DataType
{
    /**
     * Current activity status
     * @var string
     */
    protected $componentStatus = null;
    /**
     * Current trace_enabled directive value (On|Off)
     * @var boolean
     */
    protected $traceEnabled = null;
    /**
     * If true, ZendServer is waiting for a restart
     * which may effect these setting
     * @var boolean
     */
    protected $awaitsRestart = null;
    /**
     * Undocumented parameter
     * @var boolean
     */
    protected $developerMode = null;

    /**
     * Get the current activity status of the component:
     * Active | Inactive
     *
     * @return string
     */
    public function getComponentStatus ()
    {
        return $this->componentStatus;
    }

    /**
     * Get the trace enabled directive value
     * ( On | Off )
     *
     * @return string
     */
    public function getTraceEnabled ()
    {
        return $this->traceEnabled;
    }

    /**
     * If "true", ZendServer is waiting for a restart which may
     * affect these settings
     *
     * @return string
     */
    public function getAwaitsRestart ()
    {
        return $this->awaitsRestart;
    }

    /**
     * Set the component status
     *
     * @param  string $componentStatus
     * @return void
     */
    public function setComponentStatus ($componentStatus)
    {
        $this->componentStatus = $componentStatus;
    }

    /**
     * Set the trace enabled setting
     *
     * @param  string $traceEnabled
     * @return void
     */
    public function setTraceEnabled ($traceEnabled)
    {
        $this->traceEnabled = $traceEnabled;
    }

    /**
     * Set the awaits restart setting
     *
     * @param  string $awaitsRestart
     * @return void
     */
    public function setAwaitsRestart ($awaitsRestart)
    {
        $this->awaitsRestart = $awaitsRestart;
    }

    /**
     * Get the developerMode
     *
     * @return string
     */
    public function getDeveloperMode ()
    {
        return $this->developerMode;
    }

    /**
     * Set the developermode
     *
     * @param  string $developerMode
     * @return void
     */
    public function setDeveloperMode ($developerMode)
    {
        $this->developerMode = $developerMode;
    }

}
