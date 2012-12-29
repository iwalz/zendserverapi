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
 * <b>The bootstrapSingleServer Method</b>
 *
 * <pre>Bootstrap a server for standalone usage in production or development environment.
 * This action is designed to give an automated process the option to bootstrap a server with particular settings.
 * Note that once a server has been bootstrapped, it may not be added passively into a cluster using
 * clusterAddServer. It may still join a cluster using a direct WebAPI -serverAddToCluster, or a UI call.
 * This WebAPI action is explicitly accessible without a WebAPI Key, but only during the bootstrap stage.
 * Unlike the UI bootstrap/launching process, this bootstrap action does not restart Zend Server nor perform any
 * authentication. A WebAPI key with administrative permissions is created as part of the bootstrap process so
 * that you may immediately continue working. It is up to the user to decide what to do with this key once the
 * bootstrap is completed.
 * Read a certain number of log lines from the end of the file log. If serverId is passed,
 * then the request will be performed against that cluster member, otherwise it is performed locally.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class BootstrapSingleServer extends Method
{
    protected $adminPassword = null;
    protected $orderNumber = null;
    protected $licenseKey = null;
    protected $acceptEula = null;
    protected $production = null;
    protected $applicationUrl = null;
    protected $adminEmail = null;
    protected $developerPassword = null;
    /**
     * Set the arguments and configures the method
     *
     * @param string $adminPassword <p>The new administrator password to store for authentication</p>
     * @param string $orderNumber <p>License order number to store in the server’s configuration.
     * This license can be obtained from zend.com</p>
     * @param string $licenseKey <p>License key to store in the server’s configuration. T
     * his license can be obtained from zend.com</p>
     * @param bool $acceptEula <p>Must be set to true to accept ZS6’s EULA</p>
     * @param bool $production <p>Bootstrap this server using the factory “production” usage profile.
     * Default value: true</p>
     * @param string $applicationUrl <p>The default application URL to use when displaying and handling
     * deployed application URLs in the UI. Default: empty</p>
     * @param string $adminEmail <p>The default Email to use when sending notifications about events,
     * audit entries and other features</p>
     * @param string $developerPassword <p>The new developer user password to be stored for authentication.
     * If no password is supplied, the developer user will not be created</p>
     * @return \ZendService\ZendServerAPI\Method\BootstrapSingleServer
     */
    public function setArgs(
        $adminPassword,
        $orderNumber,
        $licenseKey,
        $acceptEula,
        $production = null,
        $applicationUrl = null,
        $adminEmail = null,
        $developerPassword = null
    ) {
        $this->adminPassword = $adminPassword;
        $this->orderNumber = $orderNumber;
        $this->licenseKey = $licenseKey;
        $this->acceptEula = $acceptEula;
        $this->production = $production;
        $this->applicationUrl = $applicationUrl;
        $this->adminEmail = $adminEmail;
        $this->developerPassword = $developerPassword;
        $this->configure();

        return $this;
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServer/Api/');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\DumpParser());
    }

    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.3";
    }

    /**
     * Get post body content
     *
     * @return string
     */
    public function getContent()
    {
        $content = "adminPassword=" . $this->adminPassword;
        $content .= "&orderNumber=" . $this->orderNumber;
        $content .= "&licenseKey=" . $this->licenseKey;
        $content .= "&acceptEula=" . ($this->acceptEula ? "TRUE" : "FALSE");
        $content .= "&production=" . ($this->production ? "TRUE" : "FALSE");
        $content .= "&applicationUrl=" . $this->applicationUrl;
        $content .= "&adminEmail=" . $this->adminEmail;
        $content .= "&developerPassword=" . $this->developerPassword;

        return $content;
    }
}
