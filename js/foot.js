//Fichier javascript contenant les interactions utilisateurs commun a toutes les pages
//=================================================================================================

//VARIABLES
//=================================================================================================

//EVENEMENTS
//=================================================================================================

window.addEventListener('load', function() {
	var liste_cache_detail = document.getElementsByClassName("cache_detail");
	for (var i=0; i<liste_cache_detail.length;i++) {
		var cache = liste_cache_detail[i];
		cache.onclick = function(event){
			cache_detail(event)
		};	
	}

	var liste_affiche_detail = document.getElementsByClassName("affiche_detail");
	for (var i=0; i<liste_affiche_detail.length;i++) {
		var cache = liste_affiche_detail[i];
		cache.onclick = function(event){
			affiche_detail(event);
		}	
	}

	var liste_input = document.getElementsByTagName("input");
	for (var i=0; i<liste_input.length;i++) {
		var input = liste_input[i];
		if(input.dataset.type == "date"){
			input.onkeyup = function(event){
				formater_date(event);
			}
			eval('datePickerController.createDatePicker({formElements:{'+input.id+' : "%d/%m/%Y"},statusFormat:"%l %d %F %Y"});');
		}
	}	
});

//FONCTIONS
//=================================================================================================

function cache_detail(event){
	document.getElementById(event.target.dataset.detail).style.display = "none";
	event.target.className = "affiche_detail";
	event.target.onclick = function(event){
			affiche_detail(event);
	}	
}

function affiche_detail(event){
	document.getElementById(event.target.dataset.detail).style.display = "";
	event.target.className = "cache_detail";
	event.target.onclick = function(event){
			cache_detail(event);
	}
}

function formater_date(event){
	var date = event.target.value;
	if(date.length == 8 && controle_integer(date)){
		event.target.value = date.substr(0,2)+"/"+date.substr(2,2)+"/"+date.substr(4,4);
	}
}