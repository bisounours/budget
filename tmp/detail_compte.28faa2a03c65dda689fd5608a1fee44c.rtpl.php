<?php if(!class_exists('raintpl')){exit;}?><table id-"tab_detail_compte">
	<tr>
		<td>
			Libell&eacute; :
		</td>
		<td>
			<input type="text" id="txt_libelle" name="txt_libelle" class="input_large" value="<?php echo $compte["libelle"];?>" data-type="string" data-label="le libellé"/>
		</td>
	</tr>
	<tr>
		<td>
			Solde actuel :
		</td>
		<td>
			<?php echo $compte["solde_actuel"];?> &euro;
		</td>
	</tr>
	<tr>
		<td>
			Solde saisi :
		</td>
		<td>
			<input type="text" id="txt_solde" name="txt_solde" class="input_medium" value="<?php echo ( number_format( $compte["solde"], 2,',','' ) );?>" data-type="double" data-label="le solde" data-nullable="true"/> &euro;
		</td>
	</tr>
	<tr>
		<td>
			Date mise &agrave; jour solde :
		</td>
		<td>
			<input type="text" id="txt_date_solde" name="txt_date_solde" class="input_medium" value="<?php echo ( substr( $compte["date_solde"], 6 ) );?>/<?php echo ( substr( $compte["date_solde"], 4,2 ) );?>/<?php echo ( substr( $compte["date_solde"], 0,4 ) );?>" data-type="date" data-label="la date du solde" data-nullable="true" data-link-required="txt_solde"/>
		</td>
	</tr>
</table>
<?php if( $compte["utilise"] == 'false' ){ ?>

	<button id="btn_supprimer" class="btn_gris" onclick="supprimer_compte(<?php echo $compte["id"];?>)">Supprimer</button>
<?php } ?>

<button id="btn_modifier" onclick="modifier_compte(<?php echo $compte["id"];?>)">Mettre à jour</button>