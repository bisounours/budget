//fichier qui regroupe des fonctions js concernant les tableaux

//fonction de tri descendant
function DESC(a,b){
    a=a[1];
    b=b[1];
    if(a > b){
        return -1;
    }
    if(a < b){
        return 1;
    }
   return 0;
} 

//fonction de tri ascendant 
function ASC(a,b){
    a=a[1];
    b=b[1];
    if(a > b)
        return 1;
    if(a < b)
        return -1;
    return 0;
}
 
/* 
    fonction de tri d'un tableau HTML en donnant :
    - l'id du tableau
    - l'index de la colonne a triee
    - le sens de tri (ASC ou DESC)
    - le type de la donnee a triee (string,integer,date)
*/
function sortTable(tid, col, ord, type){
    mybody = document.getElementById(tid).getElementsByTagName('tbody')[0];
    lines = mybody.getElementsByTagName('tr');
    var sorter = new Array();
    sorter.length = 0;
    var i = -1;
    //on part de la deuxième car la premiere n'est pas a trié 
    while(lines[++i]){
        var value = lines[i].getElementsByTagName('td')[col].innerHTML.trim().replace(" ","");
        switch(type){
            case "string" :   
                value = value;
            break;
            case "integer" :   
                value = parseInt(value);
            break;
            case "date" :   
                value = new Date(value.trim().substr(6,4), value.trim().substr(3,2), value.trim().substr(0,2), 0, 0, 0, 0); 
            break;
        }
        sorter.push([lines[i],value]);
    }
    sorter.sort(eval(ord));
    j=-1;
    while(sorter[++j]){
        mybody.appendChild(sorter[j][0]);
    }
}