<?php if(!class_exists('raintpl')){exit;}?><label class="select">
	<select id="lst_categorie" name="lst_categorie" size="1">
		<?php $counter1=-1; if( isset($categorie_list) && is_array($categorie_list) && sizeof($categorie_list) ) foreach( $categorie_list as $key1 => $value1 ){ $counter1++; ?>

			<option value="<?php echo $value1["id"];?>" <?php if( $categorie_select && $categorie_select == $value1["id"] ){ ?> selected <?php } ?>><?php echo $value1["libelle"];?></option>
		<?php } ?>

	</select>
</label>