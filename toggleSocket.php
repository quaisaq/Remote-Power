<?php
	if (isset($_POST['area'])) {
		$file = file('database/online.txt', FILE_SKIP_EMPTY_LINES);
		$arr = Array();
		
		if ($file) {
			foreach ($file as $line) {
				$split = explode('=', rtrim($line));
				$arr[] = $split[1];
			}
			
			$arr[$_GET['i']] = $arr[$_GET['i']] == 1 ? "0" : "1";
			$s = "";
			foreach ($arr as $lin => $val)
				$s .= $lin . '=' . $val . "\r\n";
			file_put_contents("database/online.txt", $s);
			
			// send command to Python
			exec("cd /var/www/remotepower/");
			exec("./wrapper " . $_GET['i'] . " " . $arr[$_GET['i']]);
			
			echo "OK";
		}
		else
			echo "Error";
	}
	else
		echo "Error";
?>