@extends('layouts.application')

@section('main')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <h1 class="text-3xl font-bold title">Detall del projecte/comissió</h1>
        <a href="{{ route('projects.index') }}" class="btn-secondary h-fit">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Columna izquierda - Información principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Tarjeta de información básica -->
            <div class="shadow-md simple-container">
                <h2 class="text-xl font-semibold principal-text-color mb-4">Informació bàsica</h2>
                
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Icono -->
                    <div class="flex-shrink-0">
                        <div class="bg-gray-200 rounded-lg p-8 w-24 h-24 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-600">
                                <use xlink:href="#icon-folder"></use>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Información del proyecto -->
                    <div class="space-y-4 flex-1">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between">
                            <h3 class="text-2xl font-bold principal-text-color">{{ $project->name }}</h3>
                            @if($project->is_active)
                                <div class="p-2 bg-green-200 text-green-600 border-green-600 border-1 rounded-2xl h-fit w-fit text-center text-sm font-medium mt-2 sm:mt-0">
                                    Actiu
                                </div>
                            @else
                                <div class="p-2 bg-red-200 text-red-600 border-red-600 border-1 rounded-2xl h-fit w-fit text-center text-sm font-medium mt-2 sm:mt-0">
                                    Inactiu
                                </div>
                            @endif
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex items-center text-[#011020]">
                                <svg class="w-5 h-5 flex-shrink-0">
                                    <use xlink:href="#icon-tag"></use>
                                </svg>
                                <span class="ml-2">{{ $project->type_label }}</span>
                            </div>
                            
                            <div class="flex items-center text-[#011020]">
                                <svg class="w-5 h-5 flex-shrink-0">
                                    <use xlink:href="#icon-calendar"></use>
                                </svg>
                                <span class="ml-2">{{ $project->formatted_start }}</span>
                            </div>
                            
                            <div class="flex items-center text-[#011020]">
                                <svg class="w-5 h-5 flex-shrink-0">
                                    <use xlink:href="#icon-center"></use>
                                </svg>
                                <span class="ml-2">{{ $project->centerRelation->name ?? 'Centre no assignat' }}</span>
                            </div>
                            
                            <div class="flex items-center text-[#011020]">
                                <svg class="w-5 h-5 flex-shrink-0">
                                    <use xlink:href="#icon-user"></use>
                                </svg>
                                <span class="ml-2">{{ $project->userRelation->name ?? 'Professional no assignat' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de descripción -->
            <div class="shadow-md simple-container">
                <h2 class="text-xl font-semibold principal-text-color mb-4">Descripció</h2>
                <p class="text-[#011020] whitespace-pre-wrap">{{ $project->description }}</p>
            </div>

            <!-- Tarjeta de observaciones -->
            <div class="shadow-md simple-container">
                <h2 class="text-xl font-semibold principal-text-color mb-4">Observacions</h2>
                <p class="text-[#011020] whitespace-pre-wrap">{{ $project->observations }}</p>
            </div>
        </div>

        <!-- Columna derecha - Acciones e información adicional -->
        <div class="space-y-6">
            <!-- Tarjeta de acciones -->
            <div class="shadow-md simple-container">
                <h2 class="text-xl font-semibold principal-text-color mb-4">Accions</h2>
                
                <div class="space-y-3">
                    <a href="{{ route('projects.edit', $project) }}" 
                       class="w-full flex items-center justify-center gap-2 btn-secondary">
                        <svg class="w-5 h-5">
                            <use xlink:href="#icon-square-pen"></use>
                        </svg>
                        Editar
                    </a>
                    
                    @if($project->is_active)
                        <form action="{{ route('projects.deactivate', $project) }}" method="POST" class="w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="w-full flex items-center justify-center gap-2 deactivate-button">
                                <svg class="w-5 h-5">
                                    <use xlink:href="#icon-power"></use>
                                </svg>
                                Desactivar
                            </button>
                        </form>
                    @else
                        <form action="{{ route('projects.activate', $project) }}" method="POST" class="w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="w-full flex items-center justify-center gap-2 activate-button">
                                <svg class="w-5 h-5">
                                    <use xlink:href="#icon-power"></use>
                                </svg>
                                Activar
                            </button>
                        </form>
                    @endif
                    
                    <!-- Botón eliminar con confirmación -->
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" 
                          class="w-full" 
                          onsubmit="return confirm('Estàs segur que vols eliminar aquest projecte/comissió? Aquesta acció no es pot desfer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-200">
                            <svg class="w-5 h-5">
                                <use xlink:href="#icon-trash"></use>
                            </svg>
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tarjeta de información de sistema -->
            <div class="shadow-md simple-container">
                <h2 class="text-xl font-semibold principal-text-color mb-4">Informació del sistema</h2>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Data de creació:</span>
                        <span class="font-medium">
                            {{ $project->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Última actualització:</span>
                        <span class="font-medium">
                            {{ $project->updated_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Estat:</span>
                        <span class="font-medium">
                            @if($project->is_active)
                                <span class="text-green-600">Actiu</span>
                            @else
                                <span class="text-red-600">Inactiu</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de estado -->
            <div class="shadow-md simple-container">
                <h2 class="text-xl font-semibold principal-text-color mb-4">Estat</h2>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 rounded-lg 
                        @if($project->is_active) bg-green-50 border border-green-200 @else bg-red-50 border border-red-200 @endif">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 @if($project->is_active) text-green-600 @else text-red-600 @endif">
                                <use xlink:href="#icon-power"></use>
                            </svg>
                            <span class="ml-2 font-medium @if($project->is_active) text-green-800 @else text-red-800 @endif">
                                {{ $project->is_active ? 'Actiu' : 'Inactiu' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 rounded-lg bg-blue-50 border border-blue-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600">
                                <use xlink:href="#icon-tag"></use>
                            </svg>
                            <span class="ml-2 font-medium text-blue-800">
                                {{ $project->type_label }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection