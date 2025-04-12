<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les utilisateurs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/filter.js', 'resources/js/account.js'])    
</head>
<body class="bg-[url({{ asset('pictures/fondConnexion.jpg') }})] bg-cover bg-no-repeat h-screen flex flex-col">

    <!-- Composant header -->
    <x-header />

    <!-- Main Content -->
    <main class="flex flex-row"> 
        <!-- Composant Menu réutilisable -->
        <x-menu />
        <section class="justify-center items-center flex-grow">
            <div class="flex flex-row justify-center gap-10 m-5">
                <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6 text-center">Formulaire à remplir en cas de bugs sur l'application</h2>
                    <form action="{{ route('mailer') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="establishment" class="block text-gray-700 mb-2">Etablissement</label>
                            <input type="text" name="establishment" id="establishment" required autofocus
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="mail" class="block text-gray-700 mb-2">Email</label>
                            <input type="email" name="mail" id="mail" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 mb-2">Message</label>
                            <textarea name="message" id="message" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200">
                            Envoyer le mail
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>