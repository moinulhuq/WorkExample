<?php
class dataaccess
{
	private $severname;
	private $dbname;
	private $username;
	private $password;

	public function __construct()
	{	
		$this->severname="localhost";
		$this->dbname="spo_cms";
		$this->username="root";
		$this->password="";
	}
	
	public function datareader($spname, $param)
	{
		return $this->_datareader($spname, $param);
	}
	
	public function executenonquery($spname, $param)
	{		
		return $this->_executenonquery($spname, $param);
	}
	
	private function _datareader($spname, $param)
	{			
		try 
		{	
			$sql = $this->setparameter($spname, $param);
			
			$this->getconnection();
			$result = mysql_query($sql);		
			return $result;
		}	
		catch (exception $e) 
		{
    		throw new exception('db erorr.'.$e->getmessage());
		}		
	}
	
	private function _executenonquery($spname, $param)
	{	
		try 
		{
			$sql = $this->setparameter($spname, $param);
			$this->getconnection();		
			$result = mysql_query($sql);		
			return $result;	
		}	
		catch (exception $e) 
		{
    		throw new exception('db erorr.'.$e->getmessage());
		}		
	}
	
	private function getconnection()
	{	
		try 
		{
			mysql_connect($this->severname,$this->username,$this->password,true,65536);
			mysql_select_db($this->dbname);
			return $this;
		}
		catch (exception $e) 
		{
    		throw new exception('db erorr.'.$e->getmessage());
		}		
	}
	
	private function setparameter($spname, $param)
	{	
		$procedure = "call ".$spname."(";	
		if($param!=null)
		{
			$cntparam = count($param);		
			for($i=0;$i<$cntparam;$i++)
			{
				//$i++;
				$procedure.=$param[$i].",";			
			}		
			$procedure = substr($procedure, 0, -1);
		}
		$procedure.=")";		
		//echo $procedure;		
		return $procedure;
	}
}
?>