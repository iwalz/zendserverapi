<?php
namespace ZendServerAPI\Adapter;

class Codetrace extends Adapter
{
    /**
     * @see \ZendServerAPI\Adapter\Adapter::parse()
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $codetrace = new \ZendServerAPI\DataTypes\CodeTrace();
        $codetrace->setId((string) $xml->responseData->codeTrace->id);
        $codetrace->setDate((string) $xml->responseData->codeTrace->date);
        $codetrace->setUrl((string) $xml->responseData->codeTrace->url);
        $codetrace->setCreatedBy((string) $xml->responseData->codeTrace->createdBy);
        $codetrace->setFileSize((string) $xml->responseData->codeTrace->fileSize);
        $codetrace->setApplicationId((string) $xml->responseData->codeTrace->applicationId);

        return $codetrace;
    }
}
