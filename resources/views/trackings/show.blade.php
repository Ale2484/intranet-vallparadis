@extends('layouts.app')
@section("title", "Veure els seguiments")
@section('main')
<div class="max-w-7xl mx-auto flex flex-col mb-7 gap-10 dark:text-white">
    <!-- Header -->
    <div class="w-full flex flex-col sm:flex-row justify-between items-start gap-5">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('trackings.index', $user->id) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de seguiments
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Seguiment: {{ $tracking->topic }}</h1>
            <p class="text-[#AFAFAF]" >Comentaris del seguiment seleccionat</p>
        </div>
        @unless($tracking->end_link)
            <form action="{{ route('trackings.deactivate', ['user' => $user->id, 'tracking' => $tracking->id]) }}" method="POST">
                @csrf
                @method("PATCH")
                <button type="submit" class="bg-red-600 text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-red-500 transition-all w-full">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-link-slash"></use>
                    </svg>
                    Tancar el seguiment
                </button>
            </form>
        @endunless
    </div>
    <div class="flex flex-col md:flex-row justify-between gap-5">
        <!-- Info Usuario -->
        <div class="w-full md:w-1/2 border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-row gap-5 items-center dark:bg-neutral-800 dark:border-neutral-600">
            <div class="bg-gray-200 w-20 h-20 rounded-full aspect-square">
                @if (!$user->profile_photo_path)
                    <minidenticon-svg username="{{ md5($user->id) }}" class="w-20 h-20 bg-gray-200 rounded-full"></minidenticon-svg>
                @else
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-20 h-20 bg-gray-200 rounded-full object-cover">
                @endif
            </div>
            <div class="flex flex-col justify-between">
                <div class="text-[#AFAFAF]">
                    Usuari seguit
                </div>
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
        <!-- info register -->
        <div class="w-full md:w-1/2 border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-row gap-5 items-center dark:bg-neutral-800 dark:border-neutral-600">
            <div class="bg-gray-200 w-20 h-20 rounded-full aspect-square">
                @if (!$tracking->registerRelation->profile_photo_path)
                    <minidenticon-svg username="{{ md5($tracking->registerRelation->id) }}" class="w-20 h-20 bg-gray-200 rounded-full"></minidenticon-svg>
                @else
                    <img src="{{ asset('storage/' . $tracking->registerRelation->profile_photo_path) }}" alt="{{ $tracking->registerRelation->name }}" class="w-20 h-20 bg-gray-200 rounded-full object-cover">
                @endif
            </div>
            <div class="flex flex-col justify-between">
                <div class="text-[#AFAFAF]">
                    Registrador
                </div>
                <div class="text-2xl font-bold">
                    {{ $tracking->registerRelation->name }}
                </div>
                <div class="flex flex-row gap-3">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-mail"></use>
                    </svg>
                    {{ $tracking->registerRelation->email }}
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-5">
        <div class="flex flex-col-reverse md:flex-row justify-between gap-5">
            <!-- Historial -->
            <div class="flex flex-col justify-start w-full md:w-5/8 gap-5 border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                <div class="flex flex-row justify-between items-center w-full">
                    <div class="text-2xl font-bold text-[#011020] dark:text-white">
                        Historial de comentaris
                    </div>
                    <div class="text-[#FF7E13] text-1xl font-bold">
                        {{ $total }} comentaris
                    </div>
                </div>
                <div class="overflow-y-scroll flex flex-col h-96">
                    @foreach ($comments as $comment )
                        <div class="flex flex-row gap-5">
                            <div class="flex flex-col w-min">
                                <div class="w-14 h-14 rounded-full aspect-square">
                                    <div class="w-14 h-14 aspect-square bg-gray-200 rounded-full border-3 border-zinc-300 dark:border-neutral-500 flex justify-center items-center">
                                        @if (!$comment->userRelation->profile_photo_path)
                                            <minidenticon-svg username="{{ md5($comment->userRelation->id) }}" class="w-13 h-13 rounded-full"></minidenticon-svg>
                                        @else
                                            <img src="{{ asset('storage/' . $comment->userRelation->profile_photo_path) }}" alt="{{ $comment->userRelation->name }}" class=" w-13 h-13 rounded-full">
                                        @endif
                                    </div>
                                </div>
                                <div class="min-h-[125px] h-full flex justify-center">
                                    <div class="bg-zinc-300 dark:bg-neutral-500 p-0.5 h-full"></div>
                                </div>
                            </div>
                            <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-full h-fit flex flex-col gap-5 overflow-hidden break-words whitespace-normal break-all mb-5 dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="flex flex-row justify-between">
                                    <div class="text-xl font-bold">
                                        {{ $comment->userRelation->name }}
                                    </div>
                                    <div class="flex flex-row gap-3 text-[#5E6468] dark:text-white">
                                        <svg class="w-6 h-6">
                                            <use xlink:href="#icon-calendar"></use>
                                        </svg>
                                        <div>
                                            {{ $comment->created_at }}
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    {{ $comment->comment }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="flex flex-row gap-5 items-center">
                        <div class="bg-gray-200 p-[19px] w-fit rounded-full border-3 border-zinc-300 dark:border-neutral-500 dark:bg-neutral-400">
                            <div class="bg-zinc-300 w-[11px] h-[11px] rounded-full dark:bg-neutral-500">
    
                            </div>
                        </div>
                        <div class="text-zinc-500 dark:text-neutral-300">
                            Fi de l'historial
                        </div>
                    </div>
                </div>
            </div>
            @unless ($tracking->end_link)
                @if($tracking->open || auth()->user()->role === "equip_directiu")
                <!-- Formulario -->
                <div class="flex flex-col justify-center w-full md:w-1/4 h-fit border border-[#AFAFAF] bg-white rounded-[15px] p-5 gap-5 dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="pb-3 border-b-1 border-[#AFAFAF] flex flex-col gap-2">
                        <div class="flex flex-row gap-3">
                            <svg class="w-6 h-6 text-[#FF7E13]">
                                <use xlink:href="#icon-chat-text"></use>
                            </svg>
                            <div class="font-bold">
                                Nou comentari
                            </div>
                        </div>
                        <div class="text-[#5E6468] dark:text-white">
                            Afegeix un comentari nou dins del seguiment seleccionat per a l'usuari: {{ $user->name }}
                        </div>
                    </div>
                    <form action="{{ route('trackings.comments.store', ['user' => $user->id, 'tracking' => $tracking->id]) }}" method="POST" class="text-[#5E6468] dark:text-white pt-5 flex flex-col gap-7">
                        @csrf
                        <div class="flex flex-col gap-3">
                            <div class="flex flex-col gap-1">
                                <label for="comment" class="font-medium text-gray-700 mb-1 flex items-center gap-2 dark:text-white">Afegir comentari *</label>
                                <textarea type="text" id="comment" name="comment" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('comment') border-red-500 @enderror" value="{{ old('comment') }}" required></textarea>
                                @error('comment')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                            Nou comentari
                        </button>
                    </form>
                </div>
                @endif
            @endunless
        </div>
    </div>
</div>
@endsection