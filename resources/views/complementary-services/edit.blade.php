@extends("layouts.app")
@section("title", "Editar el servei")
@section("main")
<div class="w-full flex flex-col items-center justify-center">    
    <!-- Apartado superior -->
    <div class="md:w-[60%] w-full flex flex-col gap-5">
        <a href="{{ route("complementary-services.index") }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar a la gestió de serveis complementaris
        </a>

        <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Edita el servei complementari</h1>

        <p class="text-[#AFAFAF] mb-7">Edita el servei del sistema</p>
    </div>
    <!-- Formulario -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 md:w-[60%] w-full text-[#0F172A] dark:bg-neutral-800 dark:border-neutral-600">
        @include("complementary-services.form", [
            "action" => route('complementary-services.update', $complementaryService),
            "method" => "PATCH",
            "complementaryService" => $complementaryService,
            "submitText" => "Edita el servei"
        ])
    </div>
</div>
@endsection