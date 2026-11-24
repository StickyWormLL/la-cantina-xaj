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
        <h1 class="titolPagina">Accés d'administració</h1>

        <section class="admin">
            <p class="admin-text">Només per al personal de la cantina.</p>

            <form method="post" action="" class="form-admin">
                <label class="camp-admin">Usuari
                    <input type="text" name="usuari" autocomplete="username" required>
                </label>

                <label class="camp-admin">Contrasenya
                    <input type="password" name="pass" autocomplete="current-password" required>
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

            <p class="admin-demo">Demo: admin / cantina</p>
        </section>
    </div>

    <?php include '../includes/footer.php'; ?>