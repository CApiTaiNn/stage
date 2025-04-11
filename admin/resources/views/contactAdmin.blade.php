<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les utilisateurs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/filter.js', 'resources/js/account.js'])    
</head>
<body class="bg-[url({{ asset('pictures/fondConnexion.jpg') }})] bg-cover bg-no-repeat h-screen flex flex-col">

    <!-- Header -->
    <header class="w-full bg-white shadow-md py-4 px-8 flex items-center justify-between">
        <img src="{{ asset('pictures/logoLNT.jpg') }}" alt="Logo" class="h-10">        
        <h1 class="ml-4 text-xl font-bold text-gray-800">Mon Portail Captif</h1>
        <div id="account-simple" class="flex flex-col items-center gap-2 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <p>Mon compte</p>
        </div>
        <div id="compte-container" class="hidden">
            <x-compte />
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <section class="flex justify-center">   
            <form action="{{ route('mailer') }}" method="post" class="w-full max-w-md m-10">
                @csrf
                <h2 class="text-center text-gray-600 font-bold m-5">Formulaire à remplir en cas de bugs sur l'application</h2>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-2/4">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="establishment">
                            Votre établissement
                        </label>
                    </div>
                    <div class="md:w-3/4">
                        <input name="establishment" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="establishment" type="text" placeholder="Lycée Notre Dame de la Paix">
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-2/4">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="mail">
                            Votre email
                        </label>
                    </div>
                    <div class="md:w-3/4">
                        <input name="mail" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="mail" type="email" placeholder="jean.dupond@gmail.com">
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-2/4">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="message">
                            Votre message
                        </label>
                    </div>
                    <div class="md:w-3/4">
                        <textarea id="message" name="message" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" placeholder="Votre message"></textarea>
                    </div>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-blue-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Envoyer le mail
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </main>
</body>
</html>