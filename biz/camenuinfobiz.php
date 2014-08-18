<?php
require_once('../dal/dataaccess.php');
class camenuinfobiz
{
	function __construct()
	{

	}
	
	private function getmenu($parentmenuid)
	{
		$param = array($parentmenuid);
		$dataaccess = new dataaccess;			
		$result = $dataaccess->datareader("sp_ca_menu_f", $param);
		return $result;			
	}
	
	function getmenuca()
	{	
		$str = '';	 
		$result_set1 = $this->getmenu(0);
		//var_dump($result_set1);
		while($r1 = mysql_fetch_object($result_set1))
		{	
			if($r1->MENU_LINK == null)
				$str .= "<li class='active has-sub'><a href=".$r1->MENU_LINK." title=".$r1->MENU_NAME." onclick='return false' target='_self'>".$r1->MENU_NAME."</a>";
			else				
				$str .= "<li class='active has-sub'><a href=".$r1->MENU_LINK." title=".$r1->MENU_NAME." target='_self'>".$r1->MENU_NAME."</a>";
			$result_set2 = $this->getmenu($r1->MENU_ID);
			if($result_set2)
			{
				$str .="<ul>";
				while($r2 = mysql_fetch_object($result_set2))
				{
					$str .= "<li><a href=".$r2->MENU_LINK." target='_self' title=".$r2->MENU_NAME.">".$r2->MENU_NAME."</a></li>";
				}
				$str .= "</ul></li>";						
		  	}
		}
		return $str;
	}
	
	private function getimagemenu()
	{		
		$dataaccess = new dataaccess;			
		$result = $dataaccess->datareader("sp_ca_menu_image_view_f",null);
		return $result;			
	}
	
	function getimagemenuca()
	{	
		$str = '';	 
		$result_set1 = $this->getimagemenu();
		//var_dump($result_set1);
		$str = "<div align='center'>";
		while($r1 = mysql_fetch_object($result_set1))
		{				
			$str .= "<div style='padding-top:5%;float:left;width:25%;'>";
			$str .= "<div>"."<a href='".$r1->MENU_LINK."'>"."<img src='img/menuimage/".$r1->MENU_IAMGE."'></a></div>";
			$str .= "<div><a href='".$r1->MENU_LINK."'>".$r1->MENU_NAME."</a></div>";
			$str .= "</div>";
		}
		$str .= "</div>";
		return $str;
	}
	
	function __destruct()
	{
		
	}
}	

	
?>