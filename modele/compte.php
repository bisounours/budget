<?php
/**
	Objet compte contenant les fonctions propres à un ou plusieurs objets comptes.
*/

class compte extends dao_compte{

	//Fonction renvoyant une liste d'objet compte sous forme d'un tableau associatif pour affichage
	public static function dto_liste($database,$liste_compte){
		$liste_dto = array();
		for($i=0;$i < sizeof($liste_compte);$i++){
			$compte = $liste_compte[$i];
			$compte_dto = $liste_compte[$i]->variables;
			if($compte->utilise($database)){
				$compte_dto["utilise"] = 1;
			}else{	
				$compte_dto["utilise"] = 0;
			}
			$compte_dto["solde_actuel"] = number_format(floatval($compte->solde_actuel($database)),2,","," ");
			array_push($liste_dto,$compte_dto);
		}
		return $liste_dto;
	}

	//Fonction qui retourne true si le compte est utilise dans des operations.
	public function utilise($database){
		$qualifier_compte = new qualifier(operation::$KEY_COMPTE_ID,qualifier::$EQUAL,$this->get_id());
		$qualifier_actif = new qualifier(operation::$KEY_ACTIF,qualifier::$EQUAL,1);
		$qualifier_and = new qualifier_link(qualifier_link::$AND,array($qualifier_compte,$qualifier_actif));
		$liste_operation = operation::select($database,$qualifier_and,null,null);

		if(sizeof($liste_operation) > 0 ){
			return true;
		}else{
			return false;
		}
	}

	//Fonction mettant a jour le solde du compte en fonction des operations saisies depuis la derniere date de mise a jour.
	public function solde_actuel($database){
		$qualifier_compte = new qualifier(operation::$KEY_COMPTE_ID,qualifier::$EQUAL,$this->get_id());
		$qualifier_actif = new qualifier(operation::$KEY_ACTIF,qualifier::$EQUAL,1);
		$qualifier_date = new qualifier(operation::$KEY_DATE,qualifier::$GREATER,$this->get_date_solde());
		$qualifier_and = new qualifier_link(qualifier_link::$AND,array($qualifier_compte,$qualifier_actif,$qualifier_date));
		$liste_operation = operation::select($database,$qualifier_and,null,null);

		$solde = $this->get_solde();
		foreach ($liste_operation as $operation) {
			if($operation->get_type() == operation::$TYPE_DEPENSE){
				$solde -= floatval(str_replace(',','.',$operation->get_montant()));
			}else{
				$solde += floatval(str_replace(',','.',$operation->get_montant()));
			}
		}
		return $solde;
	}
}
?>