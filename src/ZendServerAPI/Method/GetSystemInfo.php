<?php

namespace ZendServerAPI\Method;

use ZendServerAPI\DataTypes\LicenseInfo,
    ZendServerAPI\DataTypes\MessageList;

class GetSystemInfo extends \ZendServerAPI\Method 
{
	public function configure()
	{
		$this->setMethod('GET');
		$this->setFunctionPath('/ZendServerManager/Api/getSystemInfo');
		$this->setParser(new \ZendServerAPI\Mapper\SystemInfo());
	}
}

?>