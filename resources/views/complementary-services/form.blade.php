<form action="{{ $action }}" method="POST">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    <div class="flex flex-col gap-5">
        {{-- Contenedor de 2 --}}
        <div class="flex flex-row gap-5 items-start mb-1">
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-start gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-center"></use>
                        </svg>
                        <label for="center_id">Centre:</label>
                    </div>
                </div>
                <div>
                    <select name="center_id" id="center_id" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full h-10 @error('center_id') border-red-600 focus:ring-orange-500 @enderror" required>
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
            </div>
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-cog-6-tooth"></use>
                        </svg>
                        <label for="type">Tipus:</label>
                    </div>
                </div>
                <div>
                    <input type="text" name="type" id="type" placeholder="Introdueix un tipus" required class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full h-10 @error('type')border-red-600 focus:ring-orange-500 @enderror">
                    @error("type")
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        {{-- Contenedor de 2 --}}
        <div class="flex flex-row gap-5 items-start mb-1">
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-pencil"></use>
                        </svg>
                        <label for="name">Nom del servei:</label>
                    </div>
                </div>
                <div>
                    <input type="text" name="name" id="name" class="border-1 shadow-sm h-10 p-2 rounded-lg border-[#AFAFAF] w-full @error('name') border-red-600 @enderror" value="{{ old("name", $complementaryService->name) }}" placeholder="Introdueix un nom per al servei" required>
                    @error("name")
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        {{-- Contenedor de 2 --}}
        <div class="flex flex-row gap-5 items-start mb-1">
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-user"></use>
                        </svg>
                        <label for="manager_name">Nom de l'encarregat:</label>
                    </div>
                </div>
                <div>
                    <input type="text" name="manager_name" id="manager_name" class="border-1 shadow-sm h-10 p-2 rounded-lg border-[#AFAFAF] w-full @error('manager_name') border-red-600 @enderror" value="{{ old("manager_name", $complementaryService->manager_name) }}" placeholder="Nom de l'encarregat" required>
                    @error("manager_name")
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-mail"></use>
                        </svg>
                        <label for="manager_email">Email de l'encarregat:</label>
                    </div>
                </div>
                <div>
                    <input type="email" name="manager_email" id="manager_email" class="border-1 shadow-sm h-10 p-2 rounded-lg border-[#AFAFAF] w-full @error('type') border-red-600 @enderror" value="{{ old("manager_email", $complementaryService->manager_email) }}" placeholder="Email de l'encarregat" required>
                    @error("manager_email")
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        {{-- Contenedor de 2 --}}
        <div class="flex flex-row gap-5 items-start mb-1">
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-phone"></use>
                        </svg>
                        <label for="manager_phone">Telefon de l'encarregat:</p>
                    </div>
                </div>
                <div>
                    <input type="text" name="manager_phone" id="manager_phone" class="border-1 shadow-sm h-10 p-2 rounded-lg border-[#AFAFAF] w-full @error('manager_name') border-red-600 @enderror" value="{{ old("manager_phone", $complementaryService->manager_phone) }}" placeholder="Telefon de l'encarregat">
                    @error("manager_phone")
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-check-circle"></use>
                        </svg>
                        <label for="is_active">Estat del curs:</label>
                    </div>
                </div>
                <div>
                    <select name="is_active" id="is_active" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full h-10 @error('is_active') border-red-600 focus:ring-orange-500 @enderror" required>
                        <option value="1" {{ old("is_active", $complementaryService->is_active) == 1 ? "selected" : "" }}>Actiu</option>
                        <option value="0" {{ old("is_active", $complementaryService->is_active) == 0 ? "selected" : "" }}>Inactiu</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-2 mt-3 mb-2">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-users"></use>
        </svg>
        <label for="">Horari:</label>
    </div>
    <div id="rich-editor-container" data-id-input="schedules">

    </div>

    <input type="hidden" name="schedules" id="schedules" value="{{ old("schedules", $complementaryService->schedules) }}">
    <hr class="mt-10 text-[#AFAFAF]">
    <div class="flex justify-end gap-5 mt-5">
        <a href="{{ route("general-services.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">Cancel·lar</a>
        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            {{ $submitText }}
        </button>
    </div>
</form>