@extends('layouts.app')
@section("title", "Mostrar el contacte extern")
@section('main')
<div class="min-w-fit w-2/3 mx-auto flex flex-col mb-7 gap-5">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('external-contacts.index') }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de contactes externs
            </a>
            <h1 class="text-3xl font-bold text-[#011020]">Detalls del contacte extern</h1>
            <p class="text-[#AFAFAF]" >Informació completa del contacte</p>
        </div>
    </div>

    <div class="flex justify-between items-start gap-10">

        <!-- Información del Contacto -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col gap-3 w-full">
            <!-- Información principal -->
            <div class="border-b-1 border-b-gray-600">
                <div class="flex items-center gap-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-[#012F4A]">{{ $externalContact->contact_person }}</h2>
                        <p class="text-lg text-gray-600">{{ $externalContact->company_or_department }}</p>
                    </div>
                </div>
            </div>
    
            <!-- Información de contacto -->
            <h3 class="text-xl font-semibold text-[#012F4A] mb-6">Informació de contacte</h3>
            
            <div class="space-y-4">
                <!-- Email -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-mail"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1">Correu electrònic</p>
                        <p class="text-gray-900 font-semibold">{{ $externalContact->email }}</p>
                    </div>
                </div>
    
                <!-- Teléfono -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-phone"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1">Telèfon</p>
                        <p class="text-gray-900 font-semibold">{{ $externalContact->phone ?? 'No disponible' }}</p>
                    </div>
                </div>
    
                <!-- Centro -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-center"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1">Centre</p>
                        <p class="text-gray-900 font-semibold">{{ $externalContact->center->name }}</p>
                    </div>
                </div>

                <!-- Categoria -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-category"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1">Categoria</p>
                        <p class="text-gray-900 font-semibold">{{ $externalContact->category }}</p>
                    </div>
                </div>

                <!-- Motiu -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-clipboard-text"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1">Motiu</p>
                        <p class="text-gray-900 font-semibold">{{ $externalContact->reason }}</p>
                    </div>
                </div>

                <!-- Observacions -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-eye"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1">Observacions</p>
                        <p class="text-gray-900 font-semibold">{{ $externalContact->observations ?? 'Sense observacions' }}</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-5 mt-5">
                <a href="{{ route('external-contacts.edit', $externalContact) }}" 
                    class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all w-44">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-square-pen"></use>
                    </svg>
                    Editar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
