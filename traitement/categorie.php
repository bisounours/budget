<?php
	/**
		Fichier de traitement conernant l'objet categorie
	*/

	require_once("init.php");

	//Fonction de création d'une categorie
	function create(){
		global $database,$user;

		global $txt_libelle;

		$categorie = new categorie(null,$txt_libelle,$user[user::$KEY_ID]);
		$categorie->insert($database);

		generation_composant_liste_categorie_update();
	}


	//Fonction generant le detail d'une categorie
	function detail(){
		global $database,$template;

		global $id;

		$qualifier_id = new qualifier(categorie::$KEY_ID,qualifier::$EQUAL,$id);
		$liste_categorie = categorie::select($database,$qualifier_id);
		$liste_categorie_dto = categorie::dto_liste($database,$liste_categorie);

		//Generation du composant
		$template->assign("categorie",$liste_categorie_dto[0]);
		$template->draw("composant/detail_categorie");
	}

	//Fonction de modification de toutes les categories
	function update(){
		global $database,$user;

		global $id, $txt_libelle, $txt_budget, $txt_debut_mois;

		$categorie = new categorie($id,$txt_libelle,$user[user::$KEY_ID],number_format(str_replace(',','.',$txt_budget),2,'.',''),$txt_debut_mois);
		$categorie->update($database);
 
		generation_composant_liste_categorie_update();
	}

	//Fonction de suppression d'une categorie
	function delete(){
		global $database;
		
		global $id;
		
		$categorie = new categorie($id,null,null);
		$categorie->delete($database);

		generation_composant_liste_categorie_update();
	}

	//Fonction qui genere le composant liste_categorie_update
	//Ce composant permet de mettre à jour la liste des categories lors de la creation/modification/suppression d'une categorie
	function generation_composant_liste_categorie_update(){
		global $database,$user,$template;

		//Recherche des categories de l'utilisateur
		$qualifier_user = new qualifier(categorie::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
		$sort_libelle = new sort(categorie::$KEY_LIBELLE,sort::$ASC);
		$liste_categorie = categorie::select($database,$qualifier_user,null,$sort_libelle);

		//Generation du composant
		$template->assign("categorie_list",categorie::dto_liste($database,$liste_categorie));
		$template->draw("composant/liste_categorie_update");	
	}
?>