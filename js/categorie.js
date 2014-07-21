//Fichier javascript contenant les interactions utilisateurs pour l'écran de gestion des catégories
//=================================================================================================


//VARIABLES
//=================================================================================================

//identifiant de la categorie selectionnee pour suppression
var id_suppression;

var url = "./traitement/categorie.php";

//EVENEMENTS
//=================================================================================================

//Remise au zero du bouton creer des qu'on modifie le champ de saisie
document.getElementById("txt_libelle").onkeydown = function init_btn_creer(){
	document.getElementById("btn_creer").className = "";
	document.getElementById("btn_creer").innerHTML = "Ajouter la cat&eacute;gorie";
}

document.getElementById("btn_creer").onclick = creer_categorie;

//FONCTIONS
//=================================================================================================


//Fonction faisant les contrôles formulaire et l'appel ajax pour creer une categorie
function creer_categorie(){

	var formulaire_creation_categorie = document.getElementById("form_create_categorie");
	if(controle_formulaire(formulaire_creation_categorie)){
		//Feedback clique
		var btn = document.getElementById("btn_creer");
		btn.innerHTML = "<img src='./image/white_loader.gif' />";

		var attr = "fonction=create&"+recuperation_formulaire(formulaire_creation_categorie);
		ajax.post(url,function(composant){
			//Mise à jour de la liste des categories
			var ul = document.getElementById("ul_categorie");
			ul.innerHTML = composant;

			init_btn_modifier();

			//Feedback ok
			var btn = document.getElementById("btn_creer");
			btn.innerHTML = "Catégorie créée";
			btn.className += " btn_vert";
		},attr);
	}
}

function detail_categorie(id){
	document.getElementById("div_detail_categorie").innerHTML = "<img src='./image/big_loading.gif' class='loading' ></img>";
	ajax.post(url,function(composant){
		document.getElementById("div_detail_categorie").innerHTML = composant;
	},"fonction=detail&id="+id);
}

//Fonction faisant l'appel ajax pour modifier la liste des catégories
function modifier_categorie(id){
	var formulaire_update_categorie = document.getElementById("div_detail_categorie");
	if(controle_formulaire(formulaire_update_categorie)){
		//Feedback clique
		var btn = document.getElementById("btn_modifier");
		btn.innerHTML = "<img src='./image/white_loader.gif' />";

		var attr = "fonction=update&id="+id+"&"+recuperation_formulaire(formulaire_update_categorie);
		ajax.post(url,function(composant){
			//Mise à jour de la liste des categories
			var ul = document.getElementById("ul_categorie");
			ul.innerHTML = composant;

			init_btn_modifier();

			//Feedback ok
			var btn = document.getElementById("btn_modifier");
			btn.innerHTML = "Mise à jour effectuée";
			btn.className += " btn_vert";
		},attr);
	}
}

//Fonction demandant la confirmation de la suppression d'une categorie
function supprimer_categorie(id){
	id_suppression = id;
	confirm("Etes vous sûr de vouloir supprimer cette catégorie ?","supprimer",suppression);
}

//Fonction de suppression d'une categorie via ajax
function suppression(){
	ajax.post(url,function(composant){
		//Mise à jour de la liste des categories
		var ul = document.getElementById("ul_categorie");
		ul.innerHTML = composant;

		document.getElementById("div_detail_categorie").innerHTML = "";
	},"fonction=delete&id="+id_suppression);
}

//Fonction permettant d'ajouter un evenement sur les inputs pour réinitialiser le bouton modifier des qu'on modifie un champ
function init_btn_modifier(){
	//Remise au zero du bouton modifier des qu'on modifie une categorie
	var liste_input = document.getElementById('div_categorie').getElementsByTagName('input');
	for(var i = 0;i < liste_input.length;i++){
		liste_input[i].onkeydown = function(){
			document.getElementById("btn_modifier").className = "";
			document.getElementById("btn_modifier").innerHTML = "Mettre à jour";
		};
	}
}