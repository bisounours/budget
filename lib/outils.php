<?php
	/**
		Fichier regroupant des fonctions php perso
	*/

class outils{

	//fonction retournant un id unique
	public static function unique_id(){
		if (function_exists('com_create_guid')){
	        return com_create_guid();
	    }else{
	        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
	        $charid = strtoupper(md5(uniqid(rand(), true)));
	        $hyphen = chr(45);// "-"
	        $uuid = chr(123)// "{"
	            .substr($charid, 0, 8).$hyphen
	            .substr($charid, 8, 4).$hyphen
	            .substr($charid,12, 4).$hyphen
	            .substr($charid,16, 4).$hyphen
	            .substr($charid,20,12)
	            .chr(125);// "}"
	        return $uuid;
	    }
	}

	/*
		Fonction remplacant les accents par leur equivalent sans accent
		Utilise dans la recherche des operations
	*/
	public static function replace_accent($string){
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
	    $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
	    $string = utf8_decode($string);    
	    $string = strtr($string, utf8_decode($a), $b);
	    $string = strtolower($string);
	    return utf8_encode($string);
	}
}
?>