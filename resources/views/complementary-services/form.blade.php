<form action="{{ $action }}" method="POST">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Centre -->
        <div>
            <label for="center_id" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-center"></use>
                </svg>
                Centre: *
            </label>
            <select name="center_id" id="center_id" class="border shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full h-10 dark:text-white dark:bg-neutral-800 @error('center_id') border-red-600 focus:ring-orange-500 @enderror" required>
                <option value="" {{ old("center_id", $complementaryService->center_id) ? "" : "selected" }} hidden>Selecciona un centre</option>
                @if (count($centers) > 0 )
                    @foreach ($centers as $center)
                        <option value="{{ $center->id }}" {{ old("center_id", $complementaryService->center_id) == $center->id ? "selected" : "" }} >{{ $center->name }}</option>
                    @endforeach
                @else
                    <option value="" disabled>No hi ha centres</option>
                @endif
            </select>
            @error("center_id")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Tipus -->
        <div>
            <label for="type" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-cog-6-tooth"></use>
                </svg>
                Tipus: *
            </label>
            <input type="text" name="type" id="type" placeholder="Introdueix un tipus" value="{{ old("type", $complementaryService->type) }}" required class="border shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full h-10 dark:text-white @error('type')border-red-600 focus:ring-orange-500 @enderror">
            @error("type")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Nom del servei -->
        <div class="md:col-span-2">
            <label for="name" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-pencil"></use>
                </svg>
                Nom del servei: *
            </label>
            <input type="text" name="name" id="name" class="border shadow-sm h-10 p-2 rounded-lg border-[#AFAFAF] w-full dark:text-white @error('name') border-red-600 @enderror" value="{{ old("name", $complementaryService->name) }}" placeholder="Introdueix un nom per al servei" required>
            @error("name")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2 mt-4">
            <h2 class="text-xl font-semibold text-[#012F4A] dark:text-white mb-4">Informació del responsable</h2>
        </div>
        <!-- Nom encarregat -->
        <div>
            <label for="manager_name" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-user"></use>
                </svg>
                Nom de l'encarregat: *
            </label>
            <input type="text" name="manager_name" id="manager_name" class="border shadow-sm h-10 p-2 rounded-lg border-[#AFAFAF] w-full dark:text-white @error('manager_name') border-red-600 @enderror" value="{{ old("manager_name", $complementaryService->manager_name) }}" placeholder="Nom de l'encarregat" required>
            @error("manager_name")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Email de l'encarregat -->
        <div>
            <label for="manager_email" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-mail"></use>
                </svg>
                Email de l'encarregat: *
            </label>
            <input type="email" name="manager_email" id="manager_email" class="border shadow-sm h-10 p-2 rounded-lg border-[#AFAFAF] w-full dark:text-white @error('manager_email') border-red-600 @enderror" value="{{ old("manager_email", $complementaryService->manager_email) }}" placeholder="Email de l'encarregat" required>
            @error("manager_email")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Telefon de l'encarregat -->
        <div>
            <label for="manager_phone" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-phone"></use>
                </svg>
                Telefon de l'encarregat:
            </label>
            <input type="text" name="manager_phone" id="manager_phone" class="border shadow-sm h-10 p-2 rounded-lg border-[#AFAFAF] w-full dark:text-white @error('manager_phone') border-red-600 @enderror" value="{{ old("manager_phone", $complementaryService->manager_phone) }}" placeholder="Telefon de l'encarregat">
            @error("manager_phone")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Estat -->
        <div>
            <label for="is_active" class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-check-circle"></use>
                </svg>
                Estat del servei: *
            </label>
            <select name="is_active" id="is_active" class="border shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full h-10 dark:text-white dark:bg-neutral-800 @error('is_active') border-red-600 focus:ring-orange-500 @enderror" required>
                <option value="1" {{ old("is_active", $complementaryService->is_active) == 1 ? "selected" : "" }}>Actiu</option>
                <option value="0" {{ old("is_active", $complementaryService->is_active) == 0 ? "selected" : "" }}>Inactiu</option>
            </select>
        </div>
        <!-- Horari -->
        <div class="md:col-span-2 mt-4">
            <h2 class="text-xl font-semibold text-[#012F4A] dark:text-white mb-4">Horari</h2>
            <div id="rich-editor-container" data-id-input="schedules"></div>
            <input type="hidden" name="schedules" id="schedules" value="{{ old("schedules", $complementaryService->schedules) }}">
        </div>
    </div>
    
    <!-- Botones -->
    <div class="flex flex-row gap-4 justify-end mt-8 pt-6 border-t border-gray-200 dark:border-neutral-600">
        <a href="{{ route("complementary-services.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] dark:bg-neutral-800 dark:text-white dark:border-neutral-600">Cancel·lar</a>
        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            {{ $submitText }}
        </button>
    </div>
</form>