<!-- Menu lateral -->
<nav id="sidebar" class="bg-white h-screen p-5 shadow-sm flex flex-col items-start fixed top-0 left-0 z-10 w-20 transition-[width] duration-300">
    <ul class="flex flex-col gap-3 ">
        <li class="mb-5 pt-1 flex items-end justify-end">
            <button id="toggleMenu" class="p-2 group cursor-pointer">
                <svg class="w-7 h-7 text-[#0F172A]">
                    <use xlink:href="#icon-no-line-arrow"></use>
                </svg>
            </button>
        </li>
        <li>
            <a href="{{ route("dashboard") }}" class="{{ request()->routeIs('dashboard') ? "menu-option-selected" : "menu-option" }}">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-house"></use>
                </svg>
                <span class="menu-text hidden ">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route("centers.index") }}" class="{{ request()->is('centers*') ? "menu-option-selected" : "menu-option" }}">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-center"></use>
                </svg>
                <span class="menu-text hidden">Centers</span>
            </a>
        </li>
        <li>
            <a href="{{ route("users.index") }}" class="{{ request()->is('users*') ? "menu-option-selected" : "menu-option" }}">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-users"></use>
                </svg>
                <span class="menu-text hidden">Usuaris</span>
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

    </ul>
</nav>

<!-- Menu superior -->
<div class="bg-white flex flex-row items-center gap-2 w-full p-2 shadow-sm pl-28">

    <a href="{{ route("dashboard") }}">
        <img src="{{ asset("images/vallparadis-logo.svg") }}" alt="vallparadis-logo" class="w-56 mr-10">
    </a>

    <form action="#" method="post" class="w-[65%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-[#FFF9F6] p-5">
        @csrf

        <button type="submit" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#013148" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>

        <input type="search" name="search" id="search" placeholder="Buscar professionals , documents...." class=" pl-2 w-full h-10">
    </form>

    <div class="w-[25%] flex flex-row items-center justify-between px-10">

        <!-- Campana -->
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>

            <div class="h-6 w-6 rounded-full bg-orange-400 text-white absolute -top-3 -right-3 text-center font-bold flex items-center justify-center text-sm">
                <p>+11</p>
            </div>
        </div>

        <div class="flex flex-row items-center gap-5 ">
            <a href="{{ route("users.show", auth()->user()->id) }}" class="flex items-center gap-5">
                <minidenticon-svg username="{{ md5(auth()->user()->id) }}" class="w-16 h-16 bg-gray-200 rounded-full"></minidenticon-svg>
                <div>
                    <p class="font-bold">{{ auth()->user()->name }}</p>
                    <p>{{ auth()->user()->centerRelation->name  }}</p>
                </div>
            </a>

        </div>

    </div>
</div>