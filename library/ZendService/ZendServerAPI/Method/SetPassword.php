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
 * <b>The setPassword Method</b>
 *
 * <pre>Modify a current user password.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class SetPassword extends Method
{
    /**
     * @var string
     */
    protected $password = null;
    /**
     * @var string
     */
    protected $newPassword = null;
    /**
     * @var string
     */
    protected $confirmNewPassword = null;

    /**
     * Set the arguments and configures the method
     *
     * @param string $password            <p>Current password.</p>
     * @param string $newPassword         <p>New password.</p>
     * @param string $confirmNewPassword  <p>Confirmation of new password.</p>
     * @return \ZendService\ZendServerAPI\Method\SetPassword
     */
    public function setArgs($password, $newPassword, $confirmNewPassword)
    {
        $this->password = $password;
        $this->newPassword = $newPassword;
        $this->confirmNewPassword = $confirmNewPassword;
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
        $this->setFunctionPath('/Api/setPassword');
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
        $content = "password=" . $this->password;
        $content .= "&newPassword=" . $this->newPassword;
        $content .= "&confirmNewPassword=" . $this->confirmNewPassword;

        return $content;
    }
}
