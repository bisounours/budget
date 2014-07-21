/*
	Fichier contenant des fonctions utiles dans le traitement 
	des formulaires.
*/

//Fonction permettant la recuperation des inputs des éléments HTML sous forme name = valeur
//Utile dans l'envoie d'un formulaire en ajax
function recuperation_formulaire(formulaire){
	var argument = "";
	var liste_input = formulaire.getElementsByTagName("input");
	for(var i=0;i < liste_input.length;i++){
		var input = liste_input[i];
		switch(input.type){
			case "text" :	
				argument += input.name + "=" + encodeURIComponent(input.value.trim()) + "&";
				break;
			case "hidden" :	
				argument += input.name + "=" + encodeURIComponent(input.value.trim()) + "&";
				break;
			case "checkbox":
				if(input.checked){
					if(input.value != ""){
						argument += input.name + "=" + encodeURIComponent(input.value.trim()) + "&";
					}else{
						argument += input.name + "=" + input.checked + "&";
					}
				}	
				break;
			case "radio":
				if(input.checked){
					if(input.value != ""){
						argument += input.name + "=" + encodeURIComponent(input.value.trim()) + "&";
					}else{
						argument += input.name + "=" + input.checked + "&";
					}
				}
				break;
			case "password" :	
				argument += input.name + "=" + encodeURIComponent(input.value.trim()) + "&";
				break;
		}
	}
	var liste_select = formulaire.getElementsByTagName("select");
	for(var i=0;i < liste_select.length;i++){
		var select = liste_select[i];
		if(select.multiple){
			var liste_option = "";
		    for(j=0;j<select.options.length;j++)
		    { 
		        if (select.options[j].selected)
		        { 
		            liste_option += select.options[j].value + ",";
		        }
		    }
		    argument += select.name + "=" + liste_option + "&";
		}else{
		    var val = select.value != "WONoSelectionString" ? select.value : ""; 
			argument += select.name + "=" + val + "&";
		}
	}
	var liste_textarea = formulaire.getElementsByTagName("textarea");
	for(var i=0;i < liste_textarea.length;i++){
		var textarea = liste_textarea[i];
		argument += textarea.name + "=" + textarea.text + "&";
	}
	argument = argument.substr(0,argument.length -1);
	return argument;
}

//Fonction controlant les elements inputs d'un element html en fonction de l'attribut data
function controle_formulaire(formulaire){
	var liste_input = formulaire.getElementsByTagName("input");
	for(var i=0;i < liste_input.length;i++){
		var input = liste_input[i];
		switch(input.dataset.type){
			case "string" :	
				
				break;
			case "integer" :	
				if(input.value.trim() != "" && !controle_integer(input.value)){
					alert(input.dataset.label+" doit être un nombre entier");
					return false;
				}
				break;
			case "double":
				if(input.value.trim() != "" && !controle_double(input.value)){
					alert(input.dataset.label+" doit être un nombre<br>Exemple : 1.25, 2, 4.1");
					return false;
				}	
				break;
			case "date":
				if(input.value.trim() != "" && !controle_date(input.value)){
					alert(input.dataset.label+" doit être saisie sous la forme JJ/MM/AAAA");
					return false;
				}
				break;
			case "mail" :	
				if(input.value.trim() != "" && !controle_mail(input.value)){
					alert(input.dataset.label+" doit être saisie sous la forme ...@...");
					return false;
				}
				break;
			case "hour" :    
                if(input.value.trim() != "" && !controle_hour(input.value)){
                    alert(input.dataset.label+" doit être un nombre compris en 00 et 23");
                    return false;
                }
                break;
            case "minute" :   
                if(input.value.trim() != "" && !controle_minute(input.value)){
                    alert(input.dataset.label+" doit être un nombre compris en 00 et 59");
                    return false;
                }
                break;
            case "jour" :   
                if(input.value.trim() != "" && !controle_jour(input.value)){
                    alert(input.dataset.label+" doit être un nombre compris en 01 et 31");
                    return false;
                }
                break;
            case "mois" :   
                if(input.value.trim() != "" && !controle_mois(input.value)){
                    alert(input.dataset.label+" doit être un nombre compris en 01 et 12");
                    return false;
                }
                break;
		}
		if(input.type != "checkbox" && input.type != "radio" && !input.dataset.nullable && document.defaultView.getComputedStyle(input,null).display != "none" && document.defaultView.getComputedStyle(input,null).visibility != "hidden" && input.value.trim() == ""){
            alert(input.dataset.label+" est obligatoire");
            return false;
        }

		try{
			var input_equal = document.getElementById(input.dataset.equal);
			if(input.value != input_equal.value){
				alert(input.dataset.label+" et "+input_equal.dataset.label+" doivent être identiques");
				return false;
			}
        }catch(err){
        }
        
        try{
            var input_link_required = document.getElementById(input.dataset.linkRequired);
            if(input_link_required.value.trim() != "" && input.value.trim() == ""){
                alert(input.dataset.label+" doit renseigné(e) lorsque "+input_link_required.dataset.label+" est renseigné(e)");
                return false;
            }
        }catch(err){
        }
            
        try{
		    var input_link_nullable = document.getElementById(input.dataset.linkNullable);
		    if(input.value.trim() != "" && input_link_nullable.value.trim() == ""){
		        alert(input.dataset.label+" ne peut être renseigné(e) que si "+input_link_nullable.dataset.label+" est renseigné(e)");
		        return false;
		    }
        }catch(err){
        }
	}
	return true;
}


//Fonction de controle des champs de type double
function controle_double(value){
	var regex = new RegExp("^-{0,1}[0-9]{1,}[.,]{0,1}[0-9]*$");
	return regex.test(value);
}

//Fonction de controle des champs de type integer
function controle_integer(value){
	var regex = new RegExp("^[0-9]{1,}$");
	return regex.test(value);
}

//Fonction de controle des champs de type date
function controle_date(value){
	var regex = new RegExp("^[0-9]{2}/[0-9]{2}/[0-9]{4}$");
	return regex.test(value);
}

//Fonction de controle des champs de type mail
function controle_mail(value){
	var regex = new RegExp("^.+@.+$");
	return regex.test(value);
}

//Fonction de controle des champs de type heure
function controle_hour(value){
    var regex = new RegExp("^[0-2][0-9]$");
    return regex.test(value);
}

//Fonction de controle des champs de type minute
function controle_minute(value){
    var regex = new RegExp("^[0-5][0-9]$");
    return regex.test(value);
}

//Fonction de controle des champs de type jour
function controle_jour(value){
    var regex = new RegExp("^[0-9]{1,2}$");
    return regex.test(value) && value > 0 && value < 32;
}

//Fonction de controle des champs de type mois
function controle_mois(value){
    var regex = new RegExp("^[0-9]{1,2}$");
    return regex.test(value) && value > 0 && value < 13;
}