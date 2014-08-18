<?php
require("../model/userinfo.php");
?>
<!doctype html>
<!-- saved from url=(0100)http://www.red-team-design.com/wp-content/uploads/2011/09/slick-login-form-with-html5-css3-demo.html -->
<html><head><meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>:: login ::</title>
<link rel="icon" type="image/gif" href="img/spo_logo_32x32.gif" />
</head>

<body style="background-color:#e3e7eb;">

<form id="login" name="login" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<div style="width:40%; margin:0px auto; margin-top: 20%;">
		<div style="bottom: 5px;
						box-shadow: 0 0 0 1px #FFFFFF;
						content: '';
						left: 5px;
						position: absolute;
						right: 5px;
						top: 30%;
						z-index: -1;
						background-color:#f1f1f1;
						margin:0px auto;
						padding-top:15px;
						background-image: -moz-linear-gradient(center top , #FFFFFF, #EEEEEE);						
						height: 260px;						
						width: 420px;">
			<table cellpadding="0"  cellspacing="0" 
				style="border: 1px dashed #CCCCCC;
						bottom: 5px;
						box-shadow: 0 0 0 1px #FFFFFF;
						content: '';
						left: 5px;						
						right: 5px;
						top: 30%;
						z-index: -1;
						background-color:#f1f1f1;
						margin:0px auto;
						background-image: -moz-linear-gradient(center top , #FFFFFF, #EEEEEE);
						border-radius: 3px 3px 3px 3px;
						box-shadow: 0 0 2px rgba(0, 0, 0, 0.2), 0 1px 1px rgba(0, 0, 0, 0.2), 0 3px 0 #FFFFFF, 0 4px 0 rgba(0, 0, 0, 0.2), 0 6px 0 #FFFFFF, 0 7px 0 rgba(0, 0, 0, 0.2);
						height: 240px;						
						width: 400px;">
				<tr>
					<td style="text-align:center;">
						<h1 
							style="background-color: #777777;
							content: '';
							height: 1px;
							position: absolute;
							width: 100%;
							color: #666666;
							font: 26px/1 Verdana,Helvetica;
							letter-spacing: 2px;    
							position: relative;
							text-align: center;
							text-shadow: 0 1px 0 rgba(255, 255, 255, 0.7), 0 2px 0 rgba(0, 0, 0, 0.5);">Cpanel Login</h1>
					</td>
				</tr>
				<tr>
					<td>
						<input 
							style="background: url('img/login-sprite.png') no-repeat scroll 0 0 #F1F1F1;
									border: 1px solid #CCCCCC;
									border-radius: 5px 5px 5px 5px;
									box-shadow: 0 1px 1px #CCCCCC inset, 0 1px 0 #FFFFFF;    
									padding: 15px 15px 15px 30px;
									margin-left: 6%;
									width: 303px;" id="user_name" type="text" name="user_name" autofocus="" required="">
					</td>
				</tr>
				<tr>
					<td><input 
							style="background: url('img/login-sprite1.png') no-repeat scroll 0 0 #F1F1F1;
									border: 1px solid #CCCCCC;
									border-radius: 5px 5px 5px 5px;	
									margin-left: 6%;
									box-shadow: 0 1px 1px #CCCCCC inset, 0 1px 0 #FFFFFF;    
									padding: 15px 15px 15px 30px;
									width: 303px;" id="user_password" name="user_password" type="password"  required="">
					</td>
				</tr>
				<tr>
					<td style="padding-left:10%;"><label style="color:#ff0000;"><?php if(isset($_GET['msg']))echo $_GET['msg'];?></label>
					</td>
				</tr>
				<tr>
					<td style="padding-left:10%;"><input
							style="border: solid 1px gray;
									width:25%;
									border-radius: 5px 5px 5px 5px;	
									height: 28px;" type="submit" id="login" name="login" value="Log In">
					</td>
				</tr>
			</table>  
		</div>
</div>
</form>

<!-- bsa adpacks code -->
</body></html>
