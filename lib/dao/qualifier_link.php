<?php

/**
	Classe représentant une liste de clause "where" rattaché par le même lien (AND,OR,...)
*/

class qualifier_link {
	
	public static $AND = "AND";
	public static $OR = "OR";

	public $qualifier_array;
	public $link;

	public function __construct($link,$qualifier_array){
		$this->link = $link;
		$this->qualifier_array = $qualifier_array;
	}

	public function to_string(){
		$string = "(";
		for($it_qualifier_array=0;$it_qualifier_array < sizeof($this->qualifier_array);$it_qualifier_array++) {
			$string .= $this->qualifier_array[$it_qualifier_array]->to_string();
			if($it_qualifier_array+1 < sizeof($this->qualifier_array)){
				$string .= " ".$this->link." ";
			}
		}
		$string .= ")";
		return $string;
	}
}

?>