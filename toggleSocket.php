<?php
	if (isset($_POST['area'])) {
		$exploded = explode('=', $_POST['area']);
		$i = $exploded[0];
		$file = file('database/online.txt', FILE_SKIP_EMPTY_LINES);
		$arr = Array();
		
		if ($file) {
			foreach ($file as $line) {
				$split = explode('=', rtrim($line));
				$arr[] = $split[1];
			}
			
			$arr[$i] = $exploded[1];
			$s = "";
			foreach ($arr as $lin => $val)
				$s .= $lin . '=' . $val . "\r\n";
			file_put_contents("database/online.txt", $s);
			
			// send command to Python
			exec("cd /var/www/remotepower/");
			exec("./wrapper " . $i . " " . $arr[$i]);
			
			echo "OK";
		}
		else
			echo "Error";
	}
	else
		echo "Error";
?>