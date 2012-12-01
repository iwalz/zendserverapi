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

/**
 * <b>The applicationGetStatus Method</b>
 *
 * <pre>Get the list of applications currently deployed (or staged)
 * on the server or the cluster and information about each application.
 * If application IDs are specified, this method will return information about the
 * specified applications. If no IDs are specified, this method will return
 * information about all applications on the server or cluster.</pre>
 *
 * @license	http://framework.zend.com/license/new-bsd New BSD License
 * @link		http://github.com/zendframework/zf2 for the canonical source repository
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @category	Zend
 * @package	    Zend_Service
 * @subpackage	ZendServerAPI
 */
class ApplicationGetStatus extends Method
{
    /**
     * Application ID's to get status for
     * @var array
     */
    private $applications = array();


    /**
     * Constructor of method ApplicationGetStatus
     *
     * @param array Applications to get status for
     */
    public function __construct(array $applications = array())
    {
        $this->applications = $applications;
        parent::__construct();
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure ()
    {
        $this->setMethod('GET');
        $this->setFunctionPath('/ZendServerManager/Api/applicationGetStatus');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\ApplicationList());
    }

    /**
     * Get link for the method
     *
     * @return string
     */
    public function getLink()
    {
        $link = $this->getFunctionPath();
        $parameterCount = count($this->applications);

        if($parameterCount > 0)
            $link .= "?";

        foreach ($this->applications as $index => $application) {
            $link .= urlencode("applications[".$index."]")."=".$application;
            if($index+1 < $parameterCount)
                $link .= "&";
        }

        return $link;
    }
}
