<?php
namespace ZendServerAPI\Method;

class RestartPHP extends \ZendServerAPI\Method
{
    private $paramter = null;
    
    public function __construct(array $servers = array())
    {
        $this->setParameter($servers);
        parent::__construct();
    }
    
    private function setParameter($parameter)
    {
        $this->parameter = $parameter;
    }
    
    function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/restartPhp');
        $this->setParser(new \ZendServerAPI\Mapper\ServersList());
    }
    
    public function getContent()
    {
        $content = "";
        $parameterCount = count($this->parameter);
    
        foreach($this->parameter as $index => $parameter)
        {
            $content .= urlencode("servers[".$index."]")."=".$parameter;
            if($index+1 < $parameterCount)
                $content .= "&";
        }
    
        return $content;
    }

}

?>