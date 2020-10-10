<?php

	$db = mysqli_connect("localhost", "root", "", "blog");

	if ( $db ){
		// echo "Database Conneted";
	}
	else{
		die("MySQLi Error " . mysqli_error($db));
	}

?>