<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])    
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
    <main class="flex flex-row">
        <aside class="aside bg-blue-500 text-white h-screen flex flex-col transition-all duration-300 hover:w-48 w-16 group">

        <!-- Menu -->
            <nav class="flex-grow">
                <ul class="flex flex-col gap-4 p-4">
                    <!-- Lien Accueil -->
                    <li>
                        <a href="{{ route('home') }}" id="home" class="flex items-center gap-4 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                                <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                                <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                            </svg>
                            <span class="hidden group-hover:inline text-sm font-medium">Accueil</span>
                        </a>
                    </li>

                    <!-- Lien Utilisateurs -->
                    <li>
                        <a href="{{ route('listUser') }}" id="users" class="flex items-center gap-4 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                                <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                            </svg>
                            <span class="hidden group-hover:inline text-sm font-medium">Utilisateurs</span>
                        </a>
                    </li>

                    <!-- Lien Sessions -->
                    <li>
                        <a href="{{ route('listUser') }}" id="sessions" class="flex items-center gap-4 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                                <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                            </svg>
                            <span class="hidden group-hover:inline text-sm font-medium">Sessions</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
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