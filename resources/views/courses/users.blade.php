@extends("layouts.app")
@section("title", "Usuaris del curs")
@section("main")
<div class="w-full flex flex-col items-center justify-center">
    
    <!-- Apartado superior -->
    <div class="w-[65%] flex flex-col gap-5">

        <a href="{{ route("courses.index") }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar a la gestió de cursos
        </a>

        <h1 class="text-3xl font-bold text-[#011020]">Usuaris del curs i els seus certificats</h1>

        <p class="text-[#AFAFAF] mb-7">Visualitza els usuaris que pertanyen al curs</p>
    </div>
    <!-- Tabla -->
    <div class="flex flex-col gap-5 w-[65%]">
        @foreach ($courseUsers as $user )
            <div class="w-full border border-[#AFAFAF] bg-white rounded-[15px] p-5 text-[#0F172A] ">
                <div class="flex items-center justify-between">
                    {{-- Contenedor datos usuario --}}
                    <div class="flex items-center gap-2">
                        <div class="w-15 h-15 bg-gray-200 rounded-full">
                            <minidenticon-svg username="{{ md5($user->id) }}"></minidenticon-svg>
                        </div>
                        <div>
                            <a href="{{ route("users.show" , $user) }}" class="font-semibold">{{$user->name ?? " - "}}</a>
                            <p class="text-[#5E6468]">{{$user->email ?? " - "}}</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="flex items-center gap-2">
                            <svg width="10" height="10">
                                <circle cx="5" cy="5" r="5" class="{{ $user->pivot->certificate == "ENTREGAT" ? "fill-green-600" : "fill-red-600" }}"/>
                            </svg>
                            <p class="mr-10 {{ $user->pivot->certificate == "ENTREGAT" ? "text-green-600" : "text-red-600" }}">{{ $user->pivot->certificate }}</p>
                        </div>
                        <div class="flex items-center gap-5">
                            <form action="{{ route("courses.giveCertificate", ["course" => $course, "user" => $user]) }}" method="post" class="flex items-center justify-center">
                                @csrf
                                @method("PATCH")
                                <button type="submit" @disabled($user->pivot->certificate == "ENTREGAT") class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all disabled:cursor-not-allowed disabled:bg-gray-400 disabled:text-gray-100 disabled:border-gray-400 disabled:opacity-30">
                                    <svg class="w-6 h-6 ">
                                        <use xlink:href="#icon-plus"></use>
                                    </svg>
                                    Entregar certificat
                                </button>
                            </form>
                            <form action="{{ route("courses.removeCertificate", ["course" => $course, "user" => $user]) }}" method="post" class="flex items-center justify-center">
                                @csrf
                                @method("PATCH")
                                <button type="submit" @disabled($user->pivot->certificate == "PENDENT") class="bg-white text-[#FF7E13] border-1 border-[#FF7E13] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 disabled:cursor-not-allowed disabled:bg-gray-400 disabled:text-gray-100 disabled:border-gray-400 disabled:opacity-30">
                                    <svg class="w-6 h-6 ">
                                        <use xlink:href="#icon-cross"></use>
                                    </svg>
                                    Treure certificat
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection