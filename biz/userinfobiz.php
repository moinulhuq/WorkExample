<?php
require_once('../dal/dataaccess.php');
require_once('gridview.php');
require_once('dropdownlist.php');


class userinfobiz
{
	function __construct()
	{

	}
	
	function save($param)
	{
		try
		{
			$dataaccess = new dataaccess;			
			$ifsuccess = $dataaccess->executenonquery("ca_tbl_user_i", $param);
			if($ifsuccess == true)
				return "successfully saved!";
			else
				return "record can not save!";
		}
		catch (Exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}		
	}
	function changepassword($param)
	{
		try
		{
			$dataaccess = new dataaccess;			
			$ifsuccess = $dataaccess->executenonquery("ca_tbl_user_changepassword", $param);
			if($ifsuccess == true)
				return 1;
			else
				return 0;
		}
		catch (Exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}		
	}
	
	function getall($userid)
	{
		try
		{
			$dataaccess = new dataaccess;			
			$result = $dataaccess->datareader("ca_tbl_user_gall", $userid);				
			$gridview = new gridview;
			$gridview->datasource = $result;
			$gridview->headertext = array("user name","edit" , "activation", "group permission");
			$gridview->datafield = array("user_name", "is_edit", "is_active", "grp_permission" );
			$gridview->datakeynames= "user_id";	
			$gridview->makedefault();
			return $gridview->databind();			
		}
		catch (Exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}		
	}

	function getone($param)
	{
		try
		{
			$dataaccess = new dataaccess;			
			$result = $dataaccess->datareader("ca_tbl_user_gid", $param);			
			$result = mysql_fetch_object($result);
			
			return $result;
		}
		catch (Exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}		
	}	
	
	function getonechange($param)
	{
		try
		{
			$dataaccess = new dataaccess;			
			$result = $dataaccess->executenonquery("ca_tbl_user_changepassword", $param);			
			$result = mysql_fetch_object($result);
			
			return $result;
		}
		catch (Exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}		
	}	
	
	function checkuser($param)
	{
		try
		{
			$dataaccess = new dataaccess;			
			$result = $dataaccess->datareader("ca_chq_user", $param);			
			$result = mysql_fetch_object($result);			
			return $result;
		}
		catch (Exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}		
	}		
	
	function changestatus($param)
	{
		try
		{
			$dataaccess = new dataaccess;			
			$ifsuccess = $dataaccess->executenonquery("ca_tbl_user_sc", $param);
			if($ifsuccess == true)
				return "successfully saved!";
			else
				return "record can not save!";
		}
		catch (Exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}		
	}			
	function addnewpermission($userid)
	{
	    
		try
		{
			$dataaccess = new dataaccess;			
			$result = $dataaccess->datareader("ca_GET_user_permission_info", array(4, $userid));	
			$result = mysql_fetch_object($result);
			return isset($result->is_insert) ? $result->is_insert : 0;						
		}
		catch (Exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}	
	}
	function __destruct()
	{
		
	}
	
}

?>