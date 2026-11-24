<?php
session_start();
require_once '../logic/funcions.php';

if (isset($_POST['accio'])) {
    $id = $_POST['id'] ?? null;

    if ($_POST['accio'] == 'afegir') {
        if ($_POST['nom'] != '' && $_POST['preu'] > 0) {
            afegirProducte($_POST['nom'], $_POST['preu'], $_POST['img']);
        }
    } elseif ($_POST['accio'] == 'preu') {
        if ($_POST['preu'] > 0) {
            canviarPreu($id, $_POST['preu']);
        }
    } elseif ($_POST['accio'] == 'eliminar') {
        eliminarProducte($id);
    }

    header("Location: admin.php");
    exit();
}

$llistaProductes = carregarProductes();
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cantina - Administració</title>
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
        <h1 class="titolPagina">Panell d'administració:</h1>

        <section class="panell">

            <h2 class="titol-panell">Afegir producte</h2>

            <form method="post" action="" class="form-panell">
                <label class="camp-panell">Nom
                    <input type="text" name="nom" required>
                </label>

                <label class="camp-panell">Preu (euros)
                    <input type="number" name="preu" step="0.05" min="0.05" required>
                </label>

                <label class="camp-panell">Imatge
                    <input type="text" name="img" placeholder="cafe.png">
                </label>

                <button type="submit" name="accio" value="afegir" class="btn-panell">Afegir</button>
            </form>

            <h2 class="titol-panell">Productes (<?= count($llistaProductes) ?>)</h2>

            <ul class="llista-panell">
                <?php foreach ($llistaProductes as $producte): ?>
                    <li class="item-panell">
                        <img class="img-panell" src="<?= $producte['img'] ?>">
                        <span class="nom-panell"><?= $producte['nom'] ?></span>

                        <form method="post" action="" class="preu-panell">
                            <input type="hidden" name="id" value="<?= $producte['id'] ?>">
                            <input type="number" name="preu" step="0.05" min="0.05" value="<?= $producte['preu'] ?>">
                            <button type="submit" name="accio" value="preu" class="btn-panell">Guardar</button>
                        </form>

                        <form method="post" action="">
                            <input type="hidden" name="id" value="<?= $producte['id'] ?>">
                            <button type="submit" name="accio" value="eliminar" class="btn-panell">Eliminar</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>

        </section>
    </div>

    <?php include '../includes/footer.php'; ?>