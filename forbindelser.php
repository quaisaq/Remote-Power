<?php
	$page = "Forbindelser";
	require_once('include/startup.php');
?>
<html>
	<head>
		<?php require_once('include/head.php'); ?>
		<script type="text/javascript" src="js/forbindelser.js"></script>
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
				<h1>Forbindelsesoversigt</h1>
				<?php
					$file = file('database/online.txt', FILE_SKIP_EMPTY_LINES);
					$file2 = file('database/navne.txt', FILE_SKIP_EMPTY_LINES);
					
					foreach ($file as $line => $val) {
						$split = explode("=", $val);
						$split2 = explode("=", $file2[$line]);
						echo '<div class="socket">';
						echo '<div class="name">Stikdåse ' . ($line + 1) . ': <span class="place">(' . $split2[1] . ')</span></div>';
						echo '<div class="onoff"';
						if ($split[1] == 1)
							echo ' style="background: #46ff3e;"><div class="toggler" style="left: 49px;"';
						else
							echo '><div class="toggler"';
						echo '></div></div></div>';
					}
				?>
			</div>
        </div>
	</body>
</html>