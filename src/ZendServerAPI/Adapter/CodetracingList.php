<?php
namespace ZendServerAPI\Adapter;

class CodetracingList extends Adapter
{
    /**
     * @see \ZendServerAPI\Adapter\Adapter::parse()
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $codetracingList = new \ZendServerAPI\DataTypes\CodetracingList();
        foreach ($xml->responseData->codeTracingList->codeTrace as $xmlCodetrace) {
            $codetrace = new \ZendServerAPI\DataTypes\CodeTrace();
            $codetrace->setId((string) $xmlCodetrace->id);
            $codetrace->setDate((string) $xmlCodetrace->date);
            $codetrace->setUrl((string) $xmlCodetrace->url);
            $codetrace->setCreatedBy((string) $xmlCodetrace->createdBy);
            $codetrace->setFileSize((string) $xmlCodetrace->fileSize);
            $codetrace->setApplicationId((string) $xmlCodetrace->applicationId);

            $codetracingList->addCodeTrace($codetrace);
        }

        return $codetracingList;
    }
}
