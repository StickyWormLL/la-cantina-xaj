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
            <p>Encara no tens cap favorit. Prem el cor d'un producte per guardar-lo aquí.</p>
            <a href="compra.php" class="btn-default">Anar a comprar</a>
        <?php else: ?>

            <section class="catalegProductes">

                <?php foreach ($llistaFavorits as $producte): ?>
                    <article class="card-producte">
                        <h3 class="nom-producte"><?= $producte['nom'] ?></h3>
                        <img class="img-producte" src="<?= $producte['img'] ?>">
                        <p class="preu-producte">Preu: <?= $producte['preu'] ?> euros</p>
                        <div class="botons-producte">
                            <form method="post" action="">
                                <input type="hidden" name="id" value="<?= $producte['id'] ?>">
                                <button type="submit" class="btn-afegirCarret">Afegeix al carret</button>
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