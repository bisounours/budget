<?php
	require_once("init.php");
	
	//Fonction permettant de mettre à jour les configurations de l'utilisateur
	function update(){
		//variable global
		global $database,$user;

		//variable propre à la fonction
		global $hid_compte_actif,$cb_compte_actif;

		//Modification de la gestion des comptes bancaire
		$compte_actif = new parametre($hid_compte_actif,parametre::$PARAM_COMPTE_BANCAIRE,"1",$user[user::$KEY_ID]);
		if(!isset($cb_compte_actif)){
			$compte_actif->set_valeur("0");
		}
		$compte_actif->update($database);

		header("location:../configuration.php");	
	}
?>