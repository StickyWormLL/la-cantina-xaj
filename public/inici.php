<?php
session_start();
require_once '../logic/funcions.php';

// Quan es prem "Afegeix al carret" en una oferta
if (isset($_POST['id'])) {
    afegirAlCarret($_POST['id']);
    header("Location: inici.php");
    exit();
}

$ofertes = ofertesDelDia();
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cantina - Inici</title>
    <link rel="icon" type="image/svg+xml" href="../assets/img/favicon.svg">
    <style href="/frontend/src/scss/main.css"></style>
    <script type="module" src="http://localhost:5173/@vite/client">
    </script>
    <script type="module" src="http://localhost:5173/src/js/main.js">
    </script>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div id="carrousel">
        <div class="carousel-container">
            <div class="carousel-images">
                <img src="../assets/img/products/carrousel_bocadillo_jamon.jpg" alt="Imagen 1">
                <img src="../assets/img/products/carrousel_empanada_atun.jpg" alt="Imagen 2">
                <img src="../assets/img/products/carrousel_coca_cola.jpg" alt="Imagen 3">
                <img src="../assets/img/products/carrousel_cafe.jpg" alt="Imagen 4">
                <img src="../assets/img/products/carrousel_panini_atun.jpg" alt="Imagen 5">
                <img src="../assets/img/products/carrousel_croissant.jpg" alt="Imagen 6">
                <img src="../assets/img/products/carrousel_bocadillo_jamon.jpg" alt="Imagen 7">
            </div>
            <div id="carousel-text">
                <p><b>Esmorzar, dinar i berenar sense fer cua.</b></p>
            </div>
        </div>
    </div>

    <div class="container">
        <section class="ofertes">
            <div class="cap-ofertes">
                <h2 id="ofertes_dia_tit" class="titol-inici">Ofertes del dia</h2>
                <a href="compra.php" id="veureproductes" class="btn-inici">Veure tots els productes</a>
            </div>

            <div class="llista-ofertes">
                <?php foreach ($ofertes as $i => $producte): ?>
                    <article id="product<?= $i + 1 ?>" class="card-producte">
                        <h3 class="nom-producte"><?= $producte['nom'] ?></h3>
                        <img class="img-producte" src="<?= $producte['img'] ?>" alt="<?= $producte['nom'] ?>">
                        <p class="preu-producte">
                            <span class="preu-antic"><?= number_format($producte['preu'], 2) ?> euros</span>
                            <span class="preu-oferta"><?= number_format($producte['preu'] * 0.8, 2) ?> euros</span>
                        </p>
                        <form method="post" action="">
                            <input type="hidden" name="id" value="<?= $producte['id'] ?>">
                            <button type="submit" class="btn-afegirCarret">Afegeix al carret</button>
                        </form>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="nosaltres">
            <div class="text-nosaltres">
                <h2 class="titol-inici titol-nosaltres">La cantina del campus des de 2022</h2>
                <p>Som l'equip que obre la barra abans de la primera classe i la tanca quan acaben les últimes
                    pràctiques.</p>
                <p>Cuinem aquí mateix: entrepans calents a la planxa, braves fetes al moment i brioixeria dolça i
                    salada fornejada cada matí. Amb aquesta web deixes la comanda feta i la reculls sense fer cua.</p>
                <a href="compra.php" class="btn-inici">Fer una comanda</a>
            </div>

            <div class="passos">
                <h3 class="titol-passos">Com funciona</h3>
                <div class="pas">
                    <span class="num-pas">1</span>
                    <div>
                        <p class="nom-pas">Tria</p>
                        <p>Entrepans, patates, brioixeria i begudes, segons l'hora del dia.</p>
                    </div>
                </div>
                <div class="pas">
                    <span class="num-pas">2</span>
                    <div>
                        <p class="nom-pas">Revisa el tiquet</p>
                        <p>Afegeix o treu unitats i mira el total actualitzat al moment.</p>
                    </div>
                </div>
                <div class="pas">
                    <span class="num-pas">3</span>
                    <div>
                        <p class="nom-pas">Recull a la barra</p>
                        <p>Deixa nom, telèfon i correu i et guardem la comanda.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include '../includes/footer.php'; ?>