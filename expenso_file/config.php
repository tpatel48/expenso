<?php

$dbhost = 'localhost';

$dbuser = 'expenso_user';

$dbpass = 'jw6q$raJ2m!fgJXkun';

$dbname='balanceaccount';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		if (!$conn) {
					echo "Error: Unable to connect to MySQL." . PHP_EOL;
					echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
					echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
					exit;
				}

?>