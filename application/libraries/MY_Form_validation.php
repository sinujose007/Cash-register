<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    function __construct() {
        parent::__construct();
        #$this->CI =& get_instance();
    }

    function function_name($str) {
        $this->set_message('function_name', 'Set your message here');
        return FALSE;
    }

    function is_unique_decrypt($field_value, $field_name) {
        $this->set_message('is_unique_decrypt', lang('email_exists'));
        $field_arr = explode('.', $field_name);
        $query = $this->CI->db->where([decrypt_db_field($field_arr[1], false) . ' =' => $field_value])->get($field_arr[0]);
        if ($query->num_rows() === 0) {
            return TRUE;
        }
        return FALSE;
    }

    function rsa_decode($cipher) {
        $text = $this->CI->rsa_encryption->decode($cipher);
        return $text != '' ? $text : '';
    }

    public function check_alphanumeric_password($str){
        $this->set_message('check_alphanumeric_password', 'Password should be alphanumeric.');
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
            return TRUE;
        }
        return FALSE;
    }
    
    public function check_strong_password($pass) {
        if (empty($pass)) {
            return TRUE;
        }

        // This sets the error message for your custom validation
        // rule. %s will be replaced with the field name if needed.
        $this->set_message('check_strong_password', 'Password needs to have at least one uppercase letter and a number.');

        // The regex looks ahead for at least one lowercase letter,
        // one uppercase letter and a number. IT'S NOT TESTED THOUGH.
        return (bool) preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $pass);
    }

    public function is_password_valid($password) {
        $this->set_message('is_password_valid', lang('old_password_is_not_valid'));
        $query = $this->CI->db->where(['id'=>$this->CI->api_logged_in_user_id, decrypt_db_field('password', false) . ' =' => md5($password)])->get('user');
        if ($query->num_rows() === 0) {
            return FALSE;
        }
        return TRUE;
    }

}
