<?php
/**
	Commentaire de classe....
*/

class occurence extends dao_occurence{

	//Fonction qui creer les opérations manquante par rapport a l'occurence
	//NOTE : cette fonction requiert le fonction liste_date de outils.php
	public function operation_generate($database,$date_debut_calcul = null,$date_debut_incluse = true){
		$qualifier_occurence = new qualifier(operation::$KEY_OCCURENCE_ID,qualifier::$EQUAL,$this->get_id());
		$liste_operation = operation::select($database,$qualifier_occurence);

		$date_debut = $date_debut_calcul != null ? $date_debut_calcul : DateTime::createFromFormat('Ymd',$this->get_dateDebut());
		$date_fin = ($this->get_dateFin() != null && $this->get_dateFin() != "") ? DateTime::createFromFormat('Ymd',$this->get_dateFin()) : new DateTime();

		if(!$date_debut_incluse){
			$date_debut = $date_debut->add(new DateInterval($this->get_frequence()));
		}

		$liste_date = array();
		while($date_debut <= $date_fin){
			array_push($liste_date,clone $date_debut);
			$date_debut = $date_debut->add(new DateInterval($this->get_frequence()));
		}

		for($i=0;$i<sizeof($liste_date);$i++) {
			$date_courante = $liste_date[$i];
			$existe = false;
			for($j=0;$j<sizeof($liste_operation);$j++) {
				$date_operation = DateTime::createFromFormat('Ymd',$liste_operation[$j]->get_date());
				if($date_operation == $date_courante){
					$existe = true;
				}
			}
			if(!$existe){
				$operation = new operation(null,$date_courante->format('Ymd'),$this->get_montant(),$this->get_type(),$this->get_categorie_id(),$this->get_user_id(),$this->get_compte_id(),$this->get_libelle(),$this->get_id(),1);
				$operation->insert($database);
			}
		}
	}
}
?>