//Fichier javascript contenant les interactions utilisateurs pour l'écran de generation de tableaux
//=================================================================================================


//VARIABLES
//=================================================================================================

var url = "./traitement/operation.php";

//EVENEMENTS
//=================================================================================================

document.getElementById("btn_generer_graphique").onclick = generer_tableau;
document.getElementById("lst_option_affichage").onchange = affichage_option;

//FONCTIONS
//=================================================================================================

function generer_tableau(){
    document.getElementById("div_tableau").innerHTML = "<img src='./image/big_loading.gif' class='loading' ></img>";
    var attr = "fonction=tableau&"+recuperation_formulaire(document.getElementById("tab_recherche_avancee"))+"&"+recuperation_formulaire(document.getElementById("tab_option_tableau"));
    ajax.post(url,function(composant){
        document.getElementById("div_tableau").innerHTML = composant;
    },attr);
}

function affichage_option(){
    if(document.getElementById("lst_option_affichage").value == "O"){
        document.getElementById("td_option_tableau").style.display = "table-cell";
    }else{
        document.getElementById("td_option_tableau").style.display = "none";
    }
}

//fonction de tri du tbaleau de resultat
function tri(event){
    sortTable("tab_resultat_tableau",event.target.dataset.index,event.target.dataset.sort,event.target.dataset.type);
    //remise à zero des tri
    var liste_div_asc = Array.prototype.slice.call(document.getElementById("tab_resultat_tableau").getElementsByClassName("mini-fleche-bas"));
    var liste_div_desc = Array.prototype.slice.call(document.getElementById("tab_resultat_tableau").getElementsByClassName("mini-fleche-haut"));
    var liste_div = liste_div_asc.concat(liste_div_desc);
    for(var i=0;i<liste_div.length;i++){
        var div = liste_div[i];
        if(event.target != div){
            div.className = "mini-fleche-haut-bas";
            div.dataset.sort = "ASC";
        }
    }
    if(event.target.dataset.sort == "DESC"){
        event.target.className = "mini-fleche-haut";
        event.target.dataset.sort = "ASC";
    }else{
        event.target.className = "mini-fleche-bas";
        event.target.dataset.sort = "DESC";
    }
}