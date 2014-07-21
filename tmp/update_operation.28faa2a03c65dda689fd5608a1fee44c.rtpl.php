<?php if(!class_exists('raintpl')){exit;}?><h1>Modifier cette op&eacute;ration</h1>
<table id="tab_update_operation">
	<tr>
		<td></td>
		<td>
			<input type="radio" id="rd_depense" name="rd_type" value="D" <?php if( $operation["type"] == 'D' ){ ?>checked<?php } ?>/>
			<label for="rd_depense">Depense</label>
			<input type="radio" id="rd_revenu" name="rd_type" value="R" <?php if( $operation["type"] == 'R' ){ ?>checked<?php } ?>/>
			<label for="rd_revenu">Revenu</label>
		</td>
	</tr>
	<tr>
		<td>
			Libell&eacute; : 
		</td>
		<td class="td_align_gauche">
			<input type="text" id="txt_libelle" name="txt_libelle" class="input_large" data-type="string" data-label="Le libellé" value="<?php echo $operation["libelle"];?>"/>
			<input type="hidden" id="hid_id" name="hid_id" value="<?php echo $operation["id"];?>"/>
			<?php if( $operation["frequence"] ){ ?>

			<input type="hidden" id="hid_frequence_id" name="hid_frequence_id" value="<?php echo $operation["frequence"]["id"];?>"/>
			<?php } ?>

		</td>
		<td>
			Date : 
		</td>
		<td id="td_date" class="td_align_gauche">
			<?php if( $operation["frequence"] ){ ?>

				<?php echo ( substr( $operation["date"], 6 ) );?>/<?php echo ( substr( $operation["date"], 4,2 ) );?>/<?php echo ( substr( $operation["date"], 0,4 ) );?>

			<?php }else{ ?>

				<input type="text" id="txt_date_operation" name="txt_date_operation" placeholder="jj/mm/aaaa" class="input_medium" data-type="date" data-label="La date" value="<?php echo ( substr( $operation["date"], 6 ) );?>/<?php echo ( substr( $operation["date"], 4,2 ) );?>/<?php echo ( substr( $operation["date"], 0,4 ) );?>"/>
			<?php } ?>

		</td>			
	</tr>
	<tr>
		<td>
			Montant : 
		</td>
		<td class="td_align_gauche">
			<input type="text" id="txt_montant" name="txt_montant" class="input_medium" data-type="double" data-label="Le montant" value="<?php echo ( number_format( $operation["montant"], 2,',','' ) );?>"/> &euro;
		</td>
		<td class = "td_frequence">
			Fr&eacute;quence : 
		</td>
		<td id = "td_frequence" class="td_align_gauche" colspan="2">
			<?php if( $operation["frequence"] ){ ?>

				Tous les <?php echo ( substr( $operation["frequence"]["frequence"], 1,-1 ) );?> 
				<?php if( substr($operation["frequence"]["frequence"],-1) == 'M'  ){ ?>

					mois
				<?php } ?>

				<?php if( substr($operation["frequence"]["frequence"],-1) == 'D'  ){ ?>

					jour(s)
				<?php } ?>

				<?php if( substr($operation["frequence"]["frequence"],-1) == 'Y'  ){ ?>

					an(s)
				<?php } ?>

			<?php }else{ ?>

				Ponctuelle
			<?php } ?>

		</td>
	</tr>
	<tr>
		<td>
			Cat&eacute;gorie : 
		</td>
		<td class="td_align_gauche">
			<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/liste_categorie") . ( substr("composant/liste_categorie",-1,1) != "/" ? "/" : "" ) . basename("composant/liste_categorie") );?>

		</td>
		<?php if( $operation["frequence"] != '' ){ ?>

			<?php if( $operation["frequence"]["dateFin"] != '' ){ ?>

			<td class="td_arret">
				Arrêté le :
			</td>
			<td class="td_arret td_align_gauche" id="td_date_arret">
				<?php echo ( substr( $operation["frequence"]["dateFin"], 6 ) );?>/<?php echo ( substr( $operation["frequence"]["dateFin"], 4,2 ) );?>/<?php echo ( substr( $operation["frequence"]["dateFin"], 0,4 ) );?>

			</td>
			<?php } ?>

		<?php } ?>

	</tr>
	<?php if( $compte_actif["valeur"] == '1' ){ ?>

	<tr>
		<td>
			Compte : 
		</td>
		<td class="td_align_gauche">
			<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/liste_compte") . ( substr("composant/liste_compte",-1,1) != "/" ? "/" : "" ) . basename("composant/liste_compte") );?>

		</td>
	</tr>
	<?php } ?>

	<?php if( $operation["frequence"] ){ ?>

	<tr>
		<td class="td_type_modification" colspan="2">
			Appliquer :
		</td>
		<td class="td_type_modification" colspan="2" >
			<label class="select">
				<select id="lst_type_modification" name="lst_type_modification" class="select_large">
					<option value="U">Uniquement &agrave; cette op&eacute;ration</option>
					<option value="A">A toutes les op&eacute;rations</option>
				</select>
			</label>
		</td>
	</tr>
	<?php } ?>

	<tr>
		<td colspan = "4" >
			<?php if( $operation["frequence"] ){ ?>

			<button id="btn_arreter" class="btn_gris" onclick="lancer_arret()">Arr&ecirc;ter</button>
			<?php } ?>

			<button id="btn_supprimer" class="btn_gris" onclick="lancer_suppression()">Supprimer</button>
			<button id="btn_modifier" onclick="modifier()">Modifier</button>
		</td>
	</tr>
</table>