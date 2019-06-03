<?php

class Api_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
	function create_record($tablename, $recorddata) { 
	    $this->db->insert($tablename, $recorddata);
        $id = $this->db->insert_id();
        return $id;
    }
	
	function fetchrecords($product,$joint) {
        $query = $this->db->query("SELECT p.*,j.* from $product p join $joint j where p.VAT_FK=j.VAT_PK");
        $returndata = $query->result_array();
        return $returndata;
    }
	
	function fetchreceipts($create_user){
		
		$query = $this->db->query("SELECT R.* FROM ROLE R JOIN USER U  ON U.ROLE_FK=R.ROLE_PK where U.USER_PK = $create_user");
		$returndata1 = $query->row_array();
		if($returndata1['NAME'] == 'admin'){
			$query = $this->db->query("SELECT u.NAME,r.*,rp.*,p.* from receipt r left join receipt_product rp ON r.RECEIPT_PK=rp.RECEIPT_FK left join  product p ON rp.PRODUCT_FK=p.PRODUCT_PK join user U ON r.CREATE_USER_PK=u.USER_PK  group by RECEIPT_PK");
        }else{
			$query = $this->db->query("SELECT r.*,rp.*,p.* from receipt r left join receipt_product rp ON r.RECEIPT_PK=rp.RECEIPT_FK left join  product p ON rp.PRODUCT_FK=p.PRODUCT_PK where r.CREATE_USER_PK = $create_user group by RECEIPT_PK");
        }
		$returndata = $query->result_array();
        return $returndata;
	}
	
	function add_product_record($tablename, $recorddata) { 
		$bcode = $recorddata['BARCODE'];
		$query = $this->db->query("SELECT PRODUCT_PK from product where BARCODE = '$bcode'");
        $returndata = $query->row_array();
        unset($recorddata['BARCODE']);
		$recorddata['PRODUCT_FK'] = $returndata['PRODUCT_PK'];
		$recorddata['MODIFIED_COST'] = 0; 	$recorddata['DISCOUNT'] = 0;
		//print_r($recorddata); exit;
	    $this->db->insert($tablename, $recorddata);
        $id = $this->db->insert_id();
        return $id;
    }
	
	function fetchreceipts_products($create_user,$receipt_pk){
		$query = $this->db->query("SELECT R.* FROM ROLE R JOIN USER U  ON U.ROLE_FK=R.ROLE_PK where U.USER_PK = $create_user");
		$returndata1 = $query->row_array();
		if($returndata1['NAME'] == 'admin'){
			$query = $this->db->query("SELECT p.*,v.*,rp.MODIFIED_COST from receipt r left join receipt_product rp ON r.RECEIPT_PK=rp.RECEIPT_FK left join  product p ON rp.PRODUCT_FK=p.PRODUCT_PK join vatclass V on P.VAT_FK=v.VAT_PK where r.RECEIPT_PK=$receipt_pk");
      	}else{
			$query = $this->db->query("SELECT p.*,v.*,rp.MODIFIED_COST from receipt r left join receipt_product rp ON r.RECEIPT_PK=rp.RECEIPT_FK left join  product p ON rp.PRODUCT_FK=p.PRODUCT_PK join vatclass V on P.VAT_FK=v.VAT_PK where r.CREATE_USER_PK = $create_user AND r.RECEIPT_PK=$receipt_pk");
        }
		$returndata = $query->result_array();
        return $returndata;
	}
	
	function fetchproduct($barcode){
		$query = $this->db->query("SELECT p.*,j.* from product p join vatclass j where p.VAT_FK=j.VAT_PK AND p.BARCODE='$barcode'");
        $returndata = $query->result_array();
        return $returndata;
	}
	
	function update_products_cost($product_pk, $receipt_pk , $cost){
		$recorddata['MODIFIED_COST'] = $cost;
		$condition['PRODUCT_FK'] = $product_pk; 
		$condition['RECEIPT_FK'] = $receipt_pk;
		$this->db->update('receipt_product', $recorddata, $condition);
        return true;
	}
	
	function update_receipt_status($status,$receipt){
		$recorddata['STATUS'] = $status;
		$condition['RECEIPT_PK'] = $receipt;
		$this->db->update('receipt', $recorddata, $condition);
        return true;
	}
	
	function remove_products_receipt($product_pk, $receipt_pk){
		$sql = "delete from receipt_product where RECEIPT_FK = $receipt_pk AND PRODUCT_FK = $product_pk";
		$this->db->query($sql);
		return true;
	}
	
	function verify_user_name($username){
		$sql = "SELECT * FROM USER WHERE USERNAME = ?";
		$query = $this->db->query($sql,array($username));
        if ($query->num_rows() > 0)
            return true;
        else
            return false;
	}
	
}
	
	?>