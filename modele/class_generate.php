<?php
if(isset($_POST['txt_nom_classe'])){
	$str_classe = '<?php
/**
	NE PAS MODIFIER.
	Classe générée automatiquement le '.date("d/m/Y H:i").'
	Les modifications doivent être apportés dans la classe '.$_POST['txt_nom_classe'].'.
*/

class dao_'.$_POST['txt_nom_classe'].' extends dao{
	
	//Variables
	//====================================================
	public $variables = array(
		';

	for ($i=1; isset($_POST["txt_nom_attribut_".$i]) ; $i++) { 
		$str_classe .= '"'.$_POST["txt_nom_attribut_".$i].'"=>"",
		';
	}
	$str_classe = substr($str_classe,0,-5).');

	//Constantes
	//====================================================
	public static $TABLE = "'.$_POST['txt_nom_classe'].'";
	';

	for ($i=1; isset($_POST["txt_nom_attribut_".$i]) ; $i++) { 
		$str_classe .= 'public static $KEY_'.strtoupper($_POST["txt_nom_attribut_".$i]).' = "'.$_POST["txt_nom_attribut_".$i].'";
	';
	}

	$str_classe .= 'public static $SQL_CREATE_TABLE = "CREATE TABLE '.$_POST['txt_nom_classe'].'(
		';
	for ($i=1; isset($_POST["txt_nom_attribut_".$i]) ; $i++) { 
		$str_classe .= $_POST["txt_nom_attribut_".$i].' '.$_POST["lst_type_attribut_".$i].' ';
		if(!isset($_POST["cb_nullable_".$i])){
			$str_classe .= 'NOT NULL ';
		}
		if(isset($_POST["cb_primary_".$i])){
			$str_classe .= 'PRIMARY KEY ASC ';
		}
		$str_classe .= ',
		';
	}
	$str_classe = substr($str_classe,0,-5).')";
	';
	for ($i=1; isset($_POST["txt_nom_attribut_".$i]) ; $i++) { 
		
	}
	$str_classe .= '
	//Constructeur
	//====================================================
	public function __construct(';
	for ($i=1; isset($_POST["txt_nom_attribut_".$i]) ; $i++) { 
		$str_classe .= '$'.$_POST["txt_nom_attribut_".$i].' = "",';
	}
	$str_classe = substr($str_classe,0,-1).'){
		';
	for ($i=1; isset($_POST["txt_nom_attribut_".$i]) ; $i++) { 
		$str_classe .= '$this->variables[dao_'.$_POST["txt_nom_classe"].'::$KEY_'.strtoupper($_POST["txt_nom_attribut_".$i]).'] = $'.$_POST["txt_nom_attribut_".$i].';
		';
	}
	$str_classe = substr($str_classe,0,-1).'}
	
	//Methodes
	//====================================================
	';
	$str_classe .= 'public static function select($database,$qualifier,$table=null){
		$liste_object = array();
		$result = parent::select($database,$qualifier,'.$_POST["txt_nom_classe"].'::$TABLE);
		foreach ($result as $row) {
			$new_object = new '.$_POST["txt_nom_classe"].'(';
	for ($i=1; isset($_POST["txt_nom_attribut_".$i]) ; $i++) { 
		$str_classe .= '$row[dao_'.$_POST["txt_nom_classe"].'::$KEY_'.strtoupper($_POST["txt_nom_attribut_".$i]).'],';
	}
	$str_classe = substr($str_classe,0,-1).');
			';
	$str_classe	.=	'array_push($liste_object,$new_object);
		}
		return $liste_object;
	}

	public function insert($database,$table=null){
		return parent::insert($database,'.$_POST["txt_nom_classe"].'::$TABLE);
	}

	public function update($database,$table=null){
		return parent::update($database,'.$_POST["txt_nom_classe"].'::$TABLE);
	}

	public function delete($database,$table=null){
		return parent::delete($database,'.$_POST["txt_nom_classe"].'::$TABLE);
	}

	public static function create($database){
		parent::execute($database,'.$_POST["txt_nom_classe"].'::$SQL_CREATE_TABLE);
	}

	//Getters & Setters
	//====================================================
	';
	for ($i=1; isset($_POST["txt_nom_attribut_".$i]) ; $i++) {
		$str_classe .= 'public function get_'.$_POST["txt_nom_attribut_".$i].'(){
		return $this->variables[dao_'.$_POST["txt_nom_classe"].'::$KEY_'.strtoupper($_POST["txt_nom_attribut_".$i]).'];
	}

	';
		$str_classe .= 'public function set_'.$_POST["txt_nom_attribut_".$i].'($new_value){
		$this->variables[dao_'.$_POST["txt_nom_classe"].'::$KEY_'.strtoupper($_POST["txt_nom_attribut_".$i]).'] = $new_value;
	}

	';
	}
	$str_classe .= '
}
?>';
	$php_file = fopen('./dao_'.$_POST['txt_nom_classe'].'.php','w+');
	fwrite($php_file,$str_classe);
	fclose($php_file);

	$str_classe = '<?php
/**
	Commentaire de classe....
*/

class '.$_POST['txt_nom_classe'].' extends dao_'.$_POST['txt_nom_classe'].'{

}
?>';

	$php_file = fopen('./'.$_POST['txt_nom_classe'].'.php','w+');
	fwrite($php_file,$str_classe);
	fclose($php_file);
}
?>

<html>
	<head>
		<title>G&eacute;n&eacute;rateur de classe php</title>
		<style>
			form{
				position:absolute;
				top: 200px;
				width: 500px;
				left: 50%;
				margin-left: -250px;
			}
		</style>
	</head>
	<body>
		<form action="./class_generate.php" method="post">
			<table id="tab">
				<tr>
					<td>
						Class name :
					</td>
					<td>
						<input type="text" id="txt_nom_classe" name="txt_nom_classe"/>
					</td>
				</tr>
				<tr>
					<th></th>
					<th>Name</th>
					<th>Type</th>
					<th>Nullable</th>
					<th>Primary</th>
				</tr>
				<tr>
					<td>
						Field n&deg;1 :
					</td>
					<td>
						<input type="text" id="txt_nom_attribut_1" name="txt_nom_attribut_1"/>
					</td>
					<td>
						<select id="lst_type_attribut_1" name="lst_type_attribut_1"/>
						</select>
					</td>
					<td>
						<input type="checkbox" id="cb_nullable_1" name="cb_nullable_1"/>
					</td>
					<td>
						<input type="checkbox" id="cb_primary_1" name="cb_primary_1"/>
					</td>
				</tr>
			</table>
			<input type="button" value="Add field" onclick="ajouter_attribut()">
			<input type="submit" value="Generate">
		</form>
		<script type="text/javascript">
			var liste_type = ["INTEGER","TEXT","REAL","BLOB"];
			var nb_attribut = 1;

			function remplir_liste_type(id){
				for (var i = 0; i < liste_type.length; i++) {
					var opt = document.createElement('option');
					opt.innerHTML = liste_type[i];
					document.getElementById('lst_type_attribut_'+id).appendChild(opt);
				}
			}

			function ajouter_attribut(){
				nb_attribut++;
				var table = document.getElementById("tab");
				var tr = document.createElement('tr');
				var td = document.createElement('td');
				
				td.innerHTML = "Field n&deg"+nb_attribut+" :";
				tr.appendChild(td);

				td = document.createElement('td');
				var input = document.createElement('input');
				input.type = 'text';
				input.id = 'txt_nom_attribut_'+nb_attribut;
				input.name = 'txt_nom_attribut_'+nb_attribut;
				td.appendChild(input);
				tr.appendChild(td)

				td = document.createElement('td');
				var select = document.createElement('select');
				select.id = 'lst_type_attribut_'+nb_attribut;
				select.name = 'lst_type_attribut_'+nb_attribut;
				td.appendChild(select);
				tr.appendChild(td);
				table.appendChild(tr);

				td = document.createElement('td');
				var input = document.createElement('input');
				input.type = 'checkbox';
				input.id = 'cb_nullable_'+nb_attribut;
				input.name = 'cb_nullable_'+nb_attribut;
				td.appendChild(input);
				tr.appendChild(td)

				td = document.createElement('td');
				var input = document.createElement('input');
				input.type = 'checkbox';
				input.id = 'cb_primary_'+nb_attribut;
				input.name = 'cb_primary_'+nb_attribut;
				td.appendChild(input);
				tr.appendChild(td)

				remplir_liste_type(nb_attribut);
			}

			remplir_liste_type(1);
		</script>
	</body>
</html>