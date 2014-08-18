<?php
class dropdownlist
{
	//public variables
	var $datasource;
	var $displaytext;
	var $valuetext;
	//public variables
	
	function __construct()
	{
		$this->_default();
	}
	
	private function _default()
	{
/*		mysql_connect("localhost","root","",true,65536);
		mysql_select_db("spo_cms");
		$this->datasource = mysql_query("call sp_language_c()");
*/		
		$this->datasource =  null;		
		$this->displaytext = null;
		$this->valuetext = null;
	}
	
	public function databind($param="")
	{
		$v = $this->valuetext;
		$t = $this->displaytext;
		$str = "";	
		$str.= "<option selected value=''>-- please select --</option>";				
		if($this->datasource != null)
		{			
			while($result = mysql_fetch_object($this->datasource))
			{
				if($param==$result->$v)
				{
					$str.="<option value='".$result->$v."'"; 			
					$str.=" selected >".$result->$t."</option>";
				}
				else
				{
					$str.="<option value='".$result->$v."'"; 			
					$str.=">".$result->$t."</option>";
				}
			}
		}		
		return $str;
	}
	
	function __destruct()
	{
		$this->_default();
	}
}
?>