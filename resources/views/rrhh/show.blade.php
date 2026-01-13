@extends("layouts.app")
@section("title", "Mostra el centre")
@section("main")
<div class="w-full flex flex-col items-center justify-center gap-10">
    
    <!-- Apartado superior -->
    <div class="w-4/5 flex justify-between items-center">
        <div class="flex flex-col gap-3">
    
            <a href="{{ route("rrhh.index") }}" class="flex gap-3 text-[#AFAFAF]">
                <svg class="w-6 h-6 ">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de temes pendents
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Detalls de {{ $rrhh->topic }}</h1>
    
            <p class="text-[#AFAFAF]">Informació completa del tema pendent</p>
        </div>

    </div>
    <!-- Contenedor principal -->
    <div class="border border-[#AFAFAF] bg-white dark:bg-neutral-800 rounded-[15px] p-5 w-4/5 text-[#0F172A] dark:text-white flex items-center justify-between h-30 min-w-min dark:border-neutral-600">
        <p class="text-3xl font-bold text-[#011020] dark:text-white">{{ $rrhh->topic }}</p>
        <div class="flex justify-end self-start">
            <p class="w-20 border-1 p-1 text-center {{ $rrhh->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{ $rrhh->is_active ? "Actiu" : "Inactiu"}}</p>
        </div>
    </div>
    <!-- Especificaciones -->
    <div class="gap-5 justify-center text-[#0F172A] dark:text-white w-1/1 flex flex-col items-center">
        <div class="w-4/5 flex flex-col lg:flex-row gap-5">
            <div class="border border-[#AFAFAF] bg-white dark:bg-neutral-800 rounded-[15px] p-5 lg:w-[50%] min-w-min dark:border-neutral-600">
                <div class="flex gap-5 items-center ">
                    <div class="bg-gray-200 rounded-full h-16 w-16 aspect-square">
                        @if (!$rrhh->userAffectedRelation->profile_photo_path)
                            <minidenticon-svg username="{{ md5($rrhh->userAffectedRelation->id) }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full"></minidenticon-svg>
                        @else
                            <div class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full">
                                <img src="{{ asset('storage/' . $rrhh->userAffectedRelation->profile_photo_path) }}" alt="{{ $rrhh->userAffectedRelation->name }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full object-cover">
                            </div>
                        @endif
                    </div>
                    <div>
                        <p>Professionals afectat</p>
                        <p class="text-2xl font-bold text-[#011020] dark:text-white">{{ $rrhh->userAffectedRelation->name }}</p>
                        <div>
                            <div class="flex items-center text-[#011020] dark:text-neutral-400 justify-between">
                                <svg class="w-6 h-6">
                                    <use xlink:href="#icon-mail"></use>
                                </svg>
                                <span class="ml-2 dark:text-white">{{ $rrhh->userAffectedRelation->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="border border-[#AFAFAF] bg-white dark:bg-neutral-800 rounded-[15px] p-5 lg:w-[50%] min-w-min dark:border-neutral-600">
                <div class="flex gap-5 items-center ">
                    <div class="bg-gray-200 rounded-full h-16 w-16 aspect-square">
                        @if (!$rrhh->userRegisterRelation->profile_photo_path)
                            <minidenticon-svg username="{{ md5($rrhh->userRegisterRelation->id) }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full"></minidenticon-svg>
                        @else
                            <div class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full">
                                <img src="{{ asset('storage/' . $rrhh->userRegisterRelation->profile_photo_path) }}" alt="{{ $rrhh->userRegisterRelation->name }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full object-cover">
                            </div>
                        @endif
                    </div>
                    <div>
                        <p>Professional registrador</p>
                        <p class="text-2xl font-bold text-[#011020] dark:text-white">{{ $rrhh->userRegisterRelation->name }}</p>
                        <div>
                            <div class="flex items-center text-[#011020] dark:text-neutral-400 justify-between">
                                <svg class="w-6 h-6">
                                    <use xlink:href="#icon-mail"></use>
                                </svg>
                                <span class="ml-2 dark:text-white">{{ $rrhh->userRegisterRelation->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-4/5 flex flex-col lg:flex-row gap-5">
            <div class="border border-[#AFAFAF] bg-white dark:bg-neutral-800 rounded-[15px] p-5 lg:w-[50%] flex flex-col gap-3 min-w-min dark:border-neutral-600">
                <div class="flex gap-5 items-center">
                    <div class="flex items-center p-2 bg-[#ffe7de] rounded-lg">
                        <svg class="w-7 h-7 text-[#FF7E13]">
                            <use xlink:href="#icon-d20"></use>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-[#011020] dark:text-white">Derivat</p>
                </div>
                <div class="overflow-hidden break-words whitespace-normal break-all">
                    {{ $rrhh->derivative }}
                </div>
            </div>
    
            <div class="border border-[#AFAFAF] bg-white dark:bg-neutral-800 rounded-[15px] p-5 lg:w-[50%] flex flex-col gap-3 min-w-min dark:border-neutral-600">
                <div class="flex gap-5 items-center">
                    <div class="flex items-center p-2 bg-[#ffe7de] rounded-lg">
                        <svg class="w-7 h-7 text-[#FF7E13]">
                            <use xlink:href="#icon-desc"></use>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-[#011020] dark:text-white">Descripció</p>
                </div>
                <div class="overflow-hidden break-words whitespace-normal break-all">
                    {{ $rrhh->description }}
                </div>
            </div>
        </div>
    </div>
    {{-- botones --}}
    <div class="flex w-4/5 justify-end items-center gap-3">
        <a href="{{ route("rrhh.tracking", $rrhh) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-other-eye"></use>
            </svg>
            Seguiment
        </a>
    
        <a href="{{ route("rrhh.docs", $rrhh) }}" class="bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-desc"></use>
            </svg>
            Documents
        </a>
    </div>
</div>
@endsection