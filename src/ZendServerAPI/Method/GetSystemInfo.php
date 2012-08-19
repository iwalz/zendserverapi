<?php

namespace ZendServerAPI\Method;

class GetSystemInfo extends \ZendServerAPI\Method 
{
	public function configure()
	{
		$this->setMethod('GET');
		$this->setFunctionPath('/ZendServerManager/Api/getSystemInfo');
	}
}

?>