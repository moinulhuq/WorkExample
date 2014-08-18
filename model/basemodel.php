<?php
session_start();

class basemodel
{
	function __construct()
	{  
	}

	var $userid;
	var $modifyuser;
	var $createdate;	
	var $modifydate;	
	
	// to refresh the parent window 
	function refreshparentwindow()
	{	
		echo("<script language=\"javascript\">");
		echo("opener.location.reload(true);");
		echo("</script>");
	}

	// to refresh the parent window 
	function refreshchildwindow()
	{	
		echo("<script language=\"javascript\">");
		echo("window.location.reload(true);");
		echo("</script>");
	}	
	
	// to close the current window 
	function closemsgwindow()
	{
		echo("<script language=\"javascript\">");
		echo("window.alert('successfully saved!');");
		echo("window.close();");
		echo("</script>");
	}	
	
	// to close the current window 
	function errormsgwindow($msg = 'record can not save!')
	{
		echo("<script language=\"javascript\">");
		echo("window.alert('".$msg."');");
		echo("</script>");
	}	
	
	function closewindow()
	{
		echo("<script language=\"javascript\">");
		echo("window.close();");
		echo("</script>");
	}	

}

?>