<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1">
    <title>Projecte PHP</title>
    <script type="module" src="http://localhost:5173/@vite/client">
    </script>
    <script type="module" src="http://localhost:5173/src/js/main.js">
    </script>
    <link rel="stylesheet" href="../frontend/src/scss/main.css">
</head>

<?php include '../includes/header.php'; ?>

<body>
    <h1>Projecte PHP + Vite</h1>
        <div class="carousel-container">
            <div class="carousel-images">
                <img src="../assets/img/products/bocadillo_jamon.png" alt="Imagen 1">
                <img src="../assets/img/products/empanada_atun.png" alt="Imagen 2">
                <img src="../assets/img/products/lata_coca_cola.png" alt="Imatge 3">
                <img src="../assets/img/products/cafe.png" alt="Imatge 4">
                <img src="../assets/img/products/panini_atun.png" alt="Imagen 5">
                <img src="../assets/img/products/croissant.png" alt="Imagen 6">
                <img src="../assets/img/products/bocadillo_jamon.png" alt="imagen 7">
            </div>
        </div>
    <?php
    echo "<p>Contingut generat amb PHP</p>";
    ?>
</body>

<?php include '../includes/footer.php'; ?>

</html>