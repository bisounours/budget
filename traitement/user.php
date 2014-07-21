<?php
	require_once("init.php");

	//clé de cryptage du mot de passe
	$hash = outils::unique_id();

	//fonction creant le premier utilisateur
	function first_create(){
		global $database,$hash;

		//variable propre à la fonction
		global $txt_login,$txt_password,$txt_mail;


		$user = new user(null,$txt_login,md5(sha1($txt_password.$hash)),$hash,$txt_mail);
		$user->insert($database);

		//Le premier utilisateur est forcement admin
		$param = new parametre(null,parametre::$PARAM_ADMIN,"1",$user->get_id());
		$param->insert($database);

		header("location:../index.php");	
	}

	//fonction creant un utilisateur
	function create(){
		global $database,$hash;

		//variable propre à la fonction
		global $txt_login,$txt_password,$txt_mail;

		$user = new user(null,$txt_login,md5(sha1($txt_password.$hash)),$hash,$txt_mail);
		$user->insert($database);

		generation_composant_liste_user();
	}

	//fonction mettant à jour l'utilisateur courant
	function update(){
		global $database,$user,$hash;

		//variable propre à la fonction
		global $txt_login_update,$txt_password_update,$txt_password_conf_update,$txt_mail_update;

		$user_update;
		
		if(trim($txt_password_update) != "" && $txt_password_update == $txt_password_conf_update){
			//modification de l'utilisateur avec changement de mode de passe
			$user_update = new user($user[user::$KEY_ID],$txt_login_update,md5(sha1($txt_password_update.$hash)),$hash,$txt_mail_update);
			$user_update->update($database);
		}else{
			//modification de l'utilisateur sans changement de mode de passe
			$user_update = new user($user[user::$KEY_ID],$txt_login_update,$user[user::$KEY_PASSWORD],$user[user::$KEY_HASH],$txt_mail_update);
			$user_update->update($database);
		}

		//mise à jour de la variable session
		$_SESSION["user"] = serialize($user_update->variables);
	}

	//fonction reinitialisant le mot de passe d'un utilisateur à 0000 en cas de perte.
	function reset_password(){
		global $database,$user,$hash;

		//variable propre à la fonction
		global $id;
		
		//Recuperation de l'utilisateur
		$qualifier_user_id = new qualifier(user::$KEY_ID,qualifier::$EQUAL,$id);
		$liste_user = user::select($database,$qualifier_user_id);
		$user = $liste_user[0];

		$user->set_password(md5(sha1("0000".$hash)));
		$user->update($database);
	}

	//fonction supprimant un utilisateur
	function delete(){
		global $database;

		//variable propre à la fonction
		global $id;
		
		$user_delete = new user($id);
		$user_delete->delete($database);
	}

	//Fonction qui genere le composant liste_user
	//Ce composant permet de mettre à jour la liste des utilisateurs lors de la creation/suppression d'un utilisateur
	function generation_composant_liste_user(){
		global $database,$user,$template;

		//Recherche des comptes de l'utilisateur
		//Recherche de la liste des autres utlisateurs
		$qualifier_not_you = new qualifier(user::$KEY_ID,qualifier::$NOT_EQUAL,$user[user::$KEY_ID]);
		$sort_login = new sort(user::$KEY_LOGIN,sort::$ASC);
		$liste_user = user::select($database,$qualifier_not_you,null,$sort_login);

		//Generation du composant
		$template->assign("user_list",dto::dto_liste($liste_user));
		$template->draw("composant/liste_user");	
	}
?>