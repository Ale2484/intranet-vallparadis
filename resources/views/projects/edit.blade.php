@extends('layouts.app')
@section("title", "Edita el projecte/comissió")
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
            <h1 class="text-3xl font-bold text-[#011020] mb-0!">Editar projecte/comissió</h1>
            <p class="text-[#AFAFAF]">Modifica les dades del projecte/comissió</p>
        </div>
    </div>

    <!-- Form -->
    <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 mb-10">
        @include('projects.form', [
            'action' => route('projects.update', $project),
            'method' => 'PATCH',
            'project' => $project,
            'submitText' => 'Actualitzar projecte/comission'
        ])
    </div>
</div>
<script src="{{ asset('js/projects.js') }}"></script>
@endsection