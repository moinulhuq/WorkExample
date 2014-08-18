<?php
//session_start(); 
ob_start();
require_once("basemodel.php");
require_once("../biz/userinfobiz.php");

class userinfo extends basemodel
{
	//model variable	
	var $user_id;
	var $user_name;
	var $user_password;
	var $user_confirm_password;
	var $is_active;
	
	function __construct()
	{
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') 
		{
			if(isset($_POST['btnsave']))
			{				
				$msg =  $this->buildparam();				
				if($msg=="successfully saved!")
				{					
					$this->refreshparentwindow();
					$this->closemsgwindow();				
				}
				else
					$this->errormsgwindow();				
			}
			
			else if(isset($_POST['btnrefresh']))
			{
				//$this->refreshchildwindow();				
			}			
			else if(isset($_POST['btnclose']))
			{
				$this->refreshparentwindow();
				$this->closewindow();						
			}
			elseif(isset($_POST['login']))			
			{
				$param = array("'".$_POST['user_name']."'", "'".md5($_POST['user_password'])."'");
var_dump($param);
				$v = $this->checkuser($param);
				if($v == 1)
				{
					header("location: index.php");
				}
				else
				{
					header("location: login.php?msg=user id or password is invalid!");
				}
			}
			elseif(isset($_POST['btnchangesave']))
			{				
				$msg =  $this->buildparamchange();				
/*				if($msg=="successfully saved!")
				{					
					$this->refreshparentwindow();
					$this->closemsgwindow();				
				}
				else
					$this->errormsgwindow();*/	
			}
		}
		
	}
   
    function buildparamchange()
	{
		$userinfobiz=new userinfobiz;
		
		try
		{	
			//var_dump($_POST);				
			$params = array();
			$pas = array();
			//echo $_POST['user_password'];
			if($_POST['user_password']!='' && $_POST['new_user_password']!='' && $_POST['user_confirm_password']!='')
			{
			foreach ($_POST as $key => $value)
			{				
				if(htmlspecialchars($key)=='user_id')
				{
					array_push($params, htmlspecialchars($value)== '' ? 0:htmlspecialchars($value));
				}
				elseif(htmlspecialchars($key)=='user_password')
				{
					array_push($params, "'".md5(htmlspecialchars($value))."'");
				}	
				elseif(htmlspecialchars($key)=='new_user_password')
				{
					array_push($pas, "'".md5(htmlspecialchars($value))."'");
				}
				elseif(htmlspecialchars($key)=='user_confirm_password')
				{
					array_push($pas, "'".md5(htmlspecialchars($value))."'");
				}
			}
			if($this->checkpass($pas))		
			{
				array_push($params, $pas[0]);
				header('location: logout.php');
			}
			else
			{
			    
			  //	echo "<b>not match</b>";
				echo("<script language=\"javascript\">");
		        echo("alert('new pass and cofirm pass not match');");
		        echo("</script>");
				
			}			
            }
			else 
			{
			   echo("<script language=\"javascript\">");
		        echo("alert('password  blank');");
		        echo("</script>");
			}
			//array_push($params, 1);
			//array_push($params, "'".$_SERVER['remote_addr']."'");
			return $userinfobiz->changepassword($params);
		}
		catch (exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}
	}


	function checkpass($pas)
	{
		if($pas[0]==$pas[1])
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}

	function buildparam()
	{
		$userinfobiz=new userinfobiz;
		
		try
		{	
			//var_dump($_POST);
				
			$param = array();
			foreach ($_POST as $key => $value)
			{				
				if(htmlspecialchars($key)=='user_id')
				{
					array_push($param, htmlspecialchars($value)== '' ? 0:htmlspecialchars($value));
				}
				elseif(htmlspecialchars($key)=='user_name')
				{
					array_push($param, "'".htmlspecialchars($value)."'");
				}
				elseif(htmlspecialchars($key)=='user_password')
				{
					array_push($param, "'".md5(htmlspecialchars($value))."'");
				}	
							
			}

			array_push($param, 1);
			array_push($param, "'".$_SERVER['remote_addr']."'");
			return $userinfobiz->save($param);
		}
		catch (exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}
	}

	function gridview($userid)
	{
		$userinfobiz=new userinfobiz;
		return $userinfobiz->getall($userid);
	}	
	
	function editrow($param)
	{
		$userinfobiz=new userinfobiz;
		return $userinfobiz->getone($param);
	}
	
	function editrowchange($param)
	{
		$userinfobiz=new userinfobiz;
		return $userinfobiz->getonechange($param);
	}
	
	function checkuser($param)
	{
		$userinfobiz=new userinfobiz;
		$result = $userinfobiz->checkuser($param);
		if($result != null)
		{			
			$_SESSION['userid'] = $result->USER_ID;
			$_SESSION['username'] = $result->USER_NAME;
			return 1;
		}
		else
			return 0;
	}
	
	function changestatus($param)
	{
		header("location: userinfoui.php");
		$userinfobiz=new userinfobiz;
		return $userinfobiz->changestatus($param);
	}
	function getaddpermission($userid)
	{
		$userinfobiz = new userinfobiz;
		return $userinfobiz->addnewpermission($userid);
	}
}
$userinfo = new userinfo;
?>