<?php
	require_once("init.php");

	function connexion(){
		global $database;
		$login = dao::escape($_POST["txt_login"]);
		$password = dao::escape($_POST["txt_password"]);

		$qualifier_login = new qualifier(user::$KEY_LOGIN,qualifier::$EQUAL,$login);
		$liste_user = user::select($database,$qualifier_login);

		if(sizeof($liste_user) > 0){
			$user = $liste_user[0];
			if(md5(sha1($password.$user->get_hash())) == $user->get_password()){
				$_SESSION["user"] = serialize($user->variables);
				echo "ok";
			}else{
				echo "pok";
			}
		}else{
			echo "pok";
		}
	}	

	function deconnexion(){
		unset($_SESSION["user"]);
		header("location:../index.php");
	}
?>