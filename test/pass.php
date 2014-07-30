<?php
	
	require_once("../lib/outils.php");

	$hash = unique_id();

	$password = md5(sha1("0000".$hash));

	echo "hash = ".$hash."<br>";
	echo "password = ".$password;
?>