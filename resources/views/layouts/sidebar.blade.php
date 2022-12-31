<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center" id="siteLogo">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                </a>
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 hidden sm:flex items-center" id="sidemenutoggle">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-400 bg-gray-800 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" id="toggleIcon" width="1em" height="1em"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m15 4l-8 8l8 8" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<div class="sidenav">
    <x-sidenav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        <span class="iconify" data-icon="mingcute:dashboard-2-line"></span>
        <p class="sidelinktext">Dashboard</p>
    </x-sidenav-link>
    <hr class="my-1">
    <x-sidenav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
        <span class="iconify" data-icon="material-symbols:category"></span>
        <p class="sidelinktext">Categories</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('galleries.index')" :active="request()->routeIs('galleries.*')">
        <span class="iconify" data-icon="material-symbols:gallery-thumbnail-rounded"></span>
        <p class="sidelinktext">Galleries</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('trades.index')" :active="request()->routeIs('trades.*')">
        <span class="iconify" data-icon="material-symbols:home-repair-service-rounded"></span>
        <p class="sidelinktext">Trades</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('packages.index')" :active="request()->routeIs('packages.*')">
        <span class="iconify" data-icon="bxs:package"></span>
        <p class="sidelinktext">Packages</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('cruises.index')" :active="request()->routeIs('cruises.*')">
        <span class="iconify" data-icon="fluent-emoji-high-contrast:ship"></span>
        <p class="sidelinktext">Cruise</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('subscribers.index')" :active="request()->routeIs('subscribers.*')">
        <span class="iconify" data-icon="mdi:user-details"></span></span>
        <p class="sidelinktext">Subscriber</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('quaries.all')" :active="request()->routeIs('quaries.*')">
        <span class="iconify" data-icon="mdi:message-badge"></span></span>
        <p class="sidelinktext">Quaries</p>
    </x-sidenav-link>
    <x-sidenav-link href="https://lancoptt.com/webmail" target="_blank">
        <span class="iconify" data-icon="material-symbols:attach-email"></span>
        <p class="sidelinktext">Webmail</p>
    </x-sidenav-link>
    <hr class="my-1">
    <x-sidenav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
        <span class="iconify" data-icon="ph:users"></span>
        <p class="sidelinktext">Users</p>
    </x-sidenav-link>


    <x-sidenav-link :href="route('permissions.index')" :active="request()->routeIs('permissions.*')">
        <span class="iconify" data-icon="fluent:key-20-regular"></span>
        <p class="sidelinktext">Permissions</p>
    </x-sidenav-link>
    <x-sidenav-link :href="route('roles.index')" :active="request()->routeIs('roles.*')">
        <span class="iconify" data-icon="fluent:phone-key-24-regular"></span>
        <p class="sidelinktext">Roles</p>
    </x-sidenav-link>
    <hr class="my-1">
    <x-sidenav-link :href="route('settings.index')" :active="request()->routeIs('settings.*')">
        <span class="iconify" data-icon="icon-park-outline:setting-two"></span>
        <p class="sidelinktext">Settings</p>
    </x-sidenav-link>
</div>
