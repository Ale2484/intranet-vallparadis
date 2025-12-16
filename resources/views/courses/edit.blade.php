@extends("layouts.app")
@section("title", "Editar el curs")
@section("main")
<div class="w-full flex flex-col items-center justify-center">
    
    <!-- Apartado superior -->
    <div class="w-full md:w-[75%] lg:w-[65%] flex flex-col gap-5">

        <a href="{{ route("courses.index") }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar a la gestió de cursos
        </a>

        <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Edita el curs</h1>

        <p class="text-[#AFAFAF] mb-7">Afegeix un nou curs al sistema</p>
    </div>
    <!-- Formulario -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-full md:w-[75%] lg:w-[65%] text-[#0F172A] mb-20 dark:bg-neutral-800 dark:border-neutral-600">
        @include("courses.form", [
            "action" => route('courses.update', $course),
            "method" => "PATCH",
            "course" => $course,
            "submitText" => "Edita el curs"
        ])
    </div>
</div>
@endsection