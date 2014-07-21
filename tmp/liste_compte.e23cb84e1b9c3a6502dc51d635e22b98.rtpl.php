<?php if(!class_exists('raintpl')){exit;}?><label class="select">
	<select id="lst_compte" name="lst_compte" size="1">
		<?php $counter1=-1; if( isset($compte_list) && is_array($compte_list) && sizeof($compte_list) ) foreach( $compte_list as $key1 => $value1 ){ $counter1++; ?>

			<option value="<?php echo $value1["id"];?>" <?php if( $compte_select && $compte_select == $value1["id"] ){ ?> selected <?php } ?>><?php echo $value1["libelle"];?></option>
		<?php } ?>

	</select>
</label>