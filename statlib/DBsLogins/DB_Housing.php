<?php	
	$databasename = "<DATABASE NAME>";
	$databaseserver = "<DATABASE IP>";
	$databaseport = "<DATABASE PORT>";
	$databaseuser = "<DATABASE USER>";
	$databasepassword = "<DATABASE PASS>";

	$DBErrorsFilename = "/tmp/DBErrors_" . $_SERVER["SERVER_ADDR"] . ".txt";
	
	$sslkeys["srvkey"] = "/etc/mysql/ssl/client-mysql-key.pem";
	$sslkeys["srvcert"] = "/etc/mysql/ssl/client-mysql-cert.pem";
	$sslkeys["srvca"] = "/etc/mysql/ssl/ca-mysql-cert.pem";
?>
