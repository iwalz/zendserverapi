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
 * <b>The applicationSynchronize Method</b>
 *
 * <pre>Synchronizing an existing application, whether in order to fix a problem
 * or to reset an installation. This process is asynchronous, meaning the initial
 * request will start the synchronize process and the initial response will show
 * information about the application being synchronized. However, the synchronize
 * process will proceed after the response is returned. You must continue checking
 * the application status using the applicationGetStatus method until the process
 * is complete.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ApplicationSynchronize extends Method implements ZS6VersionBreakInterface
{
    /**
     * ApplicationId to sync
     * @var int
     */
    protected $applicationId = null;
    /**
     * Array of server IDs
     * @var array
     */
    protected $servers = array();
    /**
     * Ignore failures
     * @var boolean
     */
    protected $ignoreFailures = null;

    /**
     * Set arguments for ApplicationRemove
     *
     * @param int   $applicationId ApplicationId to remove
     * @param array $servers
     * <p>A List of server ID's. If defined, the action will be done
     * only on the servers whose ID's are specified and which
     * are currently members of the cluster.</p>
     * @param bool $ignoreFailures
     * <p>Ignore failures during staging or activation if only some
     * servers report failures. If all servers report failures the
     * operation will fail in any case. The default value is FALSE,
     * meaning any failure will return an error.</p>
     */
    public function setArgs($applicationId, array $servers = array(), $ignoreFailures = false)
    {
        $this->applicationId = $applicationId;
        $this->servers = $servers;
        $this->ignoreFailures = $ignoreFailures;

        $this->configure();

        return $this;
    }

    /**
     * Get the Zend Server 6 Version
     *
     * @return string
     */
    public function getZS6Version()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/Api/applicationSynchronize');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\ApplicationInfo());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        $content = "appId=".$this->applicationId;

        $content .= "&ignoreFailures=".($this->ignoreFailures == true ? 'TRUE' : 'FALSE');

        if (count($this->servers) > 0) {
            foreach ($this->servers as $index => $server) {
                $content .= "&"."servers[".$index."]=".$server;
                if($index+1 < count($this->servers))
                    $content .= "&";
            }
        }

        return $content;
    }

}
