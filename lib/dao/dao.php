<?php
/**
	Cette classe permet de faire le lien entre les objets métiers et la base de donnée
	Toutes les requêtes SQL des objets métiers devront passées le plus possible par cette classe pour être executer
	NOTE : toutes les classes et tables doivent contenir un élément id dans le tableau des variables
*/
class dao{
	
	public $variables;
	public static $table;

	public static $SQL_CREATE_TABLE;

	//Fonction inserant l'objet en base de donnée et recupère l'identifiant généré
	public function insert($database,$table){
		$rq = "insert into ".$table."(";
		foreach ($this->variables as $key => $value) {
			if($key != "id"){
				$rq .= $key.",";
			}
		}
		$rq = substr($rq,0,-1).") values( ";
		foreach ($this->variables as $key => $value) {
			if($key != "id"){
				$rq .= "'".$value."',";
			}	
		}
		$rq = substr($rq,0,-1).")";
		$this->variables["id"] = $this->execute($database,$rq);
		return $rq;
	}

	//Fonction mettant à jour l'objet en base de donnée en fonction de son identifiant
	public function update($database,$table){
		$rq = "update ".$table." set ";
		foreach ($this->variables as $key => $value) {
			if($key != "id"){
				$rq .= $key." = '".$value."', ";
			}
		}
		$rq = substr($rq,0,-2)." where id = ".$this->variables["id"];
		$this->execute($database,$rq);
		return $rq;
	}

	//Fonction supprimant l'objet en base de donnée en fonction de son identifiant
	public function delete($database,$table){
		$rq = "delete from ".$table." where id = ".$this->variables["id"];
		$this->execute($database,$rq);
		return $rq;
	}

	//Fonction recherchant dans la table correspondant à l'objet suivant les qualifiers donnés.
	//Si aucun qualifier n'est passé en paramètre, toute la table sera renvoyé.
	public static function select($database,$qualifiers,$table,$sorts = null,$limit = null){
		$rq = "select * from ".$table;
		if($qualifiers != null){
			$rq .= " where ".$qualifiers->to_string();
		}
		if($sorts != null && !is_array($sorts)){
			$rq .= " order by ".$sorts->to_string();
		}else if($sorts != null && is_array($sorts)){
			$rq .= " order by ";
			for ($i=0; $i < sizeof($sorts) ; $i++) { 
				$rq .= $sorts[$i]->to_string().", ";
			}
			$rq = substr($rq,0,-1);
		}
		if(!is_null($limit)){
			$rq .= " limit ".$limit;
		}
		return dao::query($database,$rq);
	}



	/**
		Fonctions propre à une base de donnée SQLITE
		Seules ces fonctions doivent être réécrite en cas de changement de base de donnée
	*/

	//Fonction executant des requêtes de type INSERT / UPDATE / DELETE
	public static function execute($database,$query){
		$database->exec($query) or die($query);
		return $database->lastInsertRowID();
	}

	//Fonction executant la requête select en renvoyant un tableau 2D avec chaque ligne de la table trouvée
	public static function query($database,$query){
		$array_result = array();
		$result = $database->query($query);
		if(!$result){
			die("Execution de la requ&ecirc;te impossible : ".$query);
		}else{
			while($row = $result->fetchArray()){
				array_push($array_result,$row);
			}
			$result->finalize();
			return $array_result;
		}
	}

	//Fonction echappant les caractères "dangereux" avec la fonction propre à la base de donnée utilisé
	public static function escape($value){
		return SQLite3::escapeString($value);
	}

	//Fonction qui cree l'objet de connexion a la base de donnée
	//En cas de changement de base de données, l'appel a cette fonction devra aussi etre modifie pour ajouter les options de connexion
	public static function connect($option){
		return new SQLite3($option);
	}
}
?>