<?php
//session_start(); 
/*if(!$_SESSION['username']){
 header("location: index.php");
 exit; 
}
*/
require_once("header.php");
require_once("menu.php");
require_once('../model/userinfo.php');
 
  if(!$_SESSION['username']){
    header("location: index.php");
    exit; 
   }
 
//echo $_SESSION['username'];
?>
<div class="grid_24 menu-padding"></div>
<!-- end .grid_12 -->
<div class="clear"></div>
<div class="grid_24 sidebar wrapper">
	
	<?php
		 		require_once("../model/camenuinfo.php");
				echo $camenuinfo->getmenuimageca();
		  ?> 		
</div>

</div>
<?php
require_once("footer.php");
?>
