<?php if(!class_exists('raintpl')){exit;}?><div id="widget_compte">
	<h1><div class="cache_detail" data-detail="tab_solde_compte"></div>Soldes compte bancaire</h1>
	<table id="tab_solde_compte">
		<?php $counter1=-1; if( isset($liste_compte) && is_array($liste_compte) && sizeof($liste_compte) ) foreach( $liste_compte as $key1 => $value1 ){ $counter1++; ?>

		<tr>
			<td><?php echo $value1["libelle"];?></td>
			<td>
				<?php if( $value1["solde_actuel"] > 0 ){ ?><span class="span_vert"><?php }else{ ?><span class="span_rouge"><?php } ?>

					<?php echo $value1["solde_actuel"];?> &euro;
				</span>
			</td>
		</tr>
		<?php } ?>

	</table>
</div>