<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {

    private $requestedclass;
    private $requestedmethod;

    public function __construct() {
        parent::__construct();
		$this->load->helper("common");
		 
        if(!isset($_SESSION)){ session_start(); }
        $this->loads();        
	}
	
	/*
	* admin index page
	*/
    public function index($viewname = "index") {
		$this->list_all_users();
    }
	
	/*
	* admin list all users
	*/	
	public function list_all_users() {
        $data = $this->getbasicviewdata();
        $roles = $this->admin_model->get_all_users();
        $data['users'] = $roles;
        $data['pagetitle'] = "List of all Users";
        $this->load->view("listallusers", $data);
    }
	
	/*
	* create a user
	*/    
    public function create_user() {
        if ($_POST) {
            $this->submituser();
        } else {
            $roles = $this->admin_model->get_all_roles();
            $data = $this->getbasicviewdata();
            $data['mode'] = 'create';
            $data['roles'] = $roles;
            $data['user_password_new'] = random_string('alnum', 8);
            $data['pagetitle'] = "Create New User";
            $this->load->view("create_user", $data);
        }
    }
	
	/*
	* submit user form
	*/	
	private function submituser() {
        $userdata = array();
        $replace = array('user_full_name' => 'NAME', 'username' => 'USERNAME', 'password' => 'PASSWORD', 'user_role' => 'ROLE_FK', 'user_email' => 'EMAIL');
        $post = getposteddata($replace);
        $userdata['user_username'] = $post['USERNAME'];
        $userdata['user_password'] = $post['PASSWORD'];
		if (isset($post['NAME']) && isset($post['USERNAME']) && isset($post['PASSWORD']) && isset($post['ROLE_FK'])) {
            if (!$this->userduplication($post['USERNAME'])) {
                $post['PASSWORD'] = $this->hashwrapper->createhash($post['PASSWORD']);
				//echo "<pre>";print_r($post); exit;
				unset($post['mode']);
                $message = $this->admin_model->adduser($post);
				set_flashmessage('success', "Added Successfully");				
				redirect(base_url()."admin/list_all_users");
            } else {
				set_flashmessage('error', $post['USERNAME'] . '" already exists, try with another username');
                $this->list_all_users();
            }
        } else {
			set_flashmessage('error', 'Some Problem occurred, Try again or Contact Administrator');
            $this->list_all_users();
        }
    }
	
	
	/*
	* check user duplicate
	*/
	private function userduplication($username) {
        $return = $this->admin_model->checkuser($username);
        return $return;
    }
    
	
	
	/*
	* update a user
	*/
    public function update_user() {
        if ($_POST) {
            $replace = array('user_full_name' => 'NAME', 'username' => 'USERNAME', 'password' => 'PASSWORD', 'user_role' => 'ROLE_FK','user_email' => 'EMAIL', 'user_id' => 'USER_PK');
            $post = getposteddata($replace);
            if (isset($post['USERNAME']))
                unset($post['USERNAME']);
            if (checkvariable($post['USER_PK'])) {
                $condition['USER_PK'] = $post['USER_PK'];
                unset($post['USER_PK']);
                if (checkvariable($post['ROLE_FK'])) {
                    if (isset($post['PASSWORD']) && trim($post['PASSWORD']) != '')
                        $post['PASSWORD'] = $this->hashwrapper->createhash($post['PASSWORD']);
                    elseif (isset($post['PASSWORD']) && trim($post['PASSWORD']) == '')
                        unset($post['PASSWORD']);
                    $update = $this->admin_model->update_record('USER', $post, $condition);
                    if ($update == true)
                        set_flashmessage('success', "Updated Successfully");						 				
					redirect(base_url()."admin/list_all_users");
                }
            }
            else {
                set_flashmessage('error', "Unable to Identify and Update User, Please Retry or Contact Administrator");
                $this->list_all_users();
            }
        } else {
            $userid = $this->input->get('userid');
            if (checkvariable($userid)) {
                $userdata = $this->admin_model->getuserdata($userid);
                if (checkvariable($userdata)) {
                    $roles = $this->admin_model->get_all_roles();
                    $data = $this->getbasicviewdata();
                    $data['mode'] = "update";
                    $data['userdata'] = $userdata;
                    $data['roles'] = $roles;
                    $data['pagetitle'] = "Update User";
                    $this->load->view("create_user", $data);
                } else {
                    set_flashmessage('error', "Unable to Identify User, Please Retry or Contact Administrator");
                    $this->list_all_users();
                }
            } else {
                $this->list_all_users();
            }
        }
    }
    
	
	
	/*
	* create a product , createProduct API is using
	*/
	public function create_product() {
        $data = $this->getbasicviewdata();
        $data['pagetitle'] = "Create New Product";
        $data['mode'] = "create";
		$data['vat'] = $this->admin_model->getvatrate();
        if ($_POST) {
			if(isset($_POST['mode']) && $_POST['mode']=='create'){
				$url = base_url() . "rest/api/createProduct/format/json";
			}
			if(isset($_POST['mode']) && $_POST['mode']=='update'){
				$url = base_url() . "rest/api/updateProduct/format/json";
			}
			unset($_POST['mode']);
			$block = $_POST;
			$datapost = $this->makedataforapi($block);
			$jsondata = $this->sendPostData($url, $datapost);			
			$result = json_decode($jsondata, true);
			if($result['status'] == 1){
				set_flashmessage('success', $result['message']);						 				
				redirect(base_url()."admin/list_product");
			}else{
				set_flashmessage('error', $result['error']);
				redirect(base_url()."admin/create_product");
			}
        } else {
            $this->load->view("create_product", $data);
        }
    }
	
	/*
	* Retreve Products , getProducts API is using
	*/
    public function list_product() {
		$block = array();
		$url = base_url() . "rest/api/getProducts/format/json";
		$datapost = $this->makedataforapi($block);
		$jsondata = $this->sendPostData($url, $datapost);			
		$result = json_decode($jsondata, true);
		$list = $result['data'];
        $data = $this->getbasicviewdata();
		$data['denoms'] = $list;
        $data['pagetitle'] = "List of all Products";
        $this->load->view("listallproducts", $data);
    }

	private function loads() {
        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->library('hashwrapper');
        $this->load->helper(array('form', 'url', 'common', 'string', 'file'));
        $this->load->model('admin_model');
    }
	private function getbasicviewdata() {
        $pageinfo['url_method'] = $this->router->fetch_method();
        $pageinfo['url_class'] = $this->router->fetch_class();
        $pageinfo['url_complete'] = getsessiondata('class_url');
        $data['pageinfo'] = $pageinfo;
        $data['assetsurl'] = assets_url();
        return $data;
    }
	 private function sendPostData($url, $post) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
    }

    private function makedataforapi($block) {
        $userdata = $this->admin_model->getuserdata(getsessiondata('user_id'));
        if (!empty($userdata)) {
            $tempdata['data'] = $block;
            $tempdata['username'] = $userdata['user_username'];
            $tempdata['password'] = $userdata['user_password'];
            $tempdata = json_encode($tempdata);
            return $tempdata;
        }
    }
	
	/*
	* list all receipts, getReceipts API is using
	*/
    public function list_receipt() {
		$block = array();
		$url = base_url() . "rest/api/getReceipts/format/json";
		$block['CREATE_USER_PK'] = getsessiondata('user_id');
		$datapost = $this->makedataforapi($block);
		$jsondata = $this->sendPostData($url, $datapost);			
		$result = json_decode($jsondata, true);
		//print_r($result);exit;
		$list = $result['data'];
		//print_r($list);exit;
        $data = $this->getbasicviewdata();
		$data['report_sup'] = $list;
        $data['pagetitle'] = "List of all Receipts";
        $this->load->view("receipt_list", $data);
    }
	
	/*
	* List products under receipt , getProductsReceipts API is using
	*/
    public function list_products_receipts($receipt) {		
        $data = $this->getbasicviewdata();
		$block = array();
		$url = base_url() . "rest/api/getProductsReceipts/format/json";
		$block['CREATE_USER_PK'] = getsessiondata('user_id');
		$block['RECEIPT_PK'] = $receipt;
		$data['receipt'] = $this->admin_model->getreceipt($receipt);
		$data['RECEIPT_FK'] = $receipt;
		$datapost = $this->makedataforapi($block);
		$jsondata = $this->sendPostData($url, $datapost);			
		$result = json_decode($jsondata, true);
		//print_r($result);exit;
		$list = $result['data'];
		//echo "<pre>";print_r($list);exit;
		$data['denoms'] = $list;
        $data['pagetitle'] = "List of Products Per Receipts";
        $this->load->view("receipt_product_list", $data);
    }
	
	/*
	* remove a product , removeProductsReceipts API is using
	*/
    public function removeProduct($product,$receipt) {		
        $data = $this->getbasicviewdata();
		$block = array();
		$url = base_url() . "rest/api/removeProductsReceipts/format/json";
		$block['CREATE_USER_PK'] = getsessiondata('user_id');
		$block['RECEIPT_PK'] = $receipt;
		$block['PRODUCT_PK'] = $product;
		$data['receipt'] = $this->admin_model->getreceipt($receipt);
		$data['RECEIPT_FK'] = $receipt;
		$datapost = $this->makedataforapi($block);
		$jsondata = $this->sendPostData($url, $datapost);	
			$result = json_decode($jsondata, true);
			if($result['status'] == 1){
				set_flashmessage('success', $result['message']);						 				
				redirect(base_url()."admin/list_products_receipts/$receipt");
			}else{
				set_flashmessage('error', $result['error']);
				redirect(base_url()."admin/list_products_receipts/$receipt");
			}
    }
}

?>