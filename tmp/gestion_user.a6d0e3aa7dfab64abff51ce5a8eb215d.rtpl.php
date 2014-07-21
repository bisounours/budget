<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/head") . ( substr("composant/head",-1,1) != "/" ? "/" : "" ) . basename("composant/head") );?>


		<!-- IMPORT DU STYLE CSS DE LA PAGE -->
		<link rel="stylesheet" type="text/css" href="template/../css/gestion_user.css">

		<!-- SECTION DE MODIFICATION DE L'UTILISATEUR COURANT -->
		<div id="div_update_user" class="section">
			<h1>Modifier votre compte</h1>
			<form id="form_update_user" onsubmit="return false;">
				<table id="tab_update_user">
					<tr>
						<td>
							Identifiant : 
							<input type="text" id="txt_login_update" name="txt_login_update" value="<?php echo $you["login"];?>" class="input_large" data-type="string" data-label="L'identifiant"/>
						</td>
					</tr>
					<tr>
						<td>
							Mail : 
							<input type="text" id="txt_mail_update" name="txt_mail_update" value="<?php echo $you["mail"];?>" class="input_large" data-type="mail" data-label="L'adresse mail" data-nullable="true"/>
						</td>
					</tr>
					<tr>
						<td>
							Nouveau mot de passe : 
							<input type="password" id="txt_password_update" name="txt_password_update" class="input_large" data-type="string" data-label="Le mot de passe" data-nullable="true" data-equal="txt_password_conf_update"/>
						</td>
					</tr>
					<tr>
						<td>
							Confirmation mot de passe : 
							<input type="password" id="txt_password_conf_update" name="txt_password_conf_update" class="input_large" data-type="string" data-label="le mot de passe de confirmation" data-nullable="true"/>
						</td>
					</tr>
				</table>
			</form>
			<button id="btn_modifier">Mettre à jour mon compte</button>
		</div>

		<?php if( $admin["valeur"] == '1' ){ ?>


		<!-- SECTION DE CREATION D'UN UTILISATEUR (MODE ADMIN) -->
		<div id="div_create_user" class="section">
			<h1>Cr&eacute;er un nouvel utilisateur</h1>
			<form id="form_create_user" onsubmit="return false;">
				<table id="tab_create_user">
					<tr>
						<td>
							Identifiant : 
							<input type="text" id="txt_login" name="txt_login" class="input_large" data-type="string" data-label="L'identifiant"/>
						</td>
					</tr>
					<tr>
						<td>
							Mot de passe : 
							<input type="password" id="txt_password" name="txt_password" class="input_large" data-type="string" data-label="Le mot de passe"/>
						</td>
					</tr>
					<tr>
						<td>
							Mail : 
							<input type="text" id="txt_mail" name="txt_mail" class="input_large" data-type="mail" data-label="L'adresse mail" data-nullable="true"/>
						</td>
					</tr>
				</table>
			</form>
			<button id="btn_ajouter">Ajouter un utilisateur</button>
		</div>

		<!-- SECTION DE GESTION DES UTILISATEURS (MODE ADMIN) -->
		<div id="div_list_user" class="section ">
			<h1>Gerer les autres comptes utilisateur</h1>
			<ul id="ul_user">
				<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/liste_user") . ( substr("composant/liste_user",-1,1) != "/" ? "/" : "" ) . basename("composant/liste_user") );?>

			</ul>
		</div>
		
		<?php } ?>


		<!-- IMPORT DU FICHIER JS DE LA PAGE -->
		<script type="text/javascript" src="template/../js/gestion_user.js"></script>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("composant/foot") . ( substr("composant/foot",-1,1) != "/" ? "/" : "" ) . basename("composant/foot") );?>