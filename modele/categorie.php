<?php
/**
	Commentaire de classe....
*/

class categorie extends dao_categorie{

	public static function dto_liste($database,$liste_categorie){
		$liste_dto = array();
		for($i=0;$i < sizeof($liste_categorie);$i++){
			$categorie = $liste_categorie[$i];
			$categorie_dto = $liste_categorie[$i]->variables;
			if($categorie->utilise($database)){
				$categorie_dto["utilise"] = 1;
			}else{	
				$categorie_dto["utilise"] = 0;
			}
			if($categorie->get_budget() != ""){
				$categorie_dto["budget"] = number_format(floatval($categorie->get_budget()),2,",","");
			}
			$categorie_dto["budget_utilise"] = number_format(floatval($categorie->depense_mensuel($database)),2,",","");
			$categorie_dto["budget_restant"] = number_format($categorie->get_budget() - $categorie->depense_mensuel($database),2,",","");
			array_push($liste_dto,$categorie_dto);
		}
		return $liste_dto;
	}

	public function utilise($database){
		$qualifier_categorie = new qualifier(operation::$KEY_CATEGORIE_ID,qualifier::$EQUAL,$this->get_id());
		$qualifier_actif = new qualifier(operation::$KEY_ACTIF,qualifier::$EQUAL,1);
		$qualifier_and = new qualifier_link(qualifier_link::$AND,array($qualifier_categorie,$qualifier_actif));
		$liste_operation = operation::select($database,$qualifier_and,null,null);

		if(sizeof($liste_operation) > 0 ){
			return true;
		}else{
			return false;
		}
	}

	public function depense_mensuel($database){
		$depense = 0;

		$qualifier_categorie = new qualifier(operation::$KEY_CATEGORIE_ID,qualifier::$EQUAL,$this->get_id());
		$qualifier_actif = new qualifier(operation::$KEY_ACTIF,qualifier::$EQUAL,1);
		$qualifier_date = new qualifier(operation::$KEY_DATE,qualifier::$GREATER_OR_EQUAL,categorie::date_debut_mois($this->get_debut_mois())->format('Ymd'));

		$qualifier_and = new qualifier_link(qualifier_link::$AND,array($qualifier_categorie,$qualifier_actif,$qualifier_date));
		$liste_operation = operation::select($database,$qualifier_and,null,null);
		foreach ($liste_operation as $operation) {
			$depense += floatval(str_replace(',','.',$operation->get_montant()));
		}
		return $depense;
	}

	public static function date_debut_mois($debut_mois){
		$date_courante = new DateTime();
		$date_renvoi = new DateTime();
		if($debut_mois < intval($date_courante->format("d"))){
			$date_renvoi->setDate(intval($date_courante->format('Y')),intval($date_courante->format('m')),intval($debut_mois));
		}else{
			$date_renvoi->setDate(intval($date_courante->format('Y')),intval($date_courante->format('m'))-1,intval($debut_mois));
		}
		return $date_renvoi;
	}
}
?>