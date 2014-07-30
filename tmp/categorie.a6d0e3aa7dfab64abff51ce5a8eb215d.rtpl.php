<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/head") . ( substr("composant/head",-1,1) != "/" ? "/" : "" ) . basename("composant/head") );?>


<!-- IMPORT DU STYLE CSS DE LA PAGE -->
<link rel="stylesheet" type="text/css" href="template/../css/categorie.css">

<!-- SECTION DE CREATION D'UNE CATEGORIE -->
<div id="div_create_categorie" class="section section_haute">
	<h1>Cr&eacute;er une nouvelle cat&eacute;gorie</h1>
	<form id="form_create_categorie" onsubmit="return false;">
		Libell&eacute; : <input type="text" id="txt_libelle" name="txt_libelle" class="input_large" data-type="string" data-label="Le libellé"/>
		<button id="btn_creer">Ajouter la cat&eacute;gorie</button>
	</form>
</div>

<!-- SECTION DE MODIFICATION/SUPPRESSION D'UNE CATEGORIE -->
<div id="div_list_categorie" class="section section_milieu">
	<h1 id="h1_modifier_categorie">Modifier vos cat&eacute;gories</h1>
	<div id="div_categorie">
		<ul id="ul_categorie">
			<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/liste_categorie_update") . ( substr("composant/liste_categorie_update",-1,1) != "/" ? "/" : "" ) . basename("composant/liste_categorie_update") );?>

		</ul>
	</div>
	<div id="div_detail_categorie">

	</div>
</div>

<!-- IMPORT DU FICHIER JS DE LA PAGE -->
<script type="text/javascript" src="template/../js/categorie.js"></script>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/foot") . ( substr("composant/foot",-1,1) != "/" ? "/" : "" ) . basename("composant/foot") );?>