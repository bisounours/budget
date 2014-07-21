//Fichier javascript contenant les interactions utilisateurs pour l'écran de gestion des comptes
//=================================================================================================

//VARIABLES
//=================================================================================================

//identifiant du compte selectionne pour suppression
var id_suppression;

var url = "./traitement/compte.php";

//EVENEMENTS
//=================================================================================================

//Remise au zero du bouton creer des qu'on modifie le champ de saisie
document.getElementById("txt_libelle").onkeydown = function(){
	document.getElementById("btn_creer").className = "";
	document.getElementById("btn_creer").innerHTML = "Ajouter le compte bancaire";
}

document.getElementById("btn_creer").onclick = creer_compte;

//FONCTIONS
//=================================================================================================

//Fonction faisant les contrôles formulaire et l'appel ajax pour creer un compte
function creer_compte(){
	var formulaire_creation_compte = document.getElementById("form_create_compte");
	if(controle_formulaire(formulaire_creation_compte)){
		//Feedback clique
		var btn = document.getElementById("btn_creer");
		btn.innerHTML = "<img src='./image/white_loader.gif' />";

		var attr = "fonction=create&"+recuperation_formulaire(formulaire_creation_compte);
		ajax.post(url,function(composant){
			//Mise à jour de la liste des comptes
			var ul = document.getElementById("ul_compte");
			ul.innerHTML = composant;

			//Feedback ok
			var btn = document.getElementById("btn_creer");
			btn.innerHTML = "Compte créé";
			btn.className += " btn_vert";
		},attr);
	}
}

function detail_compte(id){
	document.getElementById("div_detail_compte").innerHTML = "<img src='./image/big_loading.gif' class='loading' ></img>";
	ajax.post(url,function(composant){
		document.getElementById("div_detail_compte").innerHTML = composant;
		datePickerController.destroyDatePicker("txt_date_solde");
		datePickerController.createDatePicker({                      
			formElements:{"txt_date_solde":"%d/%m/%Y"},
        	statusFormat:"%l %d %F %Y"
		});
	},"fonction=detail&id="+id);
}

//Fonction faisant l'appel ajax pour modifier la liste des comptes
function modifier_compte(id){
	var formulaire_update_compte = document.getElementById("div_detail_compte");
	if(controle_formulaire(formulaire_update_compte)){
		//Feedback clique
		var btn = document.getElementById("btn_modifier");
		btn.innerHTML = "<img src='./image/white_loader.gif' />";

		var attr = "fonction=update&id="+id+"&"+recuperation_formulaire(formulaire_update_compte);
		ajax.post(url,function(composant){
			//Mise à jour de la liste des comptes
			var ul = document.getElementById("ul_compte");
			ul.innerHTML = composant;

			init_btn_modifier();

			//Feedback ok
			var btn = document.getElementById("btn_modifier");
			btn.innerHTML = "Mise à jour effectuée";
			btn.className += " btn_vert";
		},attr);
	}
}

//Fonction demandant la confirmation de la suppression d'un compte
function supprimer_compte(id){
	id_suppression = id;
	confirm("Etes vous sûr de vouloir supprimer ce compte bancaire ?","supprimer",suppression);
}

//Fonction de suppression d'un compte via ajax
function suppression(){
		ajax.post(url,function(composant){
			//Mise à jour de la liste des comptes
			var ul = document.getElementById("ul_compte");
			ul.innerHTML = composant;

			document.getElementById("div_detail_compte").innerHTML = "";
		},"fonction=delete&id="+id_suppression);
}

//Fonction permettant d'ajouter un evenement sur les inputs pour réinitialiser le bouton modifier des qu'on modifie un champ
function init_btn_modifier(){
	//Remise au zero du bouton modifier des qu'on modifie une categorie
	var liste_input = document.getElementById('div_detail_compte').getElementsByTagName('input');
	for(var i = 0;i < liste_input.length;i++){
		liste_input[i].onkeydown = function(){
			document.getElementById("btn_modifier").className = "";
			document.getElementById("btn_modifier").innerHTML = "Mettre à jour";
		};
	}
}