<?php
	require_once("head.php");
	require_once("./lib/dao/qualifier.php");
	require_once("./lib/dao/sort.php");
	require_once("./modele/dao_compte.php");
	require_once("./modele/compte.php");
	require_once("./modele/dao_categorie.php");
	require_once("./modele/categorie.php");

	$qualifier_user = new qualifier(categorie::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
	
	$sort_categorie_libelle = new sort(categorie::$KEY_LIBELLE,sort::$ASC);
	$sort_compte_libelle = new sort(compte::$KEY_LIBELLE,sort::$ASC);

	$liste_compte = compte::select($database,$qualifier_user,null,$sort_compte_libelle);
	$liste_categorie = categorie::select($database,$qualifier_user,null,$sort_categorie_libelle);

	$template->assign("title","g&euro;stion - Statistique tableau");
	$template->assign("compte_list",dto::dto_liste($liste_compte));
	$template->assign("categorie_list",dto::dto_liste($liste_categorie));

	$template->draw("stat_tableau");
?>