<?php
//include($_SERVER['DOCUMENT_ROOT'].'/spo_cms/ui/style/style.css');

class gridview
{
	//public variables
	var $datasource;
	var $headertext;
	var $datafield;
	var $pagesize;
	var $pageindex;
	var $datakeynames;
	var $cssclass;
	var $altrowcssclass;
	var $pagerstylecssclass;
	var $emptydatatext;	
	var $borderwidth;
	var $cellpadding;
	var $cellspacing;
	var $showselectbutton;
	var $showdeletebutton;
	var $selecttext;
	var $deletetext;
	
	//public variables	
	
	//private variables
	private $numberofrows;
	private $generatetable;
	//private variables
	
	
	function __construct()
	{
		$this->_default();
	}
	
	private function _default()
	{
		$this->datasource = null;
		$this->headertext = null;
		$this->datafield = null;
		$this->pagesize = 1000;
		$this->pageindex = 1;
		$this->datakeynames = "";
		$this->cssclass = "";
		$this->altrowcssclass = "";
		$this->pagerstylecssclass = "";
		$this->emptydatatext = "rocord not found!";
		$this->borderwidth = 0;
		$this->cellpadding = 0;
		$this->cellspacing = 0;
		$this->showselectbutton = false;
		$this->showdeletebutton = false;
		$this->selecttext = "select";
		$this->deletetext = "delete";
		
		$this->generatetable = "";
		$this->numberofrows = 0;
	}
	
	public function makedefault()
	{
		$this->pagesize = 1000;
		$this->pageindex = 1;	
		$this->cssclass = "mgrid";
		$this->altrowcssclass = "alt";
		$this->pagerstylecssclass = "pgr";
		$this->emptydatatext = "rocord not found!";
		$this->showselectbutton = false;
		$this->showdeletebutton = false;
		$this->selecttext = "edit";
		$this->deletetext = "delete";
	}
	
	public function databind()
	{
		$str = "";
		if(gettype($this->datasource) == "resource")
		{
			$this->numberofrows = mysql_num_rows($this->datasource);				
		}
		
		if(gettype($this->datasource) == "resource")
		{
			if($this->showselectbutton)
			{
				$this->headertext[count($this->headertext)] = $this->selecttext;
			}		
			if($this->showdeletebutton)
			{
				$this->headertext[count($this->headertext)] = $this->deletetext;
			}		
			//header text area start
			$str .= "<tr>";
			for($i=0;$i<count($this->headertext); $i++)	
			{
				$str .="<th>".$this->headertext[$i]."</th>";
			}		
			$str .="</tr>";
		}
		else
		{
			$str .= "<tr><td><b>you do not have any data view permission.</b></td></tr>";
		}
		//header text area end
				
		$count = 0;	
		$startindex = $this->pagesize * ($this->pageindex - 1);
		$endindex = $startindex + $this->pagesize - 1;	
		if(gettype($this->datasource) == "resource")
		{
			while($row = mysql_fetch_object($this->datasource))
			{			
				if ($count >= $startindex)
				{
					$dk = $this->datakeynames;			
					$str .= "<tr>";		
					$alt = (($count+1)%2 == 0 ? $this->altrowcssclass : "");
					for($i=0;$i<count($this->datafield);$i++)
					{
						$df = $this->datafield[$i];
						if($alt == "")
							$str .="<td>".str_replace("\\", "", $row->$df)."</td>";
						else
							$str .= "<td class='".$alt."'>".str_replace("\\", "", $row->$df)."</td>";
					}			
					if($this->showselectbutton)
					{					
						$str .="<td ";
						if($alt == "")
							$str .= "style='text-align: center;'><a href='".$_SERVER['PHP_SELF']."?pg=".$this->pageindex."&pgs=".$this->pagesize."&".$this->datakeynames."=".$row->$dk."&mode=e'>".$this->selecttext."</a></td>";
						else
							$str .= "class='".$alt."' style='text-align: center;'><a href='".$_SERVER['PHP_SELF']."?pg=".$this->pageindex."&pgs=".$this->pagesize."&".$this->datakeynames."=".$row->$dk."&mode=e'>".$this->selecttext."</a></td>";
					}			
					if($this->showdeletebutton)
					{
						$str .="<td ";
						if($alt == "")
							$str .= "style='text-align: center;'><a href='".$_SERVER['PHP_SELF']."?pg=".$this->pageindex."&pgs=".$this->pagesize."&".$this->datakeynames."=".$row->$dk."&mode=e'>".$this->selecttext."</a></td>";
						else
							$str .= "class='".$alt."' style='text-align: center;'><a href='".$_SERVER['PHP_SELF']."?pg=".$this->pageindex."&pgs=".$this->pagesize."&".$this->datakeynames."=".$row->$dk."&mode=e'>".$this->selecttext."</a></td>";
					}			
					$str .="</tr>";
				}
				if ($count >= $endindex)
				{
					break;
				}			
				$count++;
			}
			
			if($this->numberofrows == 0)
			{
				$str .="<tr>";
				$str .="<td colspan='".count($this->headertext)."' style='font-weight: bold; color: red;'>".$this->emptydatatext;		
				$str .="</td>";
				$str .="</tr>";		
			}
	
			if($this->pagerstylecssclass == "")
				$str .="<tr>";
			else
				$str .="<tr class='".$this->pagerstylecssclass."'>";
			
			$ceil_num_rows=(int)(ceil($this->numberofrows/$this->pagesize));
			$str .="<td colspan='".count($this->headertext)."'>";		
			for($i=1;$i<=$ceil_num_rows;$i++)
			{
				$str .= "<a href='".$_SERVER['PHP_SELF']."?pg=".$i."&pgs=".$this->pagesize."'>".$i."</a>&nbsp;"."&nbsp;|&nbsp;&nbsp;";
			}
			$str .="</td>";
			$str .="</tr>";	
		}			
		$this->generatetable = $str;
		return $this->generatetable;	
	}	
	
	function __destruct()
	{
		$this->_default();
	}
}
?>