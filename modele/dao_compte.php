<?php
/**
	NE PAS MODIFIER.
	Classe générée automatiquement le 07/08/2013 11:09
	Les modifications doivent être apportés dans la classe compte.
*/

class dao_compte extends dao{
	
	//Variables
	//====================================================
	public $variables = array(
		"id"=>"",
		"libelle"=>"",
		"user_id"=>"",
		"date_solde"=>"",
		"solde"=>"");

	//Constantes
	//====================================================
	public static $TABLE = "compte";
	public static $KEY_ID = "id";
	public static $KEY_LIBELLE = "libelle";
	public static $KEY_USER_ID = "user_id";
	public static $KEY_SOLDE = "solde";
	public static $KEY_DATE_SOLDE = "date_solde";
	public static $SQL_CREATE_TABLE = "CREATE TABLE compte(
		id INTEGER NOT NULL PRIMARY KEY ASC ,
		libelle TEXT NOT NULL ,
		user_id INTEGER NOT NULL,
		solde REAL,
		date_solde INTEGER,
		FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE)";
	
	//Constructeur
	//====================================================
	public function __construct($id = "",$libelle = "",$user_id = "", $solde = "", $date_solde = ""){
		$this->variables[dao_compte::$KEY_ID] = $id;
		$this->variables[dao_compte::$KEY_LIBELLE] = $libelle;
		$this->variables[dao_compte::$KEY_USER_ID] = $user_id;
		$this->variables[dao_compte::$KEY_SOLDE] = $solde;
		$this->variables[dao_compte::$KEY_DATE_SOLDE] = $date_solde;
	}
	
	//Methodes
	//====================================================
	public static function select($database,$qualifier,$table=null,$sort=null,$limit = null){
		$liste_object = array();
		$result = parent::select($database,$qualifier,compte::$TABLE,$sort,$limit);
		foreach ($result as $row) {
			$new_object = new compte($row[dao_compte::$KEY_ID],$row[dao_compte::$KEY_LIBELLE],$row[dao_compte::$KEY_USER_ID],$row[dao_compte::$KEY_SOLDE],$row[dao_compte::$KEY_DATE_SOLDE]);
			array_push($liste_object,$new_object);
		}
		return $liste_object;
	}

	public function insert($database,$table=null){
		return parent::insert($database,compte::$TABLE);
	}

	public function update($database,$table=null){
		return parent::update($database,compte::$TABLE);
	}

	public function delete($database,$table=null){
		return parent::delete($database,compte::$TABLE);
	}

	public static function create($database){
		parent::execute($database,compte::$SQL_CREATE_TABLE);
	}

	//Getters & Setters
	//====================================================
	public function get_id(){
		return $this->variables[dao_compte::$KEY_ID];
	}

	public function set_id($new_value){
		$this->variables[dao_compte::$KEY_ID] = $new_value;
	}

	public function get_libelle(){
		return $this->variables[dao_compte::$KEY_LIBELLE];
	}

	public function set_libelle($new_value){
		$this->variables[dao_compte::$KEY_LIBELLE] = $new_value;
	}

	public function get_user_id(){
		return $this->variables[dao_compte::$KEY_USER_ID];
	}

	public function set_user_id($new_value){
		$this->variables[dao_compte::$KEY_USER_ID] = $new_value;
	}

	public function get_solde(){
		return $this->variables[dao_compte::$KEY_SOLDE];
	}

	public function set_solde($new_value){
		$this->variables[dao_compte::$KEY_SOLDE] = $new_value;
	}

	public function get_date_solde(){
		return $this->variables[dao_compte::$KEY_DATE_SOLDE];
	}

	public function set_date_solde($new_value){
		$this->variables[dao_compte::$KEY_DATE_SOLDE] = $new_value;
	}
}
?>