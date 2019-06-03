<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MX_Controller {

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
		$this->list_all_receipts(); 
    }
	
	/*
	* create a receipt, createReceipt API is using for register one receipt
	*/
	public function create_receipt() {
        $data = $this->getbasicviewdata();
        $data['pagetitle'] = "Create New Receipt";
        $data['mode'] = "create";
        if ($_POST) {
			$url = base_url() . "rest/api/createReceipt/format/json";
			unset($_POST['mode']);
			$block = $_POST;
			$block['CREATE_USER_PK'] = getsessiondata('user_id');
			$block['STATUS'] = 0;
			$block['CREATE_DATE'] = date('Y-m-d H:i:s');
			//print_r($block);exit;			
			$datapost = $this->makedataforapi($block);
			$jsondata = $this->sendPostData($url, $datapost);			
			$result = json_decode($jsondata, true);
			if($result['status'] == 1){
				set_flashmessage('success', $result['message']);						 				
				redirect(base_url()."user/list_all_receipts");
			}else{
				set_flashmessage('error', $result['error']);
				redirect(base_url()."user/create_receipt");
			}
        } else {
            $this->load->view("create_receipt", $data);
        }
    }
	
	
	/*
	* list all receipts, getReceipts API is using
	*/
    public function list_all_receipts() {
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
	* Product to a receipt, addReceiptProduct API is using for register one receipt
	*/
	public function add_product($receipt) {
        $data = $this->getbasicviewdata();
        $data['pagetitle'] = "Add Product to Receipt";
        $data['mode'] = "create";
		$data['receipt'] = $this->user_model->getreceipt($receipt);
		//print_r($data['receipt']);exit;
		$data['plist'] = $this->user_model->fetchproducts();
		$data['RECEIPT_PK'] = $receipt;
        $this->load->view("add_product_receipt", $data);
    }
	
	/*
	* receipt product submit : call API- addReceiptProduct
	*/
	public function product_receipt_submit(){
		if ($_POST) {
			$url = base_url() . "rest/api/addReceiptProduct/format/json";
			unset($_POST['mode']);
			$block = $_POST;			
			$block['CREATED_DATE'] = date('Y-m-d H:i:s');
			//print_r($block);exit;			
			$datapost = $this->makedataforapi($block);
			$jsondata = $this->sendPostData($url, $datapost);			
			$result = json_decode($jsondata, true);
			if($result['status'] == 1){
				set_flashmessage('success', $result['message']);						 				
				redirect(base_url()."user/list_all_receipts");
			}else{
				set_flashmessage('error', $result['error']);
				redirect(base_url()."user/add_product");
			}
		}
           
	}
	
	
	/*
	* List products under a receipt, getProductsReceipts API is using
	*/
    public function list_products_receipts($receipt) {		
        $data = $this->getbasicviewdata();
		$block = array();
		$url = base_url() . "rest/api/getProductsReceipts/format/json";
		$block['CREATE_USER_PK'] = getsessiondata('user_id');
		$block['RECEIPT_PK'] = $receipt;
		$data['receipt'] = $this->user_model->getreceipt($receipt);
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
	* fet product using barcode , API:getSingleProduct
	*/
	public function getSingleProduct($code){
		$barcode = $code;
		$block = array();
		$block['BARCODE'] = $barcode;
		$url = base_url() . "rest/api/getSingleProduct/format/json";
		$datapost = $this->makedataforapi($block);
		$jsondata = $this->sendPostData($url, $datapost);			
		$result = json_decode($jsondata, true);
		echo "<pre>";print_r($result);exit;
		
	}
	/*
	*Modify  product cost in receipt , getModifyProductCost method
	*/
	public function modifycost($product,$receipt,$cost=0){
		if($cost==0){
			$cost = 90;
		}		
		$block = array();
		$block['COST'] = $cost;
		$block['PRODUCT_PK'] = $product;
		$block['RECEIPT_PK'] = $receipt;
		$url = base_url() . "rest/api/getModifyProductCost/format/json";
		$datapost = $this->makedataforapi($block);
		$jsondata = $this->sendPostData($url, $datapost);
		$result = json_decode($jsondata, true);
		redirect(base_url()."user/list_products_receipts/$receipt");	
	}
	
	/*
	*finish receipt, change status as completed, completeReceipt Method
	*/
	public function finish_receipt($receipt){
		$block = array();
		$block['STATUS'] = 1;
		$block['RECEIPT'] = $receipt;
		$url = base_url() . "rest/api/completeReceipt/format/json";
		$datapost = $this->makedataforapi($block);
		$jsondata = $this->sendPostData($url, $datapost);
		$result = json_decode($jsondata, true);
			if($result['status'] == 1){
				set_flashmessage('success', $result['message']);						 				
				redirect(base_url()."user/list_all_receipts");
			}else{
				set_flashmessage('error', $result['error']);
				redirect(base_url()."user/list_all_receipts");
			}	
	}
	
	/*
	*print receipt, 
	*/
	public function print_receipt($receipt){
		$data = $this->getbasicviewdata();
		$block = array();
		$url = base_url() . "rest/api/getProductsReceipts/format/json";
		$block['CREATE_USER_PK'] = getsessiondata('user_id');
		$block['RECEIPT_PK'] = $receipt;
		$data['receipt'] = $this->user_model->getreceipt($receipt);
		$data['RECEIPT_FK'] = $receipt;
		$datapost = $this->makedataforapi($block);
		$jsondata = $this->sendPostData($url, $datapost);			
		$result = json_decode($jsondata, true);
		//echo "<pre>";print_r($result);exit;
		//foreach($data as $k=>$v)
			$this->load->library('html2pdf');		
			/*$this->fpdf->SetFont('Arial','B',18);		
			$this->fpdf->Cell(1,10,'RECEIPT');
			$this->fpdf->SetFont('Arial','B',12);
			$this->fpdf->Cell(1,30,'PRODUCT NAME',0,0,'L'); $this->fpdf->Cell(1,30,'COST',);
			
			echo $this->fpdf->Output('hello_world.pdf','I');// Name of PDF file*/
				

			$this->fpdf->SetFont('Arial','B',16);		
			$nombre = "RECEIPT";
			$t1 = "PRODUCT NAME";  $t2 = "COST"; $t1 = "PRODUCT NAME";  $t3 = "FINAL COST"; $t4 = 'VAT RATE'; $t5 = 'SUB TOTAL';
			$pos = 10;
			$this->fpdf->SetXY(0, 10);
			$this->fpdf->SetX(11.5);
			$this->fpdf->Cell(0,$pos,$nombre,0,0,'C');
			$this->fpdf->SetFont('Arial','B',10);
			$this->fpdf->SetX(11.5);
			$pos = $pos + 30;
			$this->fpdf->SetFont('','U');
			$this->fpdf->Cell(50,$pos,$t1,0,0,'C');   $this->fpdf->Cell(30,$pos,$t2,0,0,'C');  $this->fpdf->Cell(30,$pos,$t3,0,0,'C');
			$this->fpdf->Cell(30,$pos,$t4,0,0,'C'); $this->fpdf->Cell(30,$pos,$t5,0,0,'C');
			$this->fpdf->SetFont('','');
			$tot1 = 0; $tot2 = 0;
			foreach($result['data'] as $k=>$v){
				
				$t1 = $v['PRODUCT_NAME']; $t2 = $v['PRODUCT_COST'];
				if($v['MODIFIED_COST']!=0){  $t3 = $v['MODIFIED_COST'].'[Modified]'; } else{$t3 = $v['PRODUCT_COST']; }
				$t4 =  $v['VAT_RATE']; 
				$this->fpdf->SetX(11.5);
				$pos = $pos + 12;
				$tt4 = $t3*($t4/100); $t4 = $tt4.'['.$t4.'%]';
				$t5 = $tt4 + $t3;
				$this->fpdf->Cell(50,$pos,$t1,0,0,'C');   $this->fpdf->Cell(30,$pos,$t2,0,0,'C');  $this->fpdf->Cell(30,$pos,$t3,0,0,'C');  
				$this->fpdf->Cell(30,$pos,$t4,0,0,'C');  $this->fpdf->Cell(30,$pos,$t5,0,0,'C');
				$tot1 += $t2; $tot2 +=  $t3; $tot3 += $t5;
				
			}
			$this->fpdf->SetX(11.5);
			$pos = $pos + 30;
			$this->fpdf->SetFont('','U');
			$this->fpdf->Cell(50,$pos,'Grand Total',0,0,'C');   $this->fpdf->Cell(30,$pos,$tot1,0,0,'C');  $this->fpdf->Cell(30,$pos,$tot2,0,0,'C');
			$this->fpdf->Cell(30,$pos,'',0,0,'C');$this->fpdf->Cell(30,$pos,$tot3,0,0,'C');
			
			
			echo $this->fpdf->Output('hello_world.pdf','I');// Name of PDF file
		
	}	

	private function loads() {
        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->library('hashwrapper');
        $this->load->helper(array('form', 'url', 'common', 'string', 'file'));
        $this->load->model('user_model');
		$this->load->model('admin/admin_model');
    }
	private function getbasicviewdata() {
        $pageinfo['url_method'] = $this->router->fetch_method();
        $pageinfo['url_class'] = $this->router->fetch_class();
        $pageinfo['url_complete'] = getsessiondata('class_url');
        $data['pageinfo'] = $pageinfo;
        $data['assetsurl'] = assets_url();
        return $data;
    }
	/*
	*Send curl POST
	*/
	 private function sendPostData($url, $post) {
		//echo $url; echo $post;exit;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		$result = curl_exec($ch);
		//print_r($result);
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

}

?>