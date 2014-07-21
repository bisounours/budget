<?php
/**
	NE PAS MODIFIER.
	Classe générée automatiquement le 08/08/2013 09:07
	Les modifications doivent être apportés dans la classe user.
*/

class dao_user extends dao{
	
	//Variables
	//====================================================
	public $variables = array(
		"id"=>"",
		"login"=>"",
		"password"=>"",
		"hash"=>"",
		"mail"=>"");

	//Constantes
	//====================================================
	public static $TABLE = "user";
	public static $KEY_ID = "id";
	public static $KEY_LOGIN = "login";
	public static $KEY_PASSWORD = "password";
	public static $KEY_HASH = "hash";
	public static $KEY_MAIL = "mail";
	public static $SQL_CREATE_TABLE = "CREATE TABLE user(
		id INTEGER NOT NULL PRIMARY KEY ASC ,
		login TEXT NOT NULL ,
		password TEXT NOT NULL ,
		hash TEXT NOT NULL ,
		mail TEXT NOT NULL )";
	
	//Constructeur
	//====================================================
	public function __construct($id = "",$login = "",$password = "",$hash = "",$mail = ""){
		$this->variables[dao_user::$KEY_ID] = $id;
		$this->variables[dao_user::$KEY_LOGIN] = $login;
		$this->variables[dao_user::$KEY_PASSWORD] = $password;
		$this->variables[dao_user::$KEY_HASH] = $hash;
		$this->variables[dao_user::$KEY_MAIL] = $mail;
	}
	
	//Methodes
	//====================================================
	public static function select($database,$qualifier,$table=null,$sort=null,$limit = null){
		$liste_object = array();
		$result = parent::select($database,$qualifier,user::$TABLE,$sort,$limit);
		foreach ($result as $row) {
			$new_object = new user($row[dao_user::$KEY_ID],$row[dao_user::$KEY_LOGIN],$row[dao_user::$KEY_PASSWORD],$row[dao_user::$KEY_HASH],$row[dao_user::$KEY_MAIL]);
			array_push($liste_object,$new_object);
		}
		return $liste_object;
	}

	public function insert($database,$table=null){
		return parent::insert($database,user::$TABLE);
	}

	public function update($database,$table=null){
		return parent::update($database,user::$TABLE);
	}

	public function delete($database,$table=null){
		return parent::delete($database,user::$TABLE);
	}

	public static function create($database){
		parent::execute($database,user::$SQL_CREATE_TABLE);
	}

	//Getters & Setters
	//====================================================
	public function get_id(){
		return $this->variables[dao_user::$KEY_ID];
	}

	public function set_id($new_value){
		$this->variables[dao_user::$KEY_ID] = $new_value;
	}

	public function get_login(){
		return $this->variables[dao_user::$KEY_LOGIN];
	}

	public function set_login($new_value){
		$this->variables[dao_user::$KEY_LOGIN] = $new_value;
	}

	public function get_password(){
		return $this->variables[dao_user::$KEY_PASSWORD];
	}

	public function set_password($new_value){
		$this->variables[dao_user::$KEY_PASSWORD] = $new_value;
	}

	public function get_hash(){
		return $this->variables[dao_user::$KEY_HASH];
	}

	public function set_hash($new_value){
		$this->variables[dao_user::$KEY_HASH] = $new_value;
	}

	public function get_mail(){
		return $this->variables[dao_user::$KEY_MAIL];
	}

	public function set_mail($new_value){
		$this->variables[dao_user::$KEY_MAIL] = $new_value;
	}

	
}
?>