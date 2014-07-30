<?php if(!class_exists('raintpl')){exit;}?><table id="tab_resultat_tableau">
	<thead>
		<tr>
			<td>
				<div class="mini-fleche-haut-bas" data-index="0" data-type="string" data-sort="ASC" onclick="tri(event)"></div><?php echo $libelle;?>

			</td>
			<?php if( $option_affichage == 'O' ){ ?>

				<td>
				<?php if( $option_date ){ ?>

					<div class="mini-fleche-bas" data-index="1" data-type="date" data-sort="DESC" onclick="tri(event)"></div>Date
				<?php } ?>

				</td>
				<td>
				<?php if( $option_montant ){ ?>

					<div class="mini-fleche-haut-bas" data-index="2" data-type="integer" data-sort="ASC" onclick="tri(event)"></div>Montant
				<?php } ?>

				</td>
				<td>
				<?php if( $option_categorie ){ ?>

					<div class="mini-fleche-haut-bas" data-index="3" data-type="string" data-sort="ASC" onclick="tri(event)"></div>Categorie
				<?php } ?>

				</td>
				<td>
				<?php if( $option_compte ){ ?>

					<div class="mini-fleche-haut-bas" data-index="4" data-type="string" data-sort="ASC" onclick="tri(event)"></div>Compte
				<?php } ?>

				</td>
			<?php } ?>

			<?php if( $option_affichage != 'O' ){ ?>

				<td>
					<div class="mini-fleche-haut-bas" data-index="1" data-type="integer" data-sort="ASC" onclick="tri(event)"></div>Montant
				</td>
				<td>
					<div class="mini-fleche-haut-bas" data-index="2" data-type="integer" data-sort="ASC" onclick="tri(event)"></div>Nombres d'op&eacute;rations
				</td>
			<?php } ?>

		</tr>
	</thead>
	<tbody>
		<?php $counter1=-1; if( isset($liste_operation) && is_array($liste_operation) && sizeof($liste_operation) ) foreach( $liste_operation as $key1 => $value1 ){ $counter1++; ?>

		<tr>
			<td>
				<?php echo ( str_replace( "\'", "'",$value1["libelle"] ) );?>

			</td>
			<?php if( $option_affichage == 'O' ){ ?>

				<td>
				<?php if( $option_date ){ ?>

					<?php echo ( substr( $value1["date"], 6 ) );?>/<?php echo ( substr( $value1["date"], 4,2 ) );?>/<?php echo ( substr( $value1["date"], 0,4 ) );?> 
				<?php } ?>

				</td>
				<td>
				<?php if( $option_montant ){ ?>

					<?php echo ( number_format( $value1["montant"], 2,',',' ' ) );?> &euro;
				<?php } ?>

				</td>
				<td>
				<?php if( $option_categorie ){ ?>

					<?php echo ( str_replace( "\'", "'",$value1["categorie"]["libelle"] ) );?>

				<?php } ?>

				</td>
				<td>
				<?php if( $option_compte ){ ?>

					<?php echo $value1["compte"]["libelle"];?>

				<?php } ?>

				</td>
			<?php } ?>

			<?php if( $option_affichage != 'O' ){ ?>

				<td>
					<?php echo ( number_format( $value1["montant"], 2,',',' ' ) );?> &euro;
				</td>
				<td>
					<?php echo $value1["nb"];?>

				</td>
			<?php } ?>

		</tr>
		<?php } ?>

		<?php if( $option_montant ){ ?>

	</tbody>
	<?php if( $option_affichage == 'O' ){ ?>

	<tfoot>	
		<tr>
			<td>TOTAL</td>
			<?php if( $option_date ){ ?>

			<td></td>
			<?php } ?>

			<td><?php echo ( number_format( $somme, 2,',',' ' ) );?> &euro;</td>
			<?php if( $option_categorie ){ ?>

			<td></td>
			<?php } ?>

			<?php if( $option_compte ){ ?>

			<td></td>
			<?php } ?>

		</tr>
		<?php } ?>

	</tfoot>
	<?php } ?>

</table>