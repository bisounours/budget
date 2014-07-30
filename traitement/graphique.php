<?php
	/**
		Page de traitement concernant les graphique.
		Cette page contient les fonctions pour générer les différents graphiques
	*/
	
class graphique{

	public static $TYPE_GRAPHIQUE_LINE = "L";
	public static $TYPE_GRAPHIQUE_HISTO = "H";
	public static $TYPE_GRAPHIQUE_PIE = "P";

	public static $OPTION_X_DATE = "DAT";
	public static $OPTION_X_CATEGORIE = "CAT";
	public static $OPTION_X_COMPTE = "COM";
	public static $OPTION_X_MOIS = "M";
	public static $OPTION_X_ANNEE = "Y";

	public static $OPTION_GROUPE_CATEGORIE = "G_CAT";
	public static $OPTION_GROUPE_COMPTE = "G_COM";
	public static $OPTION_GROUPE_TYPE = "G_TYP";

	public static $LISTE_MOIS = array("01"=>"Janvier",
					"02"=>"Fevrier",
					"03"=>"Mars",
					"04"=>"Avril",
					"05"=>"Mai",
					"06"=>"Juin",
					"07"=>"Juillet",
					"08"=>"Août",
					"09"=>"Septembre",
					"10"=>"Octobre",
					"11"=>"Novembre",
					"12"=>"Décembre");


	public static function graphique_line($liste_dto_operation,$option_x,$option_y,$option_groupe,$template){
		$liste_dto_operation_groupe = array($liste_dto_operation);
		//Premier tri par groupage
		if($option_groupe == graphique::$OPTION_GROUPE_CATEGORIE){
			$liste_dto_operation_groupe = operation::trier_par_categorie($liste_dto_operation);
		}else if($option_groupe == graphique::$OPTION_GROUPE_COMPTE){
			$liste_dto_operation_groupe = operation::trier_par_compte($liste_dto_operation);
		}else if($option_groupe == graphique::$OPTION_GROUPE_TYPE){
			$liste_dto_operation_groupe = operation::trier_par_type($liste_dto_operation);
		}

		//Generation de la liste des categories du graphique
		if($option_x == graphique::$OPTION_X_MOIS){
			$liste_mois_annee = array();
			for($i = 0;$i < sizeof($liste_dto_operation);$i++){
				$operation = $liste_dto_operation[$i];
				array_push($liste_mois_annee,graphique::$LISTE_MOIS[substr($operation["date"],4,2)]." ".substr($operation["date"],0,4));
			}
			$liste_mois_annee = array_unique($liste_mois_annee);
			$template->assign("liste_categorie",$liste_mois_annee);
		}else if($option_x == graphique::$OPTION_X_ANNEE){
			$liste_mois_annee = array();
			for($i = 0;$i < sizeof($liste_dto_operation);$i++){
				$operation = $liste_dto_operation[$i];
				array_push($liste_mois_annee,substr($operation["date"],0,4));
			}
			$liste_mois_annee = array_unique($liste_mois_annee);
			$template->assign("liste_categorie",$liste_mois_annee);
		}

		//Deuxieme tri par option abscisse
		$liste_dto_operation_groupe_option_x = $liste_dto_operation_groupe;
		foreach ($liste_dto_operation_groupe as $groupe => $liste_operation) {
			if($option_x == graphique::$OPTION_X_MOIS){
				$liste_operation_par_mois = array_fill_keys($liste_mois_annee,'0');
				for($i = 0;$i < sizeof($liste_operation);$i++){
					$operation = $liste_operation[$i];
					$liste_operation_par_mois[graphique::$LISTE_MOIS[substr($operation["date"],4,2)]." ".substr($operation["date"],0,4)] += $operation["montant"];
				}
				$liste_dto_operation_groupe_option_x[$groupe] = $liste_operation_par_mois;
			}else if($option_x == graphique::$OPTION_X_ANNEE){
				$liste_operation_par_an = array_fill_keys($liste_mois_annee,'0');
				for($i = 0;$i < sizeof($liste_operation);$i++){
					$operation = $liste_operation[$i];
					$liste_operation_par_an[substr($operation["date"],0,4)] += $operation["montant"];
				}
				$liste_dto_operation_groupe_option_x[$groupe] = $liste_operation_par_an;
			}
		}
		$template->assign("liste_operation",$liste_dto_operation_groupe_option_x);
		return $template;
	}

	public static function graphique_histo($liste_dto_operation,$option_x,$option_y,$option_groupe,$template){
		$liste_dto_operation_groupe = array($liste_dto_operation);
		//Premier tri par groupage
		if($option_groupe == graphique::$OPTION_GROUPE_CATEGORIE){
			$liste_dto_operation_groupe = operation::trier_par_categorie($liste_dto_operation);
		}else if($option_groupe == graphique::$OPTION_GROUPE_COMPTE){
			$liste_dto_operation_groupe = operation::trier_par_compte($liste_dto_operation);
		}else if($option_groupe == graphique::$OPTION_GROUPE_TYPE){
			$liste_dto_operation_groupe = operation::trier_par_type($liste_dto_operation);
		}

		//Generation de la liste des categories du graphique
		if($option_x == graphique::$OPTION_X_MOIS){
			$liste_mois_annee = array();
			for($i = 0;$i < sizeof($liste_dto_operation);$i++){
				$operation = $liste_dto_operation[$i];
				array_push($liste_mois_annee,graphique::$LISTE_MOIS[substr($operation["date"],4,2)]." ".substr($operation["date"],0,4));
			}
			$liste_mois_annee = array_unique($liste_mois_annee);
			$template->assign("liste_categorie",$liste_mois_annee);
		}else if($option_x == graphique::$OPTION_X_ANNEE){
			$liste_mois_annee = array();
			for($i = 0;$i < sizeof($liste_dto_operation);$i++){
				$operation = $liste_dto_operation[$i];
				array_push($liste_mois_annee,substr($operation["date"],0,4));
			}
			$liste_mois_annee = array_unique($liste_mois_annee);
			$template->assign("liste_categorie",$liste_mois_annee);
		}else if($option_x == graphique::$OPTION_X_CATEGORIE){
			$liste_categorie = array();
			for($i = 0;$i < sizeof($liste_dto_operation);$i++){
				$operation = $liste_dto_operation[$i];
				array_push($liste_categorie,$operation["categorie"]["libelle"]);
			}
			$liste_categorie = array_unique($liste_categorie);
			$template->assign("liste_categorie",$liste_categorie);
		}else if($option_x == graphique::$OPTION_X_COMPTE){
			$liste_compte = array();
			for($i = 0;$i < sizeof($liste_dto_operation);$i++){
				$operation = $liste_dto_operation[$i];
				array_push($liste_compte,$operation["compte"]["libelle"]);
			}
			$liste_compte = array_unique($liste_compte);
			$template->assign("liste_categorie",$liste_compte);
		}

		//Deuxieme tri par option abscisse
		$liste_dto_operation_groupe_option_x = $liste_dto_operation_groupe;
		foreach ($liste_dto_operation_groupe as $groupe => $liste_operation) {
			if($option_x == graphique::$OPTION_X_MOIS){
				$liste_operation_par_mois = array_fill_keys($liste_mois_annee,'0');
				for($i = 0;$i < sizeof($liste_operation);$i++){
					$operation = $liste_operation[$i];
					$liste_operation_par_mois[graphique::$LISTE_MOIS[substr($operation["date"],4,2)]." ".substr($operation["date"],0,4)] += $operation["montant"];
				}
				$liste_dto_operation_groupe_option_x[$groupe] = $liste_operation_par_mois;
			}else if($option_x == graphique::$OPTION_X_ANNEE){
				$liste_operation_par_an = array_fill_keys($liste_mois_annee,'0');
				for($i = 0;$i < sizeof($liste_operation);$i++){
					$operation = $liste_operation[$i];
					$liste_operation_par_an[substr($operation["date"],0,4)] += $operation["montant"];
				}
				$liste_dto_operation_groupe_option_x[$groupe] = $liste_operation_par_an;
			}else if($option_x == graphique::$OPTION_X_CATEGORIE){
				$liste_operation_par_categorie = array_fill_keys($liste_categorie,'0');
				for($i = 0;$i < sizeof($liste_operation);$i++){
					$operation = $liste_operation[$i];
					$liste_operation_par_categorie[$operation["categorie"]["libelle"]] += $operation["montant"];
				}
				$liste_dto_operation_groupe_option_x[$groupe] = $liste_operation_par_categorie;
			}else if($option_x == graphique::$OPTION_X_COMPTE){
				$liste_operation_par_compte = array_fill_keys($liste_compte,'0');
				for($i = 0;$i < sizeof($liste_operation);$i++){
					$operation = $liste_operation[$i];
					$liste_operation_par_compte[$operation["compte"]["libelle"]] += $operation["montant"];
				}
				$liste_dto_operation_groupe_option_x[$groupe] = $liste_operation_par_compte;
			}
		}
		$template->assign("liste_operation",$liste_dto_operation_groupe_option_x);
		return $template;
	}

	public static function graphique_pie($liste_dto_operation,$option_x,$option_y,$option_groupe,$template){
		if($option_groupe == graphique::$OPTION_GROUPE_CATEGORIE){
			$template->assign("titre_y","Montant (€)");
			$liste_operation_par_categorie = operation::trier_par_categorie($liste_dto_operation);
			$liste_operation_par_categorie_cumul_montant =  array();
			foreach ($liste_operation_par_categorie as $categorie => $liste_operation) {
				$total_montant_categorie = 0;
				for ($i = 0; $i < sizeof($liste_operation) ; $i++) {
					$total_montant_categorie += $liste_operation[$i]["montant"];
				}
				$liste_operation_par_categorie_cumul_montant[$categorie] = $total_montant_categorie;
			}
			$template->assign("liste_operation",$liste_operation_par_categorie_cumul_montant);
		}else if($option_groupe == graphique::$OPTION_GROUPE_COMPTE){
			$liste_operation_par_compte = operation::trier_par_compte($liste_dto_operation);
			$liste_operation_par_compte_cumul_montant =  array();
			foreach ($liste_operation_par_compte as $compte => $liste_operation) {
				$total_montant_compte = 0;
				for ($i = 0; $i < sizeof($liste_operation) ; $i++) {
					$total_montant_compte += $liste_operation[$i]["montant"];
				}
				$liste_operation_par_compte_cumul_montant[$compte] = $total_montant_compte;
			}
			$template->assign("liste_operation",$liste_operation_par_compte_cumul_montant);
		}else if($option_groupe == graphique::$OPTION_GROUPE_TYPE){
			$liste_operation_par_type = operation::trier_par_type($liste_dto_operation);
			$liste_operation_par_type_cumul_montant =  array();
			foreach ($liste_operation_par_type as $compte => $liste_operation) {
				$total_montant_type = 0;
				for ($i = 0; $i < sizeof($liste_operation) ; $i++) {
					$total_montant_type += $liste_operation[$i]["montant"];
				}
				$liste_operation_par_type_cumul_montant[$compte] = $total_montant_type;
			}
			$template->assign("liste_operation",$liste_operation_par_type_cumul_montant);
		}
		return $template;
	}	

}
?>