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
        @if (auth()->user()->role == "equip_directiu" || auth()->user()->role == "administracio")

        <li>
            <a href="{{ route("centers.index") }}" class="{{ request()->is('centers*') ? "menu-option-selected" : "menu-option" }}">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-center"></use>
                </svg>
                <span class="menu-text hidden">Centres</span>
            </a>
        </li>
        @endif
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
        @if (auth()->user()->role == "equip_directiu" || auth()->user()->role == "administracio")
            <li>
                <a href="{{ route("general-services.index") }}" class="{{ request()->is('general-services*') ? "menu-option-selected" : "menu-option" }}">
                    <svg class="w-7 h-7">
                        <use xlink:href="#icon-knife"></use>
                    </svg>
                    <span class="menu-text hidden text-nowrap">Serveis generals</span>
                </a>
            </li>
        @endif
        <li>
            <a href="{{ route("external-contacts.index") }}" class="{{ request()->is('external-contacts*') ? "menu-option-selected" : "menu-option" }}">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-conctact"></use>
            </svg>
                <span class="menu-text hidden text-nowrap">Contactes externs</span>
            </a>
        </li>
        <li>
            <a href="{{ route("documents.index") }}" class="{{ request()->is('documents*') ? "menu-option-selected" : "menu-option" }}">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-document"></use>
            </svg>
                <span class="menu-text hidden text-nowrap">Documents</span>
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
        @if (auth()->user()->role == "equip_directiu")
            <li>
                <a href="{{ route("rrhh.index") }}" class="{{ request()->is('rrhh*') ? "menu-option-selected" : "menu-option" }}">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-group-user"></use>
                </svg>
                    <span class="menu-text hidden text-nowrap">Temes pendents RRHH</span>
                </a>
            </li>
        @endif
        <li>
            <a href="{{ route("maintenance.index") }}" class="{{ request()->is('maintenance*') ? "menu-option-selected" : "menu-option" }}">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-wrench-screwdriver"></use>
            </svg>
                <span class="menu-text hidden text-nowrap">Manteniments</span>
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
        <img src="{{ asset("images/vallparadis-logo.svg") }}" alt="vallparadis-logo" class="md:w-36 lg:w-56 mr-10 hidden md:block">
        <img src="{{ asset("images/logo.svg") }}" alt="vallparadis-logo" class="w-10 md:hidden">
    </a>

    <form action="{{ route("general-search") }}" method="get" id="general-search" class="w-[65%] relative hidden items-center gap-2 border border-[#E6E5DE] rounded-lg h-10 md:flex bg-[#FFF9F6] p-5 dark:bg-neutral-800 dark:border-neutral-600">
        <button type="submit" class="cursor-pointer">
            <svg class="w-6 h-6 dark:text-neutral-400">
                <use xlink:href="#icon-search"></use>
            </svg>
        </button>
        <input type="search" name="search" id="search" placeholder="Cercar professionals, documents..." class="pl-2 w-full h-10 outline-0 dark:text-slate-400">
        <div id="general-results" class="bg-white rounded-b-lg border-b border-t-none border-2 border-x border-[#E6E5DE] w-full absolute top-9 right-0 px-3 pb-3 max-h-90 overflow-y-auto hidden">
        </div>
    </form>

    <div class="w-auo md:w-[25%] flex flex-row items-center justify-end gap-5 px-2 md:px-5">
        <div class=" w-auto flex items-center gap-2 relative">
            <button data-dropdown-content-id="navbarLinks" class="bg-[#FF7E13] hover:bg-[#FE712B] p-2 text-white rounded-lg flex items-center justify-center font-bold gap-2 mr-5 cursor-pointer">
                <svg class="w-4 h-4 md:w-6 md:h-6">
                    <use xlink:href="#icon-dots"></use>
                </svg>
            </button>
            <div id="navbarLinks" class="absolute top-12 right-0 min-w-70 bg-white shadow-lg border border-[#AFAFAF] p-2 rounded-lg dark:bg-neutral-800 z-1 hidden">
                <!-- Cambiar de modo -->
                <button type="button" id="theme-toggle" class="flex items-center w-full cursor-pointer dark:hover:bg-yellow-600/16 hover:bg-slate-600/16 rounded-lg p-2">
                    <div class="flex items-center gap-2">
                        <svg class="w-7 h-7 text-slate-500 block dark:hidden">
                            <use xlink:href="#icon-moon"></use>
                        </svg>
                        <p class="text-slate-500 dark:hidden">Fosc</p>
                    </div>
                    <div class="flex items-center rounded-lg font-semibold cursor-pointer gap-4 w-full">
                        <svg class="w-7 h-7 text-yellow-600 hidden dark:block">
                            <use xlink:href="#icon-sun"></use>
                        </svg>
                        <p class="text-yellow-600 hidden dark:block">Clar</p>
                    </div>
                </button>
                @if (auth()->user()->role == "equip_directiu")
                    <form action="{{ route("users.switchCenter") }}" method="post" class="mt-2">
                        @csrf
                        <select name="center_id" class="border border-[#AFAFAF] dark:bg-neutral-800 dark:text-white rounded-lg w-full cursor-pointer p-2" onchange="this.form.submit()">
                            @foreach ($selectable_centers as $center)
                                <option value="{{ $center->id }}" {{ session("active_center_id") == $center->id ? "selected" : "" }}>{{ $center->name }}</option>
                            @endforeach
                        </select>
                    </form>
                @endif
            </div>
        </div>
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