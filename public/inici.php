<?php
session_start();
require_once '../logic/funcions.php';

// Quan es prem "Afegeix al carret" en una oferta
if (isset($_POST['id'])) {
    afegirAlCarret($_POST['id']);
    header("Location: inici.php");
    exit();
}

// Quan es prem el cor s'afegeix o es treu de favorits
if (isset($_POST['favorit'])) {
    canviarFavorit($_POST['favorit']);
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
    <section class="carrusel">
        <div class="carrusel__imatges">
            <img class="carrusel__imatge" src="../assets/img/products/carrousel_bocadillo_jamon.jpg" alt="Entrepà de pernil">
            <img class="carrusel__imatge" src="../assets/img/products/carrousel_empanada_atun.jpg" alt="Empanada de tonyina">
            <img class="carrusel__imatge" src="../assets/img/products/carrousel_coca_cola.jpg" alt="Coca-Cola">
            <img class="carrusel__imatge" src="../assets/img/products/carrousel_cafe.jpg" alt="Cafè">
            <img class="carrusel__imatge" src="../assets/img/products/carrousel_panini_atun.jpg" alt="Panini de tonyina">
            <img class="carrusel__imatge" src="../assets/img/products/carrousel_croissant.jpg" alt="Croissant">
            <img class="carrusel__imatge" src="../assets/img/products/carrousel_bocadillo_jamon.jpg" alt="" aria-hidden="true">
        </div>
        <p class="carrusel__text">Esmorzar, dinar i berenar sense fer cua.</p>
    </section>

    <div class="container">
        <section class="ofertes">
            <div class="ofertes__capcalera">
                <h2 class="titolPagina">Ofertes del dia</h2>
                <a href="compra.php" class="btn-default">Veure tots els productes</a>
            </div>

            <div class="catalegProductes">
                <?php foreach ($ofertes as $producte): ?>
                    <article class="card-producte<?= esOferta($producte['id']) ? ' card-oferta' : '' ?>">
                        <?php if (esOferta($producte['id'])): ?>
                            <span class="etiqueta-oferta">-<?= DESCOMPTE_OFERTA * 100 ?>%</span>
                        <?php endif; ?>
                        <img class="img-producte" src="<?= $producte['img'] ?>" alt="<?= $producte['nom'] ?>">
                        <h3 class="nom-producte"><?= $producte['nom'] ?></h3>
                        <p class="preu-producte">
                            <?php if (esOferta($producte['id'])): ?>
                                <span class="preu-antic"><?= number_format($producte['preu'], 2) ?> €</span>
                            <?php endif; ?>
                            <?= number_format(preuFinal($producte), 2) ?> €
                        </p>
                        <div class="botons-producte">
                            <form method="post" action="">
                                <input type="hidden" name="id" value="<?= $producte['id'] ?>">
                                <button type="submit" class="btn-default">Afegeix al carret</button>
                            </form>
                            <form method="post" action="">
                                <input type="hidden" name="favorit" value="<?= $producte['id'] ?>">
                                <button type="submit" class="btn-favorit">
                                    <?php if (esFavorit($producte['id'])): ?>
                                        <img src="../assets/img/icons/favorite-fill.svg" alt="Treure de favorits">
                                    <?php else: ?>
                                        <img src="../assets/img/icons/favorite.svg" alt="Afegir a favorits">
                                    <?php endif; ?>
                                </button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="nosaltres">
            <div>
                <h2 class="nosaltres__titol">La cantina del campus des de 2022</h2>
                <p class="nosaltres__text">Som l'equip que obre la barra abans de la primera classe i la tanca quan
                    acaben les últimes pràctiques.</p>
                <p class="nosaltres__text">Cuinem aquí mateix: entrepans calents a la planxa, braves fetes al moment i
                    brioixeria dolça i salada fornejada cada matí. Amb aquesta web deixes la comanda feta i la reculls
                    sense fer cua.</p>
                <div class="nosaltres__accions">
                    <a href="compra.php" class="btn-default">Fer una comanda</a>
                </div>
            </div>

            <div class="passos">
                <h3 class="passos__titol">Com funciona</h3>
                <div class="passos__pas">
                    <span class="passos__numero">1</span>
                    <div>
                        <p class="passos__nom">Tria</p>
                        <p class="passos__descripcio">Entrepans, patates, brioixeria i begudes, segons l'hora del dia.</p>
                    </div>
                </div>
                <div class="passos__pas">
                    <span class="passos__numero">2</span>
                    <div>
                        <p class="passos__nom">Revisa el tiquet</p>
                        <p class="passos__descripcio">Afegeix o treu unitats i mira el total actualitzat al moment.</p>
                    </div>
                </div>
                <div class="passos__pas">
                    <span class="passos__numero">3</span>
                    <div>
                        <p class="passos__nom">Recull a la barra</p>
                        <p class="passos__descripcio">Deixa nom, telèfon i correu i et guardem la comanda.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include '../includes/footer.php'; ?>