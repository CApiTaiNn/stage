<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[url({{ asset('pictures/fond-connexion.avif') }})] bg-cover bg-no-repeat h-screen flex flex-col">

    <!-- Header -->
    <header class="w-full bg-white shadow-md py-4 px-8 flex items-center">
        <img src="{{ asset('pictures/logoLNT.jpg') }}" alt="Logo" class="h-10">        
        <h1 class="ml-4 text-xl font-bold text-gray-800">Mon Application</h1>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center">
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">Home</h2>
            <p>{{ session('name') }}</p>
        </div>
    </main>
</body>
</html>