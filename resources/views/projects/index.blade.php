@extends('layouts.application')

@section('main')
<div class="">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between">
        <h1 class="text-3xl font-bold title">Gestió de projectes i comissions</h1>
        <a href="{{ route('projects.create') }}" 
            class="btn-primary h-fit">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-plus"></use>
            </svg>
            Nou projecte/comissió
        </a>
    </div>
    <!-- Statistics Cards -->
    <div class="w-full flex flex-wrap flex-row items-stretch justify-between">
        <!-- Totals -->
        <div class="shadow-md simple-container w-32/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold principal-text-color mb-2 card-title">Totals</h2>
                <div class="bg-[#FF7E13] rounded-lg p-2">
                    <svg class="w-6 h-6 text-white">
                        <use xlink:href="#icon-folder"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ $totalProjects }}</p>
            <p class="text-sm text-[#335C68]">Projectes i comissions registrats</p>
        </div>
        
        <!-- Actius -->
        <div class="shadow-md simple-container w-32/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold principal-text-color mb-2 card-title">Actius</h2>
                <div class="bg-green-600 rounded-lg p-2">
                    <svg class="w-6 h-6 text-white">
                        <use xlink:href="#icon-check-circle"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ $activeProjects }}</p>
            <p class="text-sm text-[#335C68]">Projectes i comissions actius</p>
        </div>
        
        <!-- Inactius -->
        <div class="shadow-md simple-container w-32/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold principal-text-color mb-2 card-title">Inactius</h2>
                <div class="bg-red-600 rounded-lg p-2">
                    <svg class="w-6 h-6 text-white">
                        <use xlink:href="#icon-cross-circle"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ $inactiveProjects }}</p>
            <p class="text-sm text-[#335C68]">Projectes i comissions inactius</p>
        </div>
    </div>

    <div class="flex flex-row gap-5">
        <!-- Barra de busqueda -->
        <form action="#" method="post" class="w-[90%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5">
            @csrf
            <button type="submit" class="cursor-pointer">
                <svg class="w-6 h-6 text-[#AFAFAF]">
                    <use xlink:href="#icon-lens"></use>
                </svg>
            </button>
        
            <input type="search" name="search" id="search" placeholder="Buscar projectes o comissions..." class=" pl-2 w-full h-10">
        </form>

        <!-- Filtros -->
        <div class="flex flex-row justify-between gap-2">
            <button class="btn-primary w-20">Tots</button>
            <button class="btn-secondary w-20">Actius</button>
            <button class="btn-secondary w-20">Inactius</button>
        </div>
    </div>

    <!-- Projects Section -->
    <div class="w-full flex flex-wrap flex-row justify-between items-stretch mt-10">
        @foreach($projects as $project)
        <div class="shadow-md simple-container w-32/100 min-w-fit mb-5 flex flex-col gap-5">
            <div>
                <div class="flex flex-row justify-between w-full">
                    <div class="flex flex-row justify-between gap-2">
                        <div class="bg-gray-200 rounded-lg p-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-600">
                                <use xlink:href="#icon-folder"></use>
                            </svg>
                        </div>
                        <div class="flex items-center">
                            <a href="{{ route('projects.show', $project->id) }}" class="principal-text-color font-bold card-title">{{ $project->name }}</a>
                        </div>
                    </div>
                    @if($project->is_active)
                        <div class="p-2 bg-green-200 text-green-600 border-green-600 border-1 rounded-2xl h-fit w-1/5 text-center text-sm">
                            actiu
                        </div>
                    @else
                        <div class="p-2 bg-red-200 text-red-600 border-red-600 border-1 rounded-2xl h-fit w-1/5 text-center text-sm">
                            inactiu
                        </div>
                    @endif
                </div>
                
                <div class="mt-3 space-y-2">
                    <div class="flex items-center text-[#011020]">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-tag"></use>
                        </svg>
                        <span class="ml-2">{{ $project->type_label }}</span>
                    </div>
                    <div class="flex items-center text-[#011020]">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-center"></use>
                        </svg>
                        <span class="ml-2">{{ $project->centerRelation->name ?? 'Centre no assignat' }}</span>
                    </div>
                    <div class="flex items-center text-[#011020]">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-user"></use>
                        </svg>
                        <span class="ml-2">{{ $project->userRelation->name ?? 'Usuari no assignat' }}</span>
                    </div>
                    <div class="flex items-center text-[#011020]">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-calendar"></use>
                        </svg>
                        <span class="ml-2">{{ $project->formatted_start }}</span>
                    </div>
                </div>

                <!-- Descripción corta -->
                <div class="mt-3">
                    <p class="text-sm text-gray-600 line-clamp-2">{{ $project->description }}</p>
                </div>
            </div>
            
            <div class="flex flex-row gap-5 justify-end">
                <a href="{{ route('projects.edit', $project) }}" 
                   class="flex gap-3 btn-secondary w-1/2">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-square-pen"></use>
                    </svg>
                    Editar
                </a>
                @if($project->is_active)
                    <form action="{{ route('projects.deactivate', $project) }}" method="POST" class="inline w-1/2">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="deactivate-button w-full flex justify-center">
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-power"></use>
                            </svg>
                            Desactivar
                        </button>
                    </form>
                @else
                    <form action="{{ route('projects.activate', $project) }}" method="POST" class="inline w-1/2">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="activate-button w-full flex justify-center">
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-power"></use>
                            </svg>
                            Activar
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection