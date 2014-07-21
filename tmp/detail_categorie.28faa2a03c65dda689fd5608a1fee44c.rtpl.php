<?php if(!class_exists('raintpl')){exit;}?><table id-"tab_detail_categorie">
	<tr>
		<td>
			Libell&eacute; :
		</td>
		<td>
			<input type="text" id="txt_libelle" name="txt_libelle" class="input_large" value="<?php echo $categorie["libelle"];?>" data-type="string" data-label="le libellé"/>
		</td>
	</tr>
	<tr>
		<td>
			Budget mensuel :
		</td>
		<td>
			<input type="text" id="txt_budget" name="txt_budget" class="input_medium" value="<?php echo ( number_format( $categorie["budget"], 2,',','' ) );?>" data-type="double" data-label="le solde" data-nullable="true"/> &euro;
		</td>
	</tr>
	<tr>
		<td>
			Debut du mois :
		</td>
		<td>
			<input type="text" id="txt_debut_mois" name="txt_debut_mois" class="input_small" value="<?php echo $categorie["debut_mois"];?>" data-type="jour" data-label="le debut du mois" data-nullable="true" data-link-required="txt_budget"/>
		</td>
	</tr>
</table>
<?php if( $categorie["utilise"] == 'false' ){ ?>

	<button id="btn_supprimer" class="btn_gris" onclick="supprimer_categorie(<?php echo $categorie["id"];?>)">Supprimer</button>
<?php } ?>

<button id="btn_modifier" onclick="modifier_categorie(<?php echo $categorie["id"];?>)">Mettre à jour</button>