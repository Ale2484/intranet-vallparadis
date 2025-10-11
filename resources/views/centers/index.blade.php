@extends("layouts.application")

@section("main")
@if (session("success"))
    <p>{{ session("success") }}</p>
@endif


<h1 class="title">Gestió de centres: </h1>
<div class="w-full flex flex-wrap flex-row justify-between items-stretch">
    <!-- Contenedor -->
    <div class="shadow-md simple-container w-96 mb-10">
        <div class="flex justify-between items-center">
            <p class="principal-text-color font-bold card-title">Centres</p>
            <div class="bg-[#FF7E13] rounded-lg p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" class="size-8">mlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#012F4A" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />ath stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </div>
        </div>
        <p class="text-3xl text-left font-bold py-5">3</p>
        
        <p class="font-bold text-[#335C68] text-md text-left">Centres registrats al sistema</p>
    </div>
    
    <!-- Contenedor -->
    <div class="shadow-md simple-container w-96 mb-10">
        <div class="flex justify-between items-center">
            <p class="principal-text-color font-bold card-title">Centres nous</p>
            <div class="bg-[#FF7E13] rounded-lg p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </div>

        </div>
        <p class="text-3xl text-left font-bold py-5">1</p>        
        <p class="font-bold text-[#335C68] text-md text-left">Afegits durant l'últim mes</p>
    </div>

    <!-- Contenedor -->
    <div class="shadow-md simple-container w-96 mb-10">
        <div class="flex justify-between items-center">
            <p class="principal-text-color font-bold card-title">Centres actius</p>
            <div class="bg-green-600 rounded-lg p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>

        </div>
        <p class="text-3xl text-left font-bold py-5">2</p>
        <p class="font-bold text-[#335C68] text-md text-left">Centres registrats al sistema</p>
        <div>
            <p>Barra de progreso</p>
        </div>        
    </div>

    <!-- Contenedor -->
    <div class="shadow-md simple-container w-96 mb-10">
        <div class="flex justify-between items-center">
            <p class="principal-text-color font-bold card-title">Centres inactius</p>
            <div class="bg-red-600 p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>

        </div>
        <p class="text-3xl text-left font-bold py-5">1</p>        
        <p class="font-bold text-[#335C68] text-md text-left">Centres registrats al sistema</p>
        <p>Barra de progreso</p>
    </div>
</div>

<div class="flex flex-row gap-5">
    <!-- Barra de busqueda -->
    <form action="#" method="post" class="w-[90%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5">
        @csrf
        <button type="submit" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#AFAFAF" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
    
        <input type="search" name="search" id="search" placeholder="Buscar professionals , documents...." class=" pl-2 w-full h-10">
    </form>

    <!-- Filtros -->
    <div class="flex flex-row justify-between gap-2">
        <button class="btn-primary w-20">Tots</button>
        <button class="btn-secondary w-20">Actius</button>
        <button class="btn-secondary w-20">Inactius</button>
    
    </div>
</div>
<!-- Centros -->
<div class="w-full flex flex-wrap flex-row justify-between items-stretch mt-10">
@foreach ($centers as $center )
        <!-- Contenedor -->
        <div class="shadow-md simple-container w-[32%] min-w-[400px] mb-5 flex flex-col gap-5">
            <div class="flex justify-between items-center">
                <div class="flex flex-row items-center gap-5">
                    <div class="bg-[#ffe7de] rounded-lg p-2">
                    <svg class="w-8 h-8 text-[#FF7E13]">
                        <use xlink:href="#icon-maps"></use>
                    </svg>
                    </div>
                    <a href="{{ route("centers.show", $center->id) }}" class="principal-text-color font-bold card-title">{{ $center->name }}</a>
                </div>

                <p class="text-center w-20 {{ $center->is_active ? "is-active-button" : "is-inactive-button" }}">{{$center->is_active ? "Actiu" : "Inactiu"}}</p>
            </div>
            <!-- Especificaciones -->
            <div class="flex flex-col gap-3 text-[#0F172A]">
                <div class="flex flex-row items-center gap-2 pl-2">
                    <svg class="w-7 h-7">
                        <use xlink:href="#icon-maps"></use>
                    </svg>
                    <p>{{ $center->address }}</p>
                </div>

                <div class="flex flex-row items-center gap-2 pl-2">
                    <svg class="w-7 h-7">
                        <use xlink:href="#icon-phone"></use>
                    </svg>
                    <p>{{ $center->phone ?? "Aquest centre no te telefon" }}</p>
                </div>

                <div class="flex flex-row items-center gap-2 pl-2">
                    <svg class="w-7 h-7">
                        <use xlink:href="#icon-mail"></use>
                    </svg>
                    <p>{{ $center->email ?? "Aquest centre no te correu electronic" }}</p>
                </div>
            </div>
            <p class="text-sm">Creat: {{ $center->created_at->format("d/m/Y") }} | Actualizat: {{ $center->updated_at->format("d/m/Y") }}</p>
            
            <!-- Activar/Desactivar -->
            <div class="flex flex-row gap-5 justify-end">
                <button class="flex gap-3 btn-secondary">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-square-pen"></use>
                    </svg>
                    Editar
                </button>

                <form action="#" method="post">
                    @csrf
                    <button type="submit" class="flex justify-center gap-3 {{ $center->is_active ? "deactivate-button" : "activate-button" }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                        </svg>
                        {{ $center->is_active ? "Desactivar" : "Activar" }}
                    </button>
                </form>
            </div>

        </div>
@endforeach
</div>
    




<form action="{{ route("centers.store") }}" method="post">
    @csrf
    <input type="text" name="name" id="name" placeholder="Nombre">
    <input type="text" name="address" id="address" placeholder="Direccion">
    <input type="tel" name="phone" id="phone" placeholder="Telefono">
    
    <button type="submit" name="submit" id="submit">Eliminar</button>
</form>

@endsection