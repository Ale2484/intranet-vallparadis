@extends("layouts.app")
@section("title", "Nou manteniment")
@section("main")
<div class="w-full flex flex-col items-center justify-center dark:text-white">
    
    <!-- Apartado superior -->
    <div class="w-full md:w-[60%] flex flex-col gap-5">

        <a href="{{ route("maintenance.index") }}" class="flex gap-3 text-[#AFAFAF]">
            <svg class="w-6 h-6 ">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar a la gestió de manteniments
        </a>

        <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Nou manteniment</h1>

        <p class="text-[#AFAFAF] mb-7">Afegeix un nou manteniment al sistema</p>
    </div>
    <!-- Formulario -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5  text-[#0F172A] min-w-max w-full md:w-[60%] dark:bg-neutral-800 dark:border-neutral-600 dark:text-white">
        <form action="{{ route('maintenance.store') }}" method="POST">
            @csrf
            @method("POST")
             <div class="flex items-center gap-3 mb-3 font-semibold">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-chat-bubble-bottom-center"></use>
                </svg>
                <label for="topic">Tema</label>
            </div>
            <div class="mb-5">
                <input type="text" name="topic" id="topic" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full focus:outline-none focus:ring-2 focus:ring-orange-500 @error('topic') border-red-500 @enderror" value="{{ old("topic") }}" placeholder="Introdueix el tema del manteniment">
                @error('topic')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 mb-3 font-semibold">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-user"></use>
                </svg>
                <label for="responsible">Responsable *</label>
            </div>
            <div class="mb-5">
                <textarea name="responsible" id="responsible" class="border shadow-sm p-2 rounded-lg border-[#AFAFAF] focus:outline-none focus:ring-2 focus:ring-orange-500 w-full @error('responsible') border-red-500 @enderror" placeholder="Introdueix el responsable del manteniment">{{ old("responsible") }}</textarea>
                @error('responsible')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 mb-3 font-semibold">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-desc"></use>
                </svg>
                <label for="description">Descripció</label>
            </div>
            <div class="mb-5">
                <textarea name="description" id="description" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] focus:outline-none focus:ring-2 focus:ring-orange-500 w-full @error('description') border-red-500 @enderror" placeholder="Introdueix una descripció">{{ old("description") }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-5 mt-5">
                <a href="{{ route("maintenance.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-600 dark:text-white">Cancel·lar</a>
                <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all ">
                    Crea manteniment
                </button>
            </div>

        </form>
    </div>
</div>
@endsection