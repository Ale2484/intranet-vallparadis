@extends("layouts.app")
@section("title", "Mostra el centre")
@section("main")
<div class="w-full flex flex-col items-center justify-center gap-10">
    
    <!-- Apartado superior -->
    <div class="w-4/5 flex justify-between items-center">
        <div class="flex flex-col gap-3">
    
            <a href="{{ route("maintenance.index") }}" class="flex gap-3 text-[#AFAFAF]">
                <svg class="w-6 h-6 ">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de manteniments
            </a>
            <h1 class="text-3xl font-bold text-[#011020]">Detalls de {{ $maintenance->topic }}</h1>
    
            <p class="text-[#AFAFAF]">Informació completa del manteniment</p>
        </div>

    </div>
    <!-- Contenedor principal -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-4/5 text-[#0F172A] flex items-center justify-between h-30 min-w-min">
        <p class="text-3xl font-bold text-[#011020]">{{ $maintenance->topic }}</p>
        <div class="flex justify-end self-start">
            <p class="w-20 border-1 p-1 text-center {{ $maintenance->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{ $maintenance->is_active ? "Actiu" : "Inactiu"}}</p>
        </div>
    </div>
    <!-- Especificaciones -->
    <div class="gap-5 justify-center text-[#0F172A] w-1/1 flex flex-col items-center">
        <div class="w-4/5 flex flex-col lg:flex-row gap-5">
            <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 lg:w-[50%] flex flex-col gap-3 min-w-min">
                <div class="flex gap-5 items-center">
                    <div class="flex items-center p-2 bg-[#ffe7de] rounded-lg">
                        <svg class="w-7 h-7 text-[#FF7E13]">
                            <use xlink:href="#icon-worker"></use>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-[#011020]">Responsable</p>
                </div>
                <div class="overflow-hidden break-words whitespace-normal break-all">
                    {{ $maintenance->responsible }}
                </div>
            </div>
    
            <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 lg:w-[50%] flex flex-col gap-3 min-w-min">
                <div class="flex gap-5 items-center">
                    <div class="flex items-center p-2 bg-[#ffe7de] rounded-lg">
                        <svg class="w-7 h-7 text-[#FF7E13]">
                            <use xlink:href="#icon-desc"></use>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-[#011020]">Descripcio</p>
                </div>
                <div class="overflow-hidden break-words whitespace-normal break-all">
                    {{ $maintenance->description }}
                </div>
            </div>
        </div>
    </div>
    {{-- botones --}}
    <div class="flex w-4/5 justify-end items-center gap-3">
        <a href="{{ route("maintenance.tracking", $maintenance) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-other-eye"></use>
            </svg>
            Seguiment
        </a>
    
        <a href="{{ route("maintenance.docs", $maintenance) }}" class="bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-desc"></use>
            </svg>
            Documents
        </a>
    </div>
</div>
@endsection