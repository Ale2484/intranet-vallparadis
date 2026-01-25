<form action="{{ $action }}" method="POST">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <h2 class="text-xl font-semibold text-[#012F4A] dark:text-white mb-4">Informació del servei</h2>
        </div>
        <!-- Centre -->
        <div>
            <label for="center_id" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-pencil"></use>
                </svg>
                Nom del servei: *
            </label>
            <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white dark:bg-neutral-800 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('name') border-red-500 @enderror" value="{{ old("name", $generalService->name) }}" placeholder="Introdueix un nom per al servei" required>
            @error("name")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Tipus -->
        <div>
            <label for="type" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-cog-6-tooth"></use>
                </svg>
                Tipus: *
            </label>
            <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white dark:bg-neutral-800 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('type') border-red-500 @enderror" required>
                <option value="" selected hidden>Selecciona un tipus de servei</option>
                <option value="bugaderia" {{ old("type", $generalService->type) == "bugaderia" ? "selected" : "" }} >Bugaderia</option>
                <option value="neteja" {{ old("type", $generalService->type) == "neteja" ? "selected" : "" }}> Neteja</option>
                <option value="cuina" {{ old("type", $generalService->type) == "cuina" ? "selected" : ""}}>Cuina</option>
            </select>
            @error("type")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2 mt-4">
            <h2 class="text-xl font-semibold text-[#012F4A] dark:text-white mb-4">Informació del responsable</h2>
        </div>
        <!-- Nom encarregat -->
        <div>
            <label for="manager_name" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-users"></use>
                </svg>
                Nom encarregat: *
            </label>
            <input type="text" name="manager_name" id="manager_name" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white dark:bg-neutral-800 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('manager_name') border-red-500 @enderror" value="{{ old("manager_name", $generalService->manager_name) }}" placeholder="Nom encarregat" required>
            @error("manager_name")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Email de l'encarregat -->
        <div>
            <label for="manager_email" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-mail"></use>
                </svg>
                Email de l'encarregat: *
            </label>
            <input type="email" name="manager_email" id="manager_email" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white dark:bg-neutral-800 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('manager_email') border-red-500 @enderror" value="{{ old("manager_email", $generalService->manager_email) }}" placeholder="Email de l'encarregat" required>
            @error("manager_email")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Telefon de l'encarregat -->
        <div>
            <label for="manager_phone" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-phone"></use>
                </svg>
                Telèfon de l'encarregat:
            </label>
            <input type="text" name="manager_phone" id="manager_phone" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white dark:bg-neutral-800 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('manager_phone') border-red-500 @enderror" value="{{ old("manager_phone", $generalService->manager_phone) }}" placeholder="Telèfon de l'encarregat">
            @error("manager_phone")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Estat -->
        <div>
            <label for="is_active" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-check-circle"></use>
                </svg>
                Estat del servei: *
            </label>
            <select name="is_active" id="is_active" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white dark:bg-neutral-800 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('is_active') border-red-500 @enderror" required>
                <option value="1" {{ old("is_active", $generalService->is_active) == 1 ? "selected" : "" }}>Actiu</option>
                <option value="0" {{ old("is_active", $generalService->is_active) == 0 ? "selected" : "" }}>Inactiu</option>
            </select>
        </div>
        <!-- Personal i horaris -->
        <div class="md:col-span-2 mt-4">
            <h2 class="text-xl font-semibold text-[#012F4A] dark:text-white mb-4">Personal i horaris</h2>
            <div id="rich-editor-container" data-id-input="staff_and_schedules">
            </div>
            <input type="hidden" name="staff_and_schedules" id="staff_and_schedules" value="{{ old("staff_and_schedules", $generalService->staff_and_schedules) }}">
        </div>
    </div>
    
    <!-- Botones -->
    <div class="flex flex-row gap-4 justify-end mt-8 pt-6 border-t border-gray-200 dark:border-neutral-600">
        <a href="{{ route("general-services.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] dark:bg-neutral-800 dark:text-white dark:border-neutral-600">Cancel·lar</a>
        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            {{ $submitText }}
        </button>
    </div>
</form>