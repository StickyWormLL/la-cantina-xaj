<?php
// El header mostra quants productes hi ha al carret
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../logic/funcions.php';
?>

<header class="header">
    <div class="container header__inner">
        <a href="inici.php" class="logo">
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
                <button class="icon-btn" id="theme-toggle"><img src="../assets/img/icons/dark_mode.svg"
                        alt="Dark" /></button>
                <a href="favorits.php" class="icon-btn"><img src="../assets/img/icons/favorite.svg"
                        alt="Favorits" /></a>
                <a href="carrito.php" class="btn">
                    <img src="../assets/img/icons/shopping_bag.svg" alt="Shooping" />Tiquet <?= quantitatCarret() ?>
                </a>
                <button class="icon-btn menu-toggle" id="menu-toggle">Menu</button>
            </div>
        </nav>
    </div>
</header>