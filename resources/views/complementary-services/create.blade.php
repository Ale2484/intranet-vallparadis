@extends("layouts.app")
@section("title", "Nou servei")
@section("main")
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route("complementary-services.index") }}" class="text-[#AFAFAF] flex flex-row gap-2 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de serveis complementaris
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white ">Nou servei complementari</h1>
            <p class="text-[#AFAFAF]" >Afegeix un nou servei complementari al sistema</p>
        </div>
    </div>

    <!-- Form -->
    <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600 mb-20">
        @include("complementary-services.form", [
            "action" => route('complementary-services.store', $complementaryService),
            "method" => "POST",
            "generalService" => $complementaryService,
            "submitText" => "Crea servei"
        ])
    </div>
</div>
@endsection