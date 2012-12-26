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
 * <b>The auditGetDetails Method</b>
 *
 * <pre>Get all details available on a particular audit item.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class AuditSetSettings extends Method
{
    /**
     * Number of saved days in history
     * @var int
     */
    protected $history = null;
    /**
     * Array of email value and array of audit types
     * @var array
     */
    protected $email = array();
    /**
     * Array of URL value and array of audit types
     * @var array
     */
    protected $callbackUrl = array();

    /**
     * Set the arguments and configures the method
     *
     * @var int $auditId
     * @return \ZendService\ZendServerAPI\Method\FilterGetByType
     */
    public function setArgs($history, $email, $callbackUrl)
    {
        $this->history = $history;
        $this->email = $email;
        $this->callbackUrl = $callbackUrl;
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
        $this->setFunctionPath('/ZendServer/Api/auditSetSettings');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\AuditSettings());
    }

    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.3";
    }

    /**
     * Get the post content
     *
     * @return string
     */
    public function getContent()
    {
        $content = "history=".$this->history;

        if ($this->email) {
            $content .= "&email=" . $this->email;
        }

        if ($this->callbackUrl) {
            $content .= "&callbackUrl=" . $this->callbackUrl;
        }

        return $content;
    }
}
