<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Hello</h1>
    <ul>
        @foreach ($article as $a)
            <li>{{ $a['title'] }}, {{ $a['content'] }}</li>
        @endforeach
    </ul>
</body>
</html>