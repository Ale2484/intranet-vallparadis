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
        <div class="relative">
            <button data-dropdown-content-id="documentLinks" class="bg-[#FF7E13] hover:bg-[#FE712B] p-2 text-white rounded-lg flex items-center justify-center font-bold gap-2 cursor-pointer">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-dots"></use>
                    </svg>
                    <p>Opcions</p>
            </button>
            <div id="documentLinks" class="absolute top-12 right-0 min-w-60 bg-white shadow-lg border border-[#AFAFAF] p-2 rounded-lg dark:bg-neutral-800 z-1 hidden">
                <a href="{{ route("documents.edit", $document) }}" class="text-[#FF7E13] hover:bg-[#FE712B]/17 rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4 transition-all w-full">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-square-pen"></use>
                    </svg>
                    Editar
                </a>
                <a href="{{ route('documents.download', ['path' => $document->path]) }}"
                    class="text-[#FF7E13] hover:bg-[#FE712B]/17 rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4 transition-all w-full">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-download"></use>
                    </svg>
                    Descarregar
                </a>
                <form action="{{ route('documents.destroy', $document) }}" method="post" class="w-full">
                    @csrf
                    @method("DELETE")
                    <button type="submit"
                        class="confirmable text-red-600 hover:bg-red-700/16 w-full rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4"
                        data-confirm-message="Estàs segur que vols eliminar aquest document?">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-trash"></use>
                        </svg>
                        Eliminar
                    </button>
                </form>
            </div>
        </div>

    </div>
    <!-- Contenedor principal -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 md:w-[80%] w-full text-[#0F172A] mb-10 dark:bg-neutral-800 dark:border-neutral-600 dark:text-[#FE712B]">
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="bg-[#ffe7de] rounded-lg p-2">
                    <svg class="w-10 h-10 text-[#FF7E13]">
                        <use xlink:href="#icon-desc"></use>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-[#011020] dark:text-white">{{ $document->name }}</p>
            </div>
            <p class="bg-[#ffe7de] border border-[#FF7E13] text-[#FF7E13] rounded-lg p-2">{{ $document->type ? Str::upper($document->getFormattedTypeAttribute()) : "Tipus no assignat"  }}</p>
        </div>
        <div class="flex font-semibold p-3 rounded-lg gap-2">
            <div>
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
                        <use xlink:href="#icon-desc"></use>
                    </svg>
                </div>
                <p class="font-bold text-lg">Informació del document</p>
            </div>

            <div class="flex items-center gap-3 mb-5 pl-3">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-desc"></use>
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
