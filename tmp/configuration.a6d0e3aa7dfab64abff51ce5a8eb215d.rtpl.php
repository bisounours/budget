<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/head") . ( substr("composant/head",-1,1) != "/" ? "/" : "" ) . basename("composant/head") );?>

<!-- IMPORT DU STYLE CSS DE LA PAGE -->
<link rel="stylesheet" type="text/css" href="template/../css/configuration.css">

<!-- SECTION DE GESTION DES PARAMETRES-->
<div id="div_configuration" class="section section_haute">
	<h1>G&eacute;rer les param&egrave;tres de l'application</h1>
	<form method="POST" action="./traitement/configuration.php?fonction=update">
		<ul>
			<li>
				<input type="checkbox" id="cb_compte_actif" name="cb_compte_actif" <?php if( $compte_actif["valeur"] == '1' ){ ?> checked <?php } ?>/>
				<label for="cb_compte_actif">Comptes bancaire actifs</label>
				<input type="hidden" id="hid_compte_actif" name="hid_compte_actif" value="<?php echo $compte_actif["id"];?>" />
			</li>
		</ul>
		<button type="submit">Mettre &agrave; jour</button>
	</form>
</div>
<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/foot") . ( substr("composant/foot",-1,1) != "/" ? "/" : "" ) . basename("composant/foot") );?>