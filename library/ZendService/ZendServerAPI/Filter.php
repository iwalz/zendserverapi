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
 * <b>Filter Methods</b>
 *
 * Filter API actions provide external actors with ways to query and manipulate filters and their definitions.
 * The following is a list of Filter methods:
 *
 * <ul>
 * <li>The filterGetByType Method</li>
 * <li>Ther filterSave Method</li>
 * <li>The filtersDelete Method</li>
 * </ul>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Filter extends BaseAPI
{
    /**
     * <b>The filterGetByType Method </b>
     *
     * <pre>Retrieve and display a list of filters.</pre>
     *
     * @param string $type       <p>The type of a filter (issue,job)</p>
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function filterGetByType($type)
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('filterGetByType')->setArgs($type));
        
        return $this->pluginManager->get('request')->send();
    }

    /**
     * <b>The filterSave Method </b>
     *
     * <pre>Save a filter.</pre>
     *
     * @param string $type       <p>The type of a filter (issue,job)</p>
     * @param string $name       <p>Name of filter.</p>
     * @param int $id            <p>ID of a filter.</p>
     * @param array $data        <p>Array of parameters to be saved.</p>
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function filterSave($type, $name, $data = array(), $id = null)
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('filterSave')->setArgs($type, $name, $id, $data));
    
        return $this->pluginManager->get('request')->send();
    }
    
    /**
     * <b>The filterDelete Method </b>
     *
     * <pre>Deletes a filter.</pre>
     *
     * @param string $name       <p>Name of filter.</p>
     * @return \ZendService\ZendServerAPI\DataTypes\DebugRequest
     */
    public function filterDelete($name)
    {
        $this->pluginManager->get('request')->setAction($this->pluginManager->get('filterDelete')->setArgs($name));
    
        return $this->pluginManager->get('request')->send();
    }
}
