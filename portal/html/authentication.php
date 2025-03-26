<?php
    $orga = $_GET['orga'] ?? " ";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <ul>
            <li><img src="langue/francais.png" alt="Français" data-lang="fr"></li>
            <li><img src="langue/anglais.png" alt="Anglais" data-lang="en"></li>
        </ul>
    </header>
    <main>
        <section>
            <article id="form">
                <img src="logo/<?=$orga?>.png" alt="logo organisation">
                <h3 data-lang-fr="Formulaire d'authentification" data-lang-en="Authentification Form">Formulaire de connexion</h3>
                <form id="autForm">

                    <input type="text" name="orga" id="orga" value=<?=$orga?> hidden>

                    <label for="id" data-lang-fr="Identifiant" data-lang-en="id">Id</label>
                    <input type="text" name="id" id="id" required>

                    <label for="code">Prénom</label>
                    <input type="text" name="code" id="code" required>

                    <button id='submit' type="submit" data-lang-fr="S'authentifier" data-lang-en="Login">S'authentifier</button>
                </form>
            </article>
            <article >
                <p id="message">Un mail vous a été envoyé avec vos identifiants</p>
            </article>
        </section>
    </main>
    <script src="script.js"></script>
</body>
</html>