<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de productes</title>
    <style href="/frontend/src/scss/main.css"></style>
    <script type="module" src="http://localhost:5173/@vite/client">
    </script>
    <script type="module" src="http://localhost:5173/src/js/main.js">
    </script>
</head>
<body>
    
<header class="header">
    <div class="container header__inner">
        <a href="/inici.php" class="logo">
            <img src="../assets/img/logos/logo-simbol.svg" class="logo__mark" />
            <span class="logo__text">
                <span class="logo__name">La Cantina</span>
            </span>
        </a>

        <nav class="nav">
            <ul class="nav__list" id="menu">
                <li><a href="inici.php" class="nav__link">Inici</a></li>
                <li><a href="compra.php" class="nav__link">Comprar</a></li>
            </ul>
            <div class="nav__actions">
                <button class="icon-btn" id="theme-toggle">Dark</button>
                <a href="favorits.php" class="icon-btn"><img src="../assets/img/shopping_bag.svg" /></a>
                <a href="compra.php" class="btn">Tiquet 0</a>
                <button class="icon-btn menu-toggle" id="menu-toggle">Menu</button>
            </div>
        </nav>
    </div>
</header>