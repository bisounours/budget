<?php if(!class_exists('raintpl')){exit;}?><?php $counter1=-1; if( isset($categorie_list) && is_array($categorie_list) && sizeof($categorie_list) ) foreach( $categorie_list as $key1 => $value1 ){ $counter1++; ?>

	<li onclick="detail_categorie(<?php echo $value1["id"];?>)">
		<?php echo $value1["libelle"];?>

	</li>
<?php }else{ ?>

	<li>
		Aucune cat&eacute;gorie cr&eacute;&eacute;e
	</li>
<?php } ?>