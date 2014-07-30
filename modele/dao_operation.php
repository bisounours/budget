<?php
/**
	NE PAS MODIFIER.
	Classe générée automatiquement le 20/10/2013 16:13
	Les modifications doivent être apportés dans la classe operation.
*/

class dao_operation extends dao{
	
	//Variables
	//====================================================
	public $variables = array(
		"id"=>"",
		"date"=>"",
		"montant"=>"",
		"type"=>"",
		"categorie_id"=>"",
		"user_id"=>"",
		"compte_id"=>"",
		"libelle"=>"",
		"occurence_id"=>"",
		"actif"=>"");

	//Constantes
	//====================================================
	public static $TABLE = "operation";
	public static $KEY_ID = "id";
	public static $KEY_DATE = "date";
	public static $KEY_MONTANT = "montant";
	public static $KEY_TYPE = "type";
	public static $KEY_CATEGORIE_ID = "categorie_id";
	public static $KEY_USER_ID = "user_id";
	public static $KEY_COMPTE_ID = "compte_id";
	public static $KEY_LIBELLE = "libelle";
	public static $KEY_OCCURENCE_ID = "occurence_id";
	public static $KEY_ACTIF = "actif";
	public static $SQL_CREATE_TABLE = "CREATE TABLE operation(
		id INTEGER NOT NULL PRIMARY KEY ASC ,
		date INTEGER NOT NULL ,
		montant REAL NOT NULL ,
		type TEXT NOT NULL ,
		categorie_id INTEGER NOT NULL,
		FOREIGN KEY(categorie_id) REFERENCES categorie(id) ,
		user_id INTEGER NOT NULL,
		FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE,
		compte_id INTEGER NOT NULL,
		FOREIGN KEY(compte_id) REFERENCES compte(id) ,
		libelle TEXT NOT NULL ,
		occurence_id INTEGER NOT NULL,
		actif INTEGER NOT NULL,
		FOREIGN KEY(occurence_id) REFERENCES occurence(id) )";
	
	//Constructeur
	//====================================================
	public function __construct($id = "",$date = "",$montant = "",$type = "",$categorie_id = "",$user_id = "",$compte_id = "",$libelle = "",$occurence_id = "",$actif = ""){
		$this->variables[dao_operation::$KEY_ID] = $id;
		$this->variables[dao_operation::$KEY_DATE] = $date;
		$this->variables[dao_operation::$KEY_MONTANT] = $montant;
		$this->variables[dao_operation::$KEY_TYPE] = $type;
		$this->variables[dao_operation::$KEY_CATEGORIE_ID] = $categorie_id;
		$this->variables[dao_operation::$KEY_USER_ID] = $user_id;
		$this->variables[dao_operation::$KEY_COMPTE_ID] = $compte_id;
		$this->variables[dao_operation::$KEY_LIBELLE] = $libelle;
		$this->variables[dao_operation::$KEY_OCCURENCE_ID] = $occurence_id;
		$this->variables[dao_operation::$KEY_ACTIF] = $actif;
	}
	
	//Methodes
	//====================================================
	public static function select($database,$qualifier,$table=null,$sort=null,$limit = null){
		$liste_object = array();
		$result = parent::select($database,$qualifier,operation::$TABLE,$sort,$limit);
		foreach ($result as $row) {
			$new_object = new operation($row[dao_operation::$KEY_ID],$row[dao_operation::$KEY_DATE],$row[dao_operation::$KEY_MONTANT],$row[dao_operation::$KEY_TYPE],$row[dao_operation::$KEY_CATEGORIE_ID],$row[dao_operation::$KEY_USER_ID],$row[dao_operation::$KEY_COMPTE_ID],$row[dao_operation::$KEY_LIBELLE],$row[dao_operation::$KEY_OCCURENCE_ID],$row[dao_operation::$KEY_ACTIF]);
			array_push($liste_object,$new_object);
		}
		return $liste_object;
	}

	public function insert($database,$table=null){
		return parent::insert($database,operation::$TABLE);
	}

	public function update($database,$table=null){
		return parent::update($database,operation::$TABLE);
	}

	public function delete($database,$table=null){
		return parent::delete($database,operation::$TABLE);
	}

	public static function create($database){
		parent::execute($database,operation::$SQL_CREATE_TABLE);
	}

	//Getters & Setters
	//====================================================
	public function get_id(){
		return $this->variables[dao_operation::$KEY_ID];
	}

	public function set_id($new_value){
		$this->variables[dao_operation::$KEY_ID] = $new_value;
	}

	public function get_date(){
		return $this->variables[dao_operation::$KEY_DATE];
	}

	public function set_date($new_value){
		$this->variables[dao_operation::$KEY_DATE] = $new_value;
	}

	public function get_montant(){
		return $this->variables[dao_operation::$KEY_MONTANT];
	}

	public function set_montant($new_value){
		$this->variables[dao_operation::$KEY_MONTANT] = $new_value;
	}

	public function get_type(){
		return $this->variables[dao_operation::$KEY_TYPE];
	}

	public function set_type($new_value){
		$this->variables[dao_operation::$KEY_TYPE] = $new_value;
	}

	public function get_categorie_id(){
		return $this->variables[dao_operation::$KEY_CATEGORIE_ID];
	}

	public function set_categorie_id($new_value){
		$this->variables[dao_operation::$KEY_CATEGORIE_ID] = $new_value;
	}

	public function get_user_id(){
		return $this->variables[dao_operation::$KEY_USER_ID];
	}

	public function set_user_id($new_value){
		$this->variables[dao_operation::$KEY_USER_ID] = $new_value;
	}

	public function get_compte_id(){
		return $this->variables[dao_operation::$KEY_COMPTE_ID];
	}

	public function set_compte_id($new_value){
		$this->variables[dao_operation::$KEY_COMPTE_ID] = $new_value;
	}

	public function get_libelle(){
		return $this->variables[dao_operation::$KEY_LIBELLE];
	}

	public function set_libelle($new_value){
		$this->variables[dao_operation::$KEY_LIBELLE] = $new_value;
	}

	public function get_occurence_id(){
		return $this->variables[dao_operation::$KEY_OCCURENCE_ID];
	}

	public function set_occurence_id($new_value){
		$this->variables[dao_operation::$KEY_OCCURENCE_ID] = $new_value;
	}

	public function get_actif(){
		return $this->variables[dao_operation::$KEY_ACTIF];	
	}

	public function set_actif($new_value){
		$this->variables[dao_operation::$KEY_ACTIF] = $new_value;
	}	
	
}
?>