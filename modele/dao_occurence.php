<?php
/**
	NE PAS MODIFIER.
	Classe générée automatiquement le 07/08/2013 11:13
	Les modifications doivent être apportés dans la classe occurence.
*/

class dao_occurence extends dao{
	
	//Variables
	//====================================================
	public $variables = array(
		"id"=>"",
		"dateDebut"=>"",
		"dateFin"=>"",
		"montant"=>"",
		"type"=>"",
		"categorie_id"=>"",
		"user_id"=>"",
		"compte_id"=>"",
		"libelle"=>"",
		"frequence"=>"");

	//Constantes
	//====================================================
	public static $TABLE = "occurence";
	public static $KEY_ID = "id";
	public static $KEY_DATEDEBUT = "dateDebut";
	public static $KEY_DATEFIN = "dateFin";
	public static $KEY_MONTANT = "montant";
	public static $KEY_TYPE = "type";
	public static $KEY_CATEGORIE_ID = "categorie_id";
	public static $KEY_USER_ID = "user_id";
	public static $KEY_COMPTE_ID = "compte_id";
	public static $KEY_LIBELLE = "libelle";
	public static $KEY_FREQUENCE = "frequence";
	public static $SQL_CREATE_TABLE = "CREATE TABLE occurence(
		id INTEGER NOT NULL PRIMARY KEY ASC ,
		dateDebut INTEGER NOT NULL ,
		dateFin INTEGER ,
		montant REAL NOT NULL ,
		type TEXT NOT NULL ,
		categorie_id INTEGER NOT NULL,
		FOREIGN KEY(categorie_id) REFERENCES categorie(id) ,
		user_id INTEGER NOT NULL,
		FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE,
		compte_id INTEGER NOT NULL,
		FOREIGN KEY(compte_id) REFERENCES compte(id) ,
		libelle TEXT NOT NULL ,
		frequence TEXT NOT NULL )";
	
	//Constructeur
	//====================================================
	public function __construct($id = "",$dateDebut = "",$dateFin = "",$montant = "",$type = "",$categorie_id = "",$user_id = "",$compte_id = "",$libelle = "",$frequence = ""){
		$this->variables[dao_occurence::$KEY_ID] = $id;
		$this->variables[dao_occurence::$KEY_DATEDEBUT] = $dateDebut;
		$this->variables[dao_occurence::$KEY_DATEFIN] = $dateFin;
		$this->variables[dao_occurence::$KEY_MONTANT] = $montant;
		$this->variables[dao_occurence::$KEY_TYPE] = $type;
		$this->variables[dao_occurence::$KEY_CATEGORIE_ID] = $categorie_id;
		$this->variables[dao_occurence::$KEY_USER_ID] = $user_id;
		$this->variables[dao_occurence::$KEY_COMPTE_ID] = $compte_id;
		$this->variables[dao_occurence::$KEY_LIBELLE] = $libelle;
		$this->variables[dao_occurence::$KEY_FREQUENCE] = $frequence;
	}
	
	//Methodes
	//====================================================
	public static function select($database,$qualifier,$table=null,$sort=null,$limit = null){
		$liste_object = array();
		$result = parent::select($database,$qualifier,occurence::$TABLE,$sort,$limit);
		foreach ($result as $row) {
			$new_object = new occurence($row[dao_occurence::$KEY_ID],$row[dao_occurence::$KEY_DATEDEBUT],$row[dao_occurence::$KEY_DATEFIN],$row[dao_occurence::$KEY_MONTANT],$row[dao_occurence::$KEY_TYPE],$row[dao_occurence::$KEY_CATEGORIE_ID],$row[dao_occurence::$KEY_USER_ID],$row[dao_occurence::$KEY_COMPTE_ID],$row[dao_occurence::$KEY_LIBELLE],$row[dao_occurence::$KEY_FREQUENCE]);
			array_push($liste_object,$new_object);
		}
		return $liste_object;
	}

	public function insert($database,$table=null){
		return parent::insert($database,occurence::$TABLE);
	}

	public function update($database,$table=null){
		return parent::update($database,occurence::$TABLE);
	}

	public function delete($database,$table=null){
		return parent::delete($database,occurence::$TABLE);
	}

	public static function create($database){
		parent::execute($database,occurence::$SQL_CREATE_TABLE);
	}

	//Getters & Setters
	//====================================================
	public function get_id(){
		return $this->variables[dao_occurence::$KEY_ID];
	}

	public function set_id($new_value){
		$this->variables[dao_occurence::$KEY_ID] = $new_value;
	}

	public function get_dateDebut(){
		return $this->variables[dao_occurence::$KEY_DATEDEBUT];
	}

	public function set_dateDebut($new_value){
		$this->variables[dao_occurence::$KEY_DATEDEBUT] = $new_value;
	}

	public function get_dateFin(){
		return $this->variables[dao_occurence::$KEY_DATEFIN];
	}

	public function set_dateFin($new_value){
		$this->variables[dao_occurence::$KEY_DATEFIN] = $new_value;
	}

	public function get_montant(){
		return $this->variables[dao_occurence::$KEY_MONTANT];
	}

	public function set_montant($new_value){
		$this->variables[dao_occurence::$KEY_MONTANT] = $new_value;
	}

	public function get_type(){
		return $this->variables[dao_occurence::$KEY_TYPE];
	}

	public function set_type($new_value){
		$this->variables[dao_occurence::$KEY_TYPE] = $new_value;
	}

	public function get_categorie_id(){
		return $this->variables[dao_occurence::$KEY_CATEGORIE_ID];
	}

	public function set_categorie_id($new_value){
		$this->variables[dao_occurence::$KEY_CATEGORIE_ID] = $new_value;
	}

	public function get_user_id(){
		return $this->variables[dao_occurence::$KEY_USER_ID];
	}

	public function set_user_id($new_value){
		$this->variables[dao_occurence::$KEY_USER_ID] = $new_value;
	}

	public function get_compte_id(){
		return $this->variables[dao_occurence::$KEY_COMPTE_ID];
	}

	public function set_compte_id($new_value){
		$this->variables[dao_occurence::$KEY_COMPTE_ID] = $new_value;
	}

	public function get_libelle(){
		return $this->variables[dao_occurence::$KEY_LIBELLE];
	}

	public function set_libelle($new_value){
		$this->variables[dao_occurence::$KEY_LIBELLE] = $new_value;
	}

	public function get_frequence(){
		return $this->variables[dao_occurence::$KEY_FREQUENCE];
	}

	public function set_frequence($new_value){
		$this->variables[dao_occurence::$KEY_FREQUENCE] = $new_value;
	}

	
}
?>