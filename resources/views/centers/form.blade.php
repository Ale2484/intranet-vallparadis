<form action="{{ $action }}" method="POST">
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
    <input type="text" name="name" id="name" class="input-field w-full mb-5" value="{{ old("name", $center->name) }}" placeholder="Introdueix el nom del centre" required>

    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-maps"></use>
        </svg>
        <label for="address">Adreça * </label>
    </div>
    <input type="text" name="address" id="address" class="input-field w-full mb-5" value="{{ old("address", $center->address) }}" placeholder="Introdueix la adreça del centre" required>

    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-phone"></use>
        </svg>
        <label for="phone">Telefon</label>
    </div>
    <input type="tel" name="phone" id="phone" class="input-field w-full mb-5" value="{{ old("phone", $center->phone) }}" placeholder="Introdueix el telefon del centre">

    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-mail"></use>
        </svg>
        <label for="email">Email</label>
    </div>
    <input type="email" name="email" id="email" class="input-field w-full mb-5" value="{{ old("email", $center->email) }}" placeholder="Introdueix l'email del centre">

    <div class="flex items-center gap-3 mb-3 font-semibold">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-mail"></use>
        </svg>
        <label for="is_active">Estat *</label>
    </div>
    <select name="is_active" id="is_active" class="input-field w-full mb-10" required>
        <option value="1" {{ old("is_active", $center->is_active) == 1 ? "selected" : "" }}>Actiu</option>
        <option value="0" {{ old("is_active", $center->is_active) == 0 ? "selected" : "" }}>Inactiu</option>
    </select>

    <hr class="text-[#AFAFAF]">

    <div class="flex justify-end gap-5 mt-5">
        <a href="{{ route("centers.index") }}" class="btn-secondary">Cancel·lar</a>
        <button type="submit" class="btn-primary">
            {{ $submitText }}
        </button>
    </div>

</form>