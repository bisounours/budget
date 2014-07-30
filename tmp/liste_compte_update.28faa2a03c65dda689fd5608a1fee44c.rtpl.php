<?php if(!class_exists('raintpl')){exit;}?><?php $counter1=-1; if( isset($compte_list) && is_array($compte_list) && sizeof($compte_list) ) foreach( $compte_list as $key1 => $value1 ){ $counter1++; ?>

	<li onclick="detail_compte(<?php echo $value1["id"];?>)">
		<?php echo $value1["libelle"];?>

		(
		<?php if( $value1["solde_actuel"] > 0 ){ ?>

		<span class="span_vert">
		<?php }else{ ?>

		<span class="span_rouge">
		<?php } ?>

		<?php echo $value1["solde_actuel"];?> &euro;
		</span>
		)
	</li>
<?php }else{ ?>

	<li>
		Aucune compte cr&eacute;&eacute;
	</li>
<?php } ?>