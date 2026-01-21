<form action="{{ $action }}" method="POST">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    
    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6 dark:text-neutral-400">
            <use xlink:href="#icon-center"></use>
        </svg>
        <label for="name" class="dark:text-white">Nom del centre* </label>
    </div>
    <div class="mb-5">
        <input type="text" name="name" id="name" class="border shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full dark:text-white @error('name') border-red-500 @enderror" value="{{ old("name", $center->name) }}" placeholder="Introdueix el nom del centre" required>
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6 dark:text-neutral-400">
            <use xlink:href="#icon-maps"></use>
        </svg>
        <label for="address" class="dark:text-white">Adreça* </label>
    </div>
    <div class="mb-5">
        <input type="text" name="address" id="address" class="border shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full dark:text-white @error('address') border-red-500 @enderror" value="{{ old("address", $center->address) }}" placeholder="Introdueix l'adreça del centre" required>
        @error('address')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6 dark:text-neutral-400">
            <use xlink:href="#icon-phone"></use>
        </svg>
        <label for="phone" class="dark:text-white">Telèfon</label>
    </div>
    <div class="mb-5">
        <input type="tel" name="phone" id="phone" class="border shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full dark:text-white @error('phone') border-red-500 @enderror" value="{{ old("phone", $center->phone) }}" placeholder="Introdueix el telèfon del centre">
        @error('phone')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6 dark:text-neutral-400">
            <use xlink:href="#icon-mail"></use>
        </svg>
        <label for="email" class="dark:text-white">Correu electrònic</label>
    </div>
    <div class="mb-5">
        <input type="email" name="email" id="email" class="border shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full dark:text-white @error('email') border-red-500 @enderror" value="{{ old("email", $center->email) }}" placeholder="Introdueix el correu electrònic del centre">
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6 dark:text-neutral-400">
            <use xlink:href="#icon-check-circle"></use>
        </svg>
        <label for="is_active" class="dark:text-white">Estat*</label>
    </div>
    <div>
        <select name="is_active" id="is_active" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-10 dark:text-white @error('is_active') border-red-500 @enderror" required>
            <option value="1" {{ old("is_active", $center->is_active) == 1 ? "selected" : "" }}>Actiu</option>
            <option value="0" {{ old("is_active", $center->is_active) == 0 ? "selected" : "" }}>Inactiu</option>
        </select>
        @error('is_active')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <hr class="text-[#AFAFAF]">

    <div class="flex justify-end gap-5 mt-5">
        <a href="{{ route("centers.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-600 dark:text-white">Cancel·lar</a>
        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            {{ $submitText }}
        </button>
    </div>

</form>