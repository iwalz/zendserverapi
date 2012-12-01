<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link 		http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright 	Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license 	http://framework.zend.com/license/new-bsd New BSD License
 * @package 	Zend_Service
 */

namespace ZendService\ZendServerAPI\Method;

use ZendService\ZendServerAPI\DataTypes\LicenseInfo,
    ZendService\ZendServerAPI\DataTypes\MessageList;

/**
 * <b>The getSystemInfo Method</b>
 *
 * <pre>Use this method to get information about the system, including
 * the Zend Server edition and version, PHP version, licensing information,
 * etc. This method produces similar output on all Zend Server systems, and
 * is future compatible.</pre>
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	Zend_Service
 * @subpackage	ZendServerAPI
 */
class GetSystemInfo extends Method
{
    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/getSystemInfo');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\SystemInfo());
    }
}
