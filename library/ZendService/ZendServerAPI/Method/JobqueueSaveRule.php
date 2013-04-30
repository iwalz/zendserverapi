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
 * <b>The jobqueueSaveRule Method</b>
 *
 * <pre>Retrieve and display a job rule information</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class JobqueueSaveRule extends Method
{
    protected $url = null;
    protected $vars = null;
    protected $options = null;

    /**
     * set arguments for JobqueueSaveRule
     *
     * @param
     */
    public function setArgs($url, $options, $vars)
    {
        $this->url = $url;
        $this->vars = $vars;
        $this->options = $options;
        $this->configure();

        return $this;
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/Api/jobqueueSaveRule');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\DumpParser());
    }

    /**
     * Returns the correct accept header for a specific version
     *
     * @see \ZendService\ZendServerAPI\Method\Method::getAcceptHeader()
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.3";
    }

    /**
     * Get content for post body
     *
     * @return string
     */
    public function getContent()
    {
        $content = "url=" . urlencode($this->url);
        $content .= "&options[schedule]=" .  $this->options;
        #$content .= "&" . $this->buildParameterArray('vars', $this->vars);

        return $content;
    }
}
