<?php

class User_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
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
	
	function fetchproducts() {
        $query = $this->db->query("SELECT BARCODE,PRODUCT_NAME from product");
        $returndata = $query->result_array();
        return $returndata;
    }
	
}

?>