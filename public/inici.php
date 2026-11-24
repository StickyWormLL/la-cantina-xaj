<!DOCTYPE html>
<html lang="en">

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
    <div>
    <?php echo date("d/m") ?>
    <h2 id="ofertes_dia_tit">Ofertes del dia</h2>
    <button id="veureproductes">Veure tots els productes</button>
    <div>
        <div id="product1">
            <img>
                <p>2%</p>
                <h4>Entrepà de Llom</h4>
                <p>Rebaixes en entrepans de llom</p>
                <h3>2.94€<del>3€</del></h3>
                <button></button>
            </div>
            <div id="product2">
                <img>
                <p></p>
                <h4></h4>
                <p></p>
                <h3></h3>
                <button></button>
            </div>
            <div id="product3">
                <img>
                <p></p>
                <h4></h4>
                <p></p>
                <h3></h3>
                <button></button>
            </div>
        </div>
    </div>
    <div>
        <div>
            <p>Sobre nosaltres</p>
            <h2>La cantina del campus des de 2022</h2>
            <p>Som l'equip que obre la barra abans de la primera classe i la tanca quan acaben les últimes pràctiques.
            </p>
            <p>Cuinem aquí mateix: entrepans calents a la planxa, braves fetes al moment i brioixeria dolça i salada
                fornejada cada matí. Amb aquesta web deixes la comanda feta i la reculls sense fer cua.</p>
        </div>
        <div>
            <h3>Com funciona</h3>
            <div>
                <img>
                <p>1. Tria</p>
                <p>Entrepans, patates, brioixeria i begudes, segons l'hora del dia.</p>
            </div>
            <div>
                <img>
                <p>2. Revisa el tiquet</p>
                <p>Afegeix o treu unitats i mira el total actualitzat al moment.</p>
            </div>
            <div>
                <img>
                <p>3. Recull a la barra</p>
                <p>Deixa nom, telèfon i correu i et guardem la comanda.</p>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>