<?php

function carregarProductes() {
    $JsonProductes = file_get_contents("../data/productes.json");
    $productes = json_decode($JsonProductes, true);
    return $productes;
} 

$llistaProductes = carregarProductes();
// PARA LLAMAR A UN PRODUCTO DETERMINADO, USAR $productes[x]['y']
// x REFIERE A NUMERO DE INDICE, y REFIERE A CATEGORIA (id,nom,preu,img) 
?>