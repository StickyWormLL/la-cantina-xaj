<?php
// Inici de sessió
// Importar funció i inciar sessió local (cookies)
require_once '../logic/funcions.php';
session_start();
//variable error per si falla omplir-la i mostrar-la a la pàgina
$error = "";

// Validació de l'usuari i contrasenya que passa per el json, si és correcte redirigeix a la pàgina de compra, si no mostra un missatge d'error
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $password = $_POST['contrasenya'] ?? '';
    $llistaUsuaris = carregarUsuaris(); // Carrega la llista d'usuaris de funcions.php on es llegeix el fitxer JSON

    foreach ($llistaUsuaris as $usuaris) { // Itera sobre cada usuari del JSON per comprovar si coincideix amb les credencials introduïdes
        if ($usuaris['username'] === $user && $usuaris['contrasenya'] === $password) {
            $_SESSION['usuari'] = $usuaris['username'];
            header('Location: compra.php');  // Redirigeix a la pàgina de compra si les credencials són correctes
            exit;
        }
    }

    $error = "Usuari o contrasenya incorrectes. Torna-ho a provar."; // Assigna un missatge d'error si les credencials no coincideixen amb cap usuari del JSON

}
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cantina - Login</title>
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
        <h1 class="titolPagina">Accés al sistema</h1>

        <section class="admin">
            <p class="admin-text">Només per al personal de la cantina.</p>
            <!-- Mostra l'error si n'hi ha -->
            <?php if ($error): ?>
                <p><?= $error ?></p>
            <?php endif; ?>

            <form method="POST" action="" class="form-admin">
                <label class="camp-admin">Usuari
                    <input type="text" name="username" autocomplete="username" required>
                </label>

                <label class="camp-admin">Contrasenya
                    <input type="password" name="contrasenya" autocomplete="current-password" required>
                </label>

                <label class="check-admin">
                    <input type="checkbox" name="recorda">
                    Recorda'm en aquest dispositiu
                </label>

                <div class="botons-admin">
                    <a href="inici.php" class="btn-admin">Tornar a la botiga</a>
                    <button type="submit" class="btn-admin">Entrar</button>
                </div>
            </form>

            <p class="admin-demo">Demo: exemple124 / 67contrasenya</p>
        </section>
    </div>

    <?php include '../includes/footer.php'; ?>