<?php

/**
	Classe qui permet les transformations nécessaires pour l'affichage à partir d'objet de type dao
*/

class dto{
	
	//Fonction qui renvoi la liste simple (tableau associatif) d'une liste d'objet dao
	public static function dto_liste($array){
		$dto_array = array();
		for($i=0;$i < sizeof($array);$i++){
			array_push($dto_array,$array[$i]->variables);
		}
		return $dto_array;
	}
}

?>