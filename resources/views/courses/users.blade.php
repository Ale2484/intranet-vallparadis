@extends("layouts.app")
@section("title", "Usuaris del curs")
@section("main")
<div class="w-full flex flex-col items-center justify-center">
    
    <!-- Apartado superior -->
    <div class="w-full lg:w-[75%] flex flex-col gap-5">

        <a href="{{ route("courses.show", $course) }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar al curs {{ $course->name }}
        </a>

        <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Usuaris del curs i els seus certificats</h1>

        <p class="text-[#AFAFAF] mb-7">Visualitza els usuaris que pertanyen al curs</p>
    </div>
    <!-- Tabla -->
    <div class="flex flex-col w-full lg:w-[75%]">
        @foreach ($courseUsers as $user )
            <div class="lg:hidden flex items-center gap-2 w-full justify-end">
                <svg width="10" height="10">
                    <circle cx="5" cy="5" r="5" class="{{ $user->pivot->certificate == "LLIURAT" ? "fill-green-600" : "fill-red-600" }}"/>
                </svg>
                <p class="{{ $user->pivot->certificate == "LLIURAT" ? "text-green-600" : "text-red-600" }}">{{ $user->pivot->certificate }}</p>
            </div>
            <div class="w-full border border-[#AFAFAF] bg-white rounded-[15px] p-5 text-[#0F172A] dark:bg-neutral-800 dark:border-neutral-600 mb-5">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    {{-- Contenedor datos usuario --}}
                    <div class="flex w-full justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-15 h-15 bg-gray-200 rounded-full">
                                @if (!$user->profile_photo_path)
                                    <minidenticon-svg username="{{ md5($user->id) }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full"></minidenticon-svg>
                                @else
                                    <div class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full">
                                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="md:w-16 md:h-16 w-10 h-10 aspect-square bg-gray-200 rounded-full object-cover">
                                    </div>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route("users.show" , $user) }}" class="font-semibold dark:text-white">{{$user->name ?? " - "}}</a>
                                <p class="text-[#5E6468] dark:text-neutral-400">{{$user->email ?? " - "}}</p>
                            </div>
                        </div>

                        <div class="hidden items-center gap-2 lg:flex">
                            <svg width="10" height="10">
                                <circle cx="5" cy="5" r="5" class="{{ $user->pivot->certificate == "LLIURAT" ? "fill-green-600" : "fill-red-600" }}"/>
                            </svg>
                            <p class="mr-10 {{ $user->pivot->certificate == "LLIURAT" ? "text-green-600" : "text-red-600" }}">{{ $user->pivot->certificate }}</p>
                        </div>
                    </div>

                    <div class="flex items-center w-full md:w-auto">
                        <div class="flex flex-col md:flex-row items-center md:gap-5 w-full md:w-auto">
                            <form action="{{ route("courses.giveCertificate", ["course" => $course, "user" => $user]) }}" method="post" class="flex items-center justify-center w-full md:w-auto">
                                @csrf
                                @method("PATCH")
                                <button type="submit" @disabled($user->pivot->certificate == "LLIURAT") class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all disabled:cursor-not-allowed disabled:bg-gray-400 disabled:text-gray-100 disabled:border-gray-400 disabled:opacity-30 w-full mt-5 md:w-auto md:mt-0">
                                    <svg class="w-6 h-6 ">
                                        <use xlink:href="#icon-plus"></use>
                                    </svg>
                                    Lliurar certificat
                                </button>
                            </form>
                            <form action="{{ route("courses.removeCertificate", ["course" => $course, "user" => $user]) }}" method="post" class="flex items-center justify-center w-full md:w-auto">
                                @csrf
                                @method("PATCH")
                                <button type="submit" @disabled($user->pivot->certificate == "PENDENT") class="bg-white text-[#FF7E13] border border-[#FF7E13] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 disabled:cursor-not-allowed disabled:bg-gray-400 disabled:text-gray-100 disabled:border-gray-400 disabled:opacity-30 w-full mt-5 md:w-auto md:mt-0">
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