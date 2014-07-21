//Fichier javascript contenant les interactions utilisateurs pour l'écran de connexion
//=================================================================================================


//VARIABLES
//=================================================================================================

//EVENEMENTS
//=================================================================================================

document.getElementById("btn_connexion").onclick = connexion;

var liste_input = document.getElementById('form_connexion').getElementsByTagName('input');
for(var i = 0;i < liste_input.length;i++){
	liste_input[i].onkeydown = function(event){
		if(event.keyCode == 13){
			connexion();
		}
	}
}

//FONCTIONS
//=================================================================================================

function connexion(){
	var formulaire = document.getElementById("form_connexion");
		if(controle_formulaire(formulaire)){
		document.getElementById("message").innerHTML = "V&eacute;rification en cours...";
		ajax.post("./traitement/identification.php",function(res){
			var message = document.getElementById("message");
			if(res == 'ok'){
				calcul_automatique_operation();
			}else{
				document.getElementById("message").innerHTML = "L'identification a &eacute;chou&eacute;";
				return false;
			}
		},"fonction=connexion&"+recuperation_formulaire(formulaire));
	}
}

function calcul_automatique_operation(){
	document.getElementById("message").innerHTML = "Calcul automatique des op&eacute;rations p&eacute;riodiques...";
	var url = "./traitement/operation.php";
    ajax.post(url,function(){
    	document.location.reload();
    },"fonction=update_operation");
}