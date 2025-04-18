<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les erreurs</title>
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
            <article class="flex justify-center mt-10">
                <table class="table-fixed border-collapse border border-gray-400">
                    <caption class="text-3xl m-2">Listes des échecs de connexion</caption>
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">Nom</th>
                            <th class="px-4 py-2 border border-gray-300">Prénom</th>
                            <th class="px-4 py-2 border border-gray-300">Email</th>
                            <th class="px-4 py-2 border border-gray-300">Téléphone</th>
                            <th class="px-4 py-2 border border-gray-300">Nombre d'échecs</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($users))
                            <tr>
                                <td colspan="5" class="px-4 py-2 border border-gray-300 text-center">Aucun utilisateur trouvé</td>
                            </tr>
                        @else
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 text-center">{{ $user->getName() }}</td>
                                    <td class="px-4 py-2 border border-gray-300 text-center">{{ $user->getFirstname() }}</td>
                                    <td class="px-4 py-2 border border-gray-300 text-center">{{ $user->getEmail() }}</td>
                                    <td class="px-4 py-2 border border-gray-300 text-center">{{ $user->getPhone() }}</td>
                                    <td class="px-4 py-2 border border-gray-300 text-center">{{ $user->getNbError() }}</td>
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