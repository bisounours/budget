<?php if(!class_exists('raintpl')){exit;}?><div id="menu">
	<?php if( $connected_user ){ ?>

		<ul>
			<li><a href="compte.php">Gestion membres</a><li>
		</ul>
	<?php }else{ ?>

		<ul>
			<li><a href="index.php?do=identification">Administration</a><li>
		</ul>
	<?php } ?>

</div>