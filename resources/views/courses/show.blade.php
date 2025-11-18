@extends("layouts.app")
@section("title", "Mostra el curs")
@section("main")
<div class="w-full flex items-center justify-center">
    <div class="w-[90%] flex flex-col items-center justify-center">   
        <!-- Apartado superior -->
        <div class="w-full flex items-center justify-between">
            <div class="flex flex-col gap-3">
                <a href="{{ route("courses.index") }}" class="flex gap-3 text-[#AFAFAF]">
                    <svg class="w-6 h-6 ">
                        <use xlink:href="#icon-arrow-left"></use>
                    </svg>
                    Tornar a la gestió de cursos
                </a>
        
                <h1 class="text-3xl font-bold text-[#011020]">{{ $course->name }}</h1>
        
                <h1 class="text-lg font-bold text-[#FF7E13]">Codi: {{ $course->code ?? "Aquest curs no te codi" }}</h1>
                <p class="text-[#AFAFAF] mb-7">Informació completa del curs</p>
            </div>
            <a href="{{ route("courses.edit", $course) }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all py-3">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar el curs                
            </a>
        </div>
        <!-- Contenedor principal -->
        <div class="w-full flex flex-wrap flex-row justify-between gap-5 text-[#011020]">
            
            <div class="w-[55%] flex flex-col gap-3">
                {{-- Contenedor secundario --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col min-w-[350px]">
                    <p class="text-[20px] font-bold text-[#011020] mb-5">Informació del general:</p>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center mb-5">
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-center"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Centre:</p>
                                <p class="font-semibold">{{ $course->center->name ?? "Error en obtenir el centre" }}</p>
                            </div>
                        </div>
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-clock"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Hores totals:</p>
                                <p class="font-semibold">{{ $course->hours ? $course->hours . " hores" : "Error en obtenir les hores" }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center">
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-7 h-7">
                                    <use xlink:href="#icon-computer-desktop"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Modalitat:</p>
                                <p class="font-semibold">{{ $course->modality ?? "Error en obtenir la modalitat" }}</p>
                            </div>
                        </div>
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-role"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Tipus:</p>
                                <p class="font-semibold">{{ $course->type ?? "Error en obtenir el tipus" }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contenedor secundario --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col min-w-[350px]">
                    <p class="text-[20px] font-bold text-[#011020] mb-5">Dates i horaris:</p>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center mb-5">
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-calendar"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Data d'inici:</p>
                                <p class="font-semibold">{{ $course->start_date ? date("d/m/Y", strtotime($course->start_date)) : "Error en obtenir la data d'inici" }}</p>
                            </div>
                        </div>
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-calendar"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Data de finalització:</p>
                                <p class="font-semibold">{{ $course->end_date ? date("d/m/Y", strtotime($course->end_date)) : "Error en obtenir la data d'inici" }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center mt-3">
                        {{-- Elemento --}}
                        <div class="w-full flex flex-row items-start gap-2">
                            <div class="p-2 rounded-lg flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-clock"></use>
                                </svg>
                            </div>
                            <div class="w-[80%] flex flex-col gap-3">
                                <p class="text-md font-semibold">Horari semanal:</p>
                                @if (count($schedules) > 0)
                                    @foreach ($schedules as $schedule )
                                        <div class="w-full flex flex-row items-center justify-between p-2 border-1 border-[#AFAFAF] bg-[#f6f8fc] rounded-lg">
                                            <p>{{ $schedule->day_of_week ?? " - " }}</p>
                                            <p class="text-[#FF7E13] font-semibold">{{ $schedule->start_time ? substr($schedule->start_time, 0,5) :" - " }} - {{ $schedule->end_time ? substr($schedule->end_time, 0,5) :" - " }}</p>
                                        </div>
                                    @endforeach
                                @else
                                <p>Aquest curs encara no te horari</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contenedor secundario --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col mb-5 min-w-[350px]">
                    <p class="text-[20px] font-bold text-[#011020] mb-3">Descripció:</p>
                    <p class="text-[#5E6468]">{{ $course->description ?? "Aquest curs no té descripció"}}</p>
                </div>
    
            </div>
            
            {{-- Contenedor lateral --}}
            <div class="w-[40%]">
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex-flex-col min-w-[300px]">
                    <div class="flex flex-row justify-between">
                        <p class="text-[20px] font-bold text-[#011020] mb-5">Usuaris inscrits i el seus certificats:</p>
                        <p class="bg-[#ffe7de] text-[#FF7E13] w-7 h-7 flex items-center justify-center rounded-full font-semibold">{{count($totalUsers) }}</p>
                    </div>

                    @if (count($usersPreview) > 0)
                        <div class="flex flex-col gap-5">
                            @foreach ($usersPreview as $user )
                                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-2">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="w-15 h-15 bg-gray-200 rounded-full">
                                                <minidenticon-svg username="{{ md5($user->id) }}"></minidenticon-svg>
                                            </div>
                                            <div>
                                                <a href="{{ route("users.show" , $user) }}" class="font-semibold">{{$user->name ?? " - "}}</a>
                                                <p class="text-[#5E6468]">{{$user->email ?? " - "}}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg width="10" height="10">
                                                <circle cx="5" cy="5" r="5" class="{{ $user->pivot->certificate == "ENTREGAT" ? "fill-green-600" : "fill-red-600" }}"/>
                                            </svg>
                                            <p class="mr-10 {{ $user->pivot->certificate == "ENTREGAT" ? "text-green-600" : "text-red-600" }}">{{ $user->pivot->certificate }}</p>
                                        </div>
                                    </div>

                                    {{-- Certificados --}}
                                    <div class="w-full flex items-center gap-5 mt-3 p-2">
                                        <form action="{{ route("courses.giveCertificate", ["course" => $course, "user" => $user]) }}" method="post" class="flex items-center justify-center w-[50%]">
                                            @csrf
                                            @method("PATCH")
                                            <button type="submit" @disabled($user->pivot->certificate == "ENTREGAT") class="w-full bg-white text-[#FF7E13] border-1 border-[#FF7E13] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 disabled:cursor-not-allowed disabled:bg-gray-400 disabled:text-gray-100 disabled:border-gray-400 disabled:opacity-30">
                                                <svg class="w-6 h-6 ">
                                                    <use xlink:href="#icon-plus"></use>
                                                </svg>
                                                Entregar certificat
                                            </button>
                                        </form>
                                    
                                        <form action="{{ route("courses.removeCertificate", ["course" => $course, "user" => $user]) }}" method="post" class="flex items-center justify-center w-[50%]">
                                            @csrf
                                            @method("PATCH")
                                            <button type="submit" @disabled($user->pivot->certificate == "PENDENT") class="w-full bg-white text-[#FF7E13] border-1 border-[#FF7E13] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 disabled:cursor-not-allowed disabled:bg-gray-400 disabled:text-gray-100 disabled:border-gray-400 disabled:opacity-30">
                                                <svg class="w-6 h-6 ">
                                                    <use xlink:href="#icon-cross"></use>
                                                </svg>
                                                Treure certificat
                                            </button>
                                        </form>

                                    </div>
                                </div>

                            @endforeach

                            @if (count($totalUsers) > 0 && count($totalUsers) > count($usersPreview))
                                <a href="{{ route("courses.users", $course) }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                                    <svg class="w-6 h-6 ">
                                        <use xlink:href="#icon-group-user"></use>
                                    </svg>
                                    Veure tots els usuaris
                                </a>
                            @endif
                        </div>
                    @else
                        <p>Aquest curs no te usuaris inscrits</p>                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection