/* Fichier contenant les fonctions pour les fenetres de dialogue generique */

/* EVENEMENT JS */
/* ========================================================================== */

/* REDEFINITION DE LA FONCTION ALERT */
/* ========================================================================== */
window.alert = function(msg){
    var alert = document.createElement("div");
    alert.id = "div_alert";
    
    var message = document.createElement("span");
    message.innerHTML = msg;
    
    var bouton = document.createElement("button");
    bouton.innerHTML = "OK";
    bouton.onclick = remove_alert;
     
    var td = document.createElement("td");
    var tr = document.createElement("tr");
    var table = document.createElement("table");
    
    td.appendChild(message);
    tr.appendChild(td);
    table.appendChild(tr);
    
    td = document.createElement("td");
    tr = document.createElement("tr");
    
    td.appendChild(bouton);
    tr.appendChild(td);
    table.appendChild(tr);
    
	alert.appendChild(table);
	glasspane();
	document.body.appendChild(alert);
}

function remove_alert(){
	document.getElementById("div_alert").parentNode.removeChild(document.getElementById("div_alert"));
	remove_glasspane();
}

/* REDEFINITION DE LA FONCTION CONFIRM */
/* ========================================================================== */

//ne redefinie pas exactement la fonction confirm
//le systeme d'attente de la reponse (gere par le navigateur) ne peut être reproduit
//creer une fonction confirm prenant trois attribut
//- le message a afficher
//- la valeur du bouton de confirmation
//- la fonction a executer en cas de confirmation
window.confirm = function(msg,nom_btn_ok,fonction_ok){
    var alert = document.createElement("div");
    alert.id = "div_confirm";
    
    var message = document.createElement("span");
    message.innerHTML = msg;
    
    var bouton_ok = document.createElement("button");
    bouton_ok.innerHTML = nom_btn_ok;
    bouton_ok.onclick = function(){
        fonction_ok.call();
        remove_confirm();
    }
    
    var bouton_cancel = document.createElement("button");
    bouton_cancel.innerHTML = "Annuler";
    bouton_cancel.onclick = remove_confirm;
    bouton_cancel.className = "btn_gris";
     
    var td = document.createElement("td");
    var tr = document.createElement("tr");
    var table = document.createElement("table");
    
    td.appendChild(message);
    tr.appendChild(td);
    table.appendChild(tr);
    
    td = document.createElement("td");
    tr = document.createElement("tr");
    
    td.appendChild(bouton_cancel);
    td.appendChild(bouton_ok);
    tr.appendChild(td);
    table.appendChild(tr);
    
    alert.appendChild(table);
    glasspane();
    document.body.appendChild(alert);
}

function remove_confirm(){
	document.getElementById("div_confirm").parentNode.removeChild(document.getElementById("div_confirm"));
    remove_glasspane();
}


/* GLASSPANE */
/* ========================================================================== */
function glasspane(){
    var glasspane = document.createElement("div");
    glasspane.id = "glasspane";
    glasspane.style = "position:fixed;width:100%;height:100%;margin:0;padding:0;top:0;left:0;opacity:0.7;background-color:black;z-index:50;";
    document.body.appendChild(glasspane);
}

function remove_glasspane(){
    document.getElementById("glasspane").parentNode.removeChild(document.getElementById("glasspane"));
}