<?php
	/**
		Fichier servant à l'installation de la base de donnée SQLite
		A réécrire en cas de changement de base de donnée
	*/

	//fonction creant la base sqlite avec les tables et renvoyant l'objet database
	function install(){

		$SQL_CREATE_TABLE_CATEGORIE = "CREATE TABLE categorie(
			id INTEGER NOT NULL PRIMARY KEY ASC ,
			libelle TEXT NOT NULL ,
			user_id INTEGER NOT NULL,
			FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE)";

		$SQL_CREATE_TABLE_COMPTE = "CREATE TABLE compte(
			id INTEGER NOT NULL PRIMARY KEY ASC ,
			libelle TEXT NOT NULL ,
			user_id INTEGER NOT NULL,
			FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE)";

		$SQL_CREATE_TABLE_OCCURENCE = "CREATE TABLE occurence(
			id INTEGER NOT NULL PRIMARY KEY ASC ,
			dateDebut INTEGER NOT NULL ,
			dateFin INTEGER ,
			montant REAL NOT NULL ,
			type TEXT NOT NULL ,
			user_id INTEGER NOT NULL,
			compte_id INTEGER NOT NULL,
			categorie_id INTEGER NOT NULL,
			libelle TEXT NOT NULL ,
			frequence TEXT NOT NULL ,
			FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE,
			FOREIGN KEY(compte_id) REFERENCES compte(id) ,
			FOREIGN KEY(categorie_id) REFERENCES categorie(id))";

		$SQL_CREATE_TABLE_OPERATION = "CREATE TABLE operation(
			id INTEGER NOT NULL PRIMARY KEY ASC ,
			date INTEGER NOT NULL ,
			montant REAL NOT NULL ,
			type TEXT NOT NULL ,
			categorie_id INTEGER NOT NULL,
			user_id INTEGER NOT NULL,
			compte_id INTEGER NOT NULL,
			libelle TEXT NOT NULL ,
			occurence_id INTEGER NOT NULL,
			actif INTEGER NOT NULL,
			FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE,
			FOREIGN KEY(compte_id) REFERENCES compte(id) ,
			FOREIGN KEY(categorie_id) REFERENCES categorie(id) ,
			FOREIGN KEY(occurence_id) REFERENCES occurence(id) )";

		$SQL_CREATE_TABLE_USER = "CREATE TABLE user(
			id INTEGER NOT NULL PRIMARY KEY ASC ,
			login TEXT NOT NULL ,
			password TEXT NOT NULL ,
			hash TEXT NOT NULL ,
			mail TEXT NOT NULL )";

		$SQL_CREATE_TABLE_PARAMETRE = "CREATE TABLE parametre(
			id INTEGER NOT NULL PRIMARY KEY ASC ,
			libelle TEXT NOT NULL ,
			valeur TEXT NOT NULL ,
			user_id INTEGER NOT NULL,
			FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE)";

		$database = new SQLite3('./data/finance.sqlite3');

		$database->exec($SQL_CREATE_TABLE_USER);
		$database->exec($SQL_CREATE_TABLE_CATEGORIE);
		$database->exec($SQL_CREATE_TABLE_COMPTE);
		$database->exec($SQL_CREATE_TABLE_OCCURENCE);
		$database->exec($SQL_CREATE_TABLE_OPERATION);
		$database->exec($SQL_CREATE_TABLE_PARAMETRE);

		return $database;
	}
?>