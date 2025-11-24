@extends("layouts.app")
@section("title", "Mostra el servei")
@section("main")
<div class="w-full flex items-center justify-center">
    <div class="w-[90%] flex flex-col items-center justify-center">   
        <!-- Apartado superior -->
        <div class="w-full flex items-center justify-between">
            <div class="flex flex-col gap-3">
                <a href="{{ route("general-services.index") }}" class="flex gap-3 text-[#AFAFAF]">
                    <svg class="w-6 h-6 ">
                        <use xlink:href="#icon-arrow-left"></use>
                    </svg>
                    Tornar a la gestió de serveis
                </a>
        
                <h1 class="text-3xl font-bold text-[#011020]">{{ $generalService->name }}</h1>        
                <p class="text-[#AFAFAF] mb-7">Informació completa del servei</p>
            </div>
            <a href="{{ route("general-services.edit", $generalService) }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all py-3">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar el servei                
            </a>
        </div>
        <!-- Contenedor principal -->
        <div class="w-full flex flex-wrap flex-row justify-between gap-5 text-[#011020]">
            
            <div class="w-[55%] flex flex-col gap-3">
                {{-- Contenedor secundario --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col min-w-[350px]">
                    <p class="text-[20px] font-bold text-[#011020] mb-5">Dades del encarregat:</p>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center mb-5">
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-user"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Nom:</p>
                                <p class="font-semibold">{{ $generalService->manager_name ?? "Aquest servei no te encarregat" }}</p>
                            </div>
                        </div>
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-mail"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Correu:</p>
                                <p class="font-semibold">{{ $generalService->manager_email ?? "L'encarregat no te correu" }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center">
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-7 h-7">
                                    <use xlink:href="#icon-phone"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Telefon:</p>
                                <p class="font-semibold">{{ $generalService->manager_phone ?? "L'encarregat no te telefon" }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contenedor secundario --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col min-w-[350px]">
                    <p class="text-[20px] font-bold text-[#011020] mb-5">Detalls del servei:</p>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center mb-5">
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                @if ( in_array($generalService->type, ["cuina", "neteja", "cook"]) )
                                    <svg class="w-8 h-8">
                                        <use xlink:href="#icon-{{ $generalService->type == 'cuina' ? 'sparkles' : ($generalService->type == 'neteja' ? 'sea' : ($generalService->type == 'cook' ? 'knife' : 'default-icon')) }}"></use>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-md">Tipus de servei:</p>
                                <p class="font-semibold">{{ $generalService->type ?? "Aquest servei no te tipus"}}</p>
                            </div>
                        </div>
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-center"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Centre associat:</p>
                                <p class="font-semibold">{{ $generalService->center->name ?? "Aquest servei no te un centre associat" }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center mt-3">
                        {{-- Elemento --}}
                        <div class="w-full flex flex-row items-start gap-2">
                            <div class="p-2 rounded-lg flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-desc"></use>
                                </svg>
                            </div>
                            <div class="w-[80%] flex flex-col gap-3">
                                <p class="text-md font-semibold">Descripció:</p>
                                <p>{{$generalService->description ?? "Aquest servei no te descripció"}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contenedor secundario --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col min-w-[350px]">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="p-2 rounded-lg flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                            <svg class="w-8 h-8">
                                <use xlink:href="#icon-clock"></use>
                            </svg>
                        </div>
                        <p class="text-[20px] font-bold text-[#011020]">Horari del servei:</p>
                    </div>

                    {{-- Contenedor elemento --}}
                    <div class="flex w-full flex-row items-center gap-2 mb-5">
                        <p>{{ $generalService->users_and_schedules ?? "Aquest servei no te usuaris ni horaris" }}</p>
                    </div>

                </div>
            </div>
            
            {{-- Contenedor lateral --}}
            <div class="w-[40%] flex flex-col gap-5">
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex-flex-col min-w-[300px]">
                    <p class="text-[20px] font-bold text-[#011020] mb-5">Observacions:</p>
                    @if (count($observations) > 0)
                        @foreach ($observations as $observation)
                            <p>{{ $observation->observation }}</p>                            
                        @endforeach
                    @endif
                </div>
                {{-- Apartado de observaciones --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex-flex-col min-w-[300px]">
                    <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-[#FF7E13]">
                        <use xlink:href="#icon-chat-text"></use>
                    </svg>
                        <p class="font-semibold">Nova observació</p>
                    </div>

                    <p class="my-2 text-sm">Afegeix una nova observacio per al servei de {{  }}</p>
                    <hr class="text-[#AFAFAF] mt-2">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection