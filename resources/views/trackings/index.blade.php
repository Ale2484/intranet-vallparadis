@extends('layouts.app')
@section("title", "Veure els seguiments")
@section('main')
<div class="min-w-fit w-9/10 mx-auto flex flex-col mb-7 gap-10">
    <!-- Header -->
    <div class="w-full flex flex-row justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('users.show', $user->id) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de professionals
            </a>
            <h1 class="text-3xl font-bold text-[#011020]">Seguiment de {{ $user->name }}</h1>
            <p class="text-[#AFAFAF]" >Seguiment del professional seleccionat</p>
        </div>
    </div>
    <!-- Info Usuario -->
    <div class="w-full border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-row gap-5 items-center">
        <div class="bg-gray-200 w-20 h-20 rounded-full">
            {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=monsterid" alt="{{ $user->name }}" class="rounded-full"> --}}
            {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=robohash" alt="{{ $user->name }}" class="rounded-full"> --}}
            @if (!$user->profile_photo_path)
                <minidenticon-svg username="{{ md5($user->id) }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full"></minidenticon-svg>
            @else
                <div class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full">
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full object-cover">
                </div>
            @endif
        </div>
        <div>
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
    <div class="flex flex-col gap-5">
        <div class="flex flex-row justify-between items-center w-5/8">
            <div class="text-2xl font-bold text-[#011020]">
                Historial de seguiments
            </div>
            <div class="text-[#FF7E13] text-1xl font-bold">
                {{ $total }} Registres
            </div>
        </div>
        {{ $total<1 ? "No hi ha seguiments" : "" }}
        <div class="flex flex-row justify-between gap-5">
            <!-- Historial -->
            <div class="flex flex-col justify-start w-5/8 gap-5 overflow-y-scroll h-[443px]">
                @foreach($trackings as $tracking)
                    <div class="border-2 border-{{ $tracking->end_link ? 'red' : 'blue'}}-300 bg-white rounded-[15px] p-5 flex flex-col gap-4">
                        <div class="border-b-1 border-[#AFAFAF] pb-5">
                            <div class="flex flex-row gap-5">
                                <div>
                                    <div class="bg-gray-200 w-12 h-12 rounded-full">
                                        {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=monsterid" alt="{{ $user->name }}" class="rounded-full"> --}}
                                        {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=robohash" alt="{{ $user->name }}" class="rounded-full"> --}}
                                        @if (!$tracking->register->profile_photo_path)
                                            <minidenticon-svg username="{{ md5($tracking->register->id) }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full"></minidenticon-svg>
                                        @else
                                            <div class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full">
                                                <img src="{{ asset('storage/' . $tracking->register->profile_photo_path) }}" alt="{{ $tracking->register->name }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full object-cover">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div class="flex flex-row justify-between w-full h-min">
                                        <div class="flex flex-col gap-1">
                                            <a href="{{ route("trackings.show", ['user' => $user->id, 'tracking' => $tracking->id]) }}" class="text-2xl font-bold">
                                                {{ Str::limit($tracking->topic, 20) }}
                                            </a>
                                            <div class="flex flex-row gap-2 items-center" >
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
            <div class="flex flex-col justify-center w-1/4 h-fit border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                <div class="pb-3 border-b-1 border-[#AFAFAF] flex flex-col gap-2">
                    <div class="flex flex-row gap-3">
                        <svg class="w-6 h-6 text-[#FF7E13]">
                            <use xlink:href="#icon-plus"></use>
                        </svg>
                        <div class="font-bold">
                            Nou seguiment 
                        </div>
                    </div>
                    <div class="text-[#5E6468]">
                        Afegeix un nou seguiment per al professional: {{ $user->name }}
                    </div>
                </div>
                <form action="{{ route('trackings.store', $user->id) }}" method="POST" class="text-[#5E6468] pt-5 flex flex-col gap-7" >
                    @csrf
                    @method("POST")
                    <div class="flex flex-col gap-3">
                        <div class="flex flex-col gap-1">
                            <label for="topic">Tema</label>
                            <input type="text" id="topic" name="topic" class="border border-[#AFAFAF] bg-white rounded-lg p-2">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="open">Tipus de seguiment</label>
                            <select name="open" id="open" class="border border-[#AFAFAF] bg-white rounded-lg p-2" >
                                <option value="0">Restringit</option>
                                <option value="1">Públic</option>
                            </select>
                        </div>
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