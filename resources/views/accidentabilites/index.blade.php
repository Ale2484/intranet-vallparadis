@extends('layouts.app')
@section("title", "Veure les Accidentabilitats")
@section('main')
<div class="min-w-fit w-9/10 mx-auto flex flex-col mb-7 gap-10 dark:text-white">
    <!-- Header -->
    <div class="w-full flex flex-row justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('users.show', $user->id) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de professionals
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Accidentabilitat de {{ $user->name }}</h1>
            <p class="text-[#AFAFAF]" >Accidentabilitat del professional seleccionat</p>
        </div>
    </div>
    <!-- Info Usuario -->
    <div class="w-full border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-row gap-5 items-center dark:bg-neutral-800 dark:border-neutral-600">
        <div class="bg-gray-200 w-20 h-20 rounded-full aspect-square">
            @if (!$user->profile_photo_path)
                <minidenticon-svg username="{{ md5($user->id) }}" class="w-20 h-20 aspect-square bg-gray-200 rounded-full"></minidenticon-svg>
            @else
                <div class="w-20 h-20 aspect-square bg-gray-200 rounded-full">
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-20 h-20 aspect-square bg-gray-200 rounded-full object-cover">
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
            <div class="text-2xl font-bold text-[#011020] dark:text-white">
                Historial de accidentabilitat
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
                    <div class="border-2 border-gray-300 bg-white rounded-[15px] p-5 flex flex-col gap-4 dark:bg-neutral-800 dark:border-neutral-600">
                        <div class="border-b-1 border-[#AFAFAF] pb-5">
                            <div class="flex flex-row gap-5">
                                <div>
                                    <div class="bg-gray-200 w-12 h-12 rounded-full">
                                        @if (!$tracking->evaluateRelation->profile_photo_path)
                                            <minidenticon-svg username="{{ md5($tracking->evaluateRelation->id) }}" class="w-12 h-12 aspect-square bg-gray-200 rounded-full"></minidenticon-svg>
                                        @else
                                            <div class="w-12 h-12 aspect-square bg-gray-200 rounded-full">
                                                <img src="{{ asset('storage/' . $tracking->evaluateRelation->profile_photo_path) }}" alt="{{ $tracking->evaluateRelation->name }}" class="w-12 h-12 aspect-square bg-gray-200 rounded-full object-cover">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div class="flex flex-row justify-between w-full h-min">
                                        <div class="flex flex-col gap-1 ">
                                            <a href="{{ route("accidentabilites.show", ['user' => $user->id, 'tracking' => $tracking->id]) }}" class="text-2xl font-bold dark:text-white text-black">
                                                {{ Str::limit($tracking->context, 20) }}
                                            </a>
                                            <div class="flex flex-row gap-2 items-center" >
                                                <svg class="w-6 h-6">
                                                    <use xlink:href="#icon-user"></use>
                                                </svg>
                                                {{ $tracking->evaluateRelation->name }}
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <div class="flex flex-row gap-2">
                                                <svg class="w-6 h-6">
                                                    <use xlink:href="#icon-calendar"></use>
                                                </svg>
                                                {{ ($tracking->start ? $tracking->start : $tracking->created_at) . ($tracking->end ? " : ". $tracking->end : "") }}
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
                                {{ Str::limit($tracking->description, 75) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Formulario -->
            <div class="flex flex-col justify-center w-1/4 h-fit border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                <div class="pb-3 border-b-1 border-[#AFAFAF] flex flex-col gap-2">
                    <div class="flex flex-row gap-3">
                        <svg class="w-6 h-6 text-[#FF7E13]">
                            <use xlink:href="#icon-plus"></use>
                        </svg>
                        <div class="font-bold">
                            Nova accidentabilitat
                        </div>
                    </div>
                    <div class="text-[#5E6468] dark:text-white">
                        Afegeix una nova accidentabilitat per al professional: {{ $user->name }}
                    </div>
                </div>
                <form action="{{ route('accidentabilites.store', $user->id) }}" method="POST" class="text-[#5E6468] pt-5 flex flex-col gap-7 dark:text-white" >
                    @csrf
                    @method("POST")
                    <div class="flex flex-col gap-3">
                        <div class="flex flex-col gap-1">
                            <label for="context">Tema</label>
                            <input type="text" id="context" name="context" class="border border-gray-300 bg-white rounded-lg p-2 dark:bg-neutral-950  focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="description">Descripcio</label>
                            <textarea type="text" id="description" name="description" class="border border-gray-300 bg-white rounded-lg p-2 dark:bg-neutral-950  focus:outline-none focus:ring-2 focus:ring-orange-500" required></textarea>
                        </div>
                        <div class="flex gap-1">
                            <div class="flex flex-col gap-1">
                                <label for="start">Inici</label>
                                <input type="date" id="start" name="start" class="border border-gray-300 bg-white rounded-lg p-2 dark:bg-neutral-950  focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="end">Final</label>
                                <input type="date" id="end" name="end" class="border border-gray-300 bg-white rounded-lg p-2 dark:bg-neutral-950  focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                        Nova Accidentabilitat
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection