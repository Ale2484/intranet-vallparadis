<form action="{{ $action }}" method="POST">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <label for="name" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-document"></use>
                </svg>
                Nom del curs*
            </label>
            <input type="text" name="name" id="name" placeholder="Introdueix el nombre del curs" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('name') border-red-500 @enderror" value="{{ old("name", $course->name) }}" required>
            @error("name")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="hours" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-clock"></use>
                </svg>
                Hores*
            </label>
            <input type="number" step="0.1" name="hours" id="hours" placeholder="Introdueix les hores del curs" max="99999" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('hours') border-red-500 @enderror" value="{{ old("hours", $course->hours) }}" required>
            @error("hours")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="type" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-role"></use>
                </svg>
                Tipus*
            </label>
            <input type="text" name="type" id="type" placeholder="Introdueix el tipus de curs" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('type') border-red-500 @enderror" value="{{ old("type", $course->type) }}" required>
            @error("type")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="modality" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-clock"></use>
                </svg>
                Modalitat*
            </label>
            <select name="modality" id="modality" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('modality') border-red-500 @enderror" required>
                <option value="presencial" {{ old("modality", $course->modality) == "presencial" ? "selected" : "" }}>Presencial</option>
                <option value="online" {{ old("modality", $course->modality) == "online" ? "selected" : "" }}>Online</option>
                <option value="mixt" {{ old("modality", $course->modality) == "mixt" ? "selected" : "" }}>Mixt</option>
            </select>
            @error("modality")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="code" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-key"></use>
                </svg>
                Codi*
            </label>
            <input type="text" name="code" id="code" placeholder="Introdueix el codi del curs" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('code') border-red-500 @enderror" value="{{ old("code", $course->code) }}" required>
            @error("code")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label for="description" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-desc"></use>
                </svg>
                Descripció
            </label>
            <textarea name="description" id="description" placeholder="Descripció del curs" class="w-full h-32 px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('description') border-red-500 @enderror">{{ old("description", $course->description) }}</textarea>
            @error("description")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="start_date" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-calendar"></use>
                </svg>
                Data inici*
            </label>
            <input type="date" name="start_date" id="start_date" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('start_date') border-red-500 @enderror" value="{{ old("start_date", $course->start_date) }}" required>
            @error("start_date")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="end_date" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-calendar"></use>
                </svg>
                Data finalització*
            </label>
            <input type="date" name="end_date" id="end_date" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('end_date') border-red-500 @enderror" value="{{ old("end_date", $course->end_date) }}" required>
            @error("end_date")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="assistant" class="font-medium text-gray-700 mb-2 flex items-center gap-2 dark:text-white">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-user"></use>
                </svg>
                Assistent*
            </label>
            <select name="assistant" id="assistant" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('assistant') border-red-500 @enderror" required>
                <option value="" selected hidden>Selecciona un assistent</option>
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old("assistant", $course->assistant) == $user->id ? "selected" : "" }} >{{ $user->name }}</option>
                    @endforeach
                    @else
                    <option value="" disabled>No hi ha usuaris disponibles</option>
                    @endif
            </select>
            @error("assistant")
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
            <select name="is_active" id="is_active" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('is_active') border-red-500 @enderror" required>
                <option value="1" {{ old("is_active", $course->is_active) == 1 ? "selected" : "" }}>Actiu</option>
                <option value="0" {{ old("is_active", $course->is_active) == 0 ? "selected" : "" }}>Inactiu</option>
            </select>
            @error("is_active")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="md:col-span-2 mt-6">
        <h2 class="text-xl font-semibold text-[#012F4A] dark:text-white mb-4">Horari</h2>
        <div class="border border-gray-300 rounded-lg p-4 overflow-x-auto dark:border-neutral-600">
            <table class="w-full border-separate border-spacing-2 dark:text-white">
                <thead>
                    <tr>
                        <th></th>
                        @foreach ($daysOfWeek as $day)
                            <th class="text-center">{{ $day }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-center">Inici:</th>
                        @foreach ($daysOfWeek as $day)
                        <td>
                            <input type="time"
                                name="schedules[{{ $day }}][start_time]"
                                id="schedules[{{ $day }}][start_time]"
                                value="{{ old('schedules'.$day.'start_time', isset($schedules[$day]['start_time']) ? \Carbon\Carbon::parse($schedules[$day]['start_time'])->format('H:i') : '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th class="text-center">Final:</th>
                        @foreach ($daysOfWeek as $day)
                        <td>
                            <input type="time"
                                name="schedules[{{ $day }}][end_time]"
                                id="schedules[{{ $day }}][end_time]"
                                value="{{ old('schedules'.$day.'end_time', isset($schedules[$day]['end_time']) ? \Carbon\Carbon::parse($schedules[$day]['end_time'])->format('H:i') : '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div class="relative">
            <h2 class="text-xl font-semibold text-[#012F4A] dark:text-white mb-4">Usuaris inscrits</h2>
            <input type="text" placeholder="Cercar un usuari" class="searchUser w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 mb-3">
            <div id="dropZoneLeft" class="border border-gray-300 rounded-lg p-4 h-96 overflow-y-auto dark:border-neutral-600">
                <p class="no-user-message hidden">No hi han usuaris que coincideixin amb la busqueda</p>
                @if ($registeredUsers->isNotEmpty())
                    @foreach ($registeredUsers as $user )
                        <div class="user-item border border-gray-300 rounded-lg p-2 flex items-center w-full gap-2 mb-3 dark:bg-neutral-700 dark:border-neutral-600" data-id="{{ $user->id ?? "" }}" draggable="true">
                            <div class="w-12 h-12 bg-gray-200 rounded-full">
                                @if (!$user->profile_photo_path)
                                    <minidenticon-svg username="{{ md5($user->id) }}" class="w-12 h-12 bg-gray-200 rounded-full"></minidenticon-svg>
                                @else
                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full object-cover">
                                @endif
                            </div>
                            <div>
                                <p class="user-name font-semibold dark:text-white">{{$user->name ?? " - "}}</p>
                                <p class="text-sm text-gray-500 dark:text-neutral-400">{{$user->email ?? " - "}}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
                <p class="no-registered-users {{ $registeredUsers->isNotEmpty() ? "hidden" : "" }}">No hi ha usuaris inscrits</p>
            </div>
            <div class="information-drop absolute top-0 left-0 w-full h-full flex flex-col items-center justify-center z-10 pointer-events-none hidden">
                <svg class="w-10 h-10 text-green-600 dark:text-green-800 font-bold">
                    <use xlink:href="#icon-plus"></use>
                </svg>
                <p class="text-2xl font-bold text-green-600 dark:text-green-800">Inscriure usuari</p>
            </div>
        </div>
        <div class="relative">
            <h2 class="text-xl font-semibold text-[#012F4A] dark:text-white mb-4">Usuaris no inscrits</h2>
            <input type="text" placeholder="Cercar un usuari" class="searchUser w-full px-3 py-2 border border-gray-300 rounded-md dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 mb-3">
            <div id="dropZoneRight" class="border border-gray-300 rounded-lg p-4 h-96 overflow-y-auto dark:border-neutral-600">
                <p class="no-user-message hidden">No hi han usuaris que coincideixin amb la cerca</p>
                @if ($users->isNotEmpty() &&  $users->diff($registeredUsers)->isNotEmpty())
                    @foreach ($users as $user )
                        @if (!$registeredUsers->contains($user))
                            <div class="user-item border border-gray-300 rounded-lg p-2 flex items-center w-full gap-2 mb-3 dark:bg-neutral-700 dark:border-neutral-600" data-id="{{ $user->id ?? "" }}" draggable="true">
                                <div class="w-12 h-12 bg-gray-200 rounded-full">
                                    @if (!$user->profile_photo_path)
                                        <minidenticon-svg username="{{ md5($user->id) }}" class="w-12 h-12 bg-gray-200 rounded-full"></minidenticon-svg>
                                    @else
                                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full object-cover">
                                    @endif
                                </div>
                                <div>
                                    <p class="user-name font-semibold dark:text-white">{{$user->name ?? " - "}}</p>
                                    <p class="text-sm text-gray-500 dark:text-neutral-400">{{$user->email ?? " - "}}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
                <p class="no-registered-users {{ $users->isNotEmpty() &&  $users->diff($registeredUsers)->isNotEmpty() ? 'hidden' : '' }}">No hi ha usuaris que es puguin inscriure al curs</p>
            </div>
            <div class="information-drop absolute top-0 left-0 w-full h-full flex flex-col items-center justify-center z-10 pointer-events-none hidden">
                <svg class="w-10 h-10 text-red-600 dark:text-red-800 font-bold">
                    <use xlink:href="#icon-cross"></use>
                </svg>
                <p class="text-2xl font-bold text-red-600 dark:text-red-800">Desinscriure usuari</p>
            </div>
        </div>
    </div>

    <input type="hidden" name="userIds" id="userIds" value="{{ $registeredUsers->pluck("id")->implode(",") }}">

    <div class="flex justify-end gap-5 mt-8 pt-6 border-t border-gray-200">
        <a href="{{ route("courses.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-600 dark:text-white">Cancel·lar</a>
        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            {{ $submitText }}
        </button>
    </div>
</form>