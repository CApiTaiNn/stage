<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste utilisateurs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/filter.js'])    
</head>
<body class="bg-[url({{ asset('pictures/fond-connexion.avif') }})] bg-cover bg-no-repeat h-screen flex flex-col">

    <!-- Header -->
    <header class="w-full bg-white shadow-md py-4 px-8 flex items-center justify-between">
        <img src="{{ asset('pictures/logoLNT.jpg') }}" alt="Logo" class="h-10">        
        <h1 class="ml-4 text-xl font-bold text-gray-800">Mon Portail Captif</h1>
        <a href="" class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <p>Mon compte</p>
        </a>
    </header>

    <!-- Main Content -->
    <main>
    <section>
        <div class="flex flex-row justify-center gap-10 m-5">
            <!-- Barre de recherche -->
            <div class="relative border border-gray-300 rounded-full shadow-sm max-h-11 max-w-lg">

                <button type="submit"  
                    class="absolute left-1 top-1/2 transform -translate-y-1/2 bg-blue-600 text-white rounded-full p-2 hover:bg-blue-700 transition duration-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0a7.5 7.5 0 1 0-10.6 0 7.5 7.5 0 0 0 10.6 0z" />
                    </svg>
                </button>

                <input type="search" name="nom" id="nom" 
                    class="w-full px-4 py-2 pl-12  focus:outline-none placeholder-gray-400"
                    placeholder="Recherchez un nom">

                <button id="filter-button"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-800 p-2 hover:text-gray-600 transition duration-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>
                </button>

            </div>

            <!-- Filtre -->
            <div id="filter-form" class="hidden">
                <div class="flex flex-col ">
                    <caption>Sélectionner une période :</caption>
                    <div class="flex flex-row justify-start items-center p-1">
                        <input type="date" name="date-start" id="date-start" class="border border-gray-300 rounded-md px-4 py-2">
                            <p class="m-2">à</p>
                        <input type="date" name="date-end" id="date-end" class="border border-gray-300 rounded-md px-4 py-2">
                    </div>
                </div>
                <div class="flex flex-col">
                    <caption class="p-1">Sélectionner une plage horaire :</caption>
                    <div class="flex flex-row justify-start items-center p-1">
                        <input type="time" name="time-start" id="time-start" value="00:00" class="border border-gray-300 rounded-md px-4 py-2">
                        <p class="m-2">à</p>
                        <input type="time" name="time-end" id="time-end" value="00:00" class="border border-gray-300 rounded-md px-4 py-2">
                    </div>
                </div>
            </div>
        </div>
        <article class="flex justify-center mt-10">
            <table class="table-fixed border-collapse border border-gray-400">
                <caption class="text-3xl m-2">Listes des utilisateurs du portail</caption>
                <thead>
                    <tr>
                        <th class="px-4 py-2 border border-gray-300">Nom</th>
                        <th class="px-4 py-2 border border-gray-300">Prénom</th>
                        <th class="px-4 py-2 border border-gray-300">Email</th>
                        <th class="px-4 py-2 border border-gray-300">Téléphone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->getName() }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->getFirstname() }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->getEmail() }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $user->getName() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </article>
    </section>
    </main>
</body>
</html>