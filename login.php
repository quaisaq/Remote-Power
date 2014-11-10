<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="loginstyle.css">
		<meta charset="UTF-8">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript">
			$(function(){
				var mids = '<img src="images/sideimg-left-mid.png">';
				for (var i = 1; i < Math.ceil(($('#innerback').height() - 280) / 300); i++)
					mids += '<img src="images/sideimg-left-mid.png">';
				$('#leftfloater .mids').html(mids);
				$('#rightfloater .mids').html(mids.replace(/\-left\-/gi, "-right-"));
				
				$('header ul').css('margin-left', -$('header ul').width() / 2);
			});
		</script>
	</head>
	<body>
		<div id="background"></div>
		<?php require_once('include/header.php'); ?>
		<div id="wrapper">
			<?php include_once('include/sidefloaters.php'); ?>
			<div id="loginback">
				<form action="./index.html" method="POST">
					<div class="inputtop">Brugernavn:</div>
					<input name="user" class="text">
					
					<div class="inputtop">Password:</div>
					<input name="pass" type="password" class="text">
					
					<input type="submit" class="submit" value="Log ind">
				</form>
			</div>
			<div class="clear"></div>
        </div>
	</body>
</html>