<?php
ob_start();
require_once("basemodel.php");
require_once('../biz/menuinfobiz.php');

class menuinfo extends basemodel
{
	//model variable	
	var $language_id;
	var $contact_details;
	var $is_published;
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
		}
		
	}

	function buildparam()
	{
		$menuinfobiz=new menuinfobiz;
		
		try
		{		
			$param = array();
			foreach ($_POST as $key => $value)
			{				
				if(htmlspecialchars($value)!='save')
				{
					if(htmlspecialchars($key)=='menu_id')
					{
						if(htmlspecialchars($value)== '' || htmlspecialchars($value)== 0)
							array_push($param, -1);
						else						
							array_push($param, htmlspecialchars($value));
					}
					elseif(htmlspecialchars($key)=='menu_name')
					{
						array_push($param, "'".htmlspecialchars($value)."'");
					}
					elseif(htmlspecialchars($key)=='parent_menu_id')
					{
						array_push($param, htmlspecialchars($value));
					}
				}
			}
			array_push($param, $_SESSION['userid']);
			array_push($param, "'".$_server['remote_addr']."'");
			return $menuinfobiz->save($param);
		}
		catch (exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}
	}
	
	function grid($userid)
	{
	    // $param;
		$menuinfobiz=new menuinfobiz;
		return $menuinfobiz->getall($userid);
	}

	function editrow($param)
	{
		$menuinfobiz=new menuinfobiz;
		return $menuinfobiz->getone($param);
	}
	
	function dropdown($param)
	{
		$menuinfobiz=new menuinfobiz;
		return $menuinfobiz->getdropdown($param);
	}

	function changestatus($param)
	{
		header("location: menuinfoui.php");
		$menuinfobiz=new menuinfobiz;
		return $menuinfobiz->changestatus($param);
	}

	function changeposition($param)
	{
		header("location: menuinfoui.php");
		$menuinfobiz=new menuinfobiz;
		return $menuinfobiz->changeposition($param);
	}					
    function getaddpermission($userid)
	{
		$menuinfobiz=new menuinfobiz;
		return $menuinfobiz->addnewpermission($userid);
	}
}
$menuinfo = new menuinfo;
?>