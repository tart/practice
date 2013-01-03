<?php

define('CONFIG_FILE', 'config.ini');


$configArray = parse_ini_file(CONFIG_FILE);

if (!$configArray) {
	die ("An error occured while parsing the " . CONFIG_FILE . " file!" . PHP_EOL);
}

$connectionString = "host=" . $configArray['host'] . 
					" port=" . $configArray['port'] .
					" dbname=" . $configArray['dbname'] . 
					" user=" . $configArray['username'] . 
					" password=" . $configArray['password'];


$conn = pg_connect($connectionString);

if (!$conn) {
	die ("An error occured in connection!" . PHP_EOL);
}

$result = mysql_query($conn, "SELECT table_schema,table_name
							FROM information_schema.tables
							ORDER BY table_schema,table_name;");

if (!$result) {
	die ("An error occured while exectuing the query." . PHP_EOL );
}

while ($row = pg_fetch_row($result)) {
	echo $row[0] . " " . $row[1] . " " . PHP_EOL;
}
