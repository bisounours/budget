//Fichier javascript contenant les interactions utilisateurs dans la page de statistique graphique
//=================================================================================================

//VARIABLES
//=================================================================================================

//EVENEMENTS
//=================================================================================================

window.addEventListener('load', function() {
    Highcharts.setOptions({
        lang:{
            months: ["Janvier", "Fevrier", "Mars", "Avril","Mai","Juin", "Juillet", "Aout","Septembre","Octobre","Novembre","Decembre"],
            weekdays: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
            thousandsSep: ' '
        }
    });

    document.getElementById("lst_type_graphique").onchange = filtre_graphique;
});

//FONCTIONS
//=================================================================================================

//Filtrage des options en fonction du type de graphique
function filtre_graphique(){
    var type_graphique = document.getElementById("lst_type_graphique").value;

    var lst_option_x = document.getElementById('lst_option_x');
    var lst_option_y = document.getElementById('lst_option_y');

    var lbl_option_x = document.getElementById('lbl_option_x');
    var lbl_option_y = document.getElementById('lbl_option_y');

    var option_x_date = document.getElementById('option_x_date');
    var option_x_categorie = document.getElementById('option_x_categorie');
    var option_x_compte = document.getElementById('option_x_compte');
    var option_x_mois = document.getElementById('option_x_mois');
    var option_x_annee = document.getElementById('option_x_annee');

    if(type_graphique == 'L'){
        lst_option_x.style.visibility = "visible";
        lst_option_y.style.visibility = "visible";
        lbl_option_x.style.visibility = "visible";
        lbl_option_y.style.visibility = "visible";

        option_x_date.style.display = "";
        option_x_mois.style.display = "";
        option_x_annee.style.display = "";
        option_x_categorie.style.display = "none";
        if(option_x_compte){
            option_x_compte.style.display = "none";
        }
        
        lst_option_x.selectedIndex = 0;               
    }else if(type_graphique == 'H'){
        lst_option_x.style.visibility = "visible";
        lst_option_y.style.visibility = "visible";
        lbl_option_x.style.visibility = "visible";
        lbl_option_y.style.visibility = "visible";

        option_x_date.style.display = "";
        option_x_mois.style.display = "";
        option_x_annee.style.display = "";
        option_x_categorie.style.display = "";
        if(option_x_compte){
            option_x_compte.style.display = "";
        }
        
        lst_option_x.selectedIndex = 0;
    }else{
        lst_option_x.style.visibility = "hidden";
        lst_option_y.style.visibility = "hidden";
        lbl_option_x.style.visibility = "hidden";
        lbl_option_y.style.visibility = "hidden";

        option_x_date.style.display = "";
        option_x_mois.style.display = "";
        option_x_annee.style.display = "";
        option_x_categorie.style.display = "";
        if(option_x_compte){
            option_x_compte.style.display = "";
        }
        
        lst_option_x.selectedIndex = 0;
    }
}

function generer_graphique(){
    document.getElementById("div_graphique").innerHTML = "<img src='./image/big_loading.gif' class='loading' ></img>";

    var formulaire_recherche_avance = document.getElementById("tab_recherche_avancee");
    var formulaire_type_graphique = document.getElementById("liste_graphique");
    var formulaire_option_graphique = document.getElementById("tab_option_graphique");

    var attr = "fonction=graphique&"+recuperation_formulaire(formulaire_recherche_avance)+"&"+recuperation_formulaire(formulaire_type_graphique)+"&"+recuperation_formulaire(formulaire_option_graphique);

    console.log(attr);

    var url = "./traitement/operation.php";
    ajax.post(url,function(json){
         eval(json);
    },attr);
}