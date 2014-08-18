<div class="grid_24 menu_container">
	<div id='cssmenu'>		
		<ul>
		 <li class='active'>
			<a href='index.php'><img alt="home" src="img/home.png" width="25" height="25"/></a>
         </li> 
		 <?php
		 		require_once("../model/camenuinfo.php");
				echo $camenuinfo->getmenuca();
		  ?> 			
		</ul>		
		<?php
		   // echo "<b>&nbsp;&nbsp;".strtoupper($_SESSION['username'])."</b>";
		 ?>
	</div>
</div>
<!--<div class="grid_24 menu-padding"></div>
<!-- end .grid_12 -->
<div class="clear"></div>
<div class="grid_24 sidebar wrapper">