@extends("layouts.app")
@section("title", "Nou tema pendent")
@section("main")
<div class="w-full flex flex-col items-center justify-center">
    
    <!-- Apartado superior -->
    <div class="w-[60%] flex flex-col gap-5">

        <a href="{{ route("rrhh.index") }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar a la gestió de Temas pendents
        </a>

        <h1 class="text-3xl font-bold text-[#011020]">Nou tema pendent</h1>

        <p class="text-[#AFAFAF] mb-7">Afegeix un nou tema pendent al sistema</p>
    </div>
    <!-- Formulario -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5  text-[#0F172A] min-w-max w-full sm:w-[60%]">
        <form action="{{ route('rrhh.store') }}" method="POST">
            @csrf
            @method("POST")
            <div class="flex items-center gap-3 mb-3 font-semibold">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-user"></use>
                </svg>
                <label for="user_affected">Profesional afectat * </label>
            </div>
            <select name="user_affected" id="user_affected" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <div class="flex items-center gap-3 mb-3 font-semibold">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-chat-bubble-bottom-center"></use>
                </svg>
                <label for="topic">Tema</label>
            </div>
            <input type="text" name="topic" id="topic" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5" placeholder="Introdueix el derivat del tema pendent">

            <div class="flex items-center gap-3 mb-3 font-semibold">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-d20"></use>
                </svg>
                <label for="derivative">Derivat</label>
            </div>
            <textarea name="derivative" id="derivative" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5" placeholder="Introdueix el derivat del tema pendent"></textarea>

            <div class="flex items-center gap-3 mb-3 font-semibold">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-desc"></use>
                </svg>
                <label for="description">Descripcio</label>
            </div>
            <textarea name="description" id="description" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5" placeholder="Introdueix una descripcio"></textarea>

            <div class="flex justify-end gap-5 mt-5">
                <a href="{{ route("rrhh.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">Cancel·lar</a>
                <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                    Crea tema pendent
                </button>
            </div>

        </form>
    </div>
</div>
@endsection