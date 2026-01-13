@extends('layouts.app')
@section("title", "Veure els seguiments")
@section('main')
<div class="min-w-fit w-9/10 mx-auto flex flex-col mb-7 gap-10">
    <!-- Header -->
    <div class="w-full flex flex-row justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('trackings.index', $user->id) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de seguiments
            </a>
            <h1 class="text-3xl font-bold text-[#011020]">Seguiment: {{ $tracking->topic }}</h1>
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
    <div class="flex flex-row justify-between">
        <!-- Info Usuario -->
        <div class="w-49/99 border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-row gap-5 items-center">
            <div class="bg-gray-200 w-20 h-20 rounded-full">
                {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=monsterid" alt="{{ $user->name }}" class="rounded-full"> --}}
                {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=robohash" alt="{{ $user->name }}" class="rounded-full"> --}}
                <minidenticon-svg username="{{ md5($user->id) }}"></minidenticon-svg>
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
        <div class="w-49/99 border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-row gap-5 items-center">
            <div class="bg-gray-200 w-20 h-20 rounded-full">
                {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=monsterid" alt="{{ $user->name }}" class="rounded-full"> --}}
                {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=robohash" alt="{{ $user->name }}" class="rounded-full"> --}}
                <minidenticon-svg username="{{ md5($tracking->registerRelation->id) }}"></minidenticon-svg>
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

        <div class="flex flex-row justify-between gap-5">
            <!-- Historial -->
            <div class="flex flex-col justify-start w-5/8 gap-5 max-h-[495px] {{ $total<1 ? 'h-[150px]' : '' }} {{ $total==1 ? 'h-[340px]' : '' }} border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                <div class="flex flex-row justify-between items-center w-full">
                    <div class="text-2xl font-bold text-[#011020]">
                        Historial de comentaris
                    </div>
                    <div class="text-[#FF7E13] text-1xl font-bold">
                        {{ $total }} comentaris
                    </div>
                </div>
                <div class="overflow-y-scroll flex flex-col h-full">
                    @foreach ($comments as $comment )
                        <div class="flex flex-row gap-5">
                            <div class="flex flex-col w-min">
                                <div class="bg-{{ $tracking->end_link ? 'red' : 'blue'}}-100 w-14 h-14 rounded-full border-3 border-{{ $tracking->end_link ? 'red' : 'blue'}}-300">
                                    {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=monsterid" alt="{{ $user->name }}" class="rounded-full"> --}}
                                    {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=robohash" alt="{{ $user->name }}" class="rounded-full"> --}}
                                    <minidenticon-svg username="{{ md5($comment->userRelation->id) }}"></minidenticon-svg>
                                </div>
                                <div class="min-h-[125px] h-full flex justify-center">
                                    <div class="bg-{{ $tracking->end_link ? 'red' : 'blue'}}-300 p-0.5 h-full"></div>
                                </div>
                            </div>
                            <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-full h-fit flex flex-col gap-5 overflow-hidden break-words whitespace-normal break-all mb-5">
                                <div class="flex flex-row justify-between">
                                    <div class="text-xl font-bold">
                                        {{ $comment->userRelation->name }}
                                    </div>
                                    <div class="flex flex-row gap-3 text-[#5E6468]">
                                        <svg class="w-6 h-6">
                                            <use xlink:href="#icon-calendar"></use>
                                        </svg>
                                        <div>
                                            {{ $comment->created_at }}
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    {{-- {{ Str::limit($comment->comment, 500) }} --}}
                                    {{ $comment->comment }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- @if($total<1)
                        <div class='mb-4'>No hi ha commentaris</div>
                    @endif -->
                    <div class="flex flex-row gap-5 items-center">
                        <div class="bg-{{ $tracking->end_link ? 'red' : 'blue'}}-200 p-[19px] w-fit rounded-full border-3 border-{{ $tracking->end_link ? 'red' : 'blue'}}-300">
                            <div class="bg-{{ $tracking->end_link ? 'red' : 'blue'}}-300 w-[11px] h-[11px] rounded-full">
    
                            </div>
                        </div>
                        <div class="text-{{ $tracking->end_link ? 'red' : 'blue'}}-500">
                            Fi de l'historial
                        </div>
                    </div>
                </div>
            </div>
            @unless ($tracking->end_link)
                <!-- Formulario -->
                <div class="flex flex-col justify-center w-1/4 h-[495px] border border-[#AFAFAF] bg-white rounded-[15px] p-5 gap-5">
                    <div class="pb-3 border-b-1 border-[#AFAFAF] flex flex-col gap-2">
                        <div class="flex flex-row gap-3">
                            <svg class="w-6 h-6 text-[#FF7E13]">
                                <use xlink:href="#icon-chat-text"></use>
                            </svg>
                            <div class="font-bold">
                                Nou comentari 
                            </div>
                        </div>
                        <div class="text-[#5E6468]">
                            Afegeix un comentari nou dins del seguiment seleccionat per a l'usuari: {{ $user->name }}
                        </div>
                    </div>
                    <form action="{{ route('trackings.comments.store', ['user' => $user->id, 'tracking' => $tracking->id]) }}" method="POST" class="text-[#5E6468] pt-5 flex flex-col gap-7">
                        @csrf
                        @method("POST")
                        <div class="flex flex-col gap-3">
                            <div class="flex flex-col gap-1">
                                <label for="comment">Afegir comentari</label>
                                <textarea type="text" id="comment" name="comment" class="border border-[#AFAFAF] bg-white rounded-lg p-2 max-h-[200px] h-[200px]"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                            Nou comentari
                        </button>
                    </form>
                </div>
            @endunless
        </div>
    </div>
</div>
@endsection