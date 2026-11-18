<?php 
include '../includes/header.php'; 
require_once '../logic/funcions.php';
$llistaProductes = carregarProductes();
?>

<h1>Tots els nostres productes:</h1>

<section class="catalegProductes">

    <?php foreach ($llistaProductes as $producte): ?>
        <article class="card-producte">
            <h3 class="nom-producte"><?= $producte['nom'] ?></h3>
            <img class="img-producte" src="<?= $producte['img']?>">
            <p class="preu-producte">Preu: <?= $producte['preu'] ?> euros</p>
            <button class="btn-afegirCarret">Afegeix al carret</button>
        </article>
    <?php endforeach; ?>
    
</section>

<?php include '../includes/footer.php'; ?>

</body>
</html>