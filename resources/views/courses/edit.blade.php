@extends("layouts.app")
@section("title", "Editar el curs")
@section("main")
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route("courses.index") }}" class="text-[#AFAFAF] flex flex-row justify-between items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de cursos
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white ">Editar curs</h1>
            <p class="text-[#AFAFAF]" >Edita un curs al sistema</p>
        </div>
    </div>

    <!-- Form -->
    <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600 mb-20">
        @include("courses.form", [
            "action" => route('courses.update', $course),
            "method" => "PATCH",
            "course" => $course,
            "submitText" => "Edita el curs"
        ])
    </div>
</div>
@endsection