<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/head") . ( substr("composant/head",-1,1) != "/" ? "/" : "" ) . basename("composant/head") );?>


<!-- IMPORT DU STYLE CSS DE LA PAGE -->
<link rel="stylesheet" type="text/css" href="template/../css/create_operation.css">

<!-- IMPORT DU JS ET CSS DU DATEPICKER -->
<link rel="stylesheet" type="text/css" href="template/../lib/datepicker/css/datepicker.css">
<script type="text/javascript" src="template/../lib/datepicker/js/datepicker.js"></script>
<script type="text/javascript" src="template/../lib/datepicker/js/lang/fr.js"></script>

<!-- SECTION DE CREATION D'UNE OPERATION -->
<div id="div_create_operation" class="section section_haute">
	<h1>Ajouter une nouvelle op&eacute;ration</h1>
	<form id = "form_create_operation" onsubmit="return false;">
		<table id="tab_create_operation">
			<tr>
				<td></td>
				<td>
					<input type="radio" id="rd_depense" name="rd_type" value="D" checked/>
					<label for="rd_depense">Depense</label>
					<input type="radio" id="rd_revenu" name="rd_type" value="R"/>
					<label for="rd_revenu">Revenu</label>
				</td>
			</tr>
			<tr>
				<td>
					Libell&eacute; : 
				</td>
				<td >
					<input type="text" id="txt_libelle" name="txt_libelle" class="input_large" data-type="string" data-label="Le libellé"/>
				</td>
			</tr>
			<tr>
				<td>
					Date : 
				</td>
				<td>
					<input type="text" id="txt_date" name="txt_date" placeholder="jj/mm/aaaa" class="input_medium" data-type="date" data-label="La date"/>
				</td>
			</tr>
			<tr>
				<td>
					Montant : 
				</td>
				<td>
					<input type="text" id="txt_montant" name="txt_montant" size="5" class="input_medium" data-type="double" data-label="Le montant"/> &euro;
				</td>
			</tr>
			<tr>
				<td>
					Cat&eacute;gorie : 
				</td>
				<td>
					<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/liste_categorie") . ( substr("composant/liste_categorie",-1,1) != "/" ? "/" : "" ) . basename("composant/liste_categorie") );?>

				</td>
			</tr>
			<?php if( $compte_actif["valeur"] == '1' ){ ?>

			<tr>
				<td>
					Compte : 
				</td>
				<td>
					<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/liste_compte") . ( substr("composant/liste_compte",-1,1) != "/" ? "/" : "" ) . basename("composant/liste_compte") );?>

				</td>
			</tr>
			<?php } ?>

			<tr>
				<td>
					Fr&eacute;quence : 
				</td>
				<td>
					<input type="radio" id="rd_ponctuelle" name="rd_frequence" value="P" checked/>
					<label for="rd_ponctuelle">Ponctuelle</label>
					<input type="radio" id="rd_periode" name="rd_frequence" value="M"/>
					<label for="rd_periode">P&eacute;riodique</label>
				</td>
			</tr>
			<tr>
				<td class = "td_frequence"></td>
				<td class = "td_frequence">
					Tous les 
					<input type="text" id="txt_nb" name="txt_nb" size="1" data-type="integer" data-label="La frequence"/>
					<label class="select">
						<select id="lst_frequence" name="lst_frequence" size="1">
							<option value="D">Jour</option>
							<option value="M">Mois</option>
							<option value="Y">Ann&eacute;e</option>
						</select>
					</label>
				</td>	
			</tr>
		</table>
		<button id="btn_ajouter">Ajouter l'op&eacute;ration</button>
	</form>
</div>

<!-- IMPORT DU FICHIER JS DE LA PAGE -->
<script type="text/javascript" src="template/../js/create_operation.js"></script>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/foot") . ( substr("composant/foot",-1,1) != "/" ? "/" : "" ) . basename("composant/foot") );?>