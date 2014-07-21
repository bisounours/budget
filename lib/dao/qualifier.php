<?php

/**
	Classe représentant une clause "where"
*/

class qualifier{
	
	public static $EQUAL = "=";
	public static $NOT_EQUAL = "<>";
	public static $GREATER = ">";
	public static $LOWER = "<";
	public static $LIKE = "LIKE";
	public static $NOT_LIKE = "NOT LIKE";
	public static $GREATER_OR_EQUAL = ">=";
	public static $LOWER_OR_EQUAL = "<=";
	public static $IN = "IN";

	public $attribut;
	public $comparateur;
	public $valeur;

	public function __construct($attribut,$comparateur,$valeur){
		$this->attribut = $attribut;
		$this->comparateur = $comparateur;
		$this->valeur = $valeur;
	}

	function to_string(){
		if($this->comparateur == qualifier::$IN){
			return $this->attribut." ".$this->comparateur." ".$this->valeur."";
		}else{
			return $this->attribut." ".$this->comparateur." '".$this->valeur."'";
		}
	}
}

?>