<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/head") . ( substr("composant/head",-1,1) != "/" ? "/" : "" ) . basename("composant/head") );?>

<link rel="stylesheet" type="text/css" href="template/../css/liste_operation.css">
<link rel="stylesheet" type="text/css" href="template/../lib/datepicker/css/datepicker.css">
<script type="text/javascript" src="template/../lib/datepicker/js/lang/fr.js"></script>
<script type="text/javascript" src="template/../lib/datepicker/js/datepicker.js"></script>
<script type="text/javascript" src="template/../lib/js/ajax.js"></script>
<script type="text/javascript" src="template/../js/formulaire.js"></script>

<div id="div_arreter">
	Date d'arr&ecirc;t : <input type="text" id="txt_date" placeholder="jj/mm/aaaa"/>
	<input type="button" class="btn_gris" value="Annuler" onclick="annuler_arret()">
	<input type="button" value="Arr&ecirc;ter" onclick="arret()">
</div>
<div id="div_liste_operation">
	<input type="text" id="txt_recherche" name="txt_recherche" placeholder="Rechercher..." />
	<ul>
		<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/operations") . ( substr("composant/operations",-1,1) != "/" ? "/" : "" ) . basename("composant/operations") );?>

	</ul>
</div>
<div id="div_update_operation">
			
</div>
<script type="text/javascript" src="template/../js/liste_operation.js"></script>
<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/foot") . ( substr("composant/foot",-1,1) != "/" ? "/" : "" ) . basename("composant/foot") );?>