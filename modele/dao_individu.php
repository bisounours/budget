<?php
/**
	NE PAS MODIFIER.
	Classe générée automatiquement le 25/07/2014 15:31
	Les modifications doivent être apportés dans la classe Individu.
*/

class dao_individu extends dao{
	
	//Variables
	//====================================================
	public $variables = array(
		"id"=>"",
		"nom"=>"",
		"prenom"=>"",
		"date_naissance"=>"",
		"date_deces"=>"",
		"id_pere"=>"",
		"id_mere"=>"");

	//Constantes
	//====================================================
	public static $TABLE = "individu";
	public static $KEY_ID = "id";
	public static $KEY_NOM = "nom";
	public static $KEY_PRENOM = "prenom";
	public static $KEY_DATE_NAISSANCE = "date_naissance";
	public static $KEY_DATE_DECES = "date_deces";
	public static $KEY_ID_PERE = "id_pere";
	public static $KEY_ID_MERE = "id_mere";
	public static $SQL_CREATE_TABLE = "CREATE TABLE individu(
		id INTEGER NOT NULL PRIMARY KEY ASC ,
		nom TEXT NOT NULL ,
		prenom TEXT ,
		date_naissance INTEGER ,
		date_deces INTEGER ,
		id_pere INTEGER ,
		id_mere INTEGER )";
	
	//Constructeur
	//====================================================
	public function __construct($id = "",$nom = "",$prenom = "",$date_naissance = "",$date_deces = "",$id_pere = "",$id_mere = ""){
		$this->variables[dao_Individu::$KEY_ID] = $id;
		$this->variables[dao_Individu::$KEY_NOM] = $nom;
		$this->variables[dao_Individu::$KEY_PRENOM] = $prenom;
		$this->variables[dao_Individu::$KEY_DATE_NAISSANCE] = $date_naissance;
		$this->variables[dao_Individu::$KEY_DATE_DECES] = $date_deces;
		$this->variables[dao_Individu::$KEY_ID_PERE] = $id_pere;
		$this->variables[dao_Individu::$KEY_ID_MERE] = $id_mere;
	}
	
	//Methodes
	//====================================================
	public static function select($database,$qualifier,$table=null){
		$liste_object = array();
		$result = parent::select($database,$qualifier,Individu::$TABLE);
		foreach ($result as $row) {
			$new_object = new Individu($row[dao_Individu::$KEY_ID],$row[dao_Individu::$KEY_NOM],$row[dao_Individu::$KEY_PRENOM],$row[dao_Individu::$KEY_DATE_NAISSANCE],$row[dao_Individu::$KEY_DATE_DECES],$row[dao_Individu::$KEY_ID_PERE],$row[dao_Individu::$KEY_ID_MERE]);
			array_push($liste_object,$new_object);
		}
		return $liste_object;
	}

	public function insert($database,$table=null){
		return parent::insert($database,Individu::$TABLE);
	}

	public function update($database,$table=null){
		return parent::update($database,Individu::$TABLE);
	}

	public function delete($database,$table=null){
		return parent::delete($database,Individu::$TABLE);
	}

	public static function create($database){
		parent::execute($database,Individu::$SQL_CREATE_TABLE);
	}

	//Getters & Setters
	//====================================================
	public function get_id(){
		return $this->variables[dao_Individu::$KEY_ID];
	}

	public function set_id($new_value){
		$this->variables[dao_Individu::$KEY_ID] = $new_value;
	}

	public function get_nom(){
		return $this->variables[dao_Individu::$KEY_NOM];
	}

	public function set_nom($new_value){
		$this->variables[dao_Individu::$KEY_NOM] = $new_value;
	}

	public function get_prenom(){
		return $this->variables[dao_Individu::$KEY_PRENOM];
	}

	public function set_prenom($new_value){
		$this->variables[dao_Individu::$KEY_PRENOM] = $new_value;
	}

	public function get_date_naissance(){
		return $this->variables[dao_Individu::$KEY_DATE_NAISSANCE];
	}

	public function set_date_naissance($new_value){
		$this->variables[dao_Individu::$KEY_DATE_NAISSANCE] = $new_value;
	}

	public function get_date_deces(){
		return $this->variables[dao_Individu::$KEY_DATE_DECES];
	}

	public function set_date_deces($new_value){
		$this->variables[dao_Individu::$KEY_DATE_DECES] = $new_value;
	}

	public function get_id_pere(){
		return $this->variables[dao_Individu::$KEY_ID_PERE];
	}

	public function set_id_pere($new_value){
		$this->variables[dao_Individu::$KEY_ID_PERE] = $new_value;
	}

	public function get_id_mere(){
		return $this->variables[dao_Individu::$KEY_ID_MERE];
	}

	public function set_id_mere($new_value){
		$this->variables[dao_Individu::$KEY_ID_MERE] = $new_value;
	}

	
}
?>
