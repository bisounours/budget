<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/head") . ( substr("composant/head",-1,1) != "/" ? "/" : "" ) . basename("composant/head") );?>

<link rel="stylesheet" type="text/css" href="template/../css/stat_graphique.css">
<link rel="stylesheet" type="text/css" href="template/../lib/datepicker/css/datepicker.css">
<script type="text/javascript" src="template/../lib/datepicker/js/lang/fr.js"></script>
<script type="text/javascript" src="template/../lib/datepicker/js/datepicker.js"></script>
<script type="text/javascript" src="template/../lib/highcharts/adapters/standalone-framework.js"></script>
<script type="text/javascript" src="template/../lib/highcharts/highcharts.js"></script>
<script type="text/javascript" src="template/../lib/highcharts/modules/exporting.js"></script>
<div id="div_recherche">
	<h1><div class="cache_detail" data-detail="tab_recherche_avancee"></div>Recherche Avanc&eacute;e</h1>
	<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/recherche_avancee") . ( substr("composant/recherche_avancee",-1,1) != "/" ? "/" : "" ) . basename("composant/recherche_avancee") );?>

	<h1><div class="cache_detail" data-detail="liste_graphique"></div>Type graphique</h1>
	<div id="liste_graphique">
		<table>
			<tr>
				<td>
					R&eacute;sultat sous forme d'un graphique de type : 
				</td>
				<td>
					<label class="select">
						<select id="lst_type_graphique" name="lst_type_graphique">
							<option value="L">Linéaire</option>
							<option value="H">Histogramme</option>
							<option value="P">Portion</option>
						</select>
					</label>
				</td>
		</table>
	</div>
	<h1><div class="cache_detail" data-detail="tab_option_graphique"></div>Option graphique</h1>
	<table id="tab_option_graphique">
		<tr>
			<td>
				Axe abscisses :
			</td>
			<td>
				<label id="lbl_option_x" class="select">
					<select id="lst_option_x" name="lst_option_x">
						<option value = "DAT" id="option_x_date">Date</option>
						<option value = "M" id="option_x_mois">Mois</option>
						<option value = "Y" id="option_x_annee">Ann&eacute;e</option>
						<option value = "CAT" id="option_x_categorie" style="display:none">Cat&eacute;gorie</option>
						<?php if( $compte_actif["valeur"] == '1' ){ ?>

						<option value = "COM" id="option_x_compte" style="display:none">Compte</option>
						<?php } ?>

					</select>
				</label>
			</td>
		</tr>
		<tr>
			<td>
				Axe ordonnées :
			</td>
			<td>
				<label class="select" id="lbl_option_y">
					<select id="lst_option_y" name="lst_option_y">
						<option value="MON">Montant</option>
						<!-- <option value="NBO">Nombre d'opération</option> -->
					</select>
				</label>
			</td>
		</tr>
		<tr>
			<td>
				Grouper :
			</td>
			<td>
				<label id="lbl_option_groupe" class="select">
					<select id="lst_option_groupe" name="lst_option_groupe">
						<option value = "" id="option_groupe_aucun">Aucun</option>
						<option value = "G_CAT" id="option_groupe_categorie">Par cat&eacute;gorie</option>
						<?php if( $compte_actif["valeur"] == '1' ){ ?>

						<option value = "G_COM" id="option_groupe_compte">Par compte bancaire</option>
						<?php } ?>

						<option value = "G_TYP" id="option_groupe_type">Par depense/revenu</option>
					</select>
				</label>
			</td>
		</tr>
	</table>
	<input type="button" id="btn_generer_graphique" onclick="generer_graphique()" value="Generer graphique"/>
</div>
<div id="div_graphique">
</div>
<script type="text/javascript" src="template/../js/stat_graphique.js"></script>
<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/foot") . ( substr("composant/foot",-1,1) != "/" ? "/" : "" ) . basename("composant/foot") );?>