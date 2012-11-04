<?php

return array(
	"servers" => array (
        # Contains a valid default config
	    "general" => array(
            "version" => \ZendServerAPI\Version::ZS56,
		    "apiName" => "",
		    "fullApiKey" => "",
		    "readApiKey" => "",
		    "host" => "localhost",
		    "port" => "10081"
	    )
    ),
    "settings" => array (
        'loglevel' => \Zend\Log\Logger::DEBUG        
    )
);
