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
 * Transform Filters-XML datatype to \ZendService\ZendServerAPI\DataTypes\Filters
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Filters extends Adapter
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
        $xmlFilter = $this->getElements("//filter");

        $filters = new  \ZendService\ZendServerAPI\DataTypes\Filters();

        foreach ($xmlFilter as $xmlFilterElement) {
            $filter = new \ZendService\ZendServerAPI\DataTypes\Filter();
            $filter->setData(!empty($xmlFilterElement->data) ? (array) json_decode($xmlFilterElement->data) : array());
            $filter->setName(trim((string) $xmlFilterElement->name));
            $filter->setId((int) $xmlFilterElement->id);
            $filter->setCustom((string) $xmlFilterElement->custom == "1" ? true : false);

            $filters->addFilter($filter);
        }

        return $filters;
    }

}
