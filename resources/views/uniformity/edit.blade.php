@extends("layouts.app")
@section("title", "Edita l'uniforme")
@section("main")


<div class="w-full flex flex-col items-center justify-center">

    <!-- Apartado superior -->
    <div class="w-full md:w-[60%] flex flex-col gap-5">

        <a href="{{ route("users.show", $userEdit) }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar a la gestió d'usuaris
        </a>

        <h1 class="text-3xl font-bold text-[#011020]">Editar l'uniforme</h1>

        <p class="text-[#AFAFAF] mb-7">Edita l'uniforme de l'usuari {{ $userEdit->name}}</p>
    </div>
    <!-- Formulario -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-full md:w-[60%] text-[#0F172A]">
        <form action="{{ route("user.uniformity.update", $userEdit ) }}" method="POST">
            @csrf
            @method("PATCH")

            <div class="flex items-center gap-3 mb-3 font-semibold">
                <label for="pants">Pantalons:</label>
            </div>

            <select name="pants" id="pants" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-3">
                <option value="" selected hidden>Selecciona una talla de pantalons</option>
                @foreach ($sizes as $size)
                    <option value="{{ $size }}" {{ old("pants", $uniformity->pants) == $size ? "selected" : "" }}>
                        {{ $size }}
                    </option>
                @endforeach
            </select>

            <div class="flex items-center gap-3 mb-3 font-semibold">
                <label for="shirt">Jersei * </label>
            </div>
            <select name="shirt" id="shirt" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-3">
                <option value="" selected hidden>Selecciona una talla de jersei</option>
                @foreach ($sizes as $size )
                    <option value="{{ $size }}" {{ old("shirt", $uniformity->shirt) == $size ? "selected" : "" }}>
                        {{ $size }}
                    </option>
                @endforeach
            </select>

            <div class="flex items-center gap-3 mb-3 font-semibold">
                <label for="shoes">Sabates</label>
            </div>
            <input type="number" name="shoes" id="shoes" step="0.5" min="30" max="50" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5" value="{{ old("shoes", $uniformity->shoes) }}" placeholder="Introdueix un número de sabates">

            <div class="flex items-center gap-3 mb-3 font-semibold">
                <label for="userRenewal">Usuari que entrega el material</label>
            </div>

            <select name="userRenewal" id="userRenewal" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-10" required>
                <option value="" selected hidden>Selecciona l'usuari que entrega el material</option>
                @foreach ($users as $user )
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <hr class="text-[#AFAFAF]">
            <div class="flex flex-col-reverse md:flex-row justify-end gap-5 mt-5">
                <a href="{{ route("users.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">Cancel·lar</a>
                <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                    Actualitzar uniforme
                </button>
            </div>

        </form>
    </div>
</div>

@endsection