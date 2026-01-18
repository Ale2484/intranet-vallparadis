@extends("layouts.app")
@section("title", "Mostrar el document")
@section("main")
<div class="w-full flex flex-col items-center justify-center">
    
    <!-- Apartado superior -->
    <div class="md:w-[80%] w-full flex justify-between items-center">
        <div class="flex flex-col gap-3 ">
            <a href="{{ route("documents.index") }}" class="flex gap-3 text-[#AFAFAF]">
                <svg class="w-6 h-6 ">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de documents
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Detalls del document</h1>
    
            <p class="text-[#AFAFAF] mb-7">Informació completa del document</p>
        </div>
        <a href="{{ route("documents.edit", $document) }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-square-pen"></use>
            </svg>
            Editar el document
        </a>

    </div>
    <!-- Contenedor principal -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 md:w-[80%] w-full text-[#0F172A] mb-10 dark:bg-neutral-800 dark:border-neutral-600 dark:text-[#FE712B]">
        <div class="flex justify-end">
            <p class="w-20 border p-1 text-center {{ $document->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{ $document->is_active ? "Actiu" : "Inactiu"}}</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-[#ffe7de] rounded-lg p-2">
                <svg class="w-10 h-10 text-[#FF7E13]">
                    <use xlink:href="#icon-document"></use>
                </svg>
            </div>
            <div>
                <p class="text-[#AFAFAF] font-semibold">{{ $document->type ? strtoupper($document->type) : "Tipus no assignat"}}</p>
                <p class="text-3xl font-bold text-[#011020] dark:text-white">{{ $document->name }}</p>
            </div>
        </div>
        <div class="flex mt-5 font-semibold p-3 rounded-lg gap-2 border border-[#AFAFAF]">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-desc"></use>
            </svg>
            <div>
                <p class="font-semibold text-[#5E6468] dark:text-neutral-300">Descripció</p>
                <p class="text-[#011020] dark:text-white">{{ $document->description ?? "Aquest document no té descripció" }}</p>
            </div>
        </div>
    </div>
    <!-- Especificaciones -->
    <div class="md:w-[80%] w-full flex flex-col lg:flex-row gap-5 justify-center text-[#0F172A] ">
        <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 lg:w-[50%] w-full dark:bg-neutral-800 dark:border-neutral-600 dark:text-white">
            <div class="flex items-center gap-5 mb-5">
                <div class="flex items-center p-2 bg-[#ffe7de] rounded-lg">
                    <svg class="w-7 h-7 text-[#FF7E13]">
                        <use xlink:href="#icon-info-circle"></use>
                    </svg>
                </div>
                <p class="font-bold text-lg">Informació del fitxer</p>
            </div>

            <div class="flex items-center gap-3 mb-5 pl-3">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-database"></use>
                </svg>
                <div>
                    <p class="font-semibold">Mida:</p>
                    <p>{{ $document->formatted_size }}</p>
                </div>
            </div>
            <hr class="text-[#AFAFAF] my-5">
            <div class="flex items-center gap-3 mb-5 pl-3">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-calendar"></use>
                </svg>
                <div>
                    <p class="font-semibold">Data de pujada:</p>
                    <p>{{ $document->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
        <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 lg:w-[50%] w-full dark:bg-neutral-800 dark:border-neutral-600 dark:text-white">
            <div class="flex items-center gap-5 mb-5">
                <div class="flex items-center p-2 bg-[#ffe7de] rounded-lg">
                    <svg class="w-7 h-7 text-[#FF7E13]">
                        <use xlink:href="#icon-user"></use>
                    </svg>
                </div>
                <p class="font-bold text-lg">Informació de l'usuari</p>
            </div>
            <div class="flex items-center gap-3 mb-5 pl-3">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-user"></use>
                </svg>
                <div>
                    <p class="font-semibold">Pujat per:</p>
                    <p>{{ $document->userData->name ?? "Usuari no disponible"}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
