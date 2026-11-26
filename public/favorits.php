<?php
session_start();
require_once '../logic/funcions.php';

if (isset($_POST['id'])) {
    afegirAlCarret($_POST['id']);
    header("Location: favorits.php");
    exit();
}

if (isset($_POST['favorit'])) {
    canviarFavorit($_POST['favorit']);
    header("Location: favorits.php");
    exit();
}

$llistaFavorits = carregarFavorits();
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cantina - Favorits</title>
    <link rel="icon" type="image/svg+xml" href="../assets/img/favicon.svg">
    <style href="/frontend/src/scss/main.css"></style>
    <script type="module" src="http://localhost:5173/@vite/client">
    </script>
    <script type="module" src="http://localhost:5173/src/js/main.js">
    </script>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div class="container">
        <h1 class="titolPagina">Els teus favorits:</h1>
        <?php if (empty($llistaFavorits)): ?>
            <div class="container-empty">
            <p>Encara no tens cap favorit. Prem el cor d'un producte per guardar-lo aquí.</p>
            <button href="compra.php" class="btn-default">Anar a comprar</button></div>
            <?php else: ?>
            <section class="catalegProductes">

                <?php foreach ($llistaFavorits as $producte): ?>
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
                                    <img src="../assets/img/icons/favorite-fill.svg" alt="Treure de favorits">
                                </button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>

            </section>

        <?php endif; ?>
    </div>

    <?php include '../includes/footer.php'; ?>