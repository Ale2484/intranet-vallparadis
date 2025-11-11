@extends('layouts.app')
@section("title", "Mostra el projecte/comissió")
@section('main')
<div class="max-w-full mx-auto mb-10">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('projects.index') }}" class="text-[#AFAFAF] flex flex-row gap-3 items-center mb-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de projectes/comissions
            </a>
            <h1 class="text-3xl font-bold text-[#011020] mb-2">Informació completa {{ $project->type_label == "del projecte" ? "projecte" : "de la comissió" }}  {{ $project->name }}</h1>
            <div class="flex gap-2 items-center">
                <p>Informació completa del projecte/comissio</p>
                @if($project->type_label == "Projecte")
                    <div class="border-1 p-1 text-center bg-green-200 text-green-600 border-green-600 rounded-lg w-20">
                        Projecte
                    </div>
                @elseif($project->type_label == "Comissió")
                    <div class="border-1 bg-[#FF7033]/17 text-[#FF7033] border-[#FF7033] rounded-lg p-1 text-center w-20">
                        Comissió
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-5 w-full">
        <div class="w-full flex justify-beetwen gap-10">
            <!-- Tarjeta de información básica -->
            <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex-1">
                <div>
                    <!-- Usuario asignado -->
                    <div class="flex flex-col gap-3 mb-5">
                        <div class="text-lg font-semibold text-[#012F4A] mb-3 flex items-center gap-2">
                            <div class="text-[#FF7033] bg-[#FF7033]/17 p-2 rounded-lg">
                                <svg class="w-6 h-6">
                                    <use xlink:href="#icon-user"></use>
                                </svg>
                            </div>
                            <p class="font-bold text-lg">Usuari assignat</p>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-gray-200 rounded-full p-7 w-10">
        
                            </div>
                            <div class="ml-2">
                                <p class="text-xl font-bold text-[#011020] mb-1">{{ $project->userRelation->name ?? 'No assignat' }}</p>
                                <p class="text-[#AFAFAF] text-sm">{{ $project->userRelation->email ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex-1">
                <div class="">
                    <!-- Fecha inicio -->
                    <div class="flex flex-col gap-3 mb-5">
                        <div class="text-lg font-semibold text-[#012F4A] mb-3 flex items-center gap-2">
                            <div class="text-[#FF7033] bg-[#FF7033]/17 p-2 rounded-lg">
                                <svg class="w-6 h-6">
                                    <use xlink:href="#icon-calendar"></use>
                                </svg>
                            </div>
                            <p class="font-bold text-lg">Data inici</p>
                        </div>
                        <p class="text-3xl font-bold text-[#011020] mb-1">{{ $project->formatted_start }}</p>
                        <p class="text-[#AFAFAF] text-sm">Actualitat: {{ now()->format('j/n/Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex-1">
                <div class="">
                    <!-- Documentos adjuntos -->
                    <div class="flex flex-col gap-3 mb-3">
                        <div class="text-lg font-semibold text-[#012F4A] mb-3 flex items-center gap-2">
                            <div class="text-[#FF7033] bg-[#FF7033]/17 p-2 rounded-lg">
                                <svg class="w-6 h-6">
                                    <use xlink:href="#icon-document"></use>
                                </svg>
                            </div>
                            <p class="font-bold text-lg">Documents adjunts</p>
                        </div>
                        <p class="text-3xl font-bold text-[#011020] mb-1">{{ $project->documents_count }}</p>
                        <p class="text-[#AFAFAF] text-sm">Fitxers disponibles</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Descripción -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
            <div class="text-xl font-semibold text-[#012F4A] mb-4 flex items-center gap-2">
                <div class="text-[#FF7033] bg-[#FF7033]/17 p-2 rounded-lg">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-desc"></use>
                    </svg>
                </div>
                <p class="font-bold text-lg">Descripció</p>
            </div>
            <p class="text-[#011020] whitespace-pre-wrap">{{ $project->description }}</p>
        </div>

        <!-- Observaciones -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
            <div class="text-xl font-semibold text-[#012F4A] mb-4 flex items-center gap-2">
                <div class="text-[#FF7033] bg-[#FF7033]/17 p-2 rounded-lg">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-eye"></use>
                    </svg>
                </div>
                <p class="font-bold text-lg">Observacions</p>
            </div>
            <p class="text-[#011020] whitespace-pre-wrap">{{ $project->observations }}</p>
        </div>

        <!-- Documentos adjuntos -->
        @if($project->documents_count > 0)
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
            <div class="text-xl font-semibold text-[#012F4A] mb-4 flex items-center gap-2">
                <div class="text-[#FF7033] bg-[#FF7033]/17 p-2 rounded-lg">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-folder"></use>
                    </svg>
                </div>
                <p class="font-bold text-lg">Documents adjunts</p>
            </div>
            
            <div class="space-y-4">
                @foreach($project->documents as $document)
                <div class="flex items-center justify-between p-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg">
                            <svg class="w-6 h-6 text-gray-600">
                                <use xlink:href="#icon-document"></use>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-[#011020] text-lg">{{ $document->name }}</p>
                            <p class="text-sm text-[#AFAFAF]">
                                {{ $document->formatted_size }} • 
                                Pujat el {{ $document->created_at->format('j/n/Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href=""  
                            class="text-sm py-2 px-4 flex items-center gap-2">
                            <svg class="w-8 h-8">
                                <use xlink:href="#icon-download"></use>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
            <div class="text-xl font-semibold text-[#012F4A] mb-4 flex items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-document"></use>
                </svg>
                <p>Documents adjunts</p>
            </div>
            <div class="text-center py-8">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-3">
                    <use xlink:href="#icon-document"></use>
                </svg>
                <p class="text-gray-500">Encara no hi ha documents associats a aquest projecte.</p>
            </div>
        </div>
        @endif



        <div class="bg-white text-[#011020] rounded-lg p-5 font-semibold flex flex-col gap-2 border-1 border-[#AFAFAF]">
            <div class="text-xl font-semibold text-[#012F4A] flex items-center gap-2 ml-2">
                <div class="text-[#FF7033] bg-[#FF7033]/17 p-2 rounded-lg">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-eye"></use>
                    </svg>
                </div>
                <p class="text-xl font-semibold text-[#012F4A] flex items-center gap-2">Usuaris inscrits:</p>
            </div>
            <div class="bg-white rounded-[15px] px-2 block pt-5 pb-5 w-full h-56 overflow-y-auto">
                @if ($asignedUsers->isNotEmpty())
                    @foreach ($asignedUsers as $user)
                        <div class="flex gap-5 border border-[#AFAFAF] bg-white rounded-[15px] p-5 mb-5">
                            <div class="w-12 h-12 bg-gray-200 rounded-full">
                                <minidenticon-svg username="{{ md5($user->id) }}"></minidenticon-svg>
                            </div>
                            <div class="flex flex-col text-[#5E6468]">
                                <label for="user_{{ $user->id }}">{{ $user->name }}</label>
                                <p>{{ $user->email }}</p>
                            </div>

                        </div>
                    @endforeach
                @else
                    <p class="text-xl font-semibold text-[#012F4A]">No hi ha usuaris registrats</p>
                @endif
            </div>
        </div>

        <div class="w-full flex justify-end gap-3">
            <a href="{{ route('projects.index') }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">
                Cancel·lar
            </a>
            <a href="{{ route('projects.edit', $project) }}" 
                class="w-fit  bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all py-3">
                
                {{ $project->type_label == "Comissió" ? "Editar la comissió" : "Editar el projecte" }}
            </a>
        </div>
    </div>
</div>
@endsection