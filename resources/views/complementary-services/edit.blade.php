@extends("layouts.app")
@section("title", "Editar el servei")
@section("main")
<div class="w-full flex flex-col items-center justify-center">    
    <!-- Apartado superior -->
    <div class="w-[60%] flex flex-col gap-5">
        <a href="{{ route("complementary-services.index") }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar a la gestió de serveis complementaris
        </a>

        <h1 class="text-3xl font-bold text-[#011020]">Edita el servei complementari</h1>

        <p class="text-[#AFAFAF] mb-7">Edita el servei del sistema</p>
    </div>
    <!-- Formulario -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-[60%] text-[#0F172A] mb-20">
        @include("complementary-services.form", [
            "action" => route('complementary-services.update', $complementaryService),
            "method" => "PATCH",
            "complementaryService" => $complementaryService,
            "submitText" => "Edita el servei"
        ])
    </div>
</div>
@endsection