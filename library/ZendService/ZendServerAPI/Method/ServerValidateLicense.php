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
 * <b>The serverValidateLicense Method</b>
 *
 * <pre>Validate a Zend Server license.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class ServerValidateLicense extends Method
{
    /**
     * @var string
     */
    protected $licenseName = null;
    /**
     * @var string
     */
    protected $licenseValue = null;

    /**
     * Set the arguments and configures the method
     *
     * @param string $licenseName <p>The name of the license</p>
     * @param string $licenseValue <p>The value of the license</p>
     * @return \ZendService\ZendServerAPI\Method\ServerValidateLicense
     */
    public function setArgs($licenseName, $licenseValue)
    {
        $this->licenseName = $licenseName;
        $this->licenseValue = $licenseValue;
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
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServer/Api/serverValidateLicense');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\DumpParser());
    }

    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.3";
    }

    /**
     * Get content for the post body
     *
     * @return string
     */
    public function getContent()
    {
        $content = "licenseName=" . $this->licenseName;
        $content .= "&licenseValue=" . $this->licenseValue;

        return $content;
    }
}
