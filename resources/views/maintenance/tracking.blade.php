@extends('layouts.app')
@section("title", "Veure els seguiments")
@section('main')
<div class="min-w-fit w-9/10 mx-auto flex flex-col mb-7 gap-10">
    <!-- Header -->
    <div class="w-full flex flex-row justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('maintenance.show', $maintenance) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar al manteniment
            </a>
            <h1 class="text-3xl font-bold text-[#011020]">Seguimient de: {{ $maintenance->topic }}</h1>
            <p class="text-[#AFAFAF]" >Comentaris del manteniment</p>
        </div>
    </div>
    <div class="flex flex-col gap-5">

        <div class="flex flex-row justify-between gap-5">
            <!-- Historial -->
            <div class="flex flex-col justify-start w-5/8 gap-5 max-h-[640px] {{ $total<1 ? 'h-[170px]' : '' }} {{ $total==1 ? 'h-[360px]' : '' }} border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                <div class="flex flex-row justify-between items-center w-full">
                    <div class="text-2xl font-bold text-[#011020]">
                        Historial de commentaris
                    </div>
                    <div class="text-[#FF7E13] text-1xl font-bold">
                        {{ $total }} comentaris
                    </div>
                </div>
                <div class="overflow-y-scroll flex flex-col h-full">
                    @foreach ($comments as $comment )
                        <div class="flex flex-row gap-5">
                            <div class="flex flex-col">
                                <div class="bg-zinc-100 w-14 h-14 rounded-full border-3 border-zinc-300">
                                    <minidenticon-svg username="{{ md5($comment->userRelation->id) }}"></minidenticon-svg>
                                </div>
                                <div class="min-h-[125px] h-full flex justify-center">
                                    <div class="bg-zinc-300 p-0.5 h-full"></div>
                                </div>
                            </div>
                            <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-full h-fit flex flex-col gap-5 overflow-hidden break-words whitespace-normal break-all mb-5">
                                <div class="flex flex-row justify-between min-w-max">
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
                                    <!-- {{ Str::limit($comment->description, 500) }} -->
                                    {{ $comment->description }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- @if($total<1)
                        <div class='mb-4'>No hi ha commentaris</div>
                    @endif -->
                    <div class="flex flex-row gap-5 items-center">
                        <div class="bg-zinc-200 p-[19px] w-fit rounded-full border-3 border-zinc-300">
                            <div class="bg-zinc-300 w-[11px] h-[11px] rounded-full">
    
                            </div>
                        </div>
                        <div class="text-zinc-500">
                            Fi del historial
                        </div>
                    </div>
                </div>
            </div>
            @unless ($maintenance->end_link)
                <!-- Formulario -->
                <div class="flex flex-col justify-center w-1/4 h-fit border border-[#AFAFAF] bg-white rounded-[15px] p-5 gap-5 max-h-[640px] min-w-min">
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
                            Afegeix un comentari nou dins del manteniment: {{ $maintenance->topic }}
                        </div>
                    </div>
                    <form action="{{ route('maintenance.tracking.store', $maintenance) }}" method="POST" class="text-[#5E6468] pt-5 flex flex-col gap-7">
                        @csrf
                        @method("POST")
                        <div class="flex flex-col gap-3">
                            <div class="flex flex-col gap-1">
                                <label for="comment">Afegir comentari</label>
                                <textarea type="text" id="comment" name="comment" class="border border-[#AFAFAF] bg-white rounded-lg p-2 max-h-[360px] h-[200px]"></textarea>
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