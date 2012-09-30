<?php
namespace ZendServerAPI;

class Codetracing extends BaseAPI
{
    /**
     * Implementation of codetracingEnable method
     *
     * @param  boolean                                    $restartNow Restart after method call
     * @return \ZendServerAPI\DataTypes\CodeTracingStatus
     */
    public function codetracingEnable($restartNow = true)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingEnable', $restartNow));

        return $this->request->send();
    }

    /**
     * Implementation of codetracingDisable method
     *
     * @param  boolean                                    $restartNow Restart after method call
     * @return \ZendServerAPI\DataTypes\CodeTracingStatus
     */
    public function codetracingDisable($restartNow = true)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingDisable', $restartNow));

        return $this->request->send();
    }

    /**
     * Implementation of codetracingIsEnabled method
     *
     * @return \ZendServerAPI\DataTypes\CodeTracingStatus
     */
    public function codetracingIsEnabled()
    {
        $this->request->setAction($this->apiFactory->factory('codetracingIsEnabled'));

        return $this->request->send();
    }
    
    /**
     * Implementation of codetracingCreate method
     *
     * @param string $url the url to trace
     * @return \ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingCreate($url)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingCreate', $url));
    
        return $this->request->send();
    }
    
    /**
     * Implementation of codetracingDelete method
     *
     * @param integer $id Trace file ID
     * @return \ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingDelete($id)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingDelete', $id));
    
        return $this->request->send();
    }
    
}
