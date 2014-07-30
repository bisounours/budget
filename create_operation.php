<?php
	/**
		Fichier permettant l'affichage de la page de creation d'operation
	*/

	require_once("head.php");

	$qualifier_user = new qualifier(compte::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);

	//Recherche des comptes de l'utilisateur	
	$sort_compte_libelle = new sort(compte::$KEY_LIBELLE,sort::$ASC);
	$liste_compte = compte::select($database,$qualifier_user,null,$sort_compte_libelle);

	//Recherche des categories de l'utilisateur	
	$sort_categorie_libelle = new sort(categorie::$KEY_LIBELLE,sort::$ASC);
	$liste_categorie = categorie::select($database,$qualifier_user,null,$sort_categorie_libelle);

	//Assignation des variables utile aux templates
	$template->assign("title",$titre_appli." | Nouvelle operation");
	$template->assign("compte_list",dto::dto_liste($liste_compte));
	$template->assign("categorie_list",dto::dto_liste($liste_categorie));
	$template->assign("categorie_select","");
	$template->assign("compte_select","");

	//Generation du template
	$template->draw("create_operation");
?>