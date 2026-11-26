<?php
session_start();
require_once '../logic/funcions.php';

$carret = $_SESSION['carret'] ?? [];
$errors = [];

// Quan s'envia el formulari es comproven les dades i es guarda el tiquet
if (isset($_POST['nom'])) {
    $nom = trim($_POST['nom']);
    $telefon = str_replace(' ', '', $_POST['telefon']);
    $correu = trim($_POST['correu']);
    $obs = trim($_POST['obs']);

    if (strlen($nom) < 3) {
        $errors['nom'] = "Escriu el nom i cognoms (mínim 3 lletres).";
    }
    if (!preg_match('/^[0-9]{9}$/', $telefon)) {
        $errors['telefon'] = "Ha de tenir 9 xifres.";
    }
    if (!filter_var($correu, FILTER_VALIDATE_EMAIL)) {
        $errors['correu'] = "Introdueix un correu vàlid.";
    }
    if (!isset($_POST['accepto'])) {
        $errors['accepto'] = "Has d'acceptar les condicions.";
    }

    if (empty($errors) && !empty($carret)) {
        $text = "Client: " . $nom . "\n";
        $text .= "Telèfon: " . $telefon . "\n";
        $text .= "Correu: " . $correu . "\n";
        if ($obs != '') {
            $text .= "Observacions: " . $obs . "\n";
        }
        $text .= "\n";

        $total = 0;
        $itemsTiquet = [];
        foreach ($carret as $id => $quantitat) {
            $producte = buscarProducte($id);
            $subtotal = preuFinal($producte) * $quantitat;
            $total += $subtotal;
            $text .= $quantitat . " x " . $producte['nom'];
            $text .= " - " . number_format($subtotal, 2) . " euros\n";

            $itemsTiquet[] = [
                'quantitat' => $quantitat,
                'nom' => $producte['nom'],
                'subtotal' => $subtotal,
            ];
        }
        $text .= "\nTotal: " . number_format($total, 2) . " euros";

        $fitxerTiquet = time();

        // Si no es pot guardar el tiquet no es buida el carret
        if (@file_put_contents("../data/tickets/ticket_" . $fitxerTiquet . ".txt", $text) === false) {
            $errors['tiquet'] = "No s'ha pogut guardar la comanda. Torna-ho a provar o fes-la a la barra.";
        } else {
            buidarCarret();
            $_SESSION['comandaFeta'] = [
                'num' => $fitxerTiquet,
                'data' => date('d/m/Y · H:i'),
                'nom' => $nom,
                'telefon' => $telefon,
                'correu' => $correu,
                'obs' => $obs,
                'items' => $itemsTiquet,
                'total' => $total,
            ];
            header("Location: finalitzacio.php");
            exit();
        }
    }
}

// Si la comanda s'acaba de fer es mostra el missatge una sola vegada
$comandaFeta = $_SESSION['comandaFeta'] ?? null;
unset($_SESSION['comandaFeta']);

$total = 0;
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cantina - Finalitzar la compra</title>
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
        <h1 class="titolPagina">Finalitzar la compra:</h1>

        <?php if ($comandaFeta): ?>

            <section class="finalitzacio">
                <div class="comanda-feta">
                    <h2 class="titol-finalitzacio">Comanda registrada!</h2>
                    <p>Gràcies, <?= htmlspecialchars($comandaFeta['nom']) ?>. La comanda s'ha desat correctament. Recull-la a
                        la barra i paga en el moment de la recollida.</p>
                    <div class="botons-finalitzacio">
                        <a href="inici.php" class="btn-finalitzacio">Tornar a l'inici</a>
                        <a href="compra.php" class="btn-finalitzacio">Nova comanda</a>
                    </div>
                </div>

                <aside class="tiquet-impres">
                    <div class="tiquet-impres__capcalera">
                        <strong>LA CANTINA</strong>
                        <span>Tiquet #<?= htmlspecialchars($comandaFeta['num']) ?></span>
                        <span><?= htmlspecialchars($comandaFeta['data']) ?></span>
                    </div>

                    <div class="tiquet-impres__client">
                        <p><strong>Client:</strong> <?= htmlspecialchars($comandaFeta['nom']) ?></p>
                        <p><strong>Tel:</strong> <?= htmlspecialchars($comandaFeta['telefon']) ?></p>
                        <p><strong>Correu:</strong> <?= htmlspecialchars($comandaFeta['correu']) ?></p>
                        <?php if (!empty($comandaFeta['obs'])): ?>
                            <p><strong>Obs:</strong> <?= htmlspecialchars($comandaFeta['obs']) ?></p>
                        <?php endif; ?>
                    </div>

                    <ul class="tiquet-impres__llista">
                        <?php foreach ($comandaFeta['items'] as $item): ?>
                            <li>
                                <span><?= $item['quantitat'] ?>x <?= htmlspecialchars($item['nom']) ?></span>
                                <span><?= number_format($item['subtotal'], 2) ?> €</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="tiquet-impres__totals">
                        <p>
                            <span>Base imposable</span>
                            <span><?= number_format($comandaFeta['total'] / 1.1, 2) ?> €</span>
                        </p>
                        <p>
                            <span>IVA 10%</span>
                            <span><?= number_format($comandaFeta['total'] - $comandaFeta['total'] / 1.1, 2) ?> €</span>
                        </p>
                        <p class="tiquet-impres__total">
                            <span>TOTAL</span>
                            <span><?= number_format($comandaFeta['total'], 2) ?> €</span>
                        </p>
                    </div>

                    <p class="tiquet-impres__peu">--- GRÀCIES PER LA TEVA COMANDA ---</p>
                </aside>
            </section>

        <?php elseif (empty($carret)): ?>

            <section class="finalitzacio">
                <p class="finalitzacio-buit">El teu tiquet està buit. Afegeix algun producte abans de finalitzar la
                    compra.</p>
                <a href="compra.php" class="btn-finalitzacio">Anar a comprar</a>
            </section>

        <?php else: ?>

            <section class="finalitzacio">

                <div class="tiquet">
                    <h2 class="titol-finalitzacio">Tiquet de compra</h2>
                    <p class="data-tiquet"><?= date('d/m/Y · H:i') ?></p>

                    <ul class="llista-tiquet">
                        <?php foreach ($carret as $id => $quantitat): ?>
                            <?php
                            $producte = buscarProducte($id);
                            $subtotal = preuFinal($producte) * $quantitat;
                            $total += $subtotal;
                            ?>
                            <li class="item-tiquet">
                                <span class="quantitat-tiquet"><?= $quantitat ?>x</span>
                                <span class="nom-tiquet"><?= $producte['nom'] ?></span>
                                <span><?= number_format($subtotal, 2) ?> euros</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <p class="fila-tiquet"><span>Base imposable</span><span><?= number_format($total / 1.1, 2) ?>
                            euros</span></p>
                    <p class="fila-tiquet"><span>IVA 10%</span><span><?= number_format($total - $total / 1.1, 2) ?>
                            euros</span></p>
                    <p class="total-tiquet"><span>Total</span><span><?= number_format($total, 2) ?> euros</span></p>

                    <a href="carrito.php" class="btn-finalitzacio">Modificar la comanda</a>
                </div>

                <form method="post" action="" class="form-finalitzacio">
                    <h2 class="titol-finalitzacio">Les teves dades</h2>
                    <p class="text-finalitzacio">Les fem servir només per avisar-te quan la comanda estigui llesta.
                        Camps obligatoris *</p>

                    <?php if (isset($errors['tiquet'])): ?>
                        <p class="error-finalitzacio"><?= $errors['tiquet'] ?></p>
                    <?php elseif (!empty($errors)): ?>
                        <p class="error-finalitzacio">Revisa els camps marcats, hi ha dades que falten o no són
                            correctes.</p>
                    <?php endif; ?>

                    <label class="camp-finalitzacio">Nom i cognoms *
                        <input type="text" name="nom" placeholder="Ex. Laia Puig Serra"
                            value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">
                        <?php if (isset($errors['nom'])): ?>
                            <span class="error-camp"><?= $errors['nom'] ?></span>
                        <?php endif; ?>
                    </label>

                    <div class="fila-camps">
                        <label class="camp-finalitzacio">Telèfon *
                            <input type="tel" name="telefon" placeholder="600 000 000"
                                value="<?= htmlspecialchars($_POST['telefon'] ?? '') ?>">
                            <?php if (isset($errors['telefon'])): ?>
                                <span class="error-camp"><?= $errors['telefon'] ?></span>
                            <?php endif; ?>
                        </label>
                        <label class="camp-finalitzacio">Correu electrònic *
                            <input type="email" name="correu" placeholder="nom@correu.cat"
                                value="<?= htmlspecialchars($_POST['correu'] ?? '') ?>">
                            <?php if (isset($errors['correu'])): ?>
                                <span class="error-camp"><?= $errors['correu'] ?></span>
                            <?php endif; ?>
                        </label>
                    </div>

                    <label class="camp-finalitzacio">Observacions (opcional)
                        <textarea name="obs" rows="2" maxlength="140"
                            placeholder="Ex. sense ceba, llet de civada…"><?= htmlspecialchars($_POST['obs'] ?? '') ?></textarea>
                    </label>

                    <label class="check-finalitzacio">
                        <input type="checkbox" name="accepto" <?= isset($_POST['accepto']) ? 'checked' : '' ?>>
                        <span>He llegit i accepto les <a href="condicions.php" target="_blank">condicions legals i la
                                política de privacitat</a>.</span>
                    </label>
                    <?php if (isset($errors['accepto'])): ?>
                        <span class="error-camp"><?= $errors['accepto'] ?></span>
                    <?php endif; ?>

                    <div class="botons-finalitzacio">
                        <a href="carrito.php" class="btn-finalitzacio">Tornar</a>
                        <button type="submit" class="btn-finalitzacio">Confirmar la comanda</button>
                    </div>
                </form>

            </section>

        <?php endif; ?>
    </div>
    <?php include '../includes/footer.php'; ?>