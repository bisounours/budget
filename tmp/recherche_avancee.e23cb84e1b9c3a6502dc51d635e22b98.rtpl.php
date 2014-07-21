<?php if(!class_exists('raintpl')){exit;}?><table id="tab_recherche_avancee">
	<tr>
		<td>Type : </td>
		<td colspan="2">
			<input type="checkbox" id="cb_depense_recherche" name="cb_depense"/>
			<label for="cb_depense_recherche">Depense&nbsp;&nbsp;&nbsp;</label>
			<input type="checkbox" id="cb_revenu_recherche" name="cb_revenu"/>
			<label for="cb_revenu_recherche">Revenu</label>
		</td>
	</tr>
	<tr>
		<td>Fr&eacute;quence : </td>
		<td>
			<input type="checkbox" id="cb_periodique_recherche" name="cb_periodique"/>
			<label for="cb_periodique_recherche">P&eacute;riodique</label>
			<input type="checkbox" id="cb_ponctuelle_recherche" name="cb_ponctuelle"/>
			<label for="cb_ponctuelle_recherche">Ponctuelle</label>
		</td>
	</tr>
	<tr>
		<td>Libell&eacute; : </td>
		<td colspan="2"><input type="text" id="txt_libelle_recherche" name="txt_libelle" class="input_large"/></td>
	</tr>
	<tr>
		<td>Montant compris entre :</td>
		<td colspan="2"><input type="text" id="txt_montant_inf_recherche" name="txt_montant_inf" class="input_medium"/> &euro;&nbsp;&nbsp;&nbsp; et &nbsp;&nbsp;&nbsp;
		<input type="text" id="txt_montant_sup_recherche" name="txt_montant_sup" class="input_medium"/> &euro;</td>
	</tr>
	<tr>
		<td>Du :</td>
		<td colspan="2"><input type="text" id="txt_date_inf_recherche" name="txt_date_inf" data-type="date" class="input_medium" placeholder="jj/mm/aaaa"/>au&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" id="txt_date_sup_recherche" name="txt_date_sup" class="input_medium" data-type="date" placeholder="jj/mm/aaaa"/>
	</tr>
	<tr>
		<td></td>
		<td>Cat&eacute;gorie :<br>
				<select id="lst_categorie_recherche" name="lst_categorie" size="5" multiple class="input_medium" >
				<?php $counter1=-1; if( isset($categorie_list) && is_array($categorie_list) && sizeof($categorie_list) ) foreach( $categorie_list as $key1 => $value1 ){ $counter1++; ?>

					<option value="<?php echo $value1["id"];?>"><?php echo $value1["libelle"];?></option>
				<?php } ?>

				</select>
		</td>
	<?php if( $compte_actif["valeur"] == '1' ){ ?>		
		<td>Compte :<br>
				<select id="lst_compte_recherche" name="lst_compte" size="5" multiple class="input_medium">
				<?php $counter1=-1; if( isset($compte_list) && is_array($compte_list) && sizeof($compte_list) ) foreach( $compte_list as $key1 => $value1 ){ $counter1++; ?>

					<option value="<?php echo $value1["id"];?>"><?php echo $value1["libelle"];?></option>
				<?php } ?>

				</select>
		</td>
	</tr>
	<?php } ?>

</table>