<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1">
    <title>Projecte PHP</title>
    <!-- Vite en desenvolupament -->
    <!--
        Connexió amb el client de Vite.
        Permet activar HMR (Hot Module Replacement), que detecta
        els canvis en els fitxers JavaScript i Sass i actualitza
        automàticament els recursos al navegador durant el
        desenvolupament.
    -->
    <script type="module" src="http://localhost:5173/@vite/client">
    </script>
    <!--
        Carrega el fitxer JavaScript principal del projecte.
        Vite processa aquest fitxer i també els mòduls que importa.
        Si main.js importa un fitxer Sass, Vite també el compila
        i injecta els estils a la pàgina.
    -->
    <script type="module" src="http://localhost:5173/src/js/main.js">
    </script>
</head>

<body>
    <h1>Projecte PHP + Vite</h1>
    <?php
    echo "<p>Contingut generat amb PHP</p>";
    ?>
</body>

</html>