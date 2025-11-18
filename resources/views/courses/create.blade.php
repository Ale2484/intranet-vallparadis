@extends("layouts.app")
@section("title", "Nou curs")
@section("main")
<div class="w-full flex flex-col items-center justify-center">
    
    <!-- Apartado superior -->
    <div class="w-[60%] flex flex-col gap-5">

        <a href="{{ route("courses.index") }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar a la gestió de cursos
        </a>

        <h1 class="text-3xl font-bold text-[#011020]">Nou curs</h1>

        <p class="text-[#AFAFAF] mb-7">Afegeix un nou curs al sistema</p>
    </div>
    <!-- Formulario -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-[60%] text-[#0F172A] mb-20">
        @include("courses.form", [
            "action" => route('courses.store', $course),
            "method" => "POST",
            "course" => $course,
            "submitText" => "Crea curs"
        ])
    </div>
</div>
@endsection