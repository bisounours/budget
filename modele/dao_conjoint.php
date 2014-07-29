<?php
/**
	NE PAS MODIFIER.
	Classe générée automatiquement le 26/07/2014 09:45
	Les modifications doivent être apportés dans la classe Conjoint.
*/

class dao_conjoint extends dao{
	
	//Variables
	//====================================================
	public $variables = array(
		"id"=>"",
		"id_individu1"=>"",
		"id_individu2"=>"");

	//Constantes
	//====================================================
	public static $TABLE = "Conjoint";
	public static $KEY_ID = "id";
	public static $KEY_ID_INDIVIDU1 = "id_individu1";
	public static $KEY_ID_INDIVIDU2 = "id_individu2";
	public static $SQL_CREATE_TABLE = "CREATE TABLE Conjoint(
		id INTEGER NOT NULL PRIMARY KEY ASC ,
		id_individu1 INTEGER NOT NULL ,
		id_individu2 INTEGER NOT NULL )";
	
	//Constructeur
	//====================================================
	public function __construct($id = "",$id_individu1 = "",$id_individu2 = ""){
		$this->variables[dao_Conjoint::$KEY_ID] = $id;
		$this->variables[dao_Conjoint::$KEY_ID_INDIVIDU1] = $id_individu1;
		$this->variables[dao_Conjoint::$KEY_ID_INDIVIDU2] = $id_individu2;
	}
	
	//Methodes
	//====================================================
	public static function select($database,$qualifier,$table=null){
		$liste_object = array();
		$result = parent::select($database,$qualifier,Conjoint::$TABLE);
		foreach ($result as $row) {
			$new_object = new Conjoint($row[dao_Conjoint::$KEY_ID],$row[dao_Conjoint::$KEY_ID_INDIVIDU1],$row[dao_Conjoint::$KEY_ID_INDIVIDU2]);
			array_push($liste_object,$new_object);
		}
		return $liste_object;
	}

	public function insert($database,$table=null){
		return parent::insert($database,Conjoint::$TABLE);
	}

	public function update($database,$table=null){
		return parent::update($database,Conjoint::$TABLE);
	}

	public function delete($database,$table=null){
		return parent::delete($database,Conjoint::$TABLE);
	}

	public static function create($database){
		parent::execute($database,Conjoint::$SQL_CREATE_TABLE);
	}

	//Getters & Setters
	//====================================================
	public function get_id(){
		return $this->variables[dao_Conjoint::$KEY_ID];
	}

	public function set_id($new_value){
		$this->variables[dao_Conjoint::$KEY_ID] = $new_value;
	}

	public function get_id_individu1(){
		return $this->variables[dao_Conjoint::$KEY_ID_INDIVIDU1];
	}

	public function set_id_individu1($new_value){
		$this->variables[dao_Conjoint::$KEY_ID_INDIVIDU1] = $new_value;
	}

	public function get_id_individu2(){
		return $this->variables[dao_Conjoint::$KEY_ID_INDIVIDU2];
	}

	public function set_id_individu2($new_value){
		$this->variables[dao_Conjoint::$KEY_ID_INDIVIDU2] = $new_value;
	}

	
}
?>
