<nav class="border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 xl:px-0">
        <a href="/" class="flex items-center">
            <x-application-logo />
            <span class="self-center text-2xl font-semibold whitespace-nowrap">e-commerce</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 rounded-lg md:flex-row md:space-x-8 md:mt-0">
                <li>
                    <a href="/" class="block py-2 pl-3 pr-4 text-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-700 md:p-0">Accueil</a>
                </li>
                <li>
                    <a href="/products" class="block py-2 pl-3 pr-4 text-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-700 md:p-0">Articles</a>
                </li>
                <li>
                    <a style="filter: opacity(0.5);" class="block py-2 pl-3 pr-4 text-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-700 md:p-0">A propos de nous</a>
                </li>
                <li>
                    <a href="/basket" class="block py-2 pl-3 pr-4 text-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-700 md:p-0">Panier</a>
                </li>
                @guest
                <li>
                    <a href="/login" class="block py-2 pl-3 pr-4 text-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-700 md:p-0">Se connecter</a>
                </li>
                @endguest
                @auth
                <li>
                    <a href="/user-profile" class="block py-2 pl-3 pr-4 text-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-700 md:p-0">Mon compte</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
