@extends('layouts.application')

@section('main')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('projects.index') }}" class="text-[#AFAFAF] flex flex-row justify-between items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de projectes/comissions
            </a>
            <h1 class="text-3xl font-bold title mb-0!">Editar projecte/comissió</h1>
            <p class="text-[#AFAFAF]">Modifica les dades del projecte/comissió</p>
        </div>
    </div>

    <!-- Form -->
    <div class="shadow-md simple-container mb-10">
        <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información Básica -->
                <div class="md:col-span-2">
                    <h2 class="text-xl font-semibold principal-text-color mb-4">Informació bàsica</h2>
                </div>

                <!-- Nombre -->
                <div class="">
                    <label for="name" class="flex text-sm font-medium text-gray-700 mb-2 items-center gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-user"></use>
                        </svg>
                        Nom *
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
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
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('start') border-red-500 @enderror">
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
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('user') border-red-500 @enderror"
                    required>
                    <option value="">Selecciona un professional</option>
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
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type') border-red-500 @enderror"
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
                    <textarea name="description" id="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
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
                    <textarea name="observations" id="observations" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('observations') border-red-500 @enderror"
                              required>{{ old('observations', $project->observations) }}</textarea>
                    @error('observations')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Nuevos Documentos -->
            <div class="md:col-span-2 mt-4 document-upload-container">
                <div class="text-xl font-semibold principal-text-color mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-document"></use>
                    </svg>
                    @if($project->documents->count() > 0)
                    Afegir nous documents
                    @else
                    Documents
                    @endif
                </div>
                
                <div class="document-drop-zone border-2 border-dashed border-gray-300 rounded-lg p-8 text-center transition-colors cursor-pointer">
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
                </div>

                <input type="file" 
                       name="documents[]" 
                       id="documents" 
                       multiple 
                       class="hidden"
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
                <a href="{{ route('projects.index') }}" class="btn-secondary">
                    Cancel·lar
                </a>
                <button type="submit" class="btn-primary">
                    Actualitzar projecte/comissió
                </button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/projects.js') }}"></script>
@endsection