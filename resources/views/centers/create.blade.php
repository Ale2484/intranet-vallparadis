@extends("layouts.application")

@section("main")
<div class="w-full flex flex-col items-center justify-center">
    
    <!-- Apartado superior -->
    <div class="w-[60%] flex flex-col gap-5">

        <a href="{{ route("centers.index") }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar a la gestió de centres
        </a>

        <h1 class="title">Nou centre</h1>

        <p class="text-[#AFAFAF] mb-7">Afegeix un nou centre al sistema</p>
    </div>
    <!-- Formulario -->
    <div class="simple-container w-[60%] text-[#0F172A]">
        @include('centers.form', [
            'action' => route('centers.store', $center),
            'method' => 'POST',
            'center' => $center,
            'submitText' => 'Crea centre'
        ])
    </div>
</div>
@endsection