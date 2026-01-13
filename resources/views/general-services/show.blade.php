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
        
                <h1 class="text-3xl font-bold text-[#011020] dark:text-white">{{ $generalService->name }}</h1>
                <p class="text-[#AFAFAF] mb-7">Informació completa del servei</p>
            </div>
            <a href="{{ route("general-services.edit", $generalService) }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all py-3">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar el servei general
            </a>
        </div>
        <!-- Contenedor principal -->
        <div class="w-full flex sm:flex-col lg:flex-row flex-wrap justify-between gap-5 text-[#011020]">
            <div class="lg:w-[55%] w-full flex flex-col gap-3">
                {{-- Contenedor secundario --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col dark:bg-neutral-800 dark:border-neutral-600">
                    <p class="text-[20px] font-bold text-[#011020] dark:text-white mb-5">Dades de l'encarregat:</p>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex flex-col md:flex-row items-center mb-5">
                        {{-- Elemento --}}
                        <div class="flex w-full md:w-1/2 flex-row items-center gap-2 mb-5 md:mb-0">
                            <div class="p-2 rounded-lg flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-user"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md dark:text-white">Nom:</p>
                                <p class="font-semibold dark:text-white">{{ $generalService->manager_name ?? "Aquest servei no té encarregat" }}</p>
                            </div>
                        </div>
                        {{-- Elemento --}}
                        <div class="flex w-full md:w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-mail"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md dark:text-white">Correu:</p>
                                <p class="font-semibold dark:text-white">{{ $generalService->manager_email ?? "L'encarregat no té correu" }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center">
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-7 h-7">
                                    <use xlink:href="#icon-phone"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md dark:text-white">Telèfon:</p>
                                <p class="font-semibold dark:text-white">{{ $generalService->manager_phone ?? "L'encarregat no té telèfon" }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contenedor secundario --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col dark:bg-neutral-800 dark:border-neutral-600">
                    <p class="text-[20px] font-bold text-[#011020] dark:text-white mb-5">Detalls del servei:</p>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex flex-col md:flex-row items-center mb-5">
                        {{-- Elemento --}}
                        <div class="flex w-full md:w-1/2 flex-row items-center gap-2 mb-5 md:mb-0">
                            <div class="p-2 rounded-lg flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                @if ( in_array($generalService->type, ["cuina", "neteja", "bugaderia"]) )
                                    <svg class="w-8 h-8">
                                        <use xlink:href="#icon-{{ $generalService->type == 'neteja' ? 'sparkles' : ($generalService->type == 'bugaderia' ? 'sea' : ($generalService->type == 'cuina' ? 'knife' : 'default-icon')) }}"></use>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-md dark:text-white">Tipus de servei:</p>
                                <p class="font-semibold dark:text-white">{{ ucfirst($generalService->type) ?? "Aquest servei no té tipus"}}</p>
                            </div>
                        </div>
                        {{-- Elemento --}}
                        <div class="flex w-full md:w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-center"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md dark:text-white">Centre associat:</p>
                                <p class="font-semibold dark:text-white">{{ $generalService->center->name ?? "Aquest servei no té un centre associat" }}</p>
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
                                <p class="text-md font-semibold dark:text-white">Descripció:</p>
                                <p class="dark:text-white">{{$generalService->description ?? "Aquest servei no té descripció"}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contenedor secundario --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col dark:bg-neutral-800 dark:border-neutral-600 mb-5">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="p-2 rounded-lg flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                            <svg class="w-8 h-8">
                                <use xlink:href="#icon-clock"></use>
                            </svg>
                        </div>
                        <p class="text-[20px] font-bold text-[#011020] dark:text-white">Personal i horaris:</p>
                    </div>

                    {{-- Contenedor elemento --}}
                    <div class="rich-editor-container dark:text-white">
                        {!! $generalService->staff_and_schedules ? $generalService->staff_and_schedules : "Aquest servei no té usuaris ni horaris" !!}
                    </div>
                </div>
            </div>
            
            {{-- Contenedor lateral --}}
            <div class="lg:w-[40%] w-full flex flex-col gap-5">
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="flex justify-between">
                        <p class="text-[20px] font-bold text-[#011020] dark:text-white mb-5">Observacions:</p>
                        <p class="bg-[#ffe7de] text-[#FF7E13] w-7 h-7 flex items-center justify-center rounded-full font-semibold">{{ $observations->count() }}</p>
                    </div>
                    @if (count($observations) > 0)
                        <div class="flex flex-col gap-2 h-auto max-h-72 overflow-y-auto">
                            @foreach ($observations as $observation)
                                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col dark:bg-neutral-950 dark:border-neutral-600">
                                    <div class="flex gap-2 max-w-full items-start">
                                        <div class="md:w-16 md:h-16 w-10 h-10  aspect-square bg-gray-200 rounded-full sticky">
                                            @if (!$observation->user->profile_photo_path)
                                                <minidenticon-svg username="{{ md5($observation->user) }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full"></minidenticon-svg>
                                            @else
                                                <div class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full">
                                                    <img src="{{ asset('storage/' . $observation->user->profile_photo_path) }}" alt="{{ $observation->user->name }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full object-cover">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="w-full">
                                            <div class="w-full flex items-center justify-between mb-2">
                                                <p class="font-bold dark:text-white">{{ $observation->user->name }}</p>
                                                <div class="text-[#AFAFAF] gap-2 hidden md:flex">
                                                    <svg class="w-6 h-6">
                                                        <use xlink:href="#icon-calendar"></use>
                                                    </svg>
                                                    <p>{{ \Carbon\Carbon::parse($observation->created_at)->format("d/m/Y - H:i") }}</p>
                                                </div>
                                            </div>
                                            <p class="break-all dark:text-white">{{ $observation->observation }}</p>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else 
                        <p class="text-gray-600 dark:text-gray-400">Encara no hi ha observacions per a aquest servei.</p>
                    @endif
                </div>
                {{-- Apartado de observaciones --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-[#FF7E13]">
                        <use xlink:href="#icon-chat-text"></use>
                    </svg>
                        <p class="font-semibold dark:text-white">Nova observació</p>
                    </div>
                    <form action="{{ route("general-services.add-observation", $generalService) }}" method="POST">
                        @csrf
                        <p class="my-2 text-sm dark:text-white">Afegeix una nova observació per al servei de {{ $generalService->name  }}</p>
                        <hr class="text-[#AFAFAF] my-4">
                        <label for="observation" class="font-semibold dark:text-white">Afegir nova observació:</label>
                        <textarea name="observation" id="observation" placeholder="Introdueix una nova observació" class="resize-none border-1 shadow-sm h-24 p-2 rounded-lg border-[#AFAFAF] w-full mb-4 mt-2 bg-white dark:bg-neutral-950 dark:border-neutral-600 dark:text-white @error('observation') border-red-600 @enderror"></textarea>
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