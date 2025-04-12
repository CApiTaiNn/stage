<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/account.js'])    
</head>
<body class="bg-cover bg-no-repeat h-screen flex flex-col">
    
    <!-- Composant header -->
    <x-header />

    <!-- Main Content -->
    <main class="flex flex-row">

        <!-- Composant Menu réutilisable -->
        <x-menu />

        <!-- Contenu principal -->
        <section class="grid grid-cols-5 grid-rows-4 gap-4 p-4 w-full">
            <article class="col-start-1  col-end-3 row-start-1 row-end-2 border-2 rounded-lg shadow-md bg-white">
                <h4 class="text-center text-2xl font-bold bg-blue-500 text-white py-2 rounded-t-lg">Actuellement</h4>
                <hr>
                <p class="text-center py-4 text-2xl">Il y a {{ $currentSession }} connectés</p>
            </article>

            <article class="col-start-4 col-end-6 row-start-1 row-end-2 border-2 rounded-lg shadow-md bg-white">
                <h4 class="text-center text-2xl font-bold bg-blue-500 text-white py-2 rounded-t-lg">Aujourd'hui</h4>
                <hr>
                <p class="text-center py-4 text-2xl">Il y a eu {{ $daySession }} connexions</p>
            </article>

            <article class="col-start-2 col-end-5 row-start-2 row-end-5 border-2 rounded-lg shadow-md bg-white">
                <h4 class="text-center text-2xl font-bold bg-blue-500 text-white py-2 rounded-t-lg">10 derniers utilisateurs connectés</h4>
                <hr>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Prénom</th>
                            <th class="px-4 py-2">Heure</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lastSession as $session)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-2">{{ $session['name'] }}</td>
                                <td class="px-4 py-2">{{ $session['firstname'] }}</td>
                                <td class="px-4 py-2">{{ $session['time'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </article>
        </section>
    </main>
    <footer>
        <nav>
            <ul>
                <li>Copyright : Sloan</li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </nav>
    </footer>
</body>
</html>