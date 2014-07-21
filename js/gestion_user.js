//Fichier javascript contenant les interactions utilisateurs pour l'écran de gestion des comptes
//=================================================================================================

//VARIABLES
//=================================================================================================

//identifiant de l'utilisateur selectionne pour suppression et reinitialisation
var user_id;


//EVENEMENTS
//=================================================================================================
//Remise au zero du bouton modifier des qu'on modifie le champ de saisie
var liste_input = document.getElementById("form_update_user").getElementsByTagName("input");
for(var i = 0;i < liste_input.length;i++){
	liste_input[i].onkeydown = function(){
		document.getElementById("btn_modifier").className = "";
		document.getElementById("btn_modifier").innerHTML = "Mettre à jour mon compte";
	};
}

//Remise au zero du bouton ajouter des qu'on modifie le champ de saisie
var liste_input = document.getElementById("form_create_user").getElementsByTagName("input");
for(var i = 0;i < liste_input.length;i++){
	liste_input[i].onkeydown = function(){
		document.getElementById("btn_ajouter").className = "";
		document.getElementById("btn_ajouter").innerHTML = "Ajouter un utilisateur";
	};
}

document.getElementById("btn_ajouter").onclick = create;
document.getElementById("btn_modifier").onclick = update;

//FONCTIONS
//=================================================================================================
//Fonction faisant les contrôles formulaire et l'appel ajax pour creer un utilisateur
function create(){
	var form_create_user = document.getElementById("form_create_user");
	if(controle_formulaire(form_create_user)){
		//Feedback clique
		var btn = document.getElementById("btn_ajouter");
		btn.innerHTML = "<img src='./image/white_loader.gif' />";

		var url = "./traitement/user.php"
		ajax.post(url,function(composant){
			//Mise à jour de la liste des comptes
			var ul = document.getElementById("ul_user");
			ul.innerHTML = composant;

			//Feedback ok
			var btn = document.getElementById("btn_ajouter");
			btn.innerHTML = "Utilisateur créé";
			btn.className += " btn_vert";
		},"fonction=create&"+recuperation_formulaire(form_create_user));
	}
}

//Fonction faisant l'appel ajax pour modifier l'utilisateur courant
function update(){
	var form_update_user = document.getElementById("form_update_user");
	if(controle_formulaire(form_update_user)){
		//Feelback du clique sur "Modifier"
		var btn = document.getElementById("btn_modifier");
		btn.innerHTML = "<img src='./image/white_loader.gif' />";

		var url = "./traitement/user.php"
		ajax.post(url,function(){
			var btn = document.getElementById("btn_modifier");
			btn.innerHTML = "Mise à jour effectuée";
		btn.className += " btn_vert";
	},"fonction=update&"+recuperation_formulaire(document.getElementById("form_update_user")));
	}
}

//Fonction faisant l'appel ajax pour supprimer un utilisateur
function suppression(){
	var url = "./traitement/user.php"
	ajax.post(url,null,"fonction=delete&id="+user_id);
	document.getElementById("li_user_"+user_id).remove();
}

//Fonction faisant l'appel ajax pour reinitialiser le mot de passe d'un utilisateur
function reset_password(){
	var url = "./traitement/user.php"
	ajax.post(url,null,"fonction=reset_password&id="+user_id);
}

//Fonction demandant la confirmation de la suppression d'un compte
function controle_suppression(id){
	user_id = id;
	confirm("Etes vous sûr de vouloir supprimer cet utilisateur ainsi que toutes ces données ?","Supprimer",suppression);
}

//Fonction demandant la confirmation de la reinitialisation du mot de passe d'un uilisateur
function controle_reset_password(id){
	user_id = id;
	confirm("Etes vous sûr de vouloir réinitialiser le mot de passe de cet utilisateur à 0000 ?","Réinitialiser",reset_password);	
}