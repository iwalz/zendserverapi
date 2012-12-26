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
 * AuditSettings model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class AuditSettings
{
    /**
     * @var string
     */
    protected $sendToMail = null;
    /**
     * @var string
     */
    protected $sendToUrl = null;
    /**
     * @var int
     */
    protected $history = null;

    /**
     * @param int $history
     */
    public function setHistory($history)
    {
        $this->history = $history;
    }

    /**
     * @return int
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * @param string $sendToMail
     */
    public function setSendToMail($sendToMail)
    {
        $this->sendToMail = $sendToMail;
    }

    /**
     * @return string
     */
    public function getSendToMail()
    {
        return $this->sendToMail;
    }

    /**
     * @param string $sendToUrl
     */
    public function setSendToUrl($sendToUrl)
    {
        $this->sendToUrl = $sendToUrl;
    }

    /**
     * @return string
     */
    public function getSendToUrl()
    {
        return $this->sendToUrl;
    }
}
