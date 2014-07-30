<?php
	require_once("../lib/dao/dao.php");
	require_once("../lib/dao/qualifier.php");
	require_once("../lib/dao/qualifier_link.php");
	require_once("../modele/dao_user.php");
	require_once("../modele/user.php");

	require_once("../lib/outils.php");

	print_r(liste_date(new DateTime('01/01/2013'),new DateTime(),"P6M"));

	//echo sizeof(liste_date(new DateTime('01/01/2013'),new DateTime(),"P1M"));
?>