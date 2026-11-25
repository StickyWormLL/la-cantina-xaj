<?php
session_start();
require_once '../logic/funcions.php';

if (isset($_POST['accio'])) {
    $id = $_POST['id'] ?? null;

    if ($_POST['accio'] == 'sumar') {
        afegirAlCarret($id);
    } elseif ($_POST['accio'] == 'restar') {
        treureUnDelCarret($id);
    } elseif ($_POST['accio'] == 'treure') {
        eliminarDelCarret($id);
    } elseif ($_POST['accio'] == 'buidar') {
        buidarCarret();
    }

    header("Location: carrito.php");
    exit();
}

$carret = $_SESSION['carret'] ?? [];
$total = 0;
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cantina - El teu carret</title>
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
        <h1 class="titolPagina">El teu carret:</h1>

        <section class="carret">

            <?php if (empty($carret)): ?>
                <p class="carret-buit">El carret està buit.</p>
                <a href="compra.php" class="btn-default">Anar a comprar</a>
            <?php else: ?>

                <ul class="llista-carret">
                    <?php foreach ($carret as $id => $quantitat): ?>
                        <?php
                        $producte = buscarProducte($id);
                        $subtotal = preuFinal($producte) * $quantitat;
                        $total += $subtotal;
                        ?>
                        <li class="item-carret">
                            <img class="img-carret" src="<?= $producte['img'] ?>">
                            <span class="nom-carret"><?= $producte['nom'] ?></span>

                            <form method="post" action="" class="quantitat-carret">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <button type="submit" name="accio" value="restar" class="btn-default">-</button>
                                <span><?= $quantitat ?></span>
                                <button type="submit" name="accio" value="sumar" class="btn-default">+</button>
                            </form>

                            <span class="preu-carret"><?= number_format($subtotal, 2) ?> euros</span>

                            <form method="post" action="">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <button type="submit" name="accio" value="treure" class="btn-default">Treure</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <p class="total-carret">Total: <?= number_format($total, 2) ?> euros</p>

                <div class="botons-carret">
                    <a href="compra.php" class="btn-default">Seguir comprant</a>
                    <form method="post" action="">
                        <button type="submit" name="accio" value="buidar" class="btn-default">Buidar carret</button>
                    </form>
                    <a href="finalitzacio.php" class="btn-default">Finalitzar compra</a>
                </div>

            <?php endif; ?>

        </section>
    </div>
    <?php include '../includes/footer.php'; ?>