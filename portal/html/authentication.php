<?php
    $organisation = $_GET['orga'] ?? " ";
    $base = "BaseClientA";
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
                <img src="logo/<?=$organisation?>.png" alt="logo organisation">
                <h3 data-lang-fr="Formulaire d'authentification" data-lang-en="Authentification Form">Formulaire de connexion</h3>
                <form id="autForm">

                    <input type="text" name="base" id="base" value=<?=$base?> hidden>

                    <label for="name" data-lang-fr="Nom" data-lang-en="Name">Nom</label>
                    <input type="text" name="name" id="name" required>

                    <label for="firstname" data-lang-fr="Prénom" data-lang-en="First Name">Prénom</label>
                    <input type="text" name="firstname" id="firstname" required>

                    <button id='submit' type="submit" data-lang-fr="Recevoir mon mot de passe" data-lang-en="Receive my password">Recevoir mon mot de passe</button>
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