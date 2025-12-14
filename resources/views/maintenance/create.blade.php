@extends("layouts.app")
@section("title", "Nou centre")
@section("main")
<div class="w-full flex flex-col items-center justify-center">
    
    <!-- Apartado superior -->
    <div class="w-[60%] flex flex-col gap-5">

        <a href="{{ route("maintenance.index") }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar a la gestió de manteniments
        </a>

        <h1 class="text-3xl font-bold text-[#011020]">Nou manteniment</h1>

        <p class="text-[#AFAFAF] mb-7">Afegeix un nou manteniment al sistema</p>
    </div>
    <!-- Formulario -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-[60%] text-[#0F172A]">
        <form action="{{ route('maintenance.store') }}" method="POST">
            @csrf
            @method("POST")
            
            <div class="flex items-center gap-3 mb-3 font-semibold">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-center"></use>
                </svg>
                <label for="center">Nom del centre * </label>
            </div>
            <select name="center" id="center" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5">
                @foreach ($centers as $center)
                    <option value="{{ $center->id }}">{{ $center->name }}</option>
                @endforeach
            </select>
             <div class="flex items-center gap-3 mb-3 font-semibold">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-chat-bubble-bottom-center"></use>
                </svg>
                <label for="topic">Tema</label>
            </div>
            <input type="text" name="topic" id="topic" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5" placeholder="Introdueix el derivat del manteniment">

            <div class="flex items-center gap-3 mb-3 font-semibold">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-d20"></use>
                </svg>
                <label for="responsible">Responsable *</label>
            </div>
            <textarea name="responsible" id="responsible" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5" placeholder="Introdueix el derivat del manteniment"></textarea>

            <div class="flex items-center gap-3 mb-3 font-semibold">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-desc"></use>
                </svg>
                <label for="description">Descripcio</label>
            </div>
            <textarea name="description" id="description" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5" placeholder="Introdueix una descripcio"></textarea>

            <div class="flex justify-end gap-5 mt-5">
                <a href="{{ route("maintenance.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">Cancel·lar</a>
                <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                    Crea manteniment
                </button>
            </div>

        </form>
    </div>
</div>
@endsection