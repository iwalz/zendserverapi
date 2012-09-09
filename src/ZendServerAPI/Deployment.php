<?php

namespace ZendServerAPI;

class Deployment extends BaseAPI 
{
    /**
     * Construct of 'Deployment' section
     * 
     * @access public
     * @param string $name name of the server to connect to
     * @param \ZendServerAPI\Request $request Request object that should be used
     */
	public function __construct($name = null, \ZendServerAPI\Request $request = null)
	{
	    parent::__construct($name);
	    
		if($request !== null)
			$this->request = $request;
	}
	
}

?>