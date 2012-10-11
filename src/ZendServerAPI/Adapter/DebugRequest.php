<?php
namespace ZendServerAPI\Adapter;

class DebugRequest extends Adapter
{
    /**
     * @see \ZendServerAPI\Adapter\Adapter::parse()
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $debugRequest = new \ZendServerAPI\DataTypes\DebugRequest();
        $debugRequest->setSuccess((string) $xml->responseData->debugRequest->success);
        $debugRequest->setMessage((string) $xml->responseData->debugRequest->message);

        return $debugRequest;
    }
}
