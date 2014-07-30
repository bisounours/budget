//Fichier javascript contenant les interactions utilisateurs pour l'écran de création d'operation
//=================================================================================================

//VARIABLES
//=================================================================================================

//EVENEMENTS
//=================================================================================================

document.getElementById("rd_ponctuelle").onchange = changement_frequence;
document.getElementById("rd_periode").onchange = changement_frequence;
document.getElementById("btn_ajouter").onclick = create;

var liste_input = document.getElementById('form_create_operation').getElementsByTagName('input');
for(var i = 0;i < liste_input.length;i++){
	liste_input[i].onkeydown = function(){
		document.getElementById("btn_ajouter").className = "";
		document.getElementById("btn_ajouter").innerHTML = "Ajouter l'op&eacute;ration";
	};
}

var liste_select = document.getElementById('form_create_operation').getElementsByTagName('select');
for(var i = 0;i < liste_select.length;i++){
	liste_select[i].onchange = function(){
		document.getElementById("btn_ajouter").className = "";
		document.getElementById("btn_ajouter").innerHTML = "Ajouter l'op&eacute;ration";
	};
}


//FONCTIONS
//=================================================================================================

//Fonction gerant l'affichage pour l'option periodique d'une operation
function changement_frequence(){
	var rd_ponctuelle = document.getElementById("rd_ponctuelle");
	var td_frequence = document.getElementsByClassName("td_frequence");
	if(rd_ponctuelle.checked){
		for (var i = td_frequence.length - 1; i >= 0; i--) {
			td_frequence[i].style.visibility = "hidden";
		}
	}else{
		for (var i = td_frequence.length - 1; i >= 0; i--) {
			td_frequence[i].style.visibility = "visible";
		}
	}
	document.getElementById("btn_ajouter").className = "";
	document.getElementById("btn_ajouter").innerHTML = "Ajouter l'op&eacute;ration";
}

//Fonction faisant les contrôles formulaires et l'appel ajax pour creer une opération
function create(){
	var form_create_operation = document.getElementById("form_create_operation");
	if(controle_formulaire(form_create_operation)){
		//Feedback du clique sur "Modifier"
		var btn = document.getElementById("btn_ajouter");
		btn.innerHTML = "<img src='./image/white_loader.gif' />";

		var url = "./traitement/operation.php";
		var option = "fonction=create&"+recuperation_formulaire(form_create_operation)
		
    	ajax.post(url,function(){
    		//Feedback ok
    		var btn = document.getElementById("btn_ajouter");
			btn.innerHTML = "Opération ajoutée";
			btn.className += " btn_vert";
    	},option);
		return false;
	}
}