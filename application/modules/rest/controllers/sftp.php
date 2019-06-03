<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//if (isset($_SERVER['REMOTE_ADDR']) && ($_SERVER['REMOTE_ADDR']!='35.177.211.163')) exit('FAR AWAY');

class Sftp extends REST_Controller {

    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        parent::__construct();
		$this->load->library('OAUTH2/Server');
		$this->load->model('admin/admin_model');		
    }
    public function token_post() {
        $this->load->helper(array('form', 'url', 'common', 'string', 'file'));
        $this->server->client_credentials(); 
	}
}