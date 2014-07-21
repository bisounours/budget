<?php
	/**
		Fichier permettant l'affichage de la page de gestion des utilisateurs (mode admin) ou de l'utilisateur
	*/

	require_once("head.php");

	//Recherche de la liste des autres utlisateurs
	$qualifier_not_you = new qualifier(user::$KEY_ID,qualifier::$NOT_EQUAL,$user[user::$KEY_ID]);
	$liste_user = user::select($database,$qualifier_not_you);

	//Assignation des variables utile aux templates
	$template->assign("title",$titre_appli." | Gestion des utilisateurs");
	$template->assign("user_list",dto::dto_liste($liste_user));
	$template->assign("you",$user);

	//Generation du template
	$template->draw("gestion_user");
?>