<?php
/**
	NE PAS MODIFIER.
	Classe générée automatiquement le 07/08/2013 11:09
	Les modifications doivent être apportés dans la classe categorie.
*/

class dao_categorie extends dao{
	
	//Variables
	//====================================================
	public $variables = array(
		"id"=>"",
		"libelle"=>"",
		"user_id"=>"",
		"budget"=>"",
		"debut_mois"=>"");

	//Constantes
	//====================================================
	public static $TABLE = "categorie";
	public static $KEY_ID = "id";
	public static $KEY_LIBELLE = "libelle";
	public static $KEY_USER_ID = "user_id";
	public static $KEY_BUDGET = "budget";
	public static $KEY_DEBUT_MOIS = "debut_mois";
	public static $SQL_CREATE_TABLE = "CREATE TABLE categorie(
		id INTEGER NOT NULL PRIMARY KEY ASC ,
		libelle TEXT NOT NULL ,
		user_id INTEGER NOT NULL,
		budget REAL,
		debut_mois INTEGER
		FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE)";
	
	//Constructeur
	//====================================================
	public function __construct($id = "",$libelle = "",$user_id = "", $budget = "", $debut_mois = ""){
		$this->variables[dao_categorie::$KEY_ID] = $id;
		$this->variables[dao_categorie::$KEY_LIBELLE] = $libelle;
		$this->variables[dao_categorie::$KEY_USER_ID] = $user_id;
		$this->variables[dao_categorie::$KEY_BUDGET] = $budget;
		$this->variables[dao_categorie::$KEY_DEBUT_MOIS] = $debut_mois;
	}
	
	//Methodes
	//====================================================
	public static function select($database,$qualifier,$table=null,$sort=null,$limit = null){
		$liste_object = array();
		$result = parent::select($database,$qualifier,categorie::$TABLE,$sort,$limit);
		foreach ($result as $row) {
			$new_object = new categorie($row[dao_categorie::$KEY_ID],$row[dao_categorie::$KEY_LIBELLE],$row[dao_categorie::$KEY_USER_ID],$row[dao_categorie::$KEY_BUDGET],$row[dao_categorie::$KEY_DEBUT_MOIS]);
			array_push($liste_object,$new_object);
		}
		return $liste_object;
	}

	public function insert($database,$table=null){
		return parent::insert($database,categorie::$TABLE);
	}

	public function update($database,$table=null){
		return parent::update($database,categorie::$TABLE);
	}

	public function delete($database,$table=null){
		return parent::delete($database,categorie::$TABLE);
	}

	public static function create($database){
		parent::execute($database,categorie::$SQL_CREATE_TABLE);
	}

	//Getters & Setters
	//====================================================
	public function get_id(){
		return $this->variables[dao_categorie::$KEY_ID];
	}

	public function set_id($new_value){
		$this->variables[dao_categorie::$KEY_ID] = $new_value;
	}

	public function get_libelle(){
		return $this->variables[dao_categorie::$KEY_LIBELLE];
	}

	public function set_libelle($new_value){
		$this->variables[dao_categorie::$KEY_LIBELLE] = $new_value;
	}

	public function get_user_id(){
		return $this->variables[dao_categorie::$KEY_USER_ID];
	}

	public function set_user_id($new_value){
		$this->variables[dao_categorie::$KEY_USER_ID] = $new_value;
	}

	public function get_budget(){
		return $this->variables[dao_categorie::$KEY_BUDGET];
	}

	public function set_budget($new_value){
		$this->variables[dao_categorie::$KEY_BUDGET] = $new_value;
	}

	public function get_debut_mois(){
		return $this->variables[dao_categorie::$KEY_DEBUT_MOIS];
	}

	public function set_debut_mois($new_value){
		$this->variables[dao_categorie::$KEY_DEBUT_MOIS] = $new_value;
	}
}
?>	