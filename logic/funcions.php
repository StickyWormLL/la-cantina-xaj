<?php

function carregarProductes()
{
    $JsonProductes = file_get_contents("../data/productes.json");
    $productes = json_decode($JsonProductes, true);
    return $productes;
}

/*
    PRIMERO HAY QUE IMPORTAR LA FUNCIÓN Y CARGARLA DENTRO DE UNA VARIABLE PARA RECORRERLA
    PARA LLAMAR A UN PRODUCTO DETERMINADO, USAR $productes[x]['y']
    x REFIERE A NUMERO DE INDICE, y REFIERE A CATEGORIA (id,nom,preu,img)
*/

/*
    CARRET
    EL CARRET ES GUARDA A LA SESSIÓ: $_SESSION['carret'][id] = quantitat
    CAL FER session_start() ABANS DE FER SERVIR AQUESTES FUNCIONS
*/

function buscarProducte($id)
{
    $productes = carregarProductes();
    foreach ($productes as $producte) {
        if ($producte['id'] == $id) {
            return $producte;
        }
    }
    return null;
}

function afegirAlCarret($id)
{
    if (buscarProducte($id) == null) {
        return;
    }
    if (!isset($_SESSION['carret'][$id])) {
        $_SESSION['carret'][$id] = 0;
    }
    $_SESSION['carret'][$id]++;
}

function treureUnDelCarret($id)
{
    if (!isset($_SESSION['carret'][$id])) {
        return;
    }
    $_SESSION['carret'][$id]--;
    if ($_SESSION['carret'][$id] <= 0) {
        unset($_SESSION['carret'][$id]);
    }
}

function eliminarDelCarret($id)
{
    unset($_SESSION['carret'][$id]);
}

function buidarCarret()
{
    $_SESSION['carret'] = [];
}

function quantitatCarret()
{
    if (!isset($_SESSION['carret'])) {
        return 0;
    }
    return array_sum($_SESSION['carret']);
}

/*
    FAVORITS
    ES GUARDEN A LA SESSIÓ COM UNA LLISTA D'IDS: $_SESSION['favorits'] = [1, 4, 7...]
*/

function esFavorit($id)
{
    return in_array($id, $_SESSION['favorits'] ?? []);
}

// Si ja és favorit el treu, si no ho és l'afegeix
function canviarFavorit($id)
{
    if (buscarProducte($id) == null) {
        return;
    }
    if (!isset($_SESSION['favorits'])) {
        $_SESSION['favorits'] = [];
    }
    if (esFavorit($id)) {
        $_SESSION['favorits'] = array_diff($_SESSION['favorits'], [$id]);
    } else {
        $_SESSION['favorits'][] = $id;
    }
}

function carregarFavorits()
{
    $favorits = [];
    foreach (carregarProductes() as $producte) {
        if (esFavorit($producte['id'])) {
            $favorits[] = $producte;
        }
    }
    return $favorits;
}

function guardarProductes($productes)
{
    $json = json_encode(array_values($productes), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    file_put_contents("../data/productes.json", $json);
}

function afegirProducte($nom, $preu, $img)
{
    $productes = carregarProductes();
    $nouId = 1;
    foreach ($productes as $producte) {
        if ($producte['id'] >= $nouId) {
            $nouId = $producte['id'] + 1;
        }
    }
    $productes[] = [
        "id" => $nouId,
        "nom" => $nom,
        "preu" => (float) $preu,
        "img" => "../assets/img/products/" . $img
    ];
    guardarProductes($productes);
}

function canviarPreu($id, $preu)
{
    $productes = carregarProductes();
    foreach ($productes as $i => $producte) {
        if ($producte['id'] == $id) {
            $productes[$i]['preu'] = (float) $preu;
        }
    }
    guardarProductes($productes);
}

function eliminarProducte($id)
{
    $productes = carregarProductes();
    foreach ($productes as $i => $producte) {
        if ($producte['id'] == $id) {
            unset($productes[$i]);
        }
    }
    guardarProductes($productes);
}

/*
    OFERTES DEL DIA
    ES TRIEN 4 PRODUCTES A L'ATZAR, PERÒ SEMPRE ELS MATEIXOS DURANT TOT EL DIA
*/

function ofertesDelDia()
{
    $productes = carregarProductes();
    srand((int) date('Ymd'));
    shuffle($productes);
    srand();
    return array_slice($productes, 0, 4);
}

// Descompte que s'aplica als productes en oferta (20%)
const DESCOMPTE_OFERTA = 0.2;

function esOferta($id)
{
    foreach (ofertesDelDia() as $oferta) {
        if ($oferta['id'] == $id) {
            return true;
        }
    }
    return false;
}

// Preu que es cobra: amb descompte si el producte està en oferta
function preuFinal($producte)
{
    if (esOferta($producte['id'])) {
        return round($producte['preu'] * (1 - DESCOMPTE_OFERTA), 2);
    }
    return $producte['preu'];
}

// USUARIS
function carregarUsuaris()
{
    $JsonUsuaris = file_get_contents("../data/users.json");
    $usuaris = json_decode($JsonUsuaris, true);
    return $usuaris['users'];
}

?>