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
        <div class="shadow-md simple-container w-23/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold principal-text-color mb-2 card-title">Projectes/Comissions totals</h2>
                <div class="bg-[#FF7E13] rounded-lg p-2">
                    <svg class="w-6 h-6 text-white">
                        <use xlink:href="#icon-center"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ $totalProjects }}</p>
            <p class="text-sm text-[#335C68]">Projectes i comissions registrats al centre</p>
        </div>

        <!-- ultimo mes -->
        <div class="shadow-md simple-container w-23/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold principal-text-color mb-2 card-title">Projectes/Comissions nous</h2>
                <div class="bg-[#FF7E13] rounded-lg p-2">
                    <svg class="w-6 h-6 text-white">
                        <use xlink:href="#icon-plus"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ $totalProjects }}</p>
            <p class="text-sm text-[#335C68]">Afegits durant l'últim mes</p>
        </div>
        
        <!-- Actius -->
        <div class="shadow-md simple-container w-23/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold principal-text-color mb-2 card-title">Projectes/Comissions actius</h2>
                <div class="bg-green-600 rounded-lg p-2">
                    <svg class="w-6 h-6 text-white">
                        <use xlink:href="#icon-check-circle"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ $activeProjects }}</p>
            <p class="text-sm text-[#335C68]">Registrats al centre</p>
        </div>
        
        <!-- Inactius -->
        <div class="shadow-md simple-container w-23/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold principal-text-color mb-2 card-title">Projectes/Comissions inactius</h2>
                <div class="bg-red-600 rounded-lg p-2">
                    <svg class="w-6 h-6 text-white">
                        <use xlink:href="#icon-cross-circle"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ $inactiveProjects }}</p>
            <p class="text-sm text-[#335C68]">Registrats al centre</p>
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
        <div class="shadow-md simple-container w-48/100 min-w-fit mb-5 flex flex-col gap-5">
            <div class="border-b-gray-600 border-b-1 pb-5">
                <div class="flex flex-row justify-between w-full mb-2">
                    <div class="flex flex-row justify-between gap-2">
                        @if($project->type_label == "Projecte")
                            <div class="bg-green-200 border-green-600 border-1 rounded-full p-4 flex items-center justify-center">
                                <svg class="w-8 h-8 text-green-600">
                                    <use xlink:href="#icon-folder"></use>
                                </svg>
                            </div>
                        @elseif($project->type_label == "Comissió")
                            <div class="bg-[#FF7033]/17 border-1 border-[#FF7033] rounded-full p-4 flex items-center justify-center">
                                <svg class="w-8 h-8 text-[#FF7033]">
                                    <use xlink:href="#icon-folder"></use>
                                </svg>
                            </div>
                        @endif
                        <div class="flex items-center">
                            <a href="{{ route('projects.show', $project->id) }}" class="principal-text-color font-bold card-title">{{ $project->name }}</a>
                        </div>
                    </div>
                    @if($project->type_label == "Projecte")
                        <div class="p-2 bg-green-200 text-green-600 border-green-600 border-1 rounded-2xl h-fit w-1/6 min-w-fit text-center text-sm">
                            Projecte
                        </div>
                    @elseif($project->type_label == "Comissió")
                        <div class="p-2 bg-[#FF7033]/17 border-1 border-[#FF7033] text-[#FF7033] rounded-2xl h-fit w-1/6 min-w-fit text-center text-sm">
                            Comissió
                        </div>
                    @endif
                </div>
                
                <div class="mt-3 space-y-2">
                    <div class="flex items-center text-[#011020]">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-user"></use>
                        </svg>
                        <span class="ml-2">{{ $project->userRelation->name ?? 'Usuari no assignat' }}</span>
                    </div>
                    <div class="flex items-center text-[#011020]">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-user"></use>
                        </svg>
                        <span class="ml-2">{{ $project->userRelation->email ?? 'Usuari no assignat' }}</span>
                    </div>
                    <div class="flex items-center text-[#011020]">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-calendar"></use>
                        </svg>
                        <p class="ml-2 text-sm line-clamp-2">{{ $project->description }}</p>
                    </div>
                    <div class="flex items-center text-[#011020]">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-eye"></use>
                        </svg>
                        <p class="ml-2 text-sm line-clamp-2">{{ $project->observations }}</p>
                    </div>
                    <div class="flex items-center text-[#011020]">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-document"></use>
                        </svg>
                        <p class="ml-2 text-sm line-clamp-2">{{ $project->documents_count }} Documents adjunts</p>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-row gap-5 justify-between">
                <div class="flex flex-col">
                    <p>
                        Creat: {{ $project->created_at }}
                    </p>
                    <p>
                        Actualizat: {{ $project->updated_at }}
                    </p>
                </div>
                <div class="flex w-2/3 justify-end gap-3">
                    <a href="{{ route('projects.edit', $project) }}" 
                       class="flex gap-3 btn-secondary w-1/4 min-w-fit">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-square-pen"></use>
                        </svg>
                        Editar
                    </a>
                    @if($project->is_active)
                        <form action="{{ route('projects.deactivate', $project) }}" method="POST" class="inline w-1/4 min-w-fit">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="deactivate-button w-full flex justify-center h-full items-center">
                                <svg class="w-6 h-6">
                                    <use xlink:href="#icon-power"></use>
                                </svg>
                                Desactivar
                            </button>
                        </form>
                    @else
                        <form action="{{ route('projects.activate', $project) }}" method="POST" class="inline w-1/4 min-w-fit">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="activate-button w-full flex justify-center h-full items-center">
                                <svg class="w-6 h-6">
                                    <use xlink:href="#icon-power"></use>
                                </svg>
                                Activar
                            </button>
                        </form>
                    @endif
                </div>
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