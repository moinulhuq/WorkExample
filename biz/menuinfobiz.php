<?php
require_once('../dal/dataaccess.php');
require_once('gridview.php');
require_once('dropdownlist.php');
class menuinfobiz
{
	function __construct()
	{

	}
	
	function save($param)
	{
		try
		{
			$dataaccess = new dataaccess;			
			$ifsuccess = $dataaccess->executenonquery("sp_top_menu_i", $param);
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

	function getall($userid)
	{		
		try
		{
			$str = "";
			$result_set1 = $this->getgrid(array(0,$userid));
			if(gettype($result_set1) == "resource")
			{
				$num_row1 = (int)mysql_num_rows($result_set1);
				$num_col = (int)mysql_num_fields($result_set1);
				$cnt=0;	
				$str .= "<tr>";			
				for($i=1;$i<$num_col+4; $i++)	
				{	
					if($i<9)
						$str .="<th style='border: 0px;'></th>";
					elseif($i==9)					
						$str .="<th nowrap style='text-align: left; border: 0px;'>edit</th>";
					elseif($i==10)					
						$str .="<th nowrap style='text-align: left; border: 0px;'>published</th>";
					elseif($i==11)					
						$str .="<th nowrap style='text-align: left; border: 0px;'>activation</th>";						
					elseif($i>11)					
					{
						$meta = mysql_fetch_field($result_set1, $i-4);
						$str .="<th nowrap style='text-align: left; border: 0px;'>".str_replace("_", " ", $meta->name)."</th>";						
					}
				}		
				$str .="</tr>";					
				while($result1 = mysql_fetch_array($result_set1))
				{
					$cnt++;
					$bgcolor =($cnt%2==0? "class='alt' style='border: 0px; height: 24px; text-align: left;'": "style='border: 0px; height: 24px; text-align: left;'");
					$str .="<tr>";	
					for($i=1;$i<$num_col+4;$i++)
					{	
						if($i<3)						
							$str .="<td nowrap $bgcolor>".str_replace("\\", "", isset($result1[$i]) ? $result1[$i] : "")."</td>";
						elseif($i>2 && $i<7)
							$temp ="";
						elseif($i==7)
							$str .="<td colspan='5' $bgcolor>".str_replace("\\", "", isset($result1[$i-4]) ? $result1[$i-4] : "")."</td>";
						else
							$str .="<td nowrap $bgcolor>".str_replace("\\", "", isset($result1[$i-4]) ? $result1[$i-4] : "")."</td>";
					}					
					$result_set2 = $this->getgrid(array($result1['menu_id'],$userid));
					$num_row2 = (int)mysql_num_rows($result_set2);				
					while($result2 = mysql_fetch_array($result_set2))
					{
						$cnt++;
						$bgcolor =($cnt%2==0? "class='alt' style='border: 0px; height: 24px; text-align: left;'": "style='border: 0px; height: 24px; text-align: left;'");
						$str .="<tr>";	
						for($i=1;$i<$num_col+4;$i++)
						{	
							if($i<3)
								$str .="<td $bgcolor></td>";
							elseif($i>2 && $i<5)
								$str .="<td nowrap $bgcolor>".str_replace("\\", "", isset($result2[$i-2]) ? $result2[$i-2] : "")."</td>";
							elseif(($i>4 && $i<7))
								$temp .="";
							elseif($i==7)
								$str .="<td colspan='3' nowrap $bgcolor>".str_replace("\\", "", isset($result2[$i-4]) ? $result2[$i-4] : "")."</td>";	
							else
								$str .="<td nowrap $bgcolor>".str_replace("\\", "", isset($result2[$i-4]) ? $result2[$i-4] : "")."</td>";	
						}
						$str .="</tr>";				
					
						$result_set3 = $this->getgrid(array($result2['menu_id'],$userid));
						$num_row3 = (int)mysql_num_rows($result_set3);						
						while($result3 = mysql_fetch_array($result_set3))
						{				
							$cnt++;
							$bgcolor =($cnt%2==0? "class='alt' style='border: 0px; height: 24px; text-align: left;'": "style='border: 0px; height: 24px; text-align: left;'");
							$str .="<tr>";					
							for($i=1;$i<$num_col+4;$i++)
							{
								if($i<5)
									$str .="<td $bgcolor></td>";
								elseif($i==8)
									$str .="<td $bgcolor></td>";
								else
									$str .="<td nowrap $bgcolor>".str_replace("\\", "", isset($result3[$i-4]) ? $result3[$i-4] : "")."</td>";	
							}
							$str .="</tr>";				
						}
					}	
					$str .="</tr>";
				}				
				return $str;
			}
			else
			{
				return "<tr><td><b>you do not have any data view permission.</b></td></tr>";
			}
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
			$result = $dataaccess->datareader("sp_top_menu_gid", $param);			
			$result = mysql_fetch_object($result);
			return $result;
		}
		catch (Exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}		
	}
	
	function getgrid($param)
	{
		try
		{
			$dataaccess = new dataaccess;			
			$result = $dataaccess->datareader("sp_top_menu_gall", $param);
			return $result;
		}
		catch (Exception $e) 
		{
    		return "erorr: ".$e->getmessage();
		}		
	}	
	
	function getdropdown($param)
	{
		try
		{
			$dataaccess = new dataaccess;			
			$result = $dataaccess->datareader("sp_language_c", null);			
			$dropdownlist = new dropdownlist;
			$dropdownlist->datasource = $result;
			$dropdownlist->displaytext = "language_name";
			$dropdownlist->valuetext = "language_id";
			return $dropdownlist->databind($param);			
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
			$ifsuccess = $dataaccess->executenonquery("sp_top_menu_sc", $param);
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

	function changeposition($param)
	{
		try
		{
			$dataaccess = new dataaccess;			
			$ifsuccess = $dataaccess->executenonquery("sp_top_menu_updown", $param);
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
			$result = $dataaccess->datareader("ca_GET_user_permission_info", array(9, $userid));	
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