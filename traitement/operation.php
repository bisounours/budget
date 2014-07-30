<?php
	/**
		Page de traitement concernant les opérations.
		Cette page contient toutes les actions concernants les opérations.
	*/

	require_once("init.php");
	require_once("graphique.php");

	/*
		Fonction de création d'une opération.
		Création d'une fréquence si l'opération n'est pas ponctuelle
	*/
	function create(){
		global $database,$user;

		global $txt_libelle,$txt_montant,$txt_date,$lst_categorie,$lst_compte,$rd_type,$rd_frequence,$txt_nb,$lst_frequence;

		$date = DateTime::createFromFormat("d/m/Y",$txt_date);
		$compte = isset($_POST["lst_compte"]) ? dao::escape($lst_compte) : null;
		$type = dao::escape($rd_type);
		$ponctuelle = $rd_frequence == "P" ? true : false;
		$frequence = "P".dao::escape($txt_nb).dao::escape($lst_frequence);
		
		if($ponctuelle){
			//Création d'une opération ponctuelle
			$operation = new operation(null,$date->format('Ymd'),number_format(str_replace(',','.',$txt_montant),2,'.',''),$type,$lst_categorie,$user[user::$KEY_ID],$compte,$txt_libelle,null,1);
			$operation->insert($database);
		}else{
			//Création de l'occcurence et des opérations depuis la date indiqué
			$occurence = new occurence(null,$date->format('Ymd'),null,number_format(str_replace(',','.',$txt_montant),2,'.',''),$type,$lst_categorie,$user[user::$KEY_ID],$compte,$txt_libelle,$frequence);
			$occurence->insert($database);
			$occurence->operation_generate($database);
		}
	}

	/*
		Fonction de modification d'une opération
		Il y a deux type de modification :
			- Modification d'une opération isolé
			- Modification de toutes les opérations
	*/
	function update(){
		global $database,$user;

		global $txt_libelle,$txt_montant,$lst_categorie,$rd_type,$hid_id;

		//Récupération des paramètres
		$frequence_id = isset($_POST["hid_frequence_id"]) ? dao::escape($_POST["hid_frequence_id"]) : null;
		$compte = isset($_POST["lst_compte"]) ? dao::escape($_POST["lst_compte"]) : null;
		$type_modification = isset($_POST["lst_type_modification"]) ? $_POST["lst_type_modification"] : null;
		$date = isset($_POST["txt_date_operation"]) ? DateTime::createFromFormat("d/m/Y",$_POST["txt_date_operation"]) : null;

		//Modification d'une opération unique
		if($type_modification == null || $type_modification == "U"){
			$qualifier_occurence = new qualifier(operation::$KEY_ID,qualifier::$EQUAL,$hid_id);
			$liste_operation = operation::select($database,$qualifier_occurence);
			$operation_courante = $liste_operation[0];
			if(is_null($date)){
				$date = DateTime::createFromFormat("Ymd",$operation_courante->get_date());
			}
			$operation = new operation($hid_id,$date->format('Ymd'),number_format(str_replace(',','.',$txt_montant),2,'.',''),$rd_type,$lst_categorie,$user[user::$KEY_ID],$compte,$txt_libelle,$frequence_id,1);
			$operation->update($database);
		//Modification de toutes les opérations
		}else if($type_modification == "A"){
			$qualifier_occurence = new qualifier(operation::$KEY_OCCURENCE_ID,qualifier::$EQUAL,$frequence_id);
			$liste_operation = operation::select($database,$qualifier_occurence);
			for($i=0;$i<sizeof($liste_operation);$i++){
				$operation = $liste_operation[$i];
				$operation = new operation($operation->get_id(),$operation->get_date(),number_format(str_replace(',','.',$txt_montant),2,'.',''),$rd_type,$lst_categorie,$user[user::$KEY_ID],$compte,$txt_libelle,$frequence_id,$operation->get_actif());
				$operation->update($database);
			}
			$qualifier_occurence = new qualifier(occurence::$KEY_ID,qualifier::$EQUAL,$frequence_id);
			$liste_occurence = occurence::select($database,$qualifier_occurence);
			$occurence_courant = $liste_occurence[0];
			$occurence = new occurence($frequence_id,$occurence_courant->get_dateDebut(),null,number_format(str_replace(',','.',$txt_montant),2,'.',''),$rd_type,$lst_categorie,$user[user::$KEY_ID],$compte,$txt_libelle,$occurence_courant->get_frequence());
			$occurence->update($database);
		}

		liste_operation_recherche();
	}

	/*
		Fonction de recherche des opérations sur le libellé de l'opération de l'utilisateur connecté
	*/
	function recherche(){
		global $database,$user;

		global $recherche;
	
		$qualifier_libelle = new qualifier("replace_accent(".operation::$KEY_LIBELLE.")",qualifier::$LIKE,"%".str_replace(" ","%",outils::replace_accent($recherche))."%");
		$qualifier_user = new qualifier(operation::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
		$qualifier_actif = new qualifier(operation::$KEY_ACTIF,qualifier::$EQUAL,1);
		$qualifier_and = new qualifier_link(qualifier_link::$AND,array($qualifier_user,$qualifier_libelle,$qualifier_actif));

		//sauvegarde de la recherche
		$_SESSION["recherche"] = serialize($qualifier_and);
		
		$sort_date = new sort(operation::$KEY_DATE,sort::$DESC);
		$liste_operation = operation::select($database,$qualifier_and,null,$sort_date,100);

		//Génération de la liste HTML des résultats via un systeme de template
		raintpl::$tpl_dir = "../template/"; // template directory
		raintpl::$cache_dir = "../tmp/"; // cache directory
		$template = new RainTPL();
		$template->assign("liste_operation",operation::dto_liste($database,$liste_operation));
		$template->draw("composant/operations");
	}

	/*
		Fonction de suppression d'une ou plusieurs opérations
	*/
	function delete(){
		global $database,$user;
		
		//Recuperation des paramètre
		$id = dao::escape($_POST["id"]);
		$type_suppression = dao::escape($_POST["type_suppression"]);

		//Recherche de l'opération
		$qualifier_id = new qualifier(operation::$KEY_ID,qualifier::$EQUAL,$id);
		$liste_operation = operation::select($database,$qualifier_id,null,null);
		$operation = $liste_operation[0];

		if($type_suppression == "U"){
			$operation->set_actif(0);
			$operation->update($database);
		}else{
			//Recherche de l'occurence
			$qualifier_occurence = 	new qualifier(occurence::$KEY_ID,qualifier::$EQUAL,$operation->get_occurence_id());
			$liste_occurence = occurence::select($database,$qualifier_occurence,null,null);
			$occurence = $liste_occurence[0];

			//Recherche des opérations liés à l'occurence
			$qualifier_occurence_id = new qualifier(operation::$KEY_OCCURENCE_ID,qualifier::$EQUAL,$operation->get_occurence_id());
			$liste_operation = operation::select($database,$qualifier_occurence_id,null,null);

			//Suppression des opérations depassant la date de fin
			for($i=0 ; $i < sizeof($liste_operation) ; $i++){
				$operation_courante = $liste_operation[$i];
				$operation_courante->delete($database);
			}

			$occurence->delete();
		}

		liste_operation_recherche();
	}

	/*
		Fonction permettant d'arreter le calcul automatique des opérations avec occurence
	*/
	function stop(){
		global $database,$user;

		//Récupération des paramètres
		$date_fin = DateTime::createFromFormat("d/m/Y",$_POST["date_fin"]);
		$id = dao::escape($_POST["id"]);

		//Recherche de l'opération
		$qualifier_id = new qualifier(operation::$KEY_ID,qualifier::$EQUAL,$id);
		$liste_operation = operation::select($database,$qualifier_id,null,null);
		$operation = $liste_operation[0];

		//Recherche de l'occurence
		$qualifier_occurence = 	new qualifier(occurence::$KEY_ID,qualifier::$EQUAL,$operation->get_occurence_id());
		$liste_occurence = occurence::select($database,$qualifier_occurence,null,null);
		$occurence = $liste_occurence[0];

		//Arret de l'occurence
		$occurence->set_dateFin($date_fin->format('Ymd'));
		$occurence->update($database);

		//Recherche des opérations de cette occurence depassant la date de fin
		$qualifier_occurence_id = new qualifier(operation::$KEY_OCCURENCE_ID,qualifier::$EQUAL,$operation->get_occurence_id());
		$qualifier_date = new qualifier(operation::$KEY_DATE,qualifier::$GREATER_OR_EQUAL,$date_fin->format('Ymd'));
		$qualifier_and = new qualifier_link(qualifier_link::$AND,array($qualifier_occurence_id,$qualifier_date));
		$liste_operation = operation::select($database,$qualifier_and,null,null);

		//Suppression des opérations depassant la date de fin
		for($i=0 ; $i < sizeof($liste_operation) ; $i++){
			$operation_courante = $liste_operation[$i];
			$operation_courante->delete($database);
		}

		liste_operation_recherche();
	}

	/*
		Fonction recherche les opérations selon les critères envoyés
	*/
	function recherche_avancee($libelle,$montant_inf,$montant_sup,$date_inf,$date_sup,$type_depense,$type_revenu,$liste_categorie,$liste_compte,$periodique,$ponctuelle){
		global $database,$user;

		$liste_qualifier = array();
		$qualifier_user = new qualifier(operation::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
		array_push($liste_qualifier,$qualifier_user);
		$qualifier_actif = new qualifier(operation::$KEY_ACTIF,qualifier::$EQUAL,1);
		array_push($liste_qualifier,$qualifier_actif);

		if($libelle != ""){
			if(substr($libelle,0,1) == "!"){
				$qualifier_libelle = new qualifier("replace_accent(".operation::$KEY_LIBELLE.")",qualifier::$NOT_LIKE,"%".str_replace(" ","%",outils::replace_accent(substr($libelle,1)))."%");
			}else{
				$qualifier_libelle = new qualifier("replace_accent(".operation::$KEY_LIBELLE.")",qualifier::$LIKE,"%".str_replace(" ","%",outils::replace_accent($libelle))."%");
			}
			array_push($liste_qualifier,$qualifier_libelle);
		}

		if($montant_inf != ""){
			$qualifier_montant_inf = new qualifier(operation::$KEY_MONTANT,qualifier::$GREATER_OR_EQUAL,$montant_inf);
			array_push($liste_qualifier,$qualifier_montant_inf);	
		}

		if($montant_sup != ""){
			$qualifier_montant_sup = new qualifier(operation::$KEY_MONTANT,qualifier::$LOWER_OR_EQUAL,$montant_sup);
			array_push($liste_qualifier,$qualifier_montant_sup);	
		}

		if($date_inf != ""){
			$date = DateTime::createFromFormat("d/m/Y",$date_inf);
			$qualifier_date_inf = new qualifier(operation::$KEY_DATE,qualifier::$GREATER_OR_EQUAL,$date->format('Ymd'));
			array_push($liste_qualifier,$qualifier_date_inf);
		}

		if($date_sup != ""){
			$date = DateTime::createFromFormat("d/m/Y",$date_sup);
			$qualifier_date_sup = new qualifier(operation::$KEY_DATE,qualifier::$LOWER_OR_EQUAL,$date->format('Ymd'));
			array_push($liste_qualifier,$qualifier_date_sup);
		}

		if($type_depense == "true" && $type_revenu == "false"){
			$qualifier_type = new qualifier(operation::$KEY_TYPE,qualifier::$EQUAL,operation::$TYPE_DEPENSE);
			array_push($liste_qualifier,$qualifier_type);	
		}

		if($type_depense == "false" && $type_revenu == "true"){
			$qualifier_type = new qualifier(operation::$KEY_TYPE,qualifier::$EQUAL,operation::$TYPE_REVENU);
			array_push($liste_qualifier,$qualifier_type);
		}

		if($periodique == "false" && $ponctuelle == "true"){
			$qualifier_ponctuelle = new qualifier(operation::$KEY_OCCURENCE_ID,qualifier::$EQUAL,null);
			array_push($liste_qualifier,$qualifier_ponctuelle);	
		}

		if($periodique == "true" && $ponctuelle == "false"){
			$qualifier_periodique = new qualifier(operation::$KEY_OCCURENCE_ID,qualifier::$NOT_EQUAL,null);
			array_push($liste_qualifier,$qualifier_periodique);	
		}

		if($liste_categorie != ""){
			$qualifier_categorie = new qualifier(operation::$KEY_CATEGORIE_ID,qualifier::$IN,"(".$liste_categorie.")");
			array_push($liste_qualifier,$qualifier_categorie);	
		}

		if($liste_compte != ""){
			$qualifier_compte = new qualifier(operation::$KEY_COMPTE_ID,qualifier::$IN,"(".$liste_compte.")");
			array_push($liste_qualifier,$qualifier_compte);	
		}

		$qualifier_and = new qualifier_link(qualifier_link::$AND,$liste_qualifier);
		
		$sort_date = new sort(operation::$KEY_DATE,sort::$ASC);

		$liste_operation = operation::select($database,$qualifier_and,null,$sort_date);

		return $liste_operation;
	}

	function tableau(){
		global $database,$user;

		global $txt_libelle,$txt_montant_inf,$txt_montant_sup,$txt_date_inf,$txt_date_sup,$cb_depense,$cb_revenu,$lst_categorie,$lst_compte,$lst_option_affichage,$cb_periodique,$cb_ponctuelle;

		$cb_depense = isset($cb_depense) ? "true" : "false";
		$cb_revenu = isset($cb_revenu) ? "true" : "false";
		$cb_periodique = isset($cb_periodique) ? "true" : "false";
		$cb_ponctuelle = isset($cb_ponctuelle) ? "true" : "false";

		//recherche des opérations
		$liste_operation = recherche_avancee($txt_libelle,$txt_montant_inf,$txt_montant_sup,$txt_date_inf,$txt_date_sup,$cb_depense,$cb_revenu,substr($lst_categorie,0,-1),substr($lst_compte,0,-1),$cb_periodique,$cb_ponctuelle);

		//transformation de la liste au format dto
		$liste_dto_operation = operation::dto_liste($database,$liste_operation);

		$liste_affichage = array();
		$libelle = "";
		switch ($lst_option_affichage) {
			case 'CAT':
				foreach (operation::trier_par_categorie($liste_dto_operation) as $categorie => $liste_operation) {
					$categorie_affichage = 	array();
					$categorie_affichage["libelle"] = $categorie;
					$categorie_affichage["montant"] = 0;
					$categorie_affichage["nb"] = 0;
					foreach ($liste_operation as $operation) {
						$categorie_affichage["montant"] += $operation["montant"];
						$categorie_affichage["nb"]++;
					}
					array_push($liste_affichage,$categorie_affichage);
				};
				$libelle = "Cat&eacute;gorie";
			break;
			case 'COM':
				foreach (operation::trier_par_compte($liste_dto_operation) as $compte => $liste_operation) {
					$compte_affichage =	array();
					$compte_affichage["libelle"] = $compte;
					$compte_affichage["montant"] = 0;
					$compte_affichage["nb"] = 0;
					foreach ($liste_operation as $operation) {
						$compte_affichage["montant"] += $operation["montant"];
						$compte_affichage["nb"]++;
					}
					array_push($liste_affichage,$compte_affichage);
				};
				$libelle = "Compte bancaire";
			break;
			case 'M':
				foreach (operation::trier_par_mois($liste_dto_operation) as $mois => $liste_operation) {
					$mois_affichage =	array();
					$mois_affichage["libelle"] = graphique::$LISTE_MOIS[substr($mois,4,2)]." ".substr($mois,0,4);
					$mois_affichage["montant"] = 0;
					$mois_affichage["nb"] = 0;
					foreach ($liste_operation as $operation) {
						$mois_affichage["montant"] += $operation["montant"];
						$mois_affichage["nb"]++;
					}
					array_push($liste_affichage,$mois_affichage);
				};
				$libelle = "Mois";
			break;
			case 'Y':
				foreach (operation::trier_par_an($liste_dto_operation) as $annee => $liste_operation) {
					$annee_affichage =	array();
					$annee_affichage["libelle"] = $annee;
					$annee_affichage["montant"] = 0;
					$annee_affichage["nb"] = 0;
					foreach ($liste_operation as $operation) {
						$annee_affichage["montant"] += $operation["montant"];
						$annee_affichage["nb"]++;
					}
					array_push($liste_affichage,$annee_affichage);
				};
				$libelle = "Ann&eacute;e";
			break;
			default:
				$libelle = "Op&eacute;ration";
				$liste_affichage = $liste_dto_operation;
			break;
		}

		$somme = 0;
		foreach ($liste_dto_operation as $operation) {
			if(($cb_depense == "true" && $cb_revenu == "false") || ($cb_depense == "false" && $cb_revenu == "true")){
				$somme += $operation["montant"];
			}else{
				if($operation["type"] == "D"){
					$somme -= $operation["montant"];	
				}else{
					$somme += $operation["montant"];	
				}
			}
		}

		raintpl::$tpl_dir = "../js/"; // template directory
		raintpl::$cache_dir = "../tmp/"; // cache directory
		$template = new RainTPL();
		$template->assign("liste_operation",$liste_affichage);
		$template->assign("option_affichage",$lst_option_affichage);
		$template->assign("libelle",$libelle);
		$template->assign("somme",$somme);
		$template->assign("option_montant",isset($_POST["cb_option_montant"]));
		$template->assign("option_categorie",isset($_POST["cb_option_categorie"]));
		$template->assign("option_date",isset($_POST["cb_option_date"]));
		$template->assign("option_compte",isset($_POST["cb_option_compte"]));
		$template->draw("../template/composant/resultat_tableau");
	}

	/*
		Fonction recherche les opérations selon les critères envoyés
		et généré un graphique JS sous forme de template avec les options envoyés
	*/
	function graphique(){
		global $database,$user;

		global $txt_libelle,$txt_montant_inf,$txt_montant_sup,$txt_date_inf,$txt_date_sup,$cb_depense,$cb_revenu,$lst_categorie,$lst_compte,$lst_type_graphique,$lst_option_x,$lst_option_y,$lst_option_groupe,$cb_periodique,$cb_ponctuelle;

		$cb_depense = isset($cb_depense) ? "true" : "false";
		$cb_revenu = isset($cb_revenu) ? "true" : "false";
		$cb_periodique = isset($cb_periodique) ? "true" : "false";
		$cb_ponctuelle = isset($cb_ponctuelle) ? "true" : "false";

		$liste_operation = recherche_avancee($txt_libelle,$txt_montant_inf,$txt_montant_sup,$txt_date_inf,$txt_date_sup,$cb_depense,$cb_revenu,substr($lst_categorie,0,-1),substr($lst_compte,0,-1),$cb_periodique,$cb_ponctuelle);
		$liste_dto_operation = operation::dto_liste($database,$liste_operation);

		raintpl::$tpl_dir = "../js/"; // template directory
		raintpl::$cache_dir = "../tmp/"; // cache directory
		raintpl::$tpl_ext = "js"; // cache directory
		$template = new RainTPL();
		$template->assign("titre","Résultat");
		$template->assign("sous_titre","");
		$template->assign("option_groupe",$lst_option_groupe);
		$template->assign("option_x",$lst_option_x);
		$template->assign("option_y",$lst_option_y);
		$template->assign("titre_y","Montant (€)");

		if($lst_type_graphique == graphique::$TYPE_GRAPHIQUE_LINE){
			$template = graphique::graphique_line($liste_dto_operation,$lst_option_x,$lst_option_y,$lst_option_groupe,$template);
			$template->draw("graphique_line");
		}else if($lst_type_graphique == "H"){
			$template = graphique::graphique_histo($liste_dto_operation,$lst_option_x,$lst_option_y,$lst_option_groupe,$template);
			$template->draw("graphique_histogramme");
		}else{
			$template = graphique::graphique_pie($liste_dto_operation,$lst_option_x,$lst_option_y,$lst_option_groupe,$template);
			$template->draw("graphique_pie");
		}
		
	}

	function affichage_update(){
		global $database,$user;

		global $id;

		$qualifier_id = new qualifier(operation::$KEY_ID,qualifier::$EQUAL,$id);
		$liste_operation = operation::select($database,$qualifier_id);
		$liste_operation_dto = operation::dto_liste($database,$liste_operation);
		$operation_dto = $liste_operation_dto[0];

		//Recuperation de la liste de categorie et des comptes bancaire
		$qualifier_user = new qualifier(operation::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
		$sort_categorie_libelle = new sort(categorie::$KEY_LIBELLE,sort::$ASC);
		$sort_compte_libelle = new sort(compte::$KEY_LIBELLE,sort::$ASC);
		$liste_compte = compte::select($database,$qualifier_user,null,$sort_compte_libelle);
		$liste_categorie = categorie::select($database,$qualifier_user,null,$sort_categorie_libelle);

		//Recuperation du parametrage des comptes bancaire actif
		$qualifier_user = new qualifier(parametre::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
		$qualifier_compte_bancaire = new qualifier(parametre::$KEY_LIBELLE,qualifier::$EQUAL,parametre::$PARAM_COMPTE_BANCAIRE);
		$qualifier_and_user_compte = new qualifier_link(qualifier_link::$AND,array($qualifier_user,$qualifier_compte_bancaire));
		$liste_param = parametre::select($database,$qualifier_and_user_compte);
		$compte_bancaire_actif = $liste_param[0]->variables;

		//Génération de la div de modification de l'operation via un systeme de template
		raintpl::$tpl_dir = "../template/"; // template directory
		raintpl::$cache_dir = "../tmp/"; // cache directory
		$template = new RainTPL();
		$template->assign("operation",$operation_dto);
		$template->assign("compte_list",dto::dto_liste($liste_compte));
		$template->assign("categorie_list",dto::dto_liste($liste_categorie));
		$template->assign("categorie_select",$operation_dto["categorie"]["id"]);
		$template->assign("compte_select",$operation_dto["compte"]["id"]);
		$template->assign("compte_actif",$compte_bancaire_actif);
		$template->draw("composant/update_operation");
	}

	function update_operation(){
		global $database,$user;

		$date = new DateTime;
		$qualifier_user = new qualifier(occurence::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
		$qualifier_date_fin = new qualifier(occurence::$KEY_DATEFIN,qualifier::$LOWER_OR_EQUAL,$date->format('Ymd'));
		$qualifier_date_fin_null = new qualifier(occurence::$KEY_DATEFIN,qualifier::$EQUAL,null);
		$qualifier_or = new qualifier_link(qualifier_link::$OR,array($qualifier_date_fin,$qualifier_date_fin_null));
		$qualifier_and = new qualifier_link(qualifier_link::$AND,array($qualifier_or,$qualifier_user));

		$liste_occurence = occurence::select($database,$qualifier_and);

		foreach($liste_occurence as $occurence) {
			$qualifier_occurence = new qualifier(operation::$KEY_OCCURENCE_ID,qualifier::$EQUAL,$occurence->get_id());
			$sort_date = new sort(operation::$KEY_DATE,sort::$DESC);
			$liste_operation = operation::select($database,$qualifier_occurence,null,$sort_date);

			$derniere_operation = sizeof($liste_operation) > 0 ? $liste_operation[0] : null;

			if($derniere_operation != null){
				$occurence->operation_generate($database,DateTime::createFromFormat('Ymd',$derniere_operation->get_date()),false);
			}else{
				$occurence->operation_generate($database);
			}
		}
	}

	function liste_operation_recherche(){
		global $database,$user;
		
		if(isset($_SESSION["recherche"])){
			$qualifier_and = unserialize($_SESSION["recherche"]);	
		}else{
			$qualifier_user = new qualifier(operation::$KEY_USER_ID,qualifier::$EQUAL,$user[user::$KEY_ID]);
			$qualifier_actif = new qualifier(operation::$KEY_ACTIF,qualifier::$EQUAL,1);
			$qualifier_and = new qualifier_link(qualifier_link::$AND,array($qualifier_user,$qualifier_actif));
		}

		$sort_date = new sort(operation::$KEY_DATE,sort::$DESC);
		$liste_operation = operation::select($database,$qualifier_and,null,$sort_date,100);

		//Génération de la liste HTML des résultats via un systeme de template
		raintpl::$tpl_dir = "../template/"; // template directory
		raintpl::$cache_dir = "../tmp/"; // cache directory
		$template = new RainTPL();
		$template->assign("liste_operation",operation::dto_liste($database,$liste_operation));
		$template->draw("composant/operations");
	}
?>