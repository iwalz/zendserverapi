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
class JobqueueResumeRules extends Method
{
    protected $rules = array();

    /**
     * set arguments for JobqueueRuleInfo
     *
     * @param
     */
    public function setArgs($rules)
    {
        $this->rules = $rules;
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
        $this->setFunctionPath('/ZendServerManager/Api/jobqueueResumeRules');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\DumpParser());
    }

    /**
     * Get content for post body
     *
     * @return string
     */
    public function getContent()
    {
        $content = $this->buildParameterArray('rules', $this->rules);

        return $content;
    }
}
