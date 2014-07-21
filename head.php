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

	//Enregistrement de la fonction autoload dans le registre
	spl_autoload_register('autoload');

	//Initialisation de l'objet template
	RainTPL::$tpl_dir = "template/"; // template directory
	RainTPL::$cache_dir = "tmp/"; // cache directory
	$template = new RainTPL();

	//Test existante base de donnée
	//=====================================================================
	if(!file_exists("./data/finance.sqlite3")){
		require_once("./data/install.php");
		$database = install();
	}else{
		$database = dao::connect("./data/finance.sqlite3");
	}

	

	//Test connexion utilisateur
	//=====================================================================
	if(!isset($_SESSION["user"])){
		$liste_user = user::select($database,null);
		//il existe au moins un user
		if(sizeof($liste_user) > 0){
			if(isset($_GET["bad"])){
				$template->assign("message","Utilisateur inconnu");
			}else{
				$template->assign("message","");
			}
			$template->draw('identification');
		}else{
			//pas d'utilisateur, on redirige vers le formulaire de création de user
			$template->draw('first_create_user');
		}
		exit;
	}else{
		$user = unserialize($_SESSION["user"]);
	}

	//Compte bancaire actif
	//=====================================================================
	$qualifier_user = new qualifier(parametre::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
	$qualifier_compte_bancaire = new qualifier(parametre::$KEY_LIBELLE,qualifier::$EQUAL,parametre::$PARAM_COMPTE_BANCAIRE);
	$qualifier_and_user_compte = new qualifier_link(qualifier_link::$AND,array($qualifier_user,$qualifier_compte_bancaire));

	$liste_param = parametre::select($database,$qualifier_and_user_compte);
	if(sizeof($liste_param) > 0){
		$compte_bancaire_actif = $liste_param[0]->variables;
	}else{
		//si le parametre n'existe pas encore, on l'ajoute en base en l'activant
		$param = new parametre(null,parametre::$PARAM_COMPTE_BANCAIRE,"1",$user[user::$KEY_ID]);
		$param->insert($database);
		$compte_bancaire_actif = $param->variables;
	}

	//Compte admin
	//=====================================================================
	$qualifier_user = new qualifier(parametre::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
	$qualifier_admin = new qualifier(parametre::$KEY_LIBELLE,qualifier::$EQUAL,parametre::$PARAM_ADMIN);
	$qualifier_and_user_compte = new qualifier_link(qualifier_link::$AND,array($qualifier_user,$qualifier_admin));

	$liste_param = parametre::select($database,$qualifier_and_user_compte);
	if(sizeof($liste_param) > 0){
		$compte_admin = $liste_param[0]->variables;
	}else{
		//si le parametre n'existe pas encore, on l'ajoute en base en le desactivant
		$param = new parametre(null,parametre::$PARAM_ADMIN,"0",$user[user::$KEY_ID]);
		$param->insert($database);
		$compte_admin = $param->variables;
	}

	$template->assign("compte_actif",$compte_bancaire_actif);
	$template->assign("admin",$compte_admin);

	$titre_appli = "G&euro;stion";
?>
