<?php
	require_once("head.php");
	require_once("./lib/dao/qualifier.php");
	require_once("./lib/dao/sort.php");
	require_once("./modele/dao_compte.php");
	require_once("./modele/compte.php");
	require_once("./modele/dao_occurence.php");
	require_once("./modele/occurence.php");
	require_once("./modele/dao_categorie.php");
	require_once("./modele/categorie.php");
	require_once("./modele/dao_operation.php");
	require_once("./modele/operation.php");

	$qualifier_user = new qualifier(operation::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
	$qualifier_actif = new qualifier(operation::$KEY_ACTIF,qualifier::$EQUAL,1);
	$qualifier_and = new qualifier_link(qualifier_link::$AND,array($qualifier_user,$qualifier_actif));
	
	$sort_date = new sort(operation::$KEY_DATE,sort::$DESC);
	$sort_categorie_libelle = new sort(categorie::$KEY_LIBELLE,sort::$ASC);
	$sort_compte_libelle = new sort(compte::$KEY_LIBELLE,sort::$ASC);

	$liste_operation = operation::select($database,$qualifier_and,null,$sort_date,100);
	$liste_compte = compte::select($database,$qualifier_user,null,$sort_compte_libelle);
	$liste_categorie = categorie::select($database,$qualifier_user,null,$sort_categorie_libelle);

	$template->assign("title","g&euro;stion - Operation");
	$template->assign("liste_operation",operation::dto_liste($database,$liste_operation));
	$template->assign("compte_list",dto::dto_liste($liste_compte));
	$template->assign("categorie_list",dto::dto_liste($liste_categorie));

	$template->draw("liste_operation");
?>