<?php if(!class_exists('raintpl')){exit;}?><?php $counter1=-1; if( isset($user_list) && is_array($user_list) && sizeof($user_list) ) foreach( $user_list as $key1 => $value1 ){ $counter1++; ?>

	<li id="li_user_<?php echo $value1["id"];?>">
		<span class="icon corbeille" onclick="controle_suppression(<?php echo $value1["id"];?>)" title="Supprimer ce compte"></span>
		<span class="icon cle" onclick="controle_reset_password(<?php echo $value1["id"];?>)" title="Réinitialiser le mot de passe"></span>
		<span><?php echo $value1["login"];?></span>
	<?php }else{ ?>

	<li>
		Aucun autre utilisateur cr&eacute;&eacute;
	</li>
<?php } ?>