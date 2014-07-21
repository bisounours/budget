<?php
/**
	Commentaire de classe....
*/

class operation extends dao_operation{

	public static $TYPE_REVENU = "R";
	public static $TYPE_DEPENSE = "D";

	public static function dto_liste($database,$liste_operation){
		$liste_dto = array();
		for ($i=0; $i < sizeof($liste_operation) ; $i++) { 
			$operation_courante = $liste_operation[$i];
			$operation_dto = $operation_courante->variables;
			
			$qual_compte = new qualifier(compte::$KEY_ID,qualifier::$EQUAL,$operation_courante->get_compte_id());
			$liste_compte = compte::select($database,$qual_compte);
			$compte = $liste_compte[0];
			$operation_dto["compte"] = $compte->variables;
			$operation_dto["libelle"] = addslashes($operation_dto["libelle"]);

			$operation_dto["montant"] = str_replace(',','.',$operation_dto["montant"]);

			$qual_categorie = new qualifier(categorie::$KEY_ID,qualifier::$EQUAL,$operation_courante->get_categorie_id());
			$liste_categorie = categorie::select($database,$qual_categorie);
			$categorie = $liste_categorie[0];
			$operation_dto["categorie"] = $categorie->variables;

			if($operation_courante->get_occurence_id() != null){
				$qual_occurence = new qualifier(occurence::$KEY_ID,qualifier::$EQUAL,$operation_courante->get_occurence_id());
				$liste_occurence = occurence::select($database,$qual_occurence);
				$occurence = $liste_occurence[0];
				$operation_dto["frequence"] = $occurence->variables;
			}else{
				$operation_dto["frequence"] = "";
			}

			array_push($liste_dto,$operation_dto);
		}
		return $liste_dto;
	}

	public static function trier_par_categorie($liste_dto_operation){
		$liste_operation_par_categorie = array();
		for($i = 0;$i < sizeof($liste_dto_operation);$i++){
			$operation = $liste_dto_operation[$i];
			if(isset($liste_operation_par_categorie[$operation["categorie"]["libelle"]])){
				array_push($liste_operation_par_categorie[$operation["categorie"]["libelle"]],$operation);
			}else{
				$liste_operation_par_categorie[$operation["categorie"]["libelle"]] = array($operation);
			}
		}
		return $liste_operation_par_categorie;
	}

	public static function trier_par_categorie_et_mois($liste_dto_operation){
		$liste_operation_par_categorie = array();
		$liste_operation_par_categorie_et_mois = array();
		for($i = 0;$i < sizeof($liste_dto_operation);$i++){
			$operation = $liste_dto_operation[$i];
			if(isset($liste_operation_par_categorie[$operation["categorie"]["libelle"]])){
				array_push($liste_operation_par_categorie[$operation["categorie"]["libelle"]],$operation);
			}else{
				$liste_operation_par_categorie[$operation["categorie"]["libelle"]] = array($operation);
			}
		}
		foreach ($liste_operation_par_categorie as $categorie => $liste_operation) {
			
		}
		return $liste_operation_par_categorie;
	}

	public static function trier_par_compte($liste_dto_operation){
		$liste_operation_par_compte = array();
		for($i = 0;$i < sizeof($liste_dto_operation);$i++){
			$operation = $liste_dto_operation[$i];
			if(isset($liste_operation_par_compte[$operation["compte"]["libelle"]])){
				array_push($liste_operation_par_compte[$operation["compte"]["libelle"]],$operation);
			}else{
				$liste_operation_par_compte[$operation["compte"]["libelle"]] = array($operation);
			}
		}
		return $liste_operation_par_compte;
	}

	public static function trier_par_mois($liste_dto_operation){
		$liste_operation_par_mois = array();
		for($i = 0;$i < sizeof($liste_dto_operation);$i++){
			$operation = $liste_dto_operation[$i];
			if(isset($liste_operation_par_mois[substr($operation["date"],0,6)])){
				array_push($liste_operation_par_mois[substr($operation["date"],0,6)],$operation);
			}else{
				$liste_operation_par_mois[substr($operation["date"],0,6)] = array($operation);
			}
		}
		return $liste_operation_par_mois;
	}

	public static function trier_par_an($liste_dto_operation){
		$liste_operation_par_an = array();
		for($i = 0;$i < sizeof($liste_dto_operation);$i++){
			$operation = $liste_dto_operation[$i];
			if(isset($liste_operation_par_an[substr($operation["date"],0,4)])){
				array_push($liste_operation_par_an[substr($operation["date"],0,4)],$operation);
			}else{
				$liste_operation_par_an[substr($operation["date"],0,4)] = array($operation);
			}
		}
		return $liste_operation_par_an;
	}

	public static function trier_par_type($liste_dto_operation){
		$liste_operation_par_type = array();
		for($i = 0;$i < sizeof($liste_dto_operation);$i++){
			$operation = $liste_dto_operation[$i];
			if($operation["type"] == operation::$TYPE_DEPENSE){
				if(isset($liste_operation_par_type["Depense"])){
					array_push($liste_operation_par_type["Depense"],$operation);
				}else{
					$liste_operation_par_type["Depense"] = array($operation);	
				}
			}else{
				if(isset($liste_operation_par_type["Revenu"])){
					array_push($liste_operation_par_type["Revenu"],$operation);
				}else{
					$liste_operation_par_type["Revenu"] = array($operation);	
				}
			}
		}
		return $liste_operation_par_type;
	}
}
?>