<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="fr">
	<head>
		<title><?php echo $title;?></title>
		<meta charset="utf-8">
		
		<link rel="icon" type="image/png" href="template/composant/../../image/favicon.png" />

		<!-- IMPORT CSS COMMUN-->
		<link rel="stylesheet" type="text/css" href="template/composant/../../css/commun.css">
		<link rel="stylesheet" type="text/css" href="template/composant/../../css/menu.css">

		<!-- IMPORT JAVASCRIPT COMMUN-->
		<script src="template/composant/../../lib/js/ajax.js" type="text/javascript" charset="utf-8"></script>
		<script src="template/composant/../../js/dialogue.js" type="text/javascript" charset="utf-8"></script>
		<script src="template/composant/../../js/formulaire.js" type="text/javascript" charset="utf-8"></script>
		<script src="template/composant/../../js/tableau.js" type="text/javascript" charset="utf-8"></script>

	</head>
	<body>
		<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/menu") . ( substr("composant/menu",-1,1) != "/" ? "/" : "" ) . basename("composant/menu") );?>		