<?php
	/**
		Fichier de traitement conernant l'objet compte
	*/
	
	require_once("./init.php");


	//Fonction de creation d'un compte
	function create(){
		global $database,$user;
		global $txt_libelle;
	
		$compte = new compte(null,$txt_libelle,$user[user::$KEY_ID]);
		$compte->insert($database);
		
		generation_composant_liste_compte_update();
	}

	//Fonction de modification d'un compte
	function update(){
		global $database,$user;

		global $id, $txt_libelle, $txt_solde, $txt_date_solde;
		$date = DateTime::createFromFormat("d/m/Y",$txt_date_solde);

		$compte = new compte($id,$txt_libelle,$user[user::$KEY_ID],number_format(str_replace(',','.',$txt_solde),2,'.',''),$date->format('Ymd'));
		$compte->update($database);

		generation_composant_liste_compte_update();
	}

	//Fonction de suppression d'un compte
	function delete(){
		global $database;

		global $id;
		
		$compte = new compte($id,null,null);
		$compte->delete($database);

		generation_composant_liste_compte_update();
	}

	//Fonction generant le detail d'un compte
	function detail(){
		global $database,$template;

		global $id;

		$qualifier_id = new qualifier(compte::$KEY_ID,qualifier::$EQUAL,$id);
		$liste_compte = compte::select($database,$qualifier_id);
		$liste_compte_dto = compte::dto_liste($database,$liste_compte);

		//Generation du composant
		$template->assign("compte",$liste_compte_dto[0]);
		$template->draw("composant/detail_compte");
	}

	//Fonction qui genere le composant liste_compte_update
	//Ce composant permet de mettre à jour la liste des comptes lors de la creation/modification/suppression d'un compte
	function generation_composant_liste_compte_update(){
		global $database,$user,$template;

		//Recherche des comptes de l'utilisateur
		$qualifier_user = new qualifier(compte::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
		$sort_libelle = new sort(compte::$KEY_LIBELLE,sort::$ASC);
		$liste_compte = compte::select($database,$qualifier_user,null,$sort_libelle);

		//Generation du composant
		$template->assign("compte_list",compte::dto_liste($database,$liste_compte));
		$template->draw("composant/liste_compte_update");	
	}
?>