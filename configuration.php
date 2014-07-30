<?php
	/**
		Fichier permettant l'affichage de la page de gestion des configurations
	*/

	require_once("head.php");
		
	//Assignation des variables utile aux templates
	$template->assign("title","g&euro;stion - Configuration");

	//Generation du template
	$template->draw("configuration");
?>