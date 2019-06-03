<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require APPPATH.'modules/api/libraries/REST_Controller.php';
class Api extends REST_Controller {
	
	private $requestedclass;
	private $requestedmethod;
	private $functionnames = array('removeProductsReceipts'=>'removeProductsReceipts_post','completeReceipt'=>'completeReceipt_post', 'getModifyProductCost'=>'getModifyProductCost_post','getSingleProduct'=>'getSingleProduct_post','getProductsReceipts'=>'getProductsReceipts_post', 'addReceiptProduct'=>'addReceiptProduct_post','createProduct' => 'createProduct_post','getProducts' => 'getProducts_post', 'createReceipt'=>'createReceipt_post','getReceipts'=>'getReceipts_post');
	
	public function __construct()
    {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
     	parent::__construct();
		$this->loads();
    }
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/createProduct
	* METHOD : POST
	* PARAMETERS : DATA ARRAY [ BARCODE, PRODUCT_NAME, PRODUCT_COST, VAT_FK }, username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
	public function createProduct_post(){ 
		$post = json_decode( file_get_contents( 'php://input' ), true );
		$data = $this->checkinput($post);
		$id = $this->api_model->create_record('product',$data['data']);
		$returndata['status']  = true;
		$returndata['message'] = 'Successfully Updated';
		$returndata['data'] = $id;
		$this->response($returndata, 200);
	}
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/getProducts
	* METHOD : POST
	* PARAMETERS :username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
	public function getProducts_post(){ 
		$post = json_decode( file_get_contents( 'php://input' ), true );
		$data = $this->checkinput($post);
		$list = $this->api_model->fetchrecords('product','vatclass');
		$returndata['status']  = true;
		$returndata['message'] = 'Successfully Retreved';
		$returndata['data'] = $list;
		$this->response($returndata, 200);
	}
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/getSingleProduct
	* METHOD : POST
	* PARAMETERS : data[BARCODE], username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
	public function getSingleProduct_post(){ 
		$post = json_decode( file_get_contents( 'php://input' ), true );
		$data = $this->checkinput($post);
		$barcode = $data['data']['BARCODE'];
		$list = $this->api_model->fetchproduct($barcode);
		$returndata['status']  = true;
		$returndata['message'] = 'Successfully Retreved';
		$returndata['data'] = $list;
		$this->response($returndata, 200);
	}
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/createReceipt
	* METHOD : POST
	* PARAMETERS : data[CREATE_USER_PK,STATUS,CREATE_DATE], username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
	public function createReceipt_post(){ 
		$post = json_decode( file_get_contents( 'php://input' ), true );
		$data = $this->checkinput($post);
		$id = $this->api_model->create_record('receipt',$data['data']);
		$returndata['status']  = true;
		$returndata['message'] = 'Successfully Updated';
		$returndata['data'] = $id;
		$this->response($returndata, 200);
	}
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/getReceipts
	* METHOD : POST
	* PARAMETERS : data[CREATE_USER_PK], username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
	public function getReceipts_post(){ 
		$post = json_decode( file_get_contents( 'php://input' ), true );
		$data = $this->checkinput($post);
		$create_user = $data['data']['CREATE_USER_PK'];
		$list = $this->api_model->fetchreceipts($create_user);
		$returndata['status']  = true;
		$returndata['message'] = 'Successfully Retreved';
		$returndata['data'] = $list;
		$this->response($returndata, 200);
	}
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/addReceiptProduct
	* METHOD : POST
	* PARAMETERS : data[CREATED_DATE,RECEIPT_FK,PRODUCT_FK], username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
	public function addReceiptProduct_post(){ 
		
		$post = json_decode( file_get_contents( 'php://input' ), true );
		$data = $this->checkinput($post);
		$id = $this->api_model->add_product_record('receipt_product',$data['data']);
		$returndata['status']  = true;
		$returndata['message'] = 'Successfully Updated';
		$returndata['data'] = $id;
		$this->response($returndata, 200);
	}
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/getProductsReceipts
	* METHOD : POST
	* PARAMETERS : data[CREATE_USER_PK,RECEIPT_PK], username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
	public function getProductsReceipts_post(){ 
		$post = json_decode( file_get_contents( 'php://input' ), true );
		$data = $this->checkinput($post);
		$create_user = $data['data']['CREATE_USER_PK'];
		$receipt_pk = $data['data']['RECEIPT_PK'];
		$list = $this->api_model->fetchreceipts_products($create_user, $receipt_pk );
		$returndata['status']  = true;
		$returndata['message'] = 'Successfully Retreved';
		$returndata['data'] = $list;
		$this->response($returndata, 200);
	}
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/getModifyProductCost
	* METHOD : POST
	* PARAMETERS : data[PRODUCT_PK,RECEIPT_PK, COST], username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
	public function getModifyProductCost_post(){
		$post = json_decode( file_get_contents( 'php://input' ), true );
		$data = $this->checkinput($post);
		$product_pk = $data['data']['PRODUCT_PK'];
		$receipt_pk = $data['data']['RECEIPT_PK'];
		$cost = $data['data']['COST'];
		//print_r($data);exit;
		$list = $this->api_model->update_products_cost($product_pk, $receipt_pk , $cost);
		$returndata['status']  = true;
		$returndata['message'] = 'Successfully Updated';
		$returndata['data'] = $list;
		$this->response($returndata, 200);
	}
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/completeReceipt
	* METHOD : POST
	* PARAMETERS : data[STATUS,RECEIPT] username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
	public function completeReceipt_post(){
		$post = json_decode( file_get_contents( 'php://input' ), true );
		$data = $this->checkinput($post);
		$status = $data['data']['STATUS'];
		$receipt = $data['data']['RECEIPT'];
		$list = $this->api_model->update_receipt_status($status,$receipt);
		$returndata['status']  = true;
		$returndata['message'] = 'Successfully Updated';
		$returndata['data'] = $list;
		$this->response($returndata, 200);		
	}
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/removeProductsReceipts
	* METHOD : POST
	* PARAMETERS : data[PRODUCT_PK,RECEIPT_PK] username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
	public function removeProductsReceipts_post(){
		
		$post = json_decode( file_get_contents( 'php://input' ), true );
		$data = $this->checkinput($post);
		$product_pk = $data['data']['PRODUCT_PK'];
		$receipt_pk = $data['data']['RECEIPT_PK'];
		//print_r($data);exit;
		$list = $this->api_model->remove_products_receipt($product_pk, $receipt_pk);
		$returndata['status']  = true;
		$returndata['message'] = 'Successfully Removed';
		$returndata['data'] = $list;
		$this->response($returndata, 200);
		
	}
	
	
	//error handling function 
	private function senderror($error_name, $error_id, $ht_status)
	{
		$returnerror['status'] = false;        
        $returnerror['error'] =  $error_name;
        $returnerror['error_code'] =  $error_id;
        $this->response($returnerror,  $ht_status); 	
	}
	
	/* 
	* authorization function
	* Extend with OAUTH 2
	*/
	private function checkinput($post)
	{		
		if(isset($post['username']) && isset($post['password']) && isset($post['data']) )
        {			
			if($this->api_model->verify_user_name($post['username'])){
				return $post;
			}else{
				$this->senderror("Unauthorized access",1001, 401);
			}
			
        }else{
			$this->senderror("Required data is missing",1000, 400);
		}
	}
	
	
	private function getbasicviewdata()
	{
		$data['assetsurl'] = assets_url();
		return $data;
	}
	
	// loaing important libraries
	private function loads()
	{
		$this->load->library('user_agent');
        $this->load->library('session');
        $this->load->helper(array('url','common','string'));
		$this->load->model('rest/api_model');
	}
}