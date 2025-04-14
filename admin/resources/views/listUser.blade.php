<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les utilisateurs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/account.js'])    
</head>
<body class="flex flex-col">

    <!-- Composant Header -->
    <x-header />

    <!-- Main Content -->
    <main class="flex flex-row">
        <!-- Composant Menu réutilisable -->
        <x-menu />
        <section class="justify-center items-center flex-grow">
            <div class="flex flex-row justify-center gap-10 m-5">

                <form action=" {{ route('listUser') }} " method="GET">
                    @csrf
                    <!-- Barre de recherche -->
                    <div class="relative border border-gray-300 rounded-full shadow-sm max-h-11 max-w-lg">

                        <button type="submit"  
                            class="absolute left-1 top-1/2 transform -translate-y-1/2 bg-blue-600 text-white rounded-full p-2 hover:bg-blue-700 transition duration-200 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0a7.5 7.5 0 1 0-10.6 0 7.5 7.5 0 0 0 10.6 0z" />
                            </svg>
                        </button>

                        <input type="search" name="name" id="name" 
                            class="w-full px-4 py-2 pl-12  focus:outline-none placeholder-gray-400"
                            placeholder="Recherchez un nom">
                    </div>
                </form>
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
                            <th class="px-4 py-2 border border-gray-300">Nombre de connexions</th>
                            <th class="px-4 py-2 border border-gray-300">Dernière connexion</th>
                            <th class="px-4 py-2 border border-gray-300">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($users))
                            <tr>
                                <td colspan="7" class="px-4 py-2 border border-gray-300 text-center">Aucun utilisateur trouvé</td>
                            </tr>
                        @else
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300">{{ $user->getName() }}</td>
                                    <td class="px-4 py-2 border border-gray-300">{{ $user->getFirstname() }}</td>
                                    <td class="px-4 py-2 border border-gray-300">{{ $user->getEmail() }}</td>
                                    <td class="px-4 py-2 border border-gray-300">{{ $user->getPhone() }}</td>
                                    <td class="px-4 py-2 border border-gray-300">{{ $user->getNbCo() }}</td>
                                    <td class="px-4 py-2 border border-gray-300">{{ $user->getLastCo() }}</td>
                                    @if ($user->getStatus() === 1)
                                        <td class="px-4 py-2 border border-gray-300">
                                            <img src=" {{ asset('pictures/cocher.png') }} " alt="check" class="size-7">
                                        </td>
                                    @else
                                        <td class="px-4 py-2 border border-gray-300">
                                            <img src=" {{ asset('pictures/croix.png') }} " alt="cross" class="size-6">
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </article>
        </section>
    </main>
</body>
</html>