<?php if(!class_exists('raintpl')){exit;}?><?php $counter1=-1; if( isset($liste_operation) && is_array($liste_operation) && sizeof($liste_operation) ) foreach( $liste_operation as $key1 => $value1 ){ $counter1++; ?>
	<li onclick="affichage_modification(<?php echo $value1["id"];?>)">
		<table class="table_operation">
			<tr>
				<td class="td_date" id="td_date_<?php echo $value1["id"];?>">
					<?php echo ( substr( $value1["date"], 6 ) );?>/<?php echo ( substr( $value1["date"], 4,2 ) );?>/<?php echo ( substr( $value1["date"], 0,4 ) );?> 
				</td>
				<td rowspan = "2" class="td_libelle" id="td_libelle_<?php echo $value1["id"];?>">
					<?php echo ( str_replace( "\'", "'",$value1["libelle"] ) );?>
				</td>
			 	<td id="td_montant_<?php echo $value1["id"];?>" <?php if( $value1["type"] == 'D' ){ ?> class="td_montant montant_depense" <?php }else{ ?> class="td_montant montant_revenu" <?php } ?> >
					<?php echo ( number_format( $value1["montant"], 2,',',' ' ) );?> &euro;
				</td> 
			</tr>
			<tr>
				<td id="td_categorie_<?php echo $value1["categorie"]["id"];?>" class="td_categorie">
					<?php echo ( str_replace( "\'", "'",$value1["categorie"]["libelle"] ) );?>
				</td>
				<td id="td_compte_<?php echo $value1["compte"]["id"];?>" class="td_compte">
			 		<?php echo $value1["compte"]["libelle"];?>
			 	</td>
			</tr>
		</table>
		<input type="hidden" id="hid_type_<?php echo $value1["id"];?>" value="<?php echo $value1["type"];?>" />
		<input type="hidden" id="hid_categorie_<?php echo $value1["id"];?>" value="<?php echo $value1["categorie"]["id"];?>" />
		<input type="hidden" id="hid_compte_<?php echo $value1["id"];?>" value="<?php echo $value1["compte"]["id"];?>" />
		<?php if( $value1["frequence"] ){ ?>
			<input type="hidden" id="hid_frequence_<?php echo $value1["id"];?>" value='<?php echo $value1["frequence"]["frequence"];?>' />
			<input type="hidden" id="hid_frequence_id_<?php echo $value1["id"];?>" value='<?php echo $value1["frequence"]["id"];?>' />
			<input type="hidden" id="hid_frequence_date_fin_<?php echo $value1["id"];?>" value='<?php echo $value1["frequence"]["dateFin"];?>' />
		<?php } ?>
	</li>
<?php } ?>