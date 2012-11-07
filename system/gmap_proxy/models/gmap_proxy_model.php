<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gmap_proxy_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function log_query($query, $limit, $offset)
	{
		if($limit !== FALSE)
		{
			$query .= '&limit='.$limit;
		}

		if($offset !== FALSE)
		{
			$query .= '&offset='.$offset;
		}

		$this->db->insert('gmap_api_logs', array(
			'query'      => $query,
			'date'       => $this->localize->now,
			'ip_address' => $this->input->ip_address()
		));
	}	
}