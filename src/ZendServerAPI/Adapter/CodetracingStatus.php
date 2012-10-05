<?php
namespace ZendServerAPI\Adapter;

class CodetracingStatus extends Adapter
{
    /**
     * @see \ZendServerAPI\Adapter\Adapter::parse()
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $codetracingStatus = new \ZendServerAPI\DataTypes\CodeTracingStatus();
        $codetracingStatus->setComponentStatus((string) $xml->responseData->codeTracingStatus->componentStatus);
        $codetracingStatus->setAlwaysDump(((string) $xml->responseData->codeTracingStatus->alwaysDump) == '0' ? false : true);
        $codetracingStatus->setTraceEnabled(((string) $xml->responseData->codeTracingStatus->traceEnabled) == '0' ? false : true);
        $codetracingStatus->setAwaitsRestart(((string) $xml->responseData->codeTracingStatus->awaitsRestart) == '0' ? false : true);
        $codetracingStatus->setDeveloperMode(((string) $xml->responseData->codeTracingStatus->developerMode) == '0' ? false : true);

        return $codetracingStatus;
    }
}
