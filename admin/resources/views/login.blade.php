<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen flex flex-col">

    <!-- Header -->
    <header class="w-full bg-white shadow-md py-4 px-8 flex items-center justify-between">
        <img src="{{ asset('pictures/logoLNT.jpg') }}" alt="Logo" class="h-10">        
        <h1 class="ml-4 text-xl font-bold text-gray-800">Mon Portail Captif</h1>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center bg-login bg-cover bg-center">        
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">Connexion à votre compte gérant</h2>
            <form method="POST" action="{{ route('loginApi') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 mb-2">Nom d'utilisateur</label>
                    <input type="text" name="name" id="name" required autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 mb-2">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200">
                    Se connecter
                </button>
            </form>
        </div>
    </main>
</body>
</html>