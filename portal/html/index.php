<?php
    $organisation = $_GET['orga'] ?? " ";
    $base = "BaseClientA";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portail de connexion</title>
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
                <h3 data-lang-fr="Formulaire de connexion" data-lang-en="Login Form">Formulaire de connexion</h3>
                <form id="loginForm">

                    <input type="text" name="base" id="base" value=<?=$base?> hidden>

                    <label for="nom" data-lang-fr="Nom" data-lang-en="Name">Nom</label>
                    <input type="text" name="nom" id="nom" required>

                    <label for="prenom" data-lang-fr="Prénom" data-lang-en="First Name">Prénom</label>
                    <input type="text" name="prenom" id="prenom" required>

                    <label for="email" data-lang-fr="Email" data-lang-en="Email">Email</label>
                    <input type="email" name="email" id="email">
                    <p data-lang-fr="Vous recevrez sur cette email vos identifiants de connexion" data-lang-en="You will receive your login credentials on this email">Vous recevrez sur cette email vos identifiants de connexion</p>

                    <label for="telephone" data-lang-fr="Téléphone" data-lang-en="Phone">Téléphone</label>
                    <input type="text" name="telephone" id="telephone" required>

                    <div class="cgu">
                        <input type="checkbox" name="cgu" id="cgu" required>
                        <label for="cgu" data-lang-fr="J'accepte les conditions générales d'utilisations" data-lang-en="I accept the terms and conditions">J'accepte les conditions générales d'utilisations</label>
                    </div>

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