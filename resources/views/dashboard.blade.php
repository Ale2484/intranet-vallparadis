@extends("layouts.application")
@section("main")
@include('partial.icons')

<div class="w-full flex flex-wrap flex-row justify-between items-center">
    <!-- Contenedor -->
    <div class="shadow-md simple-container w-96 mb-10">
        <div class="flex justify-between items-center">
            <p class="principal-text-color font-bold card-title">Professionals actius</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#012F4A" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
        </div>
        <p class="text-3xl text-left font-bold py-5">11</p>
        
        <div class="flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center">
            <p class="font-bold text-[#335C68] text-md text-left">4 nous aquest mes</p>
            <button type="button" class="btn-primary w-full sm:w-32 text-sm shadow-md">
                Accedir
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                </svg>

            </button>
        </div>
    </div>

    <!-- Contenedor -->
    <div class="shadow-md simple-container w-96 mb-10">
        <div class="flex justify-between items-center">
            <p class="principal-text-color font-bold card-title">Centres</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#012F4A" class="size-8">mlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#012F4A" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />ath stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
        </div>
        <p class="text-3xl text-left font-bold py-5">12</p>
        
        <div class="flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center">
            <p class="font-bold text-[#335C68] text-md text-left">5 centres inactius</p>
            
            <button type="button" class="btn-primary w-full sm:w-32 text-sm shadow-md">
                Accedir
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </button>

        </div>
    </div>

    <!-- Contenedor -->
    <div class="shadow-md simple-container w-96 mb-10">
        <div class="flex justify-between items-center">
            <p class="principal-text-color font-bold card-title">Seguiments oberts</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#012F4A" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>
        </div>
        <p class="text-3xl text-left font-bold py-5">6</p>
        
        <div class="flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center">
            <p class="font-bold text-[#335C68] text-md text-left">3 urgents</p>
            <button type="button" class="btn-primary w-full sm:w-32 text-sm shadow-md">
                Accedir
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Contenedor -->
    <div class="shadow-md simple-container w-96 mb-10">
        <div class="flex justify-between items-center">
            <p class="principal-text-color font-bold card-title">Seguiments oberts</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#012F4A" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>
        </div>
        <p class="text-3xl text-left font-bold py-5">6</p>
        
        <div class="flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center">
            <p class="font-bold text-[#335C68] text-md text-left">3 urgents</p>
            <button type="button" class="btn-primary w-full sm:w-32 text-sm shadow-md">
                Accedir
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </button>
        </div>
    </div>

</div>
<h2 class="font-bold text-lg mb-5 text-[#011020]">APARTATS DEL SISTEMA</h2>


<!-- Apartados del sistema -->
<div class="flex flex-row justify-between flex-wrap gap-8">

    <!-- Container -->
    <div class="simple-container shadow-lg flex flex-col items-start w-80">
        <div class="bg-blue-50 rounded-lg p-2 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#155dfc" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
        </div>

        <p class="card-title font-bold text-[#011020]">Professionals</p>
        <p class="text-[#013148] text-sm" >Control i seguiment del personal del centre</p>

        <!-- Opciones -->
        <ul class="my-5 w-full">
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
        </ul>

        <a href="#test" class="btn-primary w-full p-3 font-bold">Accedir al apartat</a>
    </div>
    <!-- Container -->
    <div class="simple-container shadow-lg flex flex-col items-start w-80">
        <div class="bg-green-50 rounded-lg p-2 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#155dfc" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
        </div>

        <p class="card-title font-bold text-[#011020]">Centres</p>
        <p class="text-[#013148] text-sm" >Control i seguiment del personal del centre</p>

        <!-- Opciones -->
        <ul class="my-5 w-full">
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
        </ul>
        <a href="#test" class="btn-primary w-full p-3 font-bold">Accedir al apartat</a>
    </div>
    <!-- Container -->
    <div class="simple-container shadow-lg flex flex-col items-start w-80">
        <div class="bg-teal-50 rounded-lg p-2 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#155dfc" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
        </div>

        <p class="card-title font-bold text-[#011020]">Proyectes i comissions</p>
        <p class="text-[#013148] text-sm" >Control i seguiment del personal del centre</p>

        <!-- Opciones -->
        <ul class="my-5 w-full">
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
        </ul>
        <a href="#test" class="btn-primary w-full p-3 font-bold">Accedir al apartat</a>

    </div>
    <!-- Container -->
    <div class="simple-container shadow-lg flex flex-col items-start w-80">
        <div class="bg-[#fee9d6] rounded-lg p-2 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#155dfc" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
        </div>

        <p class="card-title font-bold text-[#011020]">Serveis generals</p>
        <p class="text-[#013148] text-sm" >Control i seguiment del personal del centre</p>

        <!-- Opciones -->
        <ul class="my-5 w-full">
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
        </ul>
        <a href="#test" class="btn-primary w-full p-3 font-bold">Accedir al apartat</a>
    </div>
    <!-- Container -->
    <div class="simple-container shadow-lg flex flex-col items-start w-80">
        <div class="bg-red-50 rounded-lg p-2 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#155dfc" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
        </div>

        <p class="card-title font-bold text-[#011020]">Temes pendents RRHH</p>
        <p class="text-[#013148] text-sm" >Control i seguiment del personal del centre</p>

        <!-- Opciones -->
        <ul class="my-5 w-full">
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="google.com" class="list-option">
                    Nou professional
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </li>
        </ul>
        <a href="#test" class="btn-primary w-full p-3 font-bold">Accedir al apartat</a>

    </div>
</div>
@endsection

@section("footer")
Funciona
@endsection

    <!-- fin -->
</body>
</html>
