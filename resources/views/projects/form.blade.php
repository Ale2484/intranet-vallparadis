<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Información Básica -->
        <div class="md:col-span-2">
            <h2 class="text-xl font-semibold text-[#012F4A] mb-4">Informació bàsica</h2>
        </div>

        <!-- Nombre -->
        <div>
            <label for="name" class="flex text-sm font-medium text-gray-700 mb-2 items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-user"></use>
                </svg>
                Nom *
            </label>
            <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" placeholder="Nom del projecte/comissió"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 @error('name') border-red-500 @enderror"
                    required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Fecha de inicio -->
        <div>
            <label for="start" class="flex text-sm font-medium text-gray-700 mb-2 items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-calendar"></use>
                </svg>
                Data d'inici
            </label>
            <input type="date" name="start" id="start" value="{{ old('start', $project->start ? $project->start->format('Y-m-d') : '') }}"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 @error('start') border-red-500 @enderror">
            @error('start')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Usuario Responsable -->
        <div>
            <label for="user" class="flex text-sm font-medium text-gray-700 mb-2 items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-user"></use>
                </svg>
                Professional responsable *
            </label>
            <select name="user" id="user" 
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 @error('user') border-red-500 @enderror"
            required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user', $project->user) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->role_label }})
                    </option>
                @endforeach
            </select>
        @error('user')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Tipo -->
    <div>
        <label for="type" class="flex text-sm font-medium text-gray-700 mb-2 items-center gap-2">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-key"></use>
            </svg>
            Tipus *
        </label>
        <select name="type" id="type" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 @error('type') border-red-500 @enderror"
                required>
            <option value="">Selecciona un tipus</option>
            <option value="project" {{ old('type', $project->type) == 'project' ? 'selected' : '' }}>Projecte</option>
            <option value="commission" {{ old('type', $project->type) == 'commission' ? 'selected' : '' }}>Comissió</option>
        </select>
        @error('type')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

        <!-- Descripción -->
        <div class="md:col-span-2">
            <label for="description" class="flex text-sm font-medium text-gray-700 mb-2 items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-desc"></use>
                </svg>
                Descripció *
            </label>
            <textarea name="description" id="description" rows="3" placeholder="Descripció del projecte/comissió"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 @error('description') border-red-500 @enderror"
                        required>{{ old('description', $project->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Observaciones -->
        <div class="md:col-span-2">
            <label for="observations" class="flex text-sm font-medium text-gray-700 mb-2 items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-eye"></use>
                </svg>
                Observacions *
            </label>
            <textarea name="observations" id="observations" rows="3" placeholder="Observacions del projecte/comissió"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 @error('observations') border-red-500 @enderror"
                        required>{{ old('observations', $project->observations) }}</textarea>
            @error('observations')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Asignacion de usuarios --}}
        <div class="md:col-span-2">
            <p class="text-xl font-semibold text-[#012F4A] mb-4 flex items-center gap-2">Usuaris inscrits:</p>
            <div class="border border-[#AFAFAF] bg-white rounded-[15px] px-5 block pt-5 pb-5 w-full h-56 overflow-y-auto">
                @foreach ($users as $user)
                    <div class="flex items-center flex-row gap-2 border-1 mb-4 rounded-lg p-2 border-[#AFAFAF]">
                        <input type="checkbox" name="users[]" value="{{ $user->id }}" id="user_{{ $user->id }}"  @if(in_array($user->id, $assignedUsers->pluck('id')->toArray())) checked @endif>
                        <div class="w-12 h-12 bg-gray-200 rounded-full">
                            <minidenticon-svg username="{{ md5($user->id) }}"></minidenticon-svg>
                        </div>
                        <div class="flex flex-col text-[#5E6468]">
                            <label for="user_{{ $user->id }}">
                                {{ $user->name }}
                                <p>{{ $user->email }}</p>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Nuevos Documentos -->
    <div class="md:col-span-2 mt-4 document-upload-container">
        <div class="text-xl font-semibold text-[#012F4A] mb-4 flex items-center gap-2">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-document"></use>
            </svg>
            @if($project->documents->count() > 0)
            Afegir nous documents
            @else
            Documents
            @endif
        </div>
        
        <!-- <div class="document-drop-zone border-2 border-dashed border-gray-300 rounded-lg p-8 text-center transition-colors cursor-pointer">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4">
                <use xlink:href="#icon-upload"></use>
            </svg>
            <div class="flex items-center text-lg justify-center">
                <button type="button" 
                        class="text-[#FE7E13] flex items-center">
                    Fes click per pujar
                </button>
                <span class="text-gray-600 ml-2"> o Arrossega els documents aquí</span>
            </div>
            
            <p class="text-sm text-gray-500 mt-4">
                (PDF, DOC, DOCX, XLS, XLSX)<br>
                Mida màxima: 10MB per document
            </p>
        </div> -->

        <input type="file" 
                name="documents[]" 
                id="documents" 
                multiple 
                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.txt,.zip,.rar">
        
        <!-- Lista de documentos seleccionados -->
        <div id="selectedDocuments" class="mt-6 space-y-3 hidden">
            <h3 class="text-lg font-medium text-gray-700 mb-3">
                @if($project->documents->count() > 0)
                Nous documents seleccionats:
                @else
                Documents seleccionats:
                @endif
            </h3>
            <div id="documentsList" class="space-y-3"></div>
        </div>

        @error('documents.*')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Botones -->
    <div class="flex flex-row gap-4 justify-end mt-8 pt-6 border-t border-gray-200">
        <a href="{{ route('projects.index') }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">
            Cancel·lar
        </a>
        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            {{ $submitText }}
        </button>
    </div>
</form>