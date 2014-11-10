<?php
	$page = 'Hjem';
	require_once('include/startup.php');
?>
<html>
	<head>
		<?php require_once('include/head.php'); ?>
		<script type="text/javascript" src="js/hjem.js"></script>
		<script type="text/javascript">
			sockets = new Array(<?php
				$file = file('database/online.txt', FILE_SKIP_EMPTY_LINES);
				if ($file) {
					foreach ($file as $lin => $val) {
						$split = explode('=', rtrim($val));
						if ($lin == 0)
							echo $split[1];
						else
							echo ", " . $split[1];
					}
				}
				else
					echo "false, false, false, false, false";
			?>);
		</script>
	</head>
	<body>
		<div id="background"></div>
		<?php require_once('include/header.php'); ?>
		<div id="wrapper">
			<?php include_once('include/sidefloaters.php'); ?>
			<div id="innerback">
				<h1>Boligoversigt</h1>
				<canvas id="grundplansCanvas"></canvas>
				<img src="images/grundplan.png" class="house" usemap="#house">
				<map name="house" id="house">
					<area shape="rect" alt="Køkken" href="javascript:toggleSocket(0)">
					<area shape="rect" alt="Værelse" href="javascript:toggleSocket(1)">
					<area shape="rect" alt="Værelse" href="javascript:toggleSocket(2)">
					<area shape="rect" alt="Stue" href="javascript:toggleSocket(3)">
					<area shape="rect" alt="Stue" href="javascript:toggleSocket(3)">
					<area shape="rect" alt="Badeværelse" href="javascript:toggleSocket(4)">
				</map>
			</div>
        </div>
	</body>
</html>