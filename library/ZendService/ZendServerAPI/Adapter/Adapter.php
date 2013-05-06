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
 * Base adapter implementation
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
abstract class Adapter
{
    /**
     * The Zend HTTP response object
     * @var \Zend\Http\Response
     */
    protected $response = null;
    /**
     * XML Content
     * @var \SimpleXMLElement
     */
    protected $content = null;

    /**
     * Parse the xml response in object mappings
     *
     * @return \ZendService\ZendServerAPI\DataTypes\DataType
     */
    abstract public function parse();

    /**
     * Set the Zend Http Response
     *
     * @param \Zend\Http\Response
     * @return void
     */
    public function setResponse(\Zend\Http\Response $response)
    {
        $this->response = $response;
    }

    /**
     * Get the Zend HTTP Response
     *
     * @return \Zend\Http\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get the XML content as SimpleXMLElement
     *
     * @return SimpleXMLElement
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the XML content
     *
     * @param  string|SimpleXMLElement   $content
     * @throws \InvalidArgumentException
     */
    public function setContent($content)
    {
        $iconvExists = function_exists('iconv');
        if (is_string($content)) {
            $this->content = $iconvExists ? new \SimpleXMLElement(iconv("UTF-8", "UTF-8//IGNORE", $content)) : new \SimpleXMLElement($content);
        } elseif ($content instanceof \SimpleXMLElement) {
            $this->content = $iconvExists ? new \SimpleXMLElement(iconv("UTF-8", "UTF-8//IGNORE", $content)) : $content;
        } else {
            throw new \InvalidArgumentException("The content needs to be a string or a SimpleXMLElement");
        }
    }

    /**
     * Returns a single element, automatically adds namespaces, if namespace[""] is set
     *
     * @param  string                 $pattern
     * @return \SimpleXMLElement|null
     */
    public function getElement($pattern)
    {
        $returnValue = $this->executeXpath($pattern);

        return $returnValue[0];
    }

    /**
     * Returns an array of \SimpleXMLElement, based on a xPath query.
     * Namespaces are automatically added, if namespace[""] is set in the XML document
     *
     * @param  string     $pattern
     * @return array|null
     */
    public function getElements($pattern)
    {
        $returnValue = $this->executeXpath($pattern);

        return $returnValue;
    }

    /**
     * Transform a "pseudo" xPath query to a real query,
     * automatically adds namespace and prepend levels up to responseData
     *
     * @param  string     $pattern
     * @return array|null
     */
    protected function executeXpath($pattern)
    {
        $prependPrefix = true;
        $prePattern = "/ns:zendServerAPIResponse/ns:responseData";
        $namespace = $this->content->getNamespaces(true);
        $elements = explode("/", $pattern);
        array_shift($elements);

        // Do not add prefix if starts with //
        if (substr($pattern, 0, 2) == "//") {
            $prependPrefix = false;
        }

        // If default namespace is not set, do not register
        if (isset($namespace[""])) {
            $this->content->registerXPathNamespace("ns", $namespace[""]);
            foreach ($elements as $key => $value) {
                if($value != "")
                    $elements[$key] = "ns:" . $value;
            }
        }

        // Generate valid xPath, including namespace
        $xPath = ($prependPrefix ? $prePattern : '') . "/" . implode("/", $elements);

        return $this->content->xpath($xPath);
    }
}
