<?php
	/**
		Fichier permettant l'affichage de la page de gestion des comptes bancaires
	*/

	require_once("head.php");

	//Recherche des comptes de l'utilisateur
	$qualifier_user = new qualifier(compte::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
	$sort_libelle = new sort(compte::$KEY_LIBELLE,sort::$ASC);
	$liste_compte = compte::select($database,$qualifier_user,null,$sort_libelle);
	
	//Assignation des variables utile aux templates
	$template->assign("title",$titre_appli." | Compte");
	$template->assign("compte_list",compte::dto_liste($database,$liste_compte));

	//Generation du template
	$template->draw("compte");
?>