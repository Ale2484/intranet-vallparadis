<form action="{{ $action }}" method="POST">
    @csrf
    @isset($method)
        @method($method)        
    @endisset
    <div class="flex flex-col gap-5">
        {{-- Contenedor de 2 --}}
        <div class="flex flex-row gap-5 items-center mb-1">
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-center"></use>
                        </svg>
                        <p>Centre:</p>
                    </div>
                </div>
                <select name="center_id" id="center_id" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full @error('center_id') border-red-600 @enderror" required>
                    <option value="" selected hidden>Selecciona un centre</option>
                    @if (count($centers) > 0 )
                        @foreach ($centers as $center)
                            <option value="{{ $center->id }}" {{ old("center_id") == $center->id ? "selected" : "" }} >{{ $center->name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled>No hi ha centres</option>
                    @endif
                </select>
            </div>
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-key"></use>
                        </svg>
                        <p>Codi:</p>
                    </div>
                </div>
                <input type="text" name="code" id="code" placeholder="Introdueix el codi del curs" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full @error('code') border-red-600 @enderror" value="{{ old("code", $course->code) }}" required>
            </div>
        </div>
        {{-- Contenedor de 2 --}}
        <div class="flex flex-row gap-5 items-center mb-1">
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-clock"></use>
                        </svg>
                        <p>Hores:</p>
                    </div>
                </div>
                <input type="number" step="0.1" name="hours" id="hours" placeholder="Introdueix les hores del curs" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full @error('hours') border-red-600 @enderror" value="{{ old("hours", $course->hours) }}" required>
            </div>
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-role"></use>
                        </svg>
                        <p>Tipus:</p>
                    </div>
                </div>
                <input type="text" name="type" id="type" placeholder="Introdueix el tipus de curs" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full @error('type') border-red-600 @enderror" value="{{ old("type", $course->type) }}" required>
            </div>
        </div>
        {{-- Contenedor de 2 --}}
        <div class="flex flex-row gap-5 items-center mb-1">
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-clock"></use>
                        </svg>
                        <p>Modalitat:</p>
                    </div>
                </div>
                <input type="text" name="modality" id="modality" placeholder="Introdueix la modalitat del curs" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full @error('modality') border-red-600 @enderror" value="{{ old("modality", $course->modality) }}" required>
            </div>
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-document"></use>
                        </svg>
                        <p>Nombre:</p>
                    </div>
                </div>
                <input type="text" name="name" id="name" placeholder="Introdueix el nombre del curs" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full @error('name') border-red-600 @enderror" value="{{ old("name", $course->name) }}" required>
            </div>
        </div>
        {{-- Contenedor de 2 --}}
        <div class="flex flex-col gap-5 mb-1">
            <div class="flex gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-desc"></use>
                </svg>
                <p>Descripció:</p>
            </div>
            <textarea name="description" id="description" placeholder="Descripció del curs" class="w-12/12 h-50 border-1 border-[#AFAFAF] rounded-lg p-3 max-h-[250px] @error('description') border-red-600 @enderror" value="{{ old("description", $course->description) }}"></textarea>
        </div>
        {{-- Contenedor de 2 --}}
        <div class="flex flex-row gap-5 items-center mb-1">
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-calendar"></use>
                        </svg>
                        <p>Data d'inici:</p>
                    </div>
                </div>
                <input type="date" name="start_date" id="start_date" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full @error('start_date') border-red-600 @enderror" value="{{ old("start_date", $course->start_date) }}" required>
            </div>
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-calendar"></use>
                        </svg>
                        <p>Data de finalització:</p>
                    </div>
                </div>
                <input type="date" name="end_date" id="end_date" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full @error('end_date') border-red-600 @enderror" value="{{ old("end_date", $course->end_date) }}" required>
            </div>
        </div>
        {{-- Contenedor de 2 --}}
        <div class="flex flex-row gap-5 items-center mb-1">
            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-user"></use>
                        </svg>
                        <p>Assitent:</p>
                    </div>
                </div>
                <select name="assistant" id="assistant" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-10 @error('assistant') border-red-600 @enderror" required>
                    <option value="" selected hidden>Selecciona un assistent</option>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old("assistant") == $user->id ? "selected" : "" }} >{{ $user->name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled>No hi ha usuaris disponibles</option>
                    @endif
                </select>
            </div>            <div class="w-1/2 flex flex-col gap-2">
                <div class="flex flex-row">
                    <div class="flex flex-row items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-check-circle"></use>
                        </svg>
                        <p>Estat:</p>
                    </div>
                </div>
                <select name="is_active" id="is_active" class="border-1 shadow-sm p-2 rounded-lg border-[#AFAFAF] w-full mb-10 @error('is_active') border-red-600 @enderror" required>
                    <option value="1" {{ old("is_active", $course->is_active) == 1 ? "selected" : "" }}>Actiu</option>
                    <option value="0" {{ old("is_active", $course->is_active) == 0 ? "selected" : "" }}>Inactiu</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end gap-5">
            <a href="{{ route("courses.index") }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">Cancel·lar</a>
            <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                {{ $submitText }}
            </button>
        </div>
    </div>
</form>