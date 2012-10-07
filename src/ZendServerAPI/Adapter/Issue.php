<?php
namespace ZendServerAPI\Adapter;

class Issue extends Adapter
{
    /**
     * @see \ZendServerAPI\Adapter\Adapter::parse()
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $issue = new \ZendServerAPI\DataTypes\Issue();
        $issue->setId((string) $xml->responseData->issue->id);
        $issue->setRule((string) $xml->responseData->issue->rule);
        $issue->setCount((string) $xml->responseData->issue->count);
        $issue->setLastOccurance((string) $xml->responseData->issue->lastOccurance);
        $issue->setSeverity((string) $xml->responseData->issue->severity);
        $issue->setStatus((string) $xml->responseData->issue->status);

        $generalDetails = new \ZendServerAPI\DataTypes\GeneralDetails();
        $generalDetails->setUrl((string) $xml->responseData->issue->generalDetails->url);
        $generalDetails->setSourceFile((string) $xml->responseData->issue->generalDetails->sourceFile);
        $generalDetails->setSourceLine((string) $xml->responseData->issue->generalDetails->sourceLine);
        $generalDetails->setFunction((string) $xml->responseData->issue->generalDetails->function);
        $generalDetails->setAggregationHint((string) $xml->responseData->issue->generalDetails->aggregationHint);
        $generalDetails->setErrorString((string) $xml->responseData->issue->generalDetails->errorString);
        $generalDetails->setErrorType((string) $xml->responseData->issue->generalDetails->errorType);
        $issue->setGeneralDetails($generalDetails);

        if (isset($xml->responseData->issue->routeDetails->routeDetail)) {
            foreach ($xml->responseData->issue->routeDetails->routeDetail as $xmlRouteDetail) {
                $routeDetails = new \ZendServerAPI\DataTypes\RouteDetail();
                $routeDetails->setKey($xmlRouteDetail->key);
                $routeDetails->setValue($xmlRouteDetail->value);
                $issue->addRouteDetails($routeDetails);
            }
        }
        
        return $issue;
    }
}

?>