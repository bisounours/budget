<?php
	/**
		Fichier permettant l'affichage de la page de gestion des categories
	*/

	require_once("head.php");

	//Recherche des categories de l'utilisateur
	$qualifier_user = new qualifier(categorie::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
	$sort_libelle = new sort(categorie::$KEY_LIBELLE,sort::$ASC);
	$liste_categorie = categorie::select($database,$qualifier_user,null,$sort_libelle);

	//Assignation des variables utile aux templates
	$template->assign("title",$titre_appli." | Categorie");
	$template->assign("categorie_list",categorie::dto_liste($database,$liste_categorie));

	//Generation du template
	$template->draw("categorie");
?>