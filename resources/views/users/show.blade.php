@extends('layouts.app')
@section("title", "Mostrar l'usuari")
@section('main')
<div class="md:min-w-fit w-full md:w-[80%] mx-auto flex flex-col mb-7 gap-5">
    <!-- Header -->
    <a href="{{ route('users.index') }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-arrow-left"></use>
        </svg>
        Tornar a la gestió de professionals
    </a>
    <div class="w-full flex items-center justify-between">
        <h1 class="md:text-3xl text-2xl font-bold text-[#011020] dark:text-white">Detalls del professional</h1>
        <div class="relative">
            <button data-dropdown-content-id="userLinks" class="bg-[#FF7E13] hover:bg-[#FE712B] p-2 text-white rounded-lg flex items-center justify-center font-bold gap-2 cursor-pointer">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-dots"></use>
                    </svg>
                    <p>Opcions</p>
            </button>
            <div id="userLinks" class="absolute top-12 right-0 min-w-60 bg-white shadow-lg border border-[#AFAFAF] p-2 rounded-lg dark:bg-neutral-800 z-1 hidden">
                <a href="{{ route("users.edit", $user) }}"
                    class="text-[#FF7E13] hover:bg-[#FE712B]/17 rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4 transition-all w-full">
                    <svg class="w-5 h-5">
                        <use xlink:href="#icon-square-pen"></use>
                    </svg>
                    Editar
                </a>
                <a href="{{ route("trackings.index", $user->id) }}" class="text-[#FF7E13] rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4 hover:bg-[#FE712B]/17 transition-all w-full">
                    <svg class="w-5 h-5">
                        <use xlink:href="#icon-link"></use>
                    </svg>
                    Seguiments
                </a>
                <a href="{{ route('user.uniformity.edit', $user) }}" class="text-[#FF7E13] rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4 hover:bg-[#FE712B]/17 transition-all w-full">
                    <svg class="w-5 h-5">
                        <use xlink:href="#icon-sweater"></use>
                    </svg>
                    Editar uniformes
                </a>
                <a href="{{ route("evaluations.index", $user->id) }}" class="text-[#FF7E13] rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4 hover:bg-[#FE712B]/17 transition-all">
                    <svg class="w-5 h-5">
                        <use xlink:href="#icon-academic-cap"></use>
                    </svg>
                    Avaluacions
                </a>
                <a href="{{ route("user.docs", $user->id) }}" class="text-[#FF7E13] rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4 hover:bg-[#FE712B]/17 transition-all">
                    <svg class="w-5 h-5">
                        <use xlink:href="#icon-desc"></use>
                    </svg>
                    Documents
                </a>
                <a href="{{ route("accidentabilites.index", $user->id) }}" class="text-[#FF7E13] rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4 hover:bg-[#FE712B]/17 transition-all">
                    <svg class="w-5 h-5">
                        <use xlink:href="#icon-link"></use>
                    </svg>
                    Accidentabilitat
                </a>
                <div class="w-full">
                    {{-- Boton para abrir las opciones de exportar a excel --}}
                    <button data-dropdown-content-id="exportOptions" class="text-green-600 rounded-lg p-2 font-semibold flex w-full items-center justify-between cursor-pointer hover:bg-green-700/16 transition-all">
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5">
                                <use xlink:href="#icon-excel"></use>
                            </svg>
                            Exportar excels
                        </div>
                            <svg class="w-5 h-5 rotate-90">
                                <use xlink:href="#icon-no-line-arrow"></use>
                            </svg>
                    </button>
                    <div id="exportOptions" class="pl-2 flex flex-col hidden">
                        <a href="{{ route("exportLocker", $user->id) }}" class="text-green-600 rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4 hover:bg-green-700/16 transition-all">
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-locker"></use>
                            </svg>
                            Taquilles
                        </a>
                        <a href="{{ route("exportUniformity", $user->id) }}" class="text-green-600 rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4 hover:bg-green-700/16 transition-all">
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-sweater"></use>
                            </svg>
                            Uniformes
                        </a>
                        <a href="{{ route("exportUniformityRenovation", $user->id) }}" class="text-green-600 rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4 hover:bg-green-700/16 transition-all">
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-sweater"></use>
                            </svg>
                            Renovació uniformes
                        </a>
                    </div>
                </div>
                @if ($user->id == auth()->user()->id)
                    <form action="{{ route("users.logout") }}" method="post" class="w-full">
                        @csrf
                        <button type="submit" class="text-red-600 hover:bg-red-700/16 w-full rounded-lg p-2 font-semibold flex items-center cursor-pointer gap-4">
                                <svg class="w-5 h-5">
                                    <use xlink:href="#icon-logout"></use>
                                </svg>
                                Tanca sessió
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <p class="text-[#AFAFAF] mb-4" >Informació completa del professional</p>

    <div class="flex flex-col md:flex-row justify-between items-start gap-10 w-full">
        <!-- Información del Profesional -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col gap-3 w-full md:w-5/7 dark:bg-neutral-800 dark:border-neutral-600">
            <!-- Información principal -->
            <div class="border-b border-b-gray-600">
                <div class="flex items-center gap-4 mb-6">
                    <div>
                        <div class="bg-gray-200 w-20 h-20 rounded-full relative">
                            {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=monsterid" alt="{{ $user->name }}" class="rounded-full"> --}}
                            {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=robohash" alt="{{ $user->name }}" class="rounded-full"> --}}
                            @if (!$user->profile_photo_path)
                                <minidenticon-svg username="{{ md5($user->id) }}"></minidenticon-svg>
                            @else
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="rounded-full w-20 h-20 object-cover">
                            @endif

                            @if ($user->id)
                                @if ($user->id == auth()->user()->id)
                                    <button data-modal-id="profile-photo-modal"
                                        class="open-modal-button absolute bottom-0 right-0 bg-white rounded-full p-1 border cursor-pointer border-gray-300 hover:bg-gray-300 dark:bg-neutral-800 dark:hover:bg-neutral-900 dark:border-white transition-all">
                                        <svg class="w-5 h-5 dark:text-white">
                                            <use xlink:href="#icon-camera"></use>
                                        </svg>
                                    </button>
                                    {{-- Modal para cambiar la foto de perfil --}}
                                    <div id="profile-photo-modal" class="w-screen h-full bg-black/20 z-20 dark:bg-white/20 fixed inset-0 hidden">
                                        <div class="w-full h-full flex flex-col items-center justify-center px-5 md:px-0">
                                            <div class="w-full md:w-[40%] md:min-w-[400px] bg-white rounded-lg flex flex-col p-5 dark:bg-neutral-800 dark:border-neutral-600">
                                                <div class="w-full flex items-center justify-between">
                                                    <h3 class="font-semibold text-2xl mb-1 dark:text-white">Canviar foto de perfil</h3>
                                                    <button class="close-modal-button cursor-pointer">
                                                        <svg class="w-7 h-7 text-[#011020] dark:text-white ml-2 md:ml-0">
                                                            <use xlink:href="#icon-cross"></use>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div id="select-profile-photo" class="pl-2">
                                                    <p class="mb-3 text-gray-500 dark:text-neutral-300">Tria una opció per actualitzar la teva foto de perfil</p>
                                                    <div class="flex flex-col md:flex-row items-stretch gap-2 text-[#011020]">
                                                        <form id="profile-photo-form" action="{{ route("users.updateProfilePhoto", $user->id) }}" method="post" enctype="multipart/form-data" class="w-2/2 md:w-1/2">
                                                            @csrf
                                                            <input type="file" name="profile_photo" id="profile_photo_file_input" class="hidden" accept="image/png, image/jpeg, image/jpg">
                                                            <button type="button" id="upload-photo-button" class="w-full flex flex-col items-center justify-center border border-[#AFAFAF] rounded-lg p-5 hover:bg-gray-100 dark:hover:bg-neutral-700 transition-all cursor-pointer">
                                                                <div class="rounded-full bg-[#fef5eb] p-5 mb-2">
                                                                    <svg class="w-10 h-10 text-[#FF7E13]">
                                                                        <use xlink:href="#icon-camera"></use>
                                                                    </svg>
                                                                </div>
                                                                <p class="font-bold text-[19px] mb-2 dark:text-white">Pujar una imatge</p>
                                                                <p class="text-sm dark:text-white">Selecciona una foto des del teu dispositiu</p>
                                                            </button>
                                                        </form>
                                                        <button data-change-content-to="show-canvas-modal" data-hidden-content="select-profile-photo" class="w-2/2 md:w-1/2 flex flex-col items-center justify-center border border-[#AFAFAF] rounded-lg p-5 hover:bg-gray-100 dark:hover:bg-neutral-700 transition-all cursor-pointer">
                                                            <div class="rounded-full bg-[#fef5eb] p-5 mb-2">
                                                                <svg class="w-10 h-10 text-[#FF7E13]">
                                                                    <use xlink:href="#icon-paint-brush"></use>
                                                                </svg>
                                                            </div>
                                                            <p class="font-bold text-[19px] mb-2 dark:text-white">Dibuixar</p>
                                                            <p class="text-sm dark:text-white">Crea una imatge personalitzada dibuixant</p>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div id="show-canvas-modal" class="w-full flex flex-col items-center justify-center hidden">
                                                    <form id="canvas-form" action="{{ route("users.updateProfilePhoto", $user->id) }}" method="post" enctype="multipart/form-data" class="w-full flex flex-col items-center justify-center">
                                                        @csrf
                                                        <input type="hidden" name="profile_photo" id="profile_photo_data">
                                                        <p class="w-full text-left mb-3 text-gray-500 dark:text-neutral-300">Dibuixa la teva pròpia foto de perfil</p>
                                                        <div class="w-full bg-[#fef5eb] p-2 rounded-lg border border-[#FF7E13] flex flex-col md:flex-row items-start md:items-center justify-center gap-5">
                                                            <div class="flex items-center gap-2">
                                                                <label for="colorPicker">Color</label>
                                                                <input type="color" id="colorPicker" value="#000000" class="rounded-lg h-10">
                                                            </div>
                                                            <div class="flex items-center gap-2">
                                                                <label for="brushSize">Gruix</label>
                                                                <input type="range" id="brushSize" min="1" max="20" value="3" class="range-input">
                                                            </div>
                                                            <button type="button" id="clearCanvas" class="bg-red-500 text-white p-2 rounded-lg flex items-center cursor-pointer gap-2">
                                                                <svg class="w-5 h-5">
                                                                    <use xlink:href="#icon-trash"></use>
                                                                </svg>
                                                                <p>Esborrar</p>
                                                            </button>
                                                        </div>
                                                        <canvas id="canvas" width="200" height="200" class="mt-5 border border-dashed cursor-crosshair rounded-full bg-gray-200"></canvas>
                                                        <div class="w-full flex items-end justify-end mt-5">
                                                            <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                                                                <svg id="draw-profile-photo-button" class="w-6 h-6">
                                                                    <use xlink:href="#icon-check-circle"></use>
                                                                </svg>
                                                                <p>Guardar la nova imatge</p>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    
                    <div class="w-fit">
                        <!-- Nombre y rol -->
                        <div>
                            <h2 class="text-2xl font-bold text-[#012F4A] dark:text-white">{{ $user->name }}</h2>
                            <p class="text-lg text-gray-600 dark:text-neutral-400">{{ $user->role_label }}</p>
                        </div>
                        <!-- Fecha de inicio -->
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400 mr-2 dark:text-neutral-400">
                                <use xlink:href="#icon-calendar"></use>
                            </svg>
                            <span class="text-gray-700 dark:text-white">Inici:</span>
                            <span class="text-gray-900 font-medium ml-2 dark:text-white">
                                @if($user->created_at)
                                    {{ $user->created_at->format('d \\d\\e F \\d\\e Y') }}
                                @else
                                    No disponible
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
    
            </div>
    
            <!-- Información de contacto -->
            <h3 class="text-xl font-semibold text-[#012F4A] mb-6 dark:text-white">Informació de contacte</h3>
            
            <div class="space-y-4">
                <!-- Email -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-mail"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1 dark:text-white">Correu electrònic</p>
                        <p class="text-gray-900 font-semibold dark:text-white">{{ $user->email }}</p>
                    </div>
                </div>
    
                <!-- Teléfono -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-phone"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1 dark:text-white">Telèfon</p>
                        <p class="text-gray-900 font-semibold dark:text-white">{{ $user->phone ?? '+34 000 000 000' }}</p>
                    </div>
                </div>
    
                <!-- Rol -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-role"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1 dark:text-white">Rol</p>
                        <p class="text-gray-900 font-semibold dark:text-white">{{ $user->role_label }}</p>
                    </div>
                </div>
    
                <!-- Centro -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-center"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1 dark:text-white">Centre</p>
                        <p class="text-gray-900 font-semibold dark:text-white">
                            {{ $user->centerRelation ? $user->centerRelation->name : "Aquest usuari no te centre associat" }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:w-2/7 w-full flex flex-col gap-5">
            {{-- Seguridad y acceso --}}
            <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col gap-3 dark:bg-neutral-800 dark:border-neutral-600">
                <div class="flex items-center gap-2">
                    <svg class="w-9 h-9 {{ $user->is_active ? "text-green-600 dark:text-green-500" : "text-red-600 dark:text-red-500" }}">
                        <use xlink:href="#icon-check-circle"></use>
                    </svg>
                    <p class="text-xl font-semibold text-[#012F4A] dark:text-white">Seguretat i accés</p>
                </div>
                <p class="font-semibold {{ $user->is_active ? "text-green-600 dark:text-green-500" : "text-red-600 dark:text-red-500" }}">Compte {{ $user->is_active ? "actiu" : "inactiu"}}</p>
            </div>
            {{-- Tallas --}}
            <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col gap-3 dark:bg-neutral-800 dark:border-neutral-600">
                <div class="flex items-center gap-2">
                    <svg class="w-9 h-9 text-[#FF7033]">
                        <use xlink:href="#icon-sweater"></use>
                    </svg>
                    <p class="text-xl font-semibold text-[#012F4A] dark:text-white">Talles</p>
                </div>
                {{-- Contenedor de las tallas --}}
                <div class="mt-3 flex flex-col gap-3">
                    <div class="w-full p-5 bg-[#fef5eb] border border-[#fed6aa] rounded-lg">
                        <p class="text-[#FF7033] font-semibold text-[16px]">JERSEI</p>
                        <p class="font-bold text-3xl text-[#FF7033]">{{ optional($user->uniformity)->shirt ?? "—" }}</p>
                    </div>
                    <div class="w-full p-5 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-blue-600 font-semibold text-[16px]">PANTALONS</p>
                        <p class="font-bold text-3xl text-blue-900">{{ optional($user->uniformity)->pants ?? "—" }}</p>
                    </div>
                    <div class="w-full p-5 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-green-600 font-semibold text-[16px]">SABATES</p>
                        <p class="font-bold text-3xl text-green-900">{{ optional($user->uniformity)->shoes ?? "—" }}</p>
                    </div>
                </div>
            </div>
            {{-- Taquilla --}}
            <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col gap-3 dark:bg-neutral-800 dark:border-neutral-600">
                <p class="text-xl font-semibold text-[#012F4A] dark:text-white">Número de taquilla</p>
                <div class="bg-[#fef5eb] p-5 border border-[#fed6aa] rounded-lg">
                    <p class="text-2xl font-bold text-[#FF7033]">{{ $user->locker}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection