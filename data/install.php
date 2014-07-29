<?php
	/**
		Fichier servant à l'installation de la base de donnée SQLite
		A réécrire en cas de changement de base de donnée
	*/

	//fonction creant la base sqlite avec les tables et renvoyant l'objet database
	function install(){

		$SQL_CREATE_TABLE_USER = "CREATE TABLE user(
			id INTEGER NOT NULL PRIMARY KEY ASC ,
			login TEXT NOT NULL ,
			password TEXT NOT NULL ,
			hash TEXT NOT NULL ,
			mail TEXT NOT NULL )";

		$SQL_CREATE_TABLE_INDIVIDU = "CREATE TABLE individu(
			id INTEGER NOT NULL PRIMARY KEY ASC ,
			nom TEXT NOT NULL ,
			prenom TEXT ,
			date_naissance INTEGER ,
			date_deces INTEGER ,
			id_pere INTEGER ,
			id_mere INTEGER )";

		$SQL_CREATE_TABLE_CONJOINT = "CREATE TABLE conjoint(
			id INTEGER NOT NULL PRIMARY KEY ASC ,
			id_individu1 INTEGER NOT NULL ,
			id_individu2 INTEGER NOT NULL )";

		$database = new SQLite3('./data/famille.sqlite3');

		$database->exec($SQL_CREATE_TABLE_USER);
		$database->exec($SQL_CREATE_TABLE_INDIVIDU);
		$database->exec($SQL_CREATE_TABLE_CONJOINT);

		return $database;
	}
?>