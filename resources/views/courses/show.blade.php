@extends("layouts.app")
@section("title", "Mostra el curs")
@section("main")
<div class="w-full flex items-center justify-center">
    <div class="w-[90%] flex flex-col items-center justify-center">   
        <!-- Apartado superior -->
        <div class="w-full flex flex-col gap-3">
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
        <!-- Contenedor principal -->
        <div class="w-full flex flex-wrap flex-row justify-between gap-5 text-[#011020]">
            
            <div class="w-[60%] flex flex-col gap-3">
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
            <div class="w-[35%]">
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex-flex-col min-w-[300px]">
                    <div class="flex flex-row justify-between">
                        <p class="text-[20px] font-bold text-[#011020] mb-5">Usuaris inscrits:</p>
                        <p class="bg-[#ffe7de] text-[#FF7E13] w-7 h-7 flex items-center justify-center rounded-full font-semibold">{{count($totalUsers) }}</p>
                    </div>

                    @if (count($usersPreview) > 0)
                        <div class="flex flex-col gap-5">
                            @foreach ($usersPreview as $user )
                            <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-2 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-15 h-15 bg-gray-200 rounded-full">
                                        <minidenticon-svg username="{{ md5($user->id) }}"></minidenticon-svg>
                                    </div>
                                    <div>
                                        <a href="{{ route("users.show" , $user) }}" class="font-semibold">{{$user->name ?? " - "}}</a>
                                        <p class="text-[#5E6468]">{{$user->email ?? " - "}}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-5">
                                    @if ($user->pivot->certificate == "PENDENT")
                                        <div class="text-green-600 bg-green-200 p-2 rounded-lg flex items-center justify-center">
                                            <form action="{{ route("courses.giveCertificate", ["course" => $course, "user" => $user]) }}" method="post" class="flex items-center justify-center">
                                                @csrf
                                                @method("PATCH")
                                                <button type="submit" class="cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M12 15a3 3 0 1 0 6 0a3 3 0 1 0-6 0"/><path d="M13 17.5V22l2-1.5l2 1.5v-4.5"/><path d="M10 19H5a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v10a2 2 0 0 1-1 1.73M6 9h12M6 12h3m-3 3h2"/></g></svg>
                                                </button>
                                            </form>
                                        </div>
                                        @else
                                            <div class="text-red-600 bg-red-200 p-2 rounded-lg flex items-center justify-center">                                         
                                                <form action="{{ route("courses.giveCertificate", ["course" => $course, "user" => $user]) }}" method="post" class="flex items-center justify-center">
                                                    @csrf
                                                    @method("PATCH")
                                                    <button type="submit" class="cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M12.876 12.881a3 3 0 0 0 4.243 4.243m.588-3.42a3 3 0 0 0-1.437-1.423"/><path d="M13 17.5V22l2-1.5l2 1.5v-4.5M10 19H5a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2m4 0h10a2 2 0 0 1 2 2v10M6 9h3m4 0h5M6 12h3m-3 3h2M3 3l18 18"/></g></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                        
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