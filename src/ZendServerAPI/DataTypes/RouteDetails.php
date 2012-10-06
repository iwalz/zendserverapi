<?php
namespace ZendServerAPI\DataTypes;

class RouteDetails
{
    protected $routeDetails = array();
    
    public function addRouteDetails(\ZendServerAPI\DataTypes\RouteDetail $routeDetail)
    {
        $this->routeDetails[] = $routeDetail;
    }
    
    public function getRouteDetails()
    {
        return $this->routeDetails;
    }
    
    public function __construct()
    {

    }
}
