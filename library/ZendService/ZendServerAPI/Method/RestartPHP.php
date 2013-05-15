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
 * <b>The restartPHP Method</b>
 *
 * <pre>This method restarts PHP on all servers or on specified servers in the cluster.
 * A 202 response in this case does not always indicate a successful restart of all servers.
 * Use the clusterGetServerStatus command to check the server(s) status again after a few seconds.</pre>
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class RestartPHP extends Method
{
    /**
     * ServerIds to restart
     * @var array
     */
    private $servers = null;
    /**
     * Restart servers in parallel
     * @var boolean
     */
    private $parallelRestart = null;

    /**
     * Sert argument for RestartPhp
     *
     * @param array $servers         ServerIds to restart
     * @param bool  $parallelRestart Restart all at the same time
     */
    public function setArgs(array $servers = array(), $parallelRestart = false)
    {
        $this->servers = $servers;
        $this->parallelRestart = $parallelRestart;

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
        $this->setFunctionPath('/Api/restartPhp');
        $this->setParser(new  \ZendService\ZendServerAPI\Adapter\ServersList());
    }

    /**
     * Content for POST request
     *
     * @return string
     */
    public function getContent()
    {
        $content = "";
        $parameterCount = count($this->servers);

        foreach ($this->servers as $index => $server) {
            $content .= urlencode("servers[".$index."]")."=".$server;
            if($index+1 < $parameterCount)
                $content .= "&";
        }
        $content .= "&parallelRestart=".($this->parallelRestart === true ? 'TRUE' : 'FALSE');

        return $content;
    }

}
