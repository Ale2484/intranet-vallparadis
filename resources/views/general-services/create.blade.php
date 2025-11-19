@extends("layouts.app")
@section("title", "Nou servei")
@section("main")
<div class="w-full flex flex-col items-center justify-center">    
    <!-- Apartado superior -->
    <div class="w-[60%] flex flex-col gap-5">

        <a href="{{ route("general-services.create") }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar a la gestió de serveis
        </a>

        <h1 class="text-3xl font-bold text-[#011020]">Nou servei</h1>

        <p class="text-[#AFAFAF] mb-7">Afegeix un nou servei al sistema</p>
    </div>
    <!-- Formulario -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-[60%] text-[#0F172A] mb-20">
        @include("general-services.form", [
            "action" => route('general-services.store', $generalService),
            "method" => "POST",
            "generalService" => $generalService,
            "submitText" => "Crea servei"
        ])
    </div>
</div>
@endsection