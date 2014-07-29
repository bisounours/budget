<?php
	/**
		Page à inclure au début de chaque page php servant à l'affichage
	*/
	session_start();

	/*
		Classe permettant de charger automatiquement les classes php nécessaires au traitement 
		si celles ci ne sont pas encore chargées.
	*/
	function autoload($class) {
		if(file_exists('./modele/' . $class . '.php')){
    		include './modele/' . $class . '.php';
    	}else if(file_exists('./lib/dao/' . $class . '.php')){
    		include './lib/dao/' . $class . '.php';
    	}else if(file_exists('./lib/dto/' . $class . '.php')){
    		include './lib/dto/' . $class . '.php';
    	}else if(file_exists('./lib/rainTPL/' . $class . '.php')){
    		include './lib/rainTPL/' . $class . '.php';
    	}else if(file_exists('./lib/log4php/' . $class . '.php')){
    		include './lib/log4php/' . $class . '.php';
    	}
	}

	//Affichage des erreurs PHP
	ini_set('display_errors', 1);

	//Enregistrement de la fonction autoload dans le registre
	spl_autoload_register('autoload');

	//Initialisation de l'objet template
	RainTPL::$tpl_dir = "template/"; // template directory
	RainTPL::$cache_dir = "tmp/"; // cache directory
	$template = new RainTPL();

	$connected_user = false;


	//Test existante base de donnée
	//=====================================================================
	if(!file_exists("./data/famille.sqlite3")){
		require_once("./data/install.php");
		$database = install();
	}else{
		$database = dao::connect("./data/famille.sqlite3");
	}	

	//Test connexion utilisateur
	//=====================================================================
	if(!isset($_SESSION["user"])){
		$connected_user = false;
	}else{
		$user = unserialize($_SESSION["user"]);
		$connected_user = true;
	}

	$template->assign("connected_user",$connected_user);
	$template->assign("message","");

	if(isset($_GET["do"]) && isset($_GET["do"]) == "identification"){
		$template->draw('identification');
	}

	$titre_appli = "G&eacute;n&eacute;-Arbre";
?>
