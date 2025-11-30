<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    
    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-center"></use>
        </svg>
        <label for="name">Nom del centre * </label>
    </div>
    <input type="text" name="name" id="name" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5" value="{{ old("name", $center->name) }}" placeholder="Introdueix el nom del centre" required>

    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-maps"></use>
        </svg>
        <label for="address">Adreça * </label>
    </div>
    <input type="text" name="address" id="address" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5" value="{{ old("address", $center->address) }}" placeholder="Introdueix la adreça del centre" required>

    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-phone"></use>
        </svg>
        <label for="phone">Telefon</label>
    </div>
    <input type="tel" name="phone" id="phone" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5" value="{{ old("phone", $center->phone) }}" placeholder="Introdueix el telefon del centre">

    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-mail"></use>
        </svg>
        <label for="email">Email</label>
    </div>
    <input type="email" name="email" id="email" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5" value="{{ old("email", $center->email) }}" placeholder="Introdueix l'email del centre">

    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-check-circle"></use>
        </svg>
        <label for="is_active">Estat *</label>
    </div>
    <select name="is_active" id="is_active" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-5" required>
        <option value="1" {{ old("is_active", $center->is_active) == 1 ? "selected" : "" }}>Actiu</option>
        <option value="0" {{ old("is_active", $center->is_active) == 0 ? "selected" : "" }}>Inactiu</option>
    </select>

    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-desc"></use>
        </svg>
        <label for="is_active">Arxius *</label>
    </div>
    <input type="file" name="files[]" id="files" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-10" multiple>

    <hr class="text-[#AFAFAF]">

    <div class="flex justify-end gap-5 mt-5">
        <a href="{{ route("centers.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">Cancel·lar</a>
        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            {{ $submitText }}
        </button>
    </div>

</form>