<?php

function carregarProductes() {
    $JsonProductes = file_get_contents("../data/productes.json");
    $productes = json_decode($JsonProductes, true);


} 

?>