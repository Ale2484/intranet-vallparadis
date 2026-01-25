@extends('layouts.app')
@section("title", "Veure els seguiments")
@section('main')
<div class="max-w-7xl mx-auto flex flex-col mb-7 gap-10 dark:text-white">
    <!-- Header -->
    <div class="w-full flex flex-row justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('users.show', $user->id) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de professionals
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Seguiment de {{ $user->name }}</h1>
            <p class="text-[#AFAFAF]" >Seguiment del professional seleccionat</p>
        </div>
    </div>
    <!-- Info Usuario -->
    <div class="w-full border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col sm:flex-row gap-5 items-center dark:bg-neutral-800 dark:border-neutral-600">
        <div class="bg-gray-200 w-20 h-20 rounded-full aspect-square">
            @if (!$user->profile_photo_path)
                <minidenticon-svg username="{{ md5($user->id) }}" class="w-20 h-20 aspect-square bg-gray-200 rounded-full"></minidenticon-svg>
            @else
                <div class="w-20 h-20 aspect-square bg-gray-200 rounded-full">
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-20 h-20 aspect-square bg-gray-200 rounded-full object-cover">
                </div>
            @endif
        </div>
        <div class="flex flex-col items-center justify-center sm:justify-normal sm:items-start">
            <div class="text-2xl font-bold">
                {{ $user->name }}
            </div>
            <div class="flex flex-row gap-3">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-mail"></use>
                </svg>
                {{ $user->email }}
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-col gap-5">
        <div class="flex flex-col sm:flex-row justify-between items-center w-full">
            <div class="text-2xl font-bold text-[#011020] dark:text-white">
                Historial de seguiments
            </div>
            <div class="text-[#FF7E13] text-1xl font-bold">
                {{ $total }} Registres
            </div>
        </div>
        {{ $total<1 ? "No hi ha seguiments" : "" }}
        <div class="flex flex-col-reverse md:flex-row justify-between gap-5">
            <!-- Historial -->
            <div class="flex flex-col justify-start w-full md:w-5/8 gap-5 overflow-y-scroll h-[443px]">
                @foreach($trackings as $tracking)
                    <div class="border-2 border-gray-300 bg-white rounded-[15px] p-5 flex flex-col gap-4 dark:bg-neutral-800 dark:border-neutral-600">
                        <div class="border-b border-gray-300 pb-5">
                            <div class="flex flex-row gap-5">
                                <div>
                                    <div class="bg-gray-200 w-12 h-12 rounded-full">
                                        @if (!$tracking->registerRelation->profile_photo_path)
                                            <minidenticon-svg username="{{ md5($tracking->registerRelation->id) }}" class="w-12 h-12 aspect-square bg-gray-200 rounded-full"></minidenticon-svg>
                                        @else
                                            <div class="w-12 h-12 aspect-square bg-gray-200 rounded-full">
                                                <img src="{{ asset('storage/' . $tracking->registerRelation->profile_photo_path) }}" alt="{{ $tracking->registerRelation->name }}" class="w-12 h-12 aspect-square bg-gray-200 rounded-full object-cover">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div class="flex flex-col sm:flex-row justify-between w-full h-min">
                                        <div class="flex flex-col gap-1">
                                            <a href="{{ route("trackings.show", ['user' => $user->id, 'tracking' => $tracking->id]) }}" class="text-2xl font-bold dark:text-white text-black">
                                                {{ Str::limit($tracking->topic, 20) }}
                                            </a>
                                            <div class="flex flex-row gap-2 items-center jus" >
                                                <svg class="w-6 h-6">
                                                    <use xlink:href="#icon-user"></use>
                                                </svg>
                                                {{ $tracking->registerRelation->name }}
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <div class="flex flex-row gap-2 {{ $tracking->end_link ? '' : ''}}">
                                                <svg class="w-6 h-6">
                                                    <use xlink:href="#icon-calendar"></use>
                                                </svg>
                                                {{ $tracking->created_at }}
                                            </div>
                                            <div class="flex flex-row gap-2">
                                                <svg class="w-6 h-6">
                                                    <use xlink:href="#icon-id"></use>
                                                </svg>
                                                {{ $tracking->open ? "Public":"Restringit" }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row gap-3 items-center">
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-chat-text"></use>
                            </svg>
                            <div class="overflow-hidden">
                                {{ Str::limit($tracking->lastComment->comment ?? 'Sense comentaris',75) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Formulario -->
            <div class="flex flex-col justify-center w-full md:w-2/6 h-fit border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                <div class="pb-3 border-b border-gray-300 flex flex-col gap-2">
                    <div class="flex flex-row gap-3">
                        <svg class="w-6 h-6 text-[#FF7E13]">
                            <use xlink:href="#icon-plus"></use>
                        </svg>
                        <div class="font-bold">
                            Nou seguiment
                        </div>
                    </div>
                    <div class="text-gray-500 dark:text-white">
                        Afegeix un nou seguiment per al professional: {{ $user->name }}
                    </div>
                </div>
                <form action="{{ route('trackings.store', $user->id) }}" method="POST" class="text-gray-500 pt-5 flex flex-col gap-7 dark:text-white" >
                    @csrf
                    <div class="flex flex-col gap-3">
                        <div class="flex flex-col gap-1">
                            <label for="topic" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">Tema *</label>
                            <input type="text" id="topic" name="topic" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('topic') border-red-500 @enderror" value="{{ old('topic') }}" required>
                            @error('topic')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @if(auth()->user()->role === "equip_directiu")
                        <div class="flex flex-col gap-1">
                            <label for="open" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">Tipus de seguiment *</label>
                            <select name="open" id="open" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('open') border-red-500 @enderror" required>
                                <option value="0" {{ old('open') == '0' ? 'selected' : '' }}>Restringit</option>
                                <option value="1" {{ old('open') == '1' ? 'selected' : '' }}>Públic</option>
                            </select>
                            @error('open')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @else
                            <input type="hidden" name="open" value="1">
                        @endif
                    </div>
                    <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                        Nou seguiment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection