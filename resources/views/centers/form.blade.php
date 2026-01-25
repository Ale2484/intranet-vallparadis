<form action="{{ $action }}" method="POST">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="name" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-center"></use>
                </svg>
                Nom del centre*
            </label>
            <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('name') border-red-500 @enderror" value="{{ old("name", $center->name) }}" placeholder="Introdueix el nom del centre" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="address" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-maps"></use>
                </svg>
                Adreça*
            </label>
            <input type="text" name="address" id="address" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('address') border-red-500 @enderror" value="{{ old("address", $center->address) }}" placeholder="Introdueix l'adreça del centre" required>
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="phone" class=" font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-phone"></use>
                </svg>
                Telèfon
            </label>
            <input type="tel" name="phone" id="phone" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('phone') border-red-500 @enderror" value="{{ old("phone", $center->phone) }}" placeholder="Introdueix el telèfon del centre">
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-mail"></use>
                </svg>
                Correu electrònic
            </label>
            <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror" value="{{ old("email", $center->email) }}" placeholder="Introdueix el correu electrònic del centre">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="is_active" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-check-circle"></use>
                </svg>
                Estat*
            </label>
            <select name="is_active" id="is_active" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500  @error('is_active') border-red-500 @enderror" required>
                <option value="1" {{ old("is_active", $center->is_active) == 1 ? "selected" : "" }}>Actiu</option>
                <option value="0" {{ old("is_active", $center->is_active) == 0 ? "selected" : "" }}>Inactiu</option>
            </select>
            @error('is_active')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex justify-end gap-5 mt-8 pt-6 border-t border-gray-200">
        <a href="{{ route("centers.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">Cancel·lar</a>
        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            {{ $submitText }}
        </button>
    </div>

</form>