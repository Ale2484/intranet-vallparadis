@extends("layouts.app")
@section("title", "Nou tema pendent")
@section("main")
<div class="max-w-4xl mx-auto">
    
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route("rrhh.index") }}" class="text-[#AFAFAF] flex flex-row justify-between items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de temes pendents
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white ">Nou tema pendent</h1>
            <p class="text-[#AFAFAF]" >Afegeix un nou tema pendent al sistema</p>
        </div>
    </div>

    <!-- Form -->
    <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
        <form action="{{ route('rrhh.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="user_affected" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                        <svg class="w-6 h-6 dark:text-neutral-400">
                            <use xlink:href="#icon-user"></use>
                        </svg>
                        Professional afectat *
                    </label>
                    <select name="user_affected" id="user_affected" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('user_affected') border-red-500 @enderror" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_affected')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="topic" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                        <svg class="w-6 h-6 dark:text-neutral-400">
                            <use xlink:href="#icon-chat-bubble-bottom-center"></use>
                        </svg>
                        Tema *
                    </label>
                    <input type="text" name="topic" id="topic" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('topic') border-red-500 @enderror" placeholder="Introdueix el tema pendent" required>
                    @error('topic')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="derivative" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                        <svg class="w-6 h-6 dark:text-neutral-400">
                            <use xlink:href="#icon-d20"></use>
                        </svg>
                        Derivat *
                    </label>
                    <textarea name="derivative" id="derivative" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('derivative') border-red-500 @enderror" placeholder="Introdueix el derivat del tema pendent" required></textarea>
                    @error('derivative')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                        <svg class="w-6 h-6 dark:text-neutral-400">
                            <use xlink:href="#icon-desc"></use>
                        </svg>
                        Descripció *
                    </label>
                    <textarea name="description" id="description" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('description') border-red-500 @enderror" placeholder="Introdueix una descripció" required></textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-5 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route("rrhh.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">Cancel·lar</a>
                <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                    Crea tema pendent
                </button>
            </div>
        </form>
    </div>
</div>
@endsection