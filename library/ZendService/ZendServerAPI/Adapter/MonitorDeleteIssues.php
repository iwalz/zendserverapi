<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\Adapter;

/**
 * MonitorDeleteIssues datatype adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Kevin Papst <kpapst@gmx.net>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class MonitorDeleteIssues extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string $xml
     * @return \ZendService\ZendServerAPI\DataTypes\IssuesDeleted
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $this->setContent($xml);

        $deletedIssues = $this->getElements("//szDeleted");

        $result = new \ZendService\ZendServerAPI\DataTypes\IssuesDeleted();
        $result->setCounter((string) $deletedIssues);

        return $result;
    }
}
