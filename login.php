<?php
	session_start();
	if (isset($_POST['user']) && isset($_POST['pass'])) {
		if (strtolower($_POST['user']) == "admin" && $_POST['pass'] == "admin") {
			$_SESSION['LOGGEDIN'] = 1;
			Header('Location: ./');
		}
		else {
			$msg = "Forkert brugernavn eller password";
		}
	}
?>
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
				
				$('header .nav').css('margin-left', -$('header .nav').width() / 2).css('left', '50%');
			});
		</script>
	</head>
	<body>
		<div id="background"></div>
		<?php require_once('include/header.php'); ?>
		<div id="wrapper">
			<?php include_once('include/sidefloaters.php'); ?>
			<div id="loginback">
				<?php
					if (isset($msg))
						echo "<div class=\"msg\">$msg</div>";
				?>
				<form action="./login.php" method="POST">
					<div class="inputtop">Brugernavn:</div>
					<input name="user" class="text" autocomplete="off">
					
					<div class="inputtop">Password:</div>
					<input name="pass" type="password" class="text" autocomplete="off">
					
					<input type="submit" class="submit" value="Log ind">
				</form>
			</div>
			<div class="clear"></div>
        </div>
	</body>
</html>