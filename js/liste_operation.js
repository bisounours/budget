//Fichier javascript contenant les interactions utilisateurs pour l'écran de gestion des comptes
//=================================================================================================

//VARIABLES
//=================================================================================================
var id_operation_courante;
var url = "./traitement/operation.php";

//EVENEMENTS
//=================================================================================================
window.addEventListener('load', function() {
	datePickerController.createDatePicker({                      
	        formElements:{"txt_date":"%d/%m/%Y"},
        	statusFormat:"%l %d %F %Y"
	});

	document.getElementById("txt_recherche").onkeyup = recherche;
});

//FONCTIONS
//=================================================================================================

//Fonction de recherche d'operation en fonction du libellé
function recherche(){
	var txt_recherche = document.getElementById("txt_recherche");
	ajax.post(url,function(liste){
		var div_liste = document.getElementById("div_liste_operation");
		div_liste.getElementsByTagName("ul")[0].innerHTML = liste;
	},"fonction=recherche&recherche="+encodeURIComponent(txt_recherche.value));
}

function affichage_modification(id){
	id_operation_courante = id;
	document.getElementById("div_update_operation").innerHTML = "<img src='./image/big_loading.gif' class='loading' ></img>";
	ajax.post(url,function(composant){
		var div_update = document.getElementById("div_update_operation");
		div_update.innerHTML = composant;
		div_update.style.display = "block";
		datePickerController.destroyDatePicker("txt_date_operation");
		datePickerController.createDatePicker({                      
	        formElements:{"txt_date_operation":"%d/%m/%Y"},
        	statusFormat:"%l %d %F %Y"
		});
	},"fonction=affichage_update&id="+id);
}

function modifier(){
	var formulaire = document.getElementById("tab_update_operation");
	if(controle_formulaire(formulaire)){
		document.getElementById("btn_modifier").innerHTML = "<img src='./image/white_loader.gif' />";
		ajax.post(url,function(composant){
			var div_liste = document.getElementById("div_liste_operation");
			div_liste.getElementsByTagName("ul")[0].innerHTML = "";
			div_liste.getElementsByTagName("ul")[0].innerHTML = composant;
			document.getElementById("btn_modifier").className = "btn_vert";
			document.getElementById("btn_modifier").innerHTML = "Op&eacute;ration modifi&eacute;e";
			initialisation_bouton_modifier();
		},"fonction=update&"+recuperation_formulaire(formulaire));
	}
}

function lancer_suppression(){
	var type_modif = document.getElementById("lst_type_modification") ? document.getElementById("lst_type_modification").value : "U";
	var conf;

	if(type_modif == "U"){
		conf = "Etes vous sûr de vouloir supprimer cette opération ?"
	}else{
		conf = "Etes vous sûr de vouloir supprimer toutes les opérations "+ document.getElementById("txt_libelle").value +" ?"
	}


	confirm(conf,"Supprimer",suppression);
}

function suppression(){
	var type_modif = document.getElementById("lst_type_modification") ? document.getElementById("lst_type_modification").value : "U";
	ajax.post(url,function(msg){
			var div_liste = document.getElementById("div_liste_operation");
			div_liste.getElementsByTagName("ul")[0].innerHTML = "";
			div_liste.getElementsByTagName("ul")[0].innerHTML = msg;
			document.getElementById("div_update_operation").style.display = "none";
		},"fonction=delete&type_suppression="+type_modif+"&id="+id_operation_courante);
}

function lancer_arret(){
	glasspane();
	document.getElementById("div_arreter").style.display = "block";
}

function annuler_arret(){
	remove_glasspane();
	document.getElementById("div_arreter").style.display = "none";	
}

function arret(){
	var date_fin = document.getElementById('txt_date');

	if(date_fin.value != "" && controle_date(date_fin.value)){
		ajax.post(url,function(msg){
			var div_liste = document.getElementById("div_liste_operation");
			div_liste.getElementsByTagName("ul")[0].innerHTML = "";
			div_liste.getElementsByTagName("ul")[0].innerHTML = msg;
			annuler_arret();
			document.getElementById("div_update_operation").style.display = "none";
		},"fonction=stop&date_fin="+date_fin.value+"&id="+id_operation_courante);
	}else{
		alert("La date renseignée n'est pas correcte !");
	}
}

function initialisation_bouton_modifier(){
	var liste_input = document.getElementById('tab_update_operation').getElementsByTagName('input');
	for(var i = 0;i < liste_input.length;i++){
		liste_input[i].onkeydown = function(){
			document.getElementById("btn_modifier").className = "";
			document.getElementById("btn_modifier").innerHTML = "Modifier";
		};
	}

	var liste_select = document.getElementById('tab_update_operation').getElementsByTagName('select');
	for(var i = 0;i < liste_select.length;i++){
		liste_select[i].onchange = function(){
			document.getElementById("btn_modifier").className = "";
			document.getElementById("btn_modifier").innerHTML = "Modifier";
		};
	}
}