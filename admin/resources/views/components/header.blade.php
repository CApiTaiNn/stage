<header class="w-full bg-white shadow-md py-4 px-8 flex items-center justify-between">
    <img src="{{ asset('pictures/logoLNT.jpg') }}" alt="Logo" class="h-10">        
    <h1 class="ml-4 text-xl font-bold text-gray-800">Mon Portail Captif</h1>
    <div id="account-simple" class="flex flex-col items-center cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        <p>Mon compte</p>
    </div>
    <div id="compte-container" class="hidden">
        <x-compte />
    </div>
</header>