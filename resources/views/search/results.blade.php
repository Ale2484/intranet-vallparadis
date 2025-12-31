@extends('layouts.app')
@section("title", "Resultats de la busqueda")
@section('main')
@php
    $searchGroups = [$searchUsers, $searchCenters, $searchProjects, $searchCourses, $searchGeneralServices, $searchComplementaryServices, $searchExternalContacts];
@endphp
<a href="{{ route("dashboard") }}" class="flex gap-3 text-[#AFAFAF] mb-5">
    <svg class="w-6 h-6">
        <use xlink:href="#icon-arrow-left"></use>
    </svg>
    Tornar al dashboard
</a>
@if (collect($searchGroups)->contains(function($group) { return $group->isNotEmpty(); }))
{{-- Usuarios --}}
@if ($searchUsers->isNotEmpty())
    <h1 class="w-full mt-7 text-3xl font-bold text-[#011020] dark:text-white">Professionals:</h1>
    <div class="w-full mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($searchUsers as $user)
            <x-user-card :user="$user"/>
        @endforeach
    </div>
@endif

{{-- Centros --}}
@if ($searchCenters->isNotEmpty())
    <h1 class="w-full mt-7 text-3xl font-bold text-[#011020] dark:text-white">Centres:</h1>
    <div class="w-full mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($searchCenters as $center)
            <x-center-card :center="$center"/>
        @endforeach
    </div>
@endif

{{-- Proyectos --}}
@if ($searchProjects->isNotEmpty())
    <h1 class="w-full mt-7 text-3xl font-bold text-[#011020] dark:text-white">Projectes:</h1>
    <div class="w-full mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($searchProjects as $project)
            <x-project-card :project="$project"/>
        @endforeach
    </div>
@endif

{{-- Cursos --}}
@if ($searchCourses->isNotEmpty())
    <h1 class="w-full mt-7 text-3xl font-bold text-[#011020] dark:text-white">Cursos:</h1>
    <div class="w-full mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($searchCourses as $course)
            <x-course-card :course="$course"/>
        @endforeach
    </div>
@endif

{{-- Servicios generales --}}
@if ($searchGeneralServices->isNotEmpty())
    <h1 class="w-full mt-7 text-3xl font-bold text-[#011020] dark:text-white">Serveis generals:</h1>
    <div class="w-full mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($searchGeneralServices as $generalService )
            <x-general-services-card :generalService="$generalService"/>
        @endforeach
    </div>
@endif

{{-- Servicios complementarios --}}
@if ($searchComplementaryServices->isNotEmpty())
    <h1 class="w-full mt-7 text-3xl font-bold text-[#011020] dark:text-white">Serveis complementaris:</h1>
    <div class="w-full mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($searchComplementaryServices as $complementaryService )
            <x-complementary-service-card :complementaryService="$complementaryService"/>
        @endforeach
    </div>
@endif

{{-- Contactos externos --}}
@if ($searchExternalContacts->isNotEmpty())
    <h1 class="w-full mt-7 text-3xl font-bold text-[#011020] dark:text-white">Contactes externs:</h1>
    <div class="w-full mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($searchExternalContacts as $externalContact)
            <x-external-contact-card :externalContact="$externalContact"/>
        @endforeach
    </div>
@endif

@else
<p class="w-full text-center text-2xl text-[#AFAFAF] mt-5">No hi ha resultats</p>
@endif


@endsection