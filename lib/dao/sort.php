<?php

/**
	Classe représentant une clause "order by"
*/

class sort{
	
	public static $ASC = "ASC";
	public static $DESC = "DESC";

	public $attribut;
	public $order;

	public function __construct($attribut,$order){
		$this->attribut = $attribut;
		$this->order = $order;
	}

	function to_string(){
		return $this->attribut." ".$this->order;
	}
}

?>