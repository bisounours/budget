<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/head") . ( substr("composant/head",-1,1) != "/" ? "/" : "" ) . basename("composant/head") );?>

<link rel="stylesheet" type="text/css" href="template/../css/stat_tableau.css">
<link rel="stylesheet" type="text/css" href="template/../lib/datepicker/css/datepicker.css">
<script type="text/javascript" src="template/../lib/datepicker/js/lang/fr.js"></script>
<script type="text/javascript" src="template/../lib/datepicker/js/datepicker.js"></script>
<script type="text/javascript" src="template/../js/formulaire.js"></script>
<div id="div_recherche">
	<h1><div class="cache_detail" data-detail="tab_recherche_avancee"></div>Recherche Avanc&eacute;e</h1>
	<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/recherche_avancee") . ( substr("composant/recherche_avancee",-1,1) != "/" ? "/" : "" ) . basename("composant/recherche_avancee") );?>

	<h1><div class="cache_detail" data-detail="tab_option_tableau"></div>Options affichage</h1>
	<table id="tab_option_tableau">
		<tr>
			<td>
				Affichage :
			</td>
			<td>
				<label class="select">
					<select id="lst_option_affichage" name="lst_option_affichage">
						<option value="O">par opération</option>
						<option value="CAT">par categorie</option>
						<option value="COM">par compte</option>
						<option value="M">par mois</option>
						<option value="Y">par ann&eacute;e</option>
					</select>
				</label>
				<td id="td_option_tableau">
					<input type="checkbox" id="cb_option_montant" name="cb_option_montant" checked/>
					<label for="cb_option_montant">Montant</label>
					<br>
					<input type="checkbox" id="cb_option_date" name="cb_option_date" checked/>
					<label for="cb_option_date">Date</label>
					<br>
					<input type="checkbox" id="cb_option_categorie" name="cb_option_categorie" checked/>
					<label for="cb_option_categorie">Cat&eacute;gorie</label>
					<br>
					<input type="checkbox" id="cb_option_compte" name="cb_option_compte" checked/>
					<label for="cb_option_compte">Compte</label>
				</td>
			</td>
		</tr>
	</table>
	<input type="button" id="btn_generer_graphique" value="Generer tableau"/>
</div>
<div id="div_tableau">
</div>
<script type="text/javascript" src="template/../js/stat_tableau.js"></script>
<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/foot") . ( substr("composant/foot",-1,1) != "/" ? "/" : "" ) . basename("composant/foot") );?>