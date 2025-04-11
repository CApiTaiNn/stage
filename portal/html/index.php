<?php
    $orga = $_GET['orga'] ?? " ";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portail de connexion</title>
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
                <div>
                    <h3 data-lang-fr="Formulaire de connexion" data-lang-en="Login Form">Formulaire de connexion</h3>
                    <img src="assets/images/wifi.png" alt="wifi">
                </div>
                <form id="loginForm">

                    <input type="text" name="orga" id="orga" value=<?=$orga?> hidden>

                    <label for="name" data-lang-fr="Nom" data-lang-en="Name">Nom</label>
                    <input type="text" name="name" id="name" required>

                    <label for="firstname" data-lang-fr="Prénom" data-lang-en="First Name">Prénom</label>
                    <input type="text" name="firstname" id="firstname" required>

                    <label for="email" data-lang-fr="Email" data-lang-en="Email">Email</label>
                    <input type="email" name="email" id="email">
                    <p data-lang-fr="Vous recevrez sur cette email vos identifiants de connexion" data-lang-en="You will receive your login credentials on this email">Vous recevrez sur cette email vos identifiants de connexion</p>

                    <label for="phone" data-lang-fr="Téléphone" data-lang-en="Phone">Téléphone</label>
                    <input type="text" name="phone" id="phone" required>

                    <div class="cgu">
                        <input type="checkbox" name="cgu" id="cgu" required>
                        <label for="cgu" data-lang-fr="J'accepte les conditions générales d'utilisations" data-lang-en="I accept the terms and conditions">J'accepte les conditions générales d'utilisations</label>
                    </div>

                    <button id='submit' type="submit" data-lang-fr="Recevoir mon mot de passe" data-lang-en="Receive my password">Recevoir mon mot de passe</button>
                </form>
            </article>
        </section>
    </main>
    <script src="script/portail.js"></script>
</body>
</html>