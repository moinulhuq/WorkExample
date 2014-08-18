<?php
	ob_start();
?>
<!doctype html public "-//w3c//dtd xhtml 1.0 strict//en" "http://www.w3.org/tr/xhtml1/dtd/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="title" content="parliament of bangladesh"/>
        <meta name="description" content="google search description"/>
        <meta name="keywords" content="seo keywords"/>
        <title>parliament of bangladesh</title>
        <!--960 gs-->
        <link rel="stylesheet" href="css/960_24_col.css"/>
        <link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" media="screen" href="style/style.css"></link>
		<link rel="stylesheet" type="text/css" media="screen" href="css/colorbutton.css"></link>		
		<link rel="stylesheet" type="text/css" media="screen" href="style/bootstrap-responsive.css"></link>	
		<link rel="stylesheet" type="text/css" media="screen" href="style/bootstrap.css"></link>
		<link rel="icon" type="image/gif" href="img/spo_logo_32x32.gif" />
       <!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
	   <script src="js/jquerylibrary.js"></script>
    </head>
    <body>
        <div class="top-bar" style="text-align:right;font-size:12px;color:#ffffff"><?php
		    require_once("../model/camenuinfo.php");
		    echo "<b>welcome :: ".$_SESSION['username']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>";
		 ?></div>
        <div class="container_24">
            <div class="grid_24 slider">
                <div class="grid_10" id="logo_container">
                    <h1 id="page_title"></h1>
                </div>
            </div>			