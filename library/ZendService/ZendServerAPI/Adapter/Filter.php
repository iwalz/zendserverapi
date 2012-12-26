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
 * Transform Filter-XML datatype to \ZendService\ZendServerAPI\DataTypes\Filter
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Filter extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DataType
     */
    public function parse ($xml = null)
    {
        if ($xml === null) {
            $xml = $this->getResponse()->getBody();
        }

        $this->setContent($xml);
        $xmlFilter = $this->getElement("//filter");

        $filter = new \ZendService\ZendServerAPI\DataTypes\Filter();
        $filter->setData(!empty($xmlFilter->data) ? (array) json_decode($xmlFilter->data) : array());
        $filter->setName(trim((string) $xmlFilter->name));
        $filter->setId((int) $xmlFilter->id);
        $filter->setCustom((string) $xmlFilter->custom == "1" ? true : false);

        return $filter;
    }

}
