<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
	<head>
		<title>G&euro;stion | Identification</title>
		<link rel="stylesheet" type="text/css" href="template/../css/identification.css">
		<link rel="stylesheet" type="text/css" href="template/../css/commun.css">

		<link rel="icon" type="image/png" href="template/../../image/favicon.png" />

		<script src="template/../lib/js/ajax.js" type="text/javascript" charset="utf-8"></script>
		<script src="template/../js/dialogue.js" type="text/javascript" charset="utf-8"></script>
		<script src="template/../js/formulaire.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div id="div_identification">
			<span id="euro">g&euro;stion</span>
			<div id="message"><?php echo $message;?></div>
			<div id="form_connexion">
				<table>
					<tr>
						<td>
							Identifiant : 
						</td>
						<td>
							<input type="text" id="txt_login" name="txt_login" data-type="string" data-label="L'identifiant"/>
						</td>
					</tr>
					<tr>
						<td>
							Mot de passe : 
						</td>
						<td>
							<input type="password" id="txt_password" name="txt_password" data-type="string" data-label="Le mot de passe"/>
						</td>
					</tr>
				</table>
				<button id="btn_connexion">S'identifier</button>
			</div>
		</div>
		<script src="template/../js/identification.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>