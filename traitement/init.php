<?php
	/**
		Fichier d'initialisation pour les fichiers de traitement.
	*/

	session_start();
	require_once '../lib/rainTPL/RainTPL.php';

	/*
		Classe permettant de charger automatiquement les classes php nécessaires au traitement 
		si celles ci ne sont pas encore chargées.
	*/
	function autoload($class) {
		if(file_exists('../modele/' . $class . '.php')){
    		require_once '../modele/' . $class . '.php';
    	}else if(file_exists('../lib/' . $class . '.php')){
    		require_once '../lib/' . $class . '.php';
    	}else if(file_exists('../lib/dao/' . $class . '.php')){
    		require_once '../lib/dao/' . $class . '.php';
    	}else if(file_exists('../lib/dto/' . $class . '.php')){
    		require_once '../lib/dto/' . $class . '.php';
    	}else if(file_exists('../lib/rainTPL/' . $class . '.php')){
    		require_once '../lib/rainTPL/' . $class . '.php';
    	}else if(file_exists('../lib/log4php/' . $class . '.php')){
    		require_once '../lib/log4php/' . $class . '.php';
    	}else if(file_exists('./' . $class . '.php')){
    		require_once './' . $class . '.php';
    	}
	}

	//Enregistrement de la fonction autoload dans le registre
	spl_autoload_register('autoload');

	//Initialisation de la base de donnée SQLite
	$database = dao::connect("../data/finance.sqlite3");

	//Association d'une fonction php à une nouvelle fonction SQLite 
	$database->createFunction('replace_accent','outils::replace_accent',1);

	//Recuperation de l'utilisateur courant
	if(isset($_SESSION["user"])){
		$user = unserialize($_SESSION["user"]);
	}

	//Recuperation de la fonction à executer
	$fonction = $_REQUEST["fonction"];

	//Recuperation de toutes les variables POST
	foreach ($_REQUEST as $key => $value) {
		$$key = dao::escape($value);
	}

	//Initialisation du systeme de template
	raintpl::$tpl_dir = "../template/"; // template directory
	raintpl::$cache_dir = "../tmp/"; // cache directory
	$template = new RainTPL();

	//execution de la fonction
	call_user_func($fonction);
?>