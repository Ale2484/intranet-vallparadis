<form action="{{ $action }}" method="POST">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-user"></use>
                </svg>
                <label for="contact_person" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                    Persona de contacte *
                </label>
            </div>
            <input type="text" name="contact_person" id="contact_person" placeholder="Nom de la persona de contacte" value="{{ old('contact_person', $externalContact->contact_person) }}" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg dark:text-white dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('contact_person') border-red-500 @enderror" required>
            @error('contact_person')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex items-center gap-2 mb-2 dark:text-neutral-400">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-role"></use>
                </svg>
                <label for="company_or_department" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                    Empresa o departament *
                </label>
            </div>
            <input type="text" name="company_or_department" id="company_or_department" placeholder="Empresa o departament" value="{{ old('company_or_department', $externalContact->company_or_department) }}" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg focus:outline-none dark:text-white dark:border-neutral-600 focus:ring-2 focus:ring-orange-500 @error('company_or_department') border-red-500 @enderror" required>
            @error('company_or_department')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-mail"></use>
                </svg>
                <label for="email" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                    Email *
                </label>
            </div>
            <input type="email" name="email" id="email" placeholder="Email del contacte" value="{{ old('email', $externalContact->email) }}" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg dark:text-white dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-phone"></use>
                </svg>
                <label for="phone" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                    Telèfon
                </label>
            </div>
            <input type="text" name="phone" id="phone" placeholder="Telèfon del contacte" value="{{ old('phone', $externalContact->phone) }}" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('phone') border-red-500 @enderror" pattern="^\d{9}$" title="El número de telèfon ha de tenir 9 dígits (ex: 612345678)">
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        @if (auth()->user()->role === 'administracio' || auth()->user()->role === 'equip_directiu')
        <div>
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-desc"></use>
                </svg>
                <label for="reason" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                    Motiu *
                </label>
            </div>
            <input type="text" name="reason" id="reason" placeholder="Motiu del contacte" value="{{ old('reason', $externalContact->reason) }}" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('reason') border-red-500 @enderror" required>
            @error('reason')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        @endif
        <div class="{{ auth()->user()->role == "responsable_equip_tecnic" ? "col-span-2" : "" }}">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-category"></use>
                </svg>
                <label for="category" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                    Categoria *
                </label>
            </div>
            <select name="category" id="category" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg dark:text-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('category') border-red-500 @enderror" required>
                <option value="">Selecciona una categoria</option>
                <option value="assistencial" {{ old('category', $externalContact->category) == 'assistencial' ? 'selected' : '' }}>Assistencial</option>
                <option value="serveis generals" {{ old('category', $externalContact->category) == 'serveis generals' ? 'selected' : '' }}>Serveis Generals</option>
            </select>
            @error('category')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-eye"></use>
                </svg>
                <label for="observations" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                    Observacions
                </label>
            </div>
            <textarea name="observations" id="observations" rows="4" placeholder="Observacions addicionals" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('observations') border-red-500 @enderror">{{ old('observations', $externalContact->observations) }}</textarea>
            @error('observations')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-check-circle"></use>
                </svg>
                <label for="is_active" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                    Estat
                </label>
            </div>
            <select name="is_active" id="is_active" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg focus:outline-none dark:text-white dark:bg-neutral-800 focus:ring-2 focus:ring-orange-500 @error('is_active') border-red-500 @enderror">
                <option value="1" {{ old('is_active', $externalContact->is_active) == 1 ? 'selected' : '' }}>Actiu</option>
                <option value="0" {{ old('is_active', $externalContact->is_active) == 0 ? 'selected' : '' }}>Inactiu</option>
            </select>
            @error('is_active')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Botones -->
    <div class="flex flex-row gap-4 justify-end mt-8 pt-6 border-t border-gray-200">
        <a href="{{ route('external-contacts.index') }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-600 dark:text-white">
            Cancel·lar
        </a>
        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            {{ $submitText }}
        </button>
    </div>
</form>
