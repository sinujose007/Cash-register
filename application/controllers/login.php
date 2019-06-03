<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();	
        $this->load->library('session');
		$this->load->library('hashwrapper');
		$this->load->model('user_model');
        $this->load->helper(array('url','common','string'));
		//pre($this->session->all_userdata());
    }
	
	/*
	* Login homepage redirection
	*/
	public function index()
	{
		//pre($this->session->all_userdata());
		$usersession = getsessiondata('userinfo');
		if(isset($usersession['user_id']))
		{
			$this->gouserhome($usersession);
		}
		else
		{
			unsetsessiondata('loginerror');
			$this->loadloginview();
		}
	}
	
	/*
	* Subbmit the login form and validate
	*/
	public function submitlogin()
	{
		if ($this->input->post('user_validation_check') == getsessiondata('validationcode'))
		{
			$userdata = $this->user_model->checklogin($this->input->post());
			$loginsuccess = $this->checksuccess($userdata);
			if($loginsuccess)
			{
				$dbpassword = $userdata['user_password'];
				if($this->hashwrapper->checkpassword( $this->input->post('user_password'), $dbpassword))
				{		
					setsessiondata(array('userinfo'=>$userdata));
					$this->gouserhome($userdata);
				}
				else
				{
					setsessiondata(array('loginerror'=>'Login Failed')); //Incorrect Username or Password
					$data = $this->getbasiclogindata();
					$this->loadloginview();
				}

			}
		}
		else
		{
			setsessiondata(array('loginerror'=>'Login Failed'));  //Please Use Form to Login
			$data = $this->getbasiclogindata();
			$this->loadloginview();
		
		}
	}
	
	/*
	* Logout function
	*/
	public function user_logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."login");
	}
	
	/*
	* Redirect to home page based on role
	*/
	private function gouserhome($userdata)
	{
		$userroledata = $this->user_model->getuserpage($userdata);
		$rolesuccess = $this->checksuccess($userroledata);
		if($rolesuccess)
		{
			redirect(base_url().$userroledata['START_URL']);
		}

	}
	
	/*
	* Create basic data for view files
	*/
	private function getbasiclogindata()
	{
		$data['assetsurl'] = assets_url();
		$data['validationcode']=random_string('alnum',64);
		return $data;
	}
	
	/*
	* Login form
	*/
	private function loadloginview()
	{
		$data = $this->getbasiclogindata();
		setsessiondata(array('validationcode'=>$data['validationcode']));
		$this->load->view('loginview',$data);
	}
	
	/*
	* Check login success
	*/
	private function checksuccess($array)
	{
		if($array['querystatus'] == 'failure')
		{
			setsessiondata(array('loginerror'=>$array['message']));
			$this->loadloginview();
		}
		else
		{
			return true;
		}
	}	
        
}

/* End of file */