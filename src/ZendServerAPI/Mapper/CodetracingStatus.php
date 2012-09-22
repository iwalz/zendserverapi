<?php
namespace ZendServerAPI\Mapper;

class CodetracingStatus extends Mapper
{
	/**
     * @see \ZendServerAPI\Mapper\Mapper::parse()
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $codetracingStatus = new \ZendServerAPI\DataTypes\CodeTracingStatus();
        $codetracingStatus->setComponentStatus((string)$xml->responseData->codeTracingStatus->componentStatus);
        $codetracingStatus->setAlwaysDump((string)$xml->responseData->codeTracingStatus->alwaysDump);
        $codetracingStatus->setTraceEnabled((string)$xml->responseData->codeTracingStatus->traceEnabled);
        $codetracingStatus->setAwaitsRestart((string)$xml->responseData->codeTracingStatus->awaitsRestart);
        
        return $codetracingStatus;
    }
}

?>