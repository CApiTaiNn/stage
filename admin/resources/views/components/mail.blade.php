<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Mail reçu depuis {{ env('APP_NAME') }} </h2>
    <ul>
        <li><strong>Nom</strong> : {{ session('name') }}</li>
        <li><strong>Etablissement</strong> : {{ $contact['establishment'] }}</li>
        <li><strong>Email</strong> : {{ $contact['mail'] }}</li>
        <li><strong>Message</strong> : {{ $contact['message'] }}</li>
    </ul>
  </body>
</html>