@extends("layouts.application")

@section("main")
<div class="w-full flex flex-col items-center justify-center">
    
    <!-- Apartado superior -->
    <div class="w-[60%] flex flex-col gap-3">

        <a href="{{ route("centers.index") }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-no-line-arrow"></use>
            </svg>
            Tornar a la gestió de centres
        </a>

        <h1 class="title">Editar el centre</h1>

        <p class="text-[#AFAFAF] mb-7">Edita el centre del sistema</p>
    </div>
    <!-- Formulario -->
    <div class="simple-container w-[60%] text-[#0F172A]">
        @include('centers._form', [
            'action' => route('centers.update', $center),
            'method' => 'PATCH',
            'center' => $center,
            'submitText' => 'Edita el centre'
        ])

    </div>
</div>
@endsection