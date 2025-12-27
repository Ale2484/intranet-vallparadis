<!-- Menu lateral -->
<nav id="sidebar" class="bg-white h-full p-5 shadow-sm hidden md:flex flex-col items-start fixed top-0 left-0 z-10 w-20 transition-[width] duration-300 dark:bg-neutral-900 border-r border-transparent dark:border-neutral-600">
    <ul class="flex flex-col gap-3">
        <li class="mb-5 pt-1 flex items-end justify-end">
            <button id="toggleMenu" class="p-2 group cursor-pointer">
                <svg class="w-7 h-7 text-[#FF7E13]">
                    <use xlink:href="#icon-no-line-arrow"></use>
                </svg>
            </button>
        </li>
        <li>
            <a href="{{ route("dashboard") }}" class="{{ request()->routeIs('dashboard') ? "menu-option-selected" : "menu-option" }}">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-house"></use>
                </svg>
                <span class="menu-text hidden">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route("users.index") }}" class="{{ request()->is('users*') ? "menu-option-selected" : "menu-option" }}">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-users"></use>
                </svg>
                <span class="menu-text hidden">Professionals</span>
            </a>
        </li>
        <li>
            <a href="{{ route("centers.index") }}" class="{{ request()->is('centers*') ? "menu-option-selected" : "menu-option" }}">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-center"></use>
                </svg>
                <span class="menu-text hidden">Centres</span>
            </a>
        </li>
        <li>
            <a href="{{ route("projects.index") }}" class="{{ request()->is('projects*') ? "menu-option-selected" : "menu-option" }}">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-folder"></use>
            </svg>
                <span class="menu-text hidden text-nowrap">Projectes/Comissions</span>
            </a>
        </li>
        <li>
            <a href="{{ route("courses.index") }}" class="{{ request()->is('courses*') ? "menu-option-selected" : "menu-option" }}">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-book"></use>
            </svg>
                <span class="menu-text hidden text-nowrap">Cursos</span>
            </a>
        </li>
        <li>
            <a href="{{ route("general-services.index") }}" class="{{ request()->is('general-services*') ? "menu-option-selected" : "menu-option" }}">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-knife"></use>
                </svg>
                <span class="menu-text hidden text-nowrap">Serveis generals</span>
            </a>
        </li>
        <li>
            <a href="{{ route("external-contacts.index") }}" class="{{ request()->is('external-contacts*') ? "menu-option-selected" : "menu-option" }}">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-conctact"></use>
            </svg>
                <span class="menu-text hidden text-nowrap">Serveis generals</span>
            </a>
        </li>
        <li>
            <a href="{{ route("complementary-services.index") }}" class="{{ request()->is('complementary-services*') ? "menu-option-selected" : "menu-option" }}">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-services"></use>
            </svg>
                <span class="menu-text hidden text-nowrap">Serveis complementaris</span>
            </a>
        </li>

    </ul>
</nav>

<!-- Menu superior -->
<div class="bg-white flex flex-row items-center justify-between gap-2 w-full p-2 shadow-sm md:pl-28 dark:bg-neutral-900 border border-transparent dark:border-neutral-600">
    <button id="toggleMenu" class="p-2 group cursor-pointer border border-[#ffe7de] rounded-lg md:hidden">
        <svg class="w-7 h-7 text-[#FF7E13]">
            <use xlink:href="#icon-no-line-arrow"></use>
        </svg>
    </button>
    <button class="hidden">
            <svg class="w-6 h-6 dark:text-neutral-400">
                <use xlink:href="#icon-search"></use>
            </svg>
    </button>

    <a href="{{ route("dashboard") }}" class="text-center absolute left-[45%] md:static md:text-left">
        <img src="{{ asset("images/vallparadis-logo.svg") }}" alt="vallparadis-logo" class="w-56 mr-10 hidden md:block">
        <img src="{{ asset("images/logo.svg") }}" alt="vallparadis-logo" class="w-10 md:hidden">
    </a>
    <form action="#" method="post" class="w-[65%] hidden items-center gap-2 border border-[#E6E5DE] rounded-lg h-10 md:flex bg-[#FFF9F6] p-5 dark:bg-neutral-800 dark:border-neutral-600">
        @csrf
        <button type="submit" class="cursor-pointer">
            <svg class="w-6 h-6 dark:text-neutral-400">
                <use xlink:href="#icon-search"></use>
            </svg>
        </button>

        <input type="search" name="search" id="search" placeholder="Buscar professionals , documents...." class="pl-2 w-full h-10 outline-0 dark:text-slate-400">
    </form>

    <div class="w-auo md:w-[25%] flex flex-row items-center justify-end gap-5 px-2 md:px-5">
        <!-- Cambiar de modo -->
        <button type="button" id="theme-toggle" class="mr-5 cursor-pointer">
            <svg class="w-7 h-7 text-slate-500 block dark:hidden">
                <use xlink:href="#icon-moon"></use>
            </svg>
            <svg class="w-7 h-7 text-yellow-200 hidden dark:block">
                <use xlink:href="#icon-sun"></use>
            </svg>
        </button>

        <div class="flex flex-row items-center gap-5 ">
            <a href="{{ route("users.show", auth()->user()->id) }}" class="flex items-center gap-5">
                @if (!auth()->user()->profile_photo_path)
                    <minidenticon-svg username="{{ md5(auth()->user()->id) }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full"></minidenticon-svg>
                @else
                    <div class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full">
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full object-cover">
                    </div>
                @endif
                <div class="hidden lg:block">
                    <p class="font-bold dark:text-white">{{ auth()->user()->name}}</p>
                </div>
            </a>
        </div>
    </div>
</div>