<?php

function carregarProductes() {
    $JsonProductes = file_get_contents("../data/productes.json");
    $productes = json_decode($JsonProductes, true);
    return $productes;
} 

/*  
    PRIMERO HAY QUE IMPORTAR LA FUNCIÓN Y CARGARLA DENTRO DE UNA VARIABLE PARA RECORRERLA
    PARA LLAMAR A UN PRODUCTO DETERMINADO, USAR $productes[x]['y']
    x REFIERE A NUMERO DE INDICE, y REFIERE A CATEGORIA (id,nom,preu,img) 
*/

?>