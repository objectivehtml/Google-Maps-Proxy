<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gmap_proxy {
	
	public function __construct()
	{
		$this->EE =& get_instance();
		$this->EE->load->library('gmap_proxy_lib');
	}

	function route()
	{
		$public_methods = array('geocode', 'directions');

		$method = $this->param('method', FALSE, FALSE, TRUE);
		$method = !empty($method) ? $method : 'geocode';

		return $this->EE->gmap_proxy_lib->route($method);
	}

	private function param($param, $default = FALSE, $boolean = FALSE, $required = FALSE)
	{
		$name 	= $param;
		$param 	= $this->EE->TMPL->fetch_param($param);
		
		if($required && !$param) show_error('You must define a "'.$name.'" parameter in the '.__CLASS__.' tag.');
			
		if($param === FALSE && $default !== FALSE)
		{
			$param = $default;
		}
		else
		{				
			if($boolean)
			{
				$param = strtolower($param);
				$param = ($param == 'true' || $param == 'yes') ? TRUE : FALSE;
			}			
		}
		
		return $param;			
	}
}