@extends("layouts.app")
@section("title", "Edita el centre")
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

        <h1 class="text-3xl font-bold text-[#011020]">Editar el centre</h1>

        <p class="text-[#AFAFAF] mb-7">Edita el centre del sistema</p>
    </div>
    <!-- Formulario -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-[60%] text-[#0F172A]">
        @include('centers.form', [
            'action' => route('centers.update', $center),
            'method' => 'PATCH',
            'center' => $center,
            'submitText' => 'Edita el centre'
        ])

    </div>
</div>
@endsection