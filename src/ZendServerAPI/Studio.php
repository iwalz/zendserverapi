<?php
namespace ZendServerAPI;

class Studio extends BaseAPI
{
    /**
     * The studioStartDebug Method
     *
     * Start a debug session for a specific issue
     *
     * @param  string       $eventsGroupId   Events group ID
     * @param  string       $noRemote        Use server's own local files for debug display
     * @param  string       $overrideHost    Override the host address sent to Zend Server 
     * @return \ZendServerAPI\DataTypes\DebugRequest
     */
    public function studioStartDebug($eventsGroupId, $noRemote = null, $overrideHost = null)
    {
        $this->request->setAction($this->apiFactory->factory('studioStartDebug', $eventsGroupId, $noRemote, $overrideHost));

        return $this->request->send();
    }
    
    /**
     * The studioStartProfile Method
     *
     * Start a profiling session with Zend Studio's integration
     * using an events group identifier
     *
     * @param  string       $eventsGroupId   Events group ID
     * @param  string       $overrideHost    Override the host address sent to Zend Server
     * @return \ZendServerAPI\DataTypes\DebugRequest
     */
    public function studioStartProfile($eventsGroupId, $overrideHost = null)
    {
        $this->request->setAction($this->apiFactory->factory('studioStartProfile', $eventsGroupId, $overrideHost));
    
        return $this->request->send();
    }

}
