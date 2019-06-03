<?php

function assets_url(){
   return base_url().'assets/';
}
function pre($data,$exit=false)
{
	echo "<pre>";
	print_r ($data);
	echo "</pre>";
	if($exit)
	{
		exit;
	}
}
function setsessiondata($array)
{
	$CI =& get_instance();
	$CI->session->set_userdata($array);
}
function unsetsessiondata($array)
{	
	$CI =& get_instance();
	if(is_array($array))
	{
		foreach($array as $val)
		$CI->session->unset_userdata($val);
	}
	else
	{
		$CI->session->unset_userdata($array);
	}
}
function getsessiondata($array='')
{
	$CI =& get_instance();
	if(is_array($array))
	{
		$returndata = array();
		foreach($array as $value)
		{
			if($CI->session->userdata($value))
			{
				$tempval = $CI->session->userdata($value);
				if(is_array($tempval))
				{
					foreach($tempval as $k=>$v)
					{
						$returndata[$k] = $v;
					}
				}
				else
				{
					$returndata[$value] = $tempval;
				}
			}
			else
			{
				$tempval = findarray($value,$CI->session->all_userdata());
				if($tempval)
				{
					$returndata[$value] = $tempval;
				}
				else
				$returndata[$value] = false;
			}
		}
	}
	elseif($array == '')
	{
		$returndata = $CI->session->all_userdata();
	}
	else
	{
		//echo $array; echo 1; exit;
		$returndata = $CI->session->userdata($array);
		//print_r($returndata);exit;
		if(!$returndata)
		{
			$tempval = findarray($array,$CI->session->all_userdata());
			$returndata = $tempval;
		}
	}
	return $returndata;
}

function unset_allsessionitems() {
	$CI =& get_instance();
    $user_data = $CI->session->all_userdata();
	
    foreach ($user_data as $key => $value) {
        if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
            $CI->session->unset_userdata($key);
        }
    }
}
function findarray($key,$array)
{
	foreach($array as $k => $v )
	{
		if($key === $k)
		{
			return $v;
		}
		elseif(is_array($v))
		{
			$val = findarray($key,$v);
			if($val)
			{
				return $val;
			}
		}
		
	}
	return false;
}

function is_logged()
{
	$CI =& get_instance();	
	//if($CI->getsessiondata('USER_FK')
}

function checkaccess()
{
	$CI =& get_instance();	
	$requestedclass = $CI->router->fetch_class();
	$requestedmethod = $CI->router->fetch_method();
	$requestedmodule = $CI->router->fetch_module();
	if($requestedclass == $requestedmodule)
	{
		$url = $requestedclass.'/'.$requestedmethod;
		$class_url = $requestedclass.'/';
	}
	else
	{
		$url = $requestedmodule.'/'.$requestedclass.'/'.$requestedmethod;
		$class_url = $requestedmodule.'/'.$requestedclass.'/';
	}
	$accessrole = getsessiondata($url);
	if(!$accessrole)
	{
		return false;
	}
	else
	{
		setsessiondata(array('class_url'=>base_url().$class_url));
		return true;
	}
	
}
function geturl()
{
	$CI =& get_instance();	
	$requestedclass = $CI->router->fetch_class();
	$requestedmethod = $CI->router->fetch_method();
	$requestedmodule = $CI->router->fetch_module();
	if($requestedclass == $requestedmodule)
	{
		$url = $requestedclass.'/'.$requestedmethod;
		$class_url = $requestedclass.'/';
	}
	else
	{
		$url = $requestedmodule.'/'.$requestedclass.'/'.$requestedmethod;
		$class_url = $requestedmodule.'/'.$requestedclass.'/';
	}
	return base_url().$url;
}
function getposteddata($fieldreplace = array())
{
	$options = array();
	$CI =& get_instance();
    foreach($_POST as $key => $val)  
    {  
		if(is_array($fieldreplace) && !empty($fieldreplace))
		{
			$replace = findarray($key,$fieldreplace);
			if($replace === '---')
			{
				continue;
			}
			if($replace)
			$newkey = $replace;
			else
			$newkey = $key;
		}
		else
		{
			$newkey = $key;
		}
		$options[$newkey] = $CI->input->post($key);  
    }  

    return $options;      
}

function esc($data)
{
	$CI =& get_instance();
	return $CI->db->escape($data);
}
function checkvariable($variable)
{
	if(!isset($variable) || (is_int($variable) && $variable <= 0) || $variable = NULL || is_null($variable) || $variable == false || $variable === 'false' || (is_array($variable) && empty($variable)))
	return false;
	else 
	return true;
}
function addmissingindex(&$array)
{
	end($array);
    $max = key($array); //Get the final key as max!
    for($i = 0; $i < $max; $i++)
    {
        if(!isset($array[$i]))
        {
            $array[$i] = '';
        }
    }
	ksort($array);
}
function set_flashmessage($item,$value){
    
    $CI =& get_instance();
    
   return $CI->session->set_flashdata($item,$value);
}

function get_flashmessage($item){
    
    $CI =& get_instance();
    
    return $CI->session->flashdata($item);
}

function check_flashmessage($item){
    
    $CI =& get_instance();
    
    return $CI->session->flashdata($item);
}
function create_link($targetfunction,$linktext,$separater="",$parameters=array(),$extraparams = array())
{
	$CI =& get_instance();
	$requestedclass = $CI->router->fetch_class();
	$requestedmethod = $targetfunction;
	$requestedmodule = $CI->router->fetch_module();
	if($requestedclass == $requestedmodule)
	{
		$url = $requestedclass.'/'.$requestedmethod;
		$class_url = $requestedclass.'/';
	}
	else
	{
		$url = $requestedmodule.'/'.$requestedclass.'/'.$requestedmethod;
		$class_url = $requestedmodule.'/'.$requestedclass.'/';
	}
	$accessrole = getsessiondata($url);
	if(!$accessrole)
	{
		return '';
	}
	else
	{
		$parameterstring = "";
		if(is_array($parameters) && !empty($parameters))
		{
			foreach($parameters as $key=>$value)
			{
				$parameterstring .= $key.'='.$value.'&';
			}
			$parameterstring = substr($parameterstring,0,strlen($parameterstring)-1);
		}
		$extraparamstring = "";
		if(is_array($extraparams) && !empty($extraparams))
		{
			foreach($extraparams as $key=>$value)
			{
				$extraparamstring .= $key."='".$value."'";
			}
			//$extraparamstring = substr($parameterstring,0,strlen($parameterstring)-1);
		}
		$link = '<a href="'.$targetfunction;
		($parameterstring == '')?$link.='" '.$extraparamstring.' >'.$linktext.'</a>':$link.='?'.$parameterstring.'" '.$extraparamstring.' >'.$linktext.'</a>';
		
		return $separater.' '.$link;
	}

}

?>