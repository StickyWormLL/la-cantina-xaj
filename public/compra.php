<?php 
include '../includes/header.php'; 
require_once '../logic/funcions.php';
$llistaProductes = carregarProductes();
?>

<h1>Tots els nostres productes:</h1>

    <section class="catalegProductes">
    <?php foreach ($llistaProductes as $producte): ?>
        <article class="card">
            <h3><?= $producte['nom'] ?></h3>
            <p>Preu: <?= $producte['preu'] ?></p>
        </article>
    <?php endforeach; ?>
</section>
    </section>
<?php include '../includes/footer.php'; ?>