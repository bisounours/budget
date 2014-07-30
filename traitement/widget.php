<?php
	require_once("init.php");
	require_once("graphique.php");

	function pie_categorie(){
		global $database,$user;

		raintpl::$tpl_dir = "../js/"; // template directory
		raintpl::$cache_dir = "../tmp/"; // cache directory
		raintpl::$tpl_ext = "js"; // cache directory
		$template = new RainTPL();
		$template->assign("titre","Résultat");
		$template->assign("sous_titre","");
		$template->assign("option_groupe","G_CAT");
		$template->assign("option_x","");
		$template->assign("option_y","");

		$date_interval = new DateInterval('P1M');
		$date = new DateTime();
		$date->sub($date_interval);

		$qualifier_user = new qualifier(operation::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
		$qualifier_date = new qualifier(operation::$KEY_DATE,qualifier::$GREATER_OR_EQUAL,$date->format('Ymd'));
		$qualifier_type = new qualifier(operation::$KEY_TYPE,qualifier::$EQUAL,operation::$TYPE_DEPENSE);

		$qualifier_and = new qualifier_link(qualifier_link::$AND,array($qualifier_user,$qualifier_date,$qualifier_type));

		$liste_operation = operation::select($database,$qualifier_and);

		$liste_dto_operation = operation::dto_liste($database,$liste_operation);

		$template = graphique::graphique_pie($liste_dto_operation,null,null,"G_CAT",$template);
		$template->draw("graphique_pie");
	}
?>