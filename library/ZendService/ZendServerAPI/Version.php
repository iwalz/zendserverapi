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
 * <b>Version information</b>
 *
 * <pre>Static version information for webapi version selection</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Version
{
    /**
     * Zend Server Cluster Manager 5.1
     * API Version 1.0
     * @var string
     */
    const ZSCM51 = "1.0";
    /**
     * Zend Server Cluster Manager 5.5
     * API Version 1.1
     * @var string
     */
    const ZSCM55 = "1.1";
    /**
     * Zend Server Cluster Manager 5.6
     * API Version 1.2
     * @var string
     */
    const ZSCM56 = "1.2";
    /**
     * Zend Server Community Edition 5.1
     * API Version 1.0
     * @var string
     */
    const ZSCE51 = "1.0";
    /**
     * Zend Server Community Edition 5.5
     * API Version 1.1
     * @var string
     */
    const ZSCE55 = "1.1";
    /**
     * Zend Server Community Edition 5.6
     * API Version 1.2
     * @var string
     */
    const ZSCE56 = "1.2";
    /**
     * Zend Server 5.1
     * API Version 1.0
     * @var string
     */
    const ZS51 = "1.0";
    /**
     * Zend Server 5.5
     * API Version 1.1
     * @var string
     */
    const ZS55 = "1.1";
    /**
     * Zend Server 5.6
     * API Version 1.2
     * @var string
     */
    const ZS56 = "1.2";
}
