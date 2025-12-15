@extends("layouts.app")
@section("title", "Mostra el centre")
@section("main")
<div class="w-full flex flex-col items-center justify-center">
    
    <!-- Apartado superior -->
    <div class="md:w-[80%] w-full flex justify-between items-center">
        <div class="flex flex-col gap-3">
    
            <a href="{{ route("centers.index") }}" class="flex gap-3 text-[#AFAFAF]">
                <svg class="w-6 h-6 ">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de centres
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Detalls del centre</h1>
    
            <p class="text-[#AFAFAF] mb-7">Informació completa del centre</p>
        </div>
        <div class="flex flex-row gap-2">
            <a href="{{ route("centers.edit", $center) }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar el centre
            </a>
            <a href="{{ route("centers.documents", $center) }}" class="bg-cyan-600 text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-cyan-700 transition-all">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-document"></use>
                </svg>
                Documents
            </a>
        </div>

    </div>
    <!-- Contenedor principal -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 md:w-[80%] w-full text-[#0F172A] mb-10 dark:bg-neutral-800 dark:border-neutral-600">
        <div class="flex justify-end">
            <p class="w-20 border p-1 text-center {{ $center->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{ $center->is_active ? "Actiu" : "Inactiu"}}</p>
        </div>

        <p class="text-3xl font-bold text-[#011020] dark:text-white">{{ $center->name }}</p>
        <div class="flex items-center gap-3 mt-5 font-semibold mb-5">
            <svg class="w-6 h-6 dark:text-neutral-400">
                <use xlink:href="#icon-maps"></use>
            </svg>
            <p class="dark:text-white">{{ $center->address }}</p>
        </div>
    </div>
    <!-- Especificaciones -->
    <div class="md:w-[80%] w-full flex flex-col md:flex-row gap-5 justify-center text-[#0F172A] ">
        <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 md:w-[50%] w-full dark:bg-neutral-800 dark:border-neutral-600">
            <div class="flex items-center gap-5 mb-5">
                <div class="flex items-center p-2 bg-[#ffe7de] rounded-lg">
                    <svg class="w-7 h-7 text-[#FF7E13]">
                        <use xlink:href="#icon-phone"></use>
                    </svg>
                </div>
                <p class="font-bold text-lg dark:text-white">Informació de contacte</p>
            </div>

            <div class="flex items-center gap-3 mb-5 pl-3 dark:text-neutral-400">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-phone"></use>
                </svg>
                <div>
                    <p class="font-semibold dark:text-white">Telèfon:</p>
                    <p class="dark:text-white">{{ $center->phone ?? "Aquest centre no te telèfon"}}</p>
                </div>
            </div>
            <hr class="text-[#AFAFAF] my-5">
            <div class="flex items-center gap-3 mb-5 pl-3 dark:text-neutral-400">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-mail"></use>
                </svg>
                <div>
                    <p class="font-semibold dark:text-white">Email:</p>
                    <p class="dark:text-white">{{ $center->email ?? "Aquest centre no te email"}}</p>
                </div>
            </div>
        </div>

        <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 md:w-[50%] w-full dark:bg-neutral-800 dark:border-neutral-600">
            <div class="flex items-center gap-5 mb-5">
                <div class="flex items-center p-2 bg-[#ffe7de] rounded-lg">
                    <svg class="w-7 h-7 text-[#FF7E13]">
                        <use xlink:href="#icon-maps"></use>
                    </svg>
                </div>
                <p class="font-bold text-lg dark:text-white">Ubicació</p>
            </div>

            <div class="flex items-center gap-3 mb-5 pl-3 dark:text-neutral-400">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-maps"></use>
                </svg>
                <div>
                    <p class="font-semibold dark:text-white">Adreça:</p>
                    <p class="dark:text-white">{{ $center->address }}</p>
                </div>
            </div>
            <hr class="text-[#AFAFAF] my-5">
            <div class="flex items-center gap-3 mb-5 pl-3">
                @if ($center->is_active)
                    <svg class="w-6 h-6 text-green-600">
                        <use xlink:href="#icon-check-circle"></use>
                    </svg>
                @else
                    <svg class="w-6 h-6 text-red-600">
                        <use xlink:href="#icon-cross-circle"></use>
                    </svg>

                @endif
                <div>
                    <p class="font-semibold dark:text-white">Estat del centre:</p>
                    <p class="{{ $center->is_active ? "text-green-600" : "text-red-600" }}">{{ $center->is_active ? "Actiu" : "Inactiu"}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection