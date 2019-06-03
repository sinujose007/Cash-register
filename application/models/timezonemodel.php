<?php

class Timezonemodel extends CI_Model {

   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();

// Let's set timezone in the DB
		$timezone = $this->config->item('app_timezone');
		$this->db->query("SET time_zone = '$timezone'");
    }
    
}

?>