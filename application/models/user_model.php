<?php

class User_model extends CI_Model {

   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
	
    function checklogin($logindata){
		$username = $this->db->escape($logindata['user_username']);
		$sql = "SELECT U.ROLE_FK as role_id, U.USER_PK AS user_id, U.USERNAME AS user_name, U.NAME AS name, U.EMAIL AS user_email , U.PASSWORD AS user_password FROM USER U WHERE U.USERNAME = {$username}  AND U.DISABLED = 0 LIMIT ?,?";
		$query = $this->db->query($sql, array(0, 1));
		//echo $query->num_rows();exit;
        if($query->num_rows()>0){
			$result = $query->row_array();//print_r($result);exit;			
			$result['querystatus'] = 'success';
		}else{
			$result['querystatus'] = 'failure';
			$result['message'] = 'No User Found with this Username and Password';
		}
		return $result;
	}
	
	
	function getuserpage($userdata)
	{
		if(!empty($userdata))
		{
			$query = $this->db->query("SELECT * FROM ROLE WHERE ROLE_PK=".$userdata['role_id']);
			if($query->num_rows()>0)
			{
				$result = $query->row_array();
				$result['querystatus'] = 'success';
			}
			else
			{
				$result['querystatus'] = 'failure';
				$result['message'] = 'No Role Assigned to User';
			}
			return $result;
			
		}
	}

}

?>