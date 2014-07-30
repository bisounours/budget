<?php
	require_once("head.php");

	//Recherche des comptes de l'utilisateur
	$qualifier_user = new qualifier(compte::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
	$sort_libelle = new sort(compte::$KEY_LIBELLE,sort::$ASC);
	$liste_compte = compte::select($database,$qualifier_user,null,$sort_libelle);

	//Recherche des categories de l'utilisateur
	$qualifier_user = new qualifier(categorie::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
	$sort_libelle = new sort(categorie::$KEY_LIBELLE,sort::$ASC);
	$liste_categorie = categorie::select($database,$qualifier_user,null,$sort_libelle);

	//Assignation des variables utile aux templates
	$template->assign("liste_compte",compte::dto_liste($database,$liste_compte));
	$template->assign("liste_categorie",categorie::dto_liste($database,$liste_categorie));

	$template->assign("title",$titre_appli);
	$template->draw("index");
?>