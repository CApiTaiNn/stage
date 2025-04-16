<?php
    //session_start();
    $orga = getenv('ORGANIZATION');
    $id_session = $_COOKIE['SESSION_ID'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>
        <ul>
            <li><img src="assets/langue/francais.png" alt="Français" data-lang="fr"></li>
            <li><img src="assets/langue/anglais.png" alt="Anglais" data-lang="en"></li>
        </ul>
    </header>
    <main>
        <section>
            <article id="form">
                <img src="assets/logo/<?=$orga?>.png" alt="logo organisation">
                <h3 data-lang-fr="Formulaire d'authentification" data-lang-en="Authentification Form">Formulaire de connexion</h3>

                <form id="autForm" action="script/auth.php" method="post">

                    <input type="text" name="orga" id="orga" value=<?=$orga?> hidden>
                    <input type="text" name="id_session" id="id_session" value=<?=$id_session?> hidden>

                    <label for="id" data-lang-fr="Identifiant" data-lang-en="Id">Identifiant</label>
                    <input type="text" name="id" id="id" required>

                    <label for="code">Code</label>
                    <input type="text" name="code" id="code" required>

                    <button id='submit' type="submit" data-lang-fr="S'authentifier" data-lang-en="Login">S'authentifier</button>
                </form>
            </article>
            <article >
                <p id="message">Un mail vous a été envoyé avec vos identifiants</p>
            </article>
            <p id="error-message" style="color: red; display: none;"></p>
        </section>
    </main>
    <script src="script/js/auth.js"></script>
</body>
</html>