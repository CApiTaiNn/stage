<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation de l'A2F</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen flex flex-col">

    <!-- Composant header -->
    <x-header />
    
    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center bg-login bg-cover bg-center">        
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('a2f') }}" method="GET">
                @csrf
                <h2 class="text-2xl font-bold mb-6 text-center">Double authentification</h2>
                <p class="text-center">Scannez ce QR code avec FreeOTP</p>
                <img src="{{ $qrCode }}" alt="QR Code">
                
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200">
                    Étape suivante
                </button>            
            </form>
        </div>
    </main>
</body>
</html>