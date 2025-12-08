@extends("layouts.app")
@section("title", "Mostra el centre")
@section("main")
<div class="w-full flex flex-col items-center justify-center">
    <!-- Apartado superior -->
    <div class="w-[60%] flex justify-between items-center">
        <div class="flex flex-col gap-3">
    
            <a href="{{ route("centers.index") }}" class="flex gap-3 text-[#AFAFAF]">
                <svg class="w-6 h-6 ">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de centres
            </a>
            <h1 class="text-3xl font-bold text-[#011020]">Detalls del centre</h1>
    
            <p class="text-[#AFAFAF] mb-7">Informació completa del centre</p>
        </div>
        <a href="{{ route("centers.edit", $center) }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-square-pen"></use>
            </svg>
            Editar el centre
        </a>

    </div>
    <!-- Contenedor principal -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-[60%] text-[#0F172A] mb-10">
        <div class="flex justify-end">
            <p class="w-20 border-1 p-1 text-center {{ $center->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{ $center->is_active ? "Actiu" : "Inactiu"}}</p>
        </div>

        <p class="text-3xl font-bold text-[#011020]">{{ $center->name }}</p>
        <div class="flex items-center gap-3 mt-5 font-semibold mb-5">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-maps"></use>
            </svg>
            <p>{{ $center->address }}</p>
        </div>
    </div>
    <!-- Especificaciones -->
    <div class="w-[60%] flex flex-row gap-5 justify-center text-[#0F172A]">

        <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-[50%]">
            <div class="flex items-center gap-5 mb-5">
                <div class="flex items-center p-2 bg-[#ffe7de] rounded-lg">
                    <svg class="w-7 h-7 text-[#FF7E13]">
                        <use xlink:href="#icon-phone"></use>
                    </svg>
                </div>
                <p class="font-bold text-lg">Informació de contacte</p>
            </div>

            <div class="flex items-center gap-3 mb-5 pl-3">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-phone"></use>
                </svg>
                <div>
                    <p class="font-semibold">Telèfon:</p>
                    <p>{{ $center->phone ?? "Aquest centre no te telèfon"}}</p>
                </div>
            </div>
            <hr class="text-[#AFAFAF] my-5">
            <div class="flex items-center gap-3 mb-5 pl-3">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-mail"></use>
                </svg>
                <div>
                    <p class="font-semibold">Email:</p>
                    <p>{{ $center->email ?? "Aquest centre no te email"}}</p>
                </div>
            </div>
        </div>

        <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-[50%]">
            <div class="flex items-center gap-5 mb-5">
                <div class="flex items-center p-2 bg-[#ffe7de] rounded-lg">
                    <svg class="w-7 h-7 text-[#FF7E13]">
                        <use xlink:href="#icon-maps"></use>
                    </svg>
                </div>
                <p class="font-bold text-lg">Ubicació</p>
            </div>

            <div class="flex items-center gap-3 mb-5 pl-3">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-maps"></use>
                </svg>
                <div>
                    <p class="font-semibold">Adreça:</p>
                    <p>{{ $center->address }}</p>
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
                    <p class="font-semibold">Estat del centre:</p>
                    <p class="{{ $center->is_active ? "text-green-600" : "text-red-600" }}">{{ $center->is_active ? "Actiu" : "Inactiu"}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="w-[60%] flex flex-col mt-5">
        <h2 class="text-2xl font-bold text-[#011020]">Documents del centre</h2>
        <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 mt-3">
            @if (isset($centerDocuments) && $centerDocuments->isNotEmpty())
                <p>Documento</p>
            @else
                <p class="text-center">Aquest centre encara no te documents</p>
            @endif
        </div>
    </div>
</div>
@endsection