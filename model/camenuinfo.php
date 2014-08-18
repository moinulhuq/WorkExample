<?php
require_once("basemodel.php");
require_once("../biz/camenuinfobiz.php");
class camenuinfo
{
	function getmenuca()
	{
		$camenuinfobiz = new camenuinfobiz;
		return $camenuinfobiz->getmenuca();
	}
	function getmenuimageca()
	{
		$camenuinfobiz = new camenuinfobiz;
		return $camenuinfobiz->getimagemenuca();
	}
}
$camenuinfo = new camenuinfo;
?>