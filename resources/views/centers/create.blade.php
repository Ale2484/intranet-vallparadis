@extends("layouts.app")
@section("title", "Nou centre")
@section("main")
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route("centers.index") }}" class="text-[#AFAFAF] flex flex-row justify-between items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de centres
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white ">Nou centre</h1>
            <p class="text-[#AFAFAF]" >Afegeix un nou centre al sistema</p>
        </div>
    </div>

    <!-- Form -->
    <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
        @include('centers.form', [
            'action' => route('centers.store', $center),
            'method' => 'POST',
            'center' => $center,
            'submitText' => 'Crea centre'
        ])
    </div>
</div>
@endsection