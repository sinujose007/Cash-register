<?php

class Admin_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
	
	function get_all_users() {
        $returndata = array();
        $query = $this->db->query("SELECT U.USER_PK AS user_id, U.ROLE_FK AS user_role_id,U.NAME AS user_name, U.USERNAME AS user_username, U.EMAIL AS user_email,R.NAME AS user_role_name,R.START_URL AS user_start_url FROM USER U JOIN ROLE R ON U.ROLE_FK = R.ROLE_PK WHERE U.DISABLED = 0");
        $returndata = $query->result_array();
        return $returndata;
    }
	
	function get_all_roles() {
        $query = $this->db->query("SELECT ROLE_PK AS role_id, NAME AS role_name FROM ROLE");
        $returndata = $query->result_array();
        return $returndata;
    }
	
	function adduser($userdata) {
        $userid = $this->create_record('USER', $userdata);
        if ($this->db->affected_rows() > 0 && isset($userid)) {
            $return = 'User succesfully added';
        } else {
            $return = "Some Problem occured while adding the user, Try again , if problem persists , Contact Administrator";
        }
        return $return;
    }
	
	function checkuser($username) {
        $sql = "SELECT * FROM USER WHERE USERNAME = ?";
		$query = $this->db->query($sql,array($username));
        if ($query->num_rows() > 0)
            return true;
        else
            return false;
    }
	
	function getuserdata($user_id) {
        $returndata = array();
        $sql = "SELECT U.USER_PK AS user_id, U.ROLE_FK AS user_role_id, U.NAME AS user_name, U.USERNAME AS user_username, U.PASSWORD AS user_password, U.EMAIL AS user_email,
		R.NAME AS user_role_name,R.START_URL AS user_start_url FROM USER U JOIN ROLE R ON U.ROLE_FK = R.ROLE_PK  WHERE U.DISABLED = ? AND U.USER_PK = ? ";
        $query = $this->db->query($sql,array(0,$user_id));
		$returndata = $query->row_array();
        return $returndata;
    }
	function getroleitems($roleid) {
        $sql = "SELECT NAME AS role_name , START_URL AS role_start_url FROM ROLE WHERE ROLE_PK = ?";
        $query = $this->db->query($sql,array($roleid));
		if ($query->num_rows() > 0) {
            $roledata = $query->row_array();
             $returndata['role_name'] = $roledata['role_name'];
            $returndata['role_start_url'] = $roledata['role_start_url'];
        } else {
            $returndata = false;
        }
        return $returndata;
    }
	function getvatrate() {
        $query = $this->db->query("SELECT * from vatclass");
        $returndata = $query->result_array();
        return $returndata;
    }
	function getreceipt($receipt){
		$returndata = array();
		$sql = "SELECT RECEIPT_NAME  FROM receipt WHERE RECEIPT_PK = ?";
        $query = $this->db->query($sql,array($receipt));
		if ($query->num_rows() > 0) {
           $returndata = $query->row_array();
        }
        return $returndata;
	}
	
}

?>