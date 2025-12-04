@extends("layouts.app")
@section("title", "Mostra el servei general")
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
                    Tornar a la gestió de serveis generals
                </a>
        
                <h1 class="text-3xl font-bold text-[#011020]">{{ $generalService->name }}</h1>        
                <p class="text-[#AFAFAF] mb-7">Informació completa del servei</p>
            </div>
            <a href="{{ route("general-services.edit", $generalService) }}" class="bg-[#FF7E13] text-white rounded-lg p-[10px] font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar el servei general
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
                                @if ( in_array($generalService->type, ["cuina", "neteja", "bugaderia"]) )
                                    <svg class="w-8 h-8">
                                        <use xlink:href="#icon-{{ $generalService->type == 'neteja' ? 'sparkles' : ($generalService->type == 'bugaderia' ? 'sea' : ($generalService->type == 'cuina' ? 'knife' : 'default-icon')) }}"></use>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-md">Tipus de servei:</p>
                                <p class="font-semibold">{{ ucfirst($generalService->type) ?? "Aquest servei no te tipus"}}</p>
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
                            <div class="w-[80%] flex flex-col">
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
                        <p class="text-[20px] font-bold text-[#011020]">Personal i horaris:</p>
                    </div>

                    {{-- Contenedor elemento --}}
                    <div class="rich-editor-container">
                        {!! $generalService->staff_and_schedules ? $generalService->staff_and_schedules : "Aquest servei no te usuaris ni horaris" !!}
                    </div>
                </div>
            </div>
            
            {{-- Contenedor lateral --}}
            <div class="w-[40%] flex flex-col gap-5">
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex-flex-col min-w-[300px]">
                    <div class="flex justify-between">
                        <p class="text-[20px] font-bold text-[#011020] mb-5">Observacions:</p>
                        <p class="bg-[#ffe7de] text-[#FF7E13] w-7 h-7 flex items-center justify-center rounded-full font-semibold">{{ $observations->count() }}</p>
                    </div>
                    @if (count($observations) > 0)
                        <div class="flex flex-col gap-2 h-72 overflow-y-auto">
                            @foreach ($observations as $observation)
                                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex-flex-col">
                                    <div class="flex gap-2 max-w-full items-start">
                                        <div class="w-16 h-16 aspect-square bg-gray-200 rounded-full sticky">
                                            <minidenticon-svg username="{{ md5($observation->user_id) }}" class="w-16 h-16 aspect-square"></minidenticon-svg>
                                        </div>
                                        <div class="w-full">
                                            <div class="w-full flex items-center justify-between mb-2">
                                                <p class="font-bold">{{ $observation->user->name }}</p>
                                                <div class="text-[#AFAFAF] flex gap-2">
                                                    <svg class="w-6 h-6">
                                                        <use xlink:href="#icon-calendar"></use>
                                                    </svg>
                                                    <p>{{ \Carbon\Carbon::parse($observation->created_at)->format("d/m/Y - H:i") }}</p>
                                                </div>
                                            </div>
                                            <p class="break-all">{{ $observation->observation }}</p>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>Actualment no hi ha observacions</p>
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
                    <form action="{{ route("general-services.add-observation", $generalService) }}" method="POST">
                        @csrf
                        <p class="my-2 text-sm">Afegeix una nova observacio per al servei de {{ $generalService->name  }}</p>
                        <hr class="text-[#AFAFAF] my-4">
                        <label for="observation" class="font-semibold">Afegir nova observació:</label>
                        <textarea name="observation" id="observation" placeholder="Introdueix una nova observació" class="resize-none border-1 shadow-sm h-24 p-2 rounded-lg border-[#AFAFAF] w-full mb-4 mt-2 @error('observation') border-red-600 @enderror"></textarea>
                        <button type="submit" class="bg-[#FF7E13] w-full text-white rounded-lg p-[10px] font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-paper-airplane"></use>
                            </svg>
                            Afegir observació
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection