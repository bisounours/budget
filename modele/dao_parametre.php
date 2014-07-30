<?php
/**
	NE PAS MODIFIER.
	Classe générée automatiquement le 08/08/2013 14:44
	Les modifications doivent être apportés dans la classe parametre.
*/

class dao_parametre extends dao{
	
	//Variables
	//====================================================
	public $variables = array(
		"id"=>"",
		"libelle"=>"",
		"valeur"=>"",
		"user_id"=>"");

	//Constantes
	//====================================================
	public static $TABLE = "parametre";
	public static $KEY_ID = "id";
	public static $KEY_LIBELLE = "libelle";
	public static $KEY_VALEUR = "valeur";
	public static $KEY_USER_ID = "user_id";
	public static $SQL_CREATE_TABLE = "CREATE TABLE parametre(
		id INTEGER NOT NULL PRIMARY KEY ASC ,
		libelle TEXT NOT NULL ,
		valeur TEXT NOT NULL ,
		user_id INTEGER NOT NULL,
		FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE)";
	
	//Constructeur
	//====================================================
	public function __construct($id = "",$libelle = "",$valeur = "",$user_id = ""){
		$this->variables[dao_parametre::$KEY_ID] = $id;
		$this->variables[dao_parametre::$KEY_LIBELLE] = $libelle;
		$this->variables[dao_parametre::$KEY_VALEUR] = $valeur;
		$this->variables[dao_parametre::$KEY_USER_ID] = $user_id;
	}
	
	//Methodes
	//====================================================
	public static function select($database,$qualifier,$table=null,$sort=null,$limit = null){
		$liste_object = array();
		$result = parent::select($database,$qualifier,parametre::$TABLE,$sort,$limit);
		foreach ($result as $row) {
			$new_object = new parametre($row[dao_parametre::$KEY_ID],$row[dao_parametre::$KEY_LIBELLE],$row[dao_parametre::$KEY_VALEUR],$row[dao_parametre::$KEY_USER_ID]);
			array_push($liste_object,$new_object);
		}
		return $liste_object;
	}

	public function insert($database,$table=null){
		return parent::insert($database,parametre::$TABLE);
	}

	public function update($database,$table=null){
		return parent::update($database,parametre::$TABLE);
	}

	public function delete($database,$table=null){
		return parent::delete($database,parametre::$TABLE);
	}

	public static function create($database){
		parent::execute($database,parametre::$SQL_CREATE_TABLE);
	}

	//Getters & Setters
	//====================================================
	public function get_id(){
		return $this->variables[dao_parametre::$KEY_ID];
	}

	public function set_id($new_value){
		$this->variables[dao_parametre::$KEY_ID] = $new_value;
	}

	public function get_libelle(){
		return $this->variables[dao_parametre::$KEY_LIBELLE];
	}

	public function set_libelle($new_value){
		$this->variables[dao_parametre::$KEY_LIBELLE] = $new_value;
	}

	public function get_valeur(){
		return $this->variables[dao_parametre::$KEY_VALEUR];
	}

	public function set_valeur($new_value){
		$this->variables[dao_parametre::$KEY_VALEUR] = $new_value;
	}

	public function get_user_id(){
		return $this->variables[dao_parametre::$KEY_USER_ID];
	}

	public function set_user_id($new_value){
		$this->variables[dao_parametre::$KEY_USER_ID] = $new_value;
	}

	
}
?>