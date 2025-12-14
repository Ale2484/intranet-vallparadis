@extends("layouts.app")
@section("title", "Mostra el servei complementari")
@section("main")
<div class="w-full flex items-center justify-center">
    <div class="w-[90%] flex flex-col items-center justify-center">   
        <!-- Apartado superior -->
        <div class="w-full flex items-center justify-between">
            <div class="flex flex-col gap-3">
                <a href="{{ route("complementary-services.index") }}" class="flex gap-3 text-[#AFAFAF]">
                    <svg class="w-6 h-6 ">
                        <use xlink:href="#icon-arrow-left"></use>
                    </svg>
                    Tornar a la gestió de serveis generals
                </a>
        
                <h1 class="text-3xl font-bold text-[#011020]">{{ $complementaryService->name }}</h1>        
                <p class="text-[#AFAFAF] mb-7">Informació completa del servei</p>
            </div>
            <a href="{{ route("complementary-services.edit", $complementaryService) }}" class="bg-[#FF7E13] text-white rounded-lg p-[10px] font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar el servei
            </a>
        </div>
        <!-- Contenedor principal -->
        <div class="w-full flex flex-wrap flex-row justify-between gap-5 text-[#011020]">
            
            <div class="w-[55%] flex flex-col gap-3">
                {{-- Contenedor secundario --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col min-w-[350px]">
                    <p class="text-[20px] font-bold text-[#011020] mb-5">Dades del responsable:</p>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center mb-5">
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-user"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Nom:</p>
                                <p class="font-semibold">{{ $complementaryService->manager_name ?? "Aquest servei no te encarregat" }}</p>
                            </div>
                        </div>
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-mail"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Correu:</p>
                                <p class="font-semibold">{{ $complementaryService->manager_email ?? "L'encarregat no te correu" }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center">
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-7 h-7">
                                    <use xlink:href="#icon-phone"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Telefon:</p>
                                <p class="font-semibold">{{ $complementaryService->manager_phone ?? "L'encarregat no te telefon" }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contenedor secundario --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col min-w-[350px]">
                    <p class="text-[20px] font-bold text-[#011020] mb-5">Detalls del servei:</p>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center mb-5">
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-cog-8-tooth"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Tipus de servei:</p>
                                <p class="font-semibold">{{ ucfirst($complementaryService->type) ?? "Aquest servei no te tipus"}}</p>
                            </div>
                        </div>
                        {{-- Elemento --}}
                        <div class="flex w-1/2 flex-row items-center gap-2">
                            <div class="p-2 rounded-lg mb-2 flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-center"></use>
                                </svg>
                            </div>
                            <div>
                                <p class="text-md">Centre associat:</p>
                                <p class="font-semibold">{{ $complementaryService->center->name ?? "Aquest servei no te un centre associat" }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Contenedor 2 elementos --}}
                    <div class="w-full flex items-center mt-3">
                        {{-- Elemento --}}
                        <div class="w-full flex flex-row items-start gap-2">
                            <div class="p-2 rounded-lg flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-desc"></use>
                                </svg>
                            </div>
                            <div class="w-[80%] flex flex-col">
                                <p class="text-md font-semibold">Observacions:</p>
                                <p>{{$complementaryService->observations ?? "Aquest servei no te observacions encara"}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contenedor secundario --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col min-w-[350px]">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="p-2 rounded-lg flex flex-row items-center justify-center bg-[#ffe7de] text-[#FF7E13] w-12 h-12">
                            <svg class="w-8 h-8">
                                <use xlink:href="#icon-clock"></use>
                            </svg>
                        </div>
                        <p class="text-[20px] font-bold text-[#011020]">Horari:</p>
                    </div>

                    {{-- Contenedor elemento --}}
                    <div class="rich-editor-container">
                        {!! $complementaryService->schedules ? $complementaryService->schedules : "Aquest servei no te horari" !!}
                    </div>
                </div>
            </div>
            
            {{-- Contenedor lateral --}}
            <div class="w-[40%] flex flex-col gap-5">
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex-flex-col min-w-[300px]">
                    <div class="flex justify-between">
                        <p class="text-[20px] font-bold text-[#011020] mb-5">Fitxers:</p>
                        <p class="bg-[#ffe7de] text-[#FF7E13] w-7 h-7 flex items-center justify-center rounded-full font-semibold">{{ count($complementaryServiceDocuments) }}</p>
                    </div>
                    @if (count($complementaryServiceDocuments) > 0)
                        <div class="flex flex-col gap-2 h-auto max-h-72 overflow-y-auto">
                            @foreach ($complementaryServiceDocuments as $file)
                            <div class="mt-2 border border-[#AFAFAF] rounded-lg p-2 flex items-center gap-4">
                                <svg class="w-7 h-7 text-[#011020]">
                                    <use xlink:href="#icon-document"></use>
                                </svg>
                                <div class="w-full flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold text-[#011020]">{{ $file->name }}</p>
                                        <p class="text-[#AFAFAF]">{{ $file->formatted_size }}</p>
                                    </div>
                                    <a href="{{ route("complementary-services.documents.download", basename($file->path)) }}">
                                        <svg class="w-7 h-7 text-[#011020] cursor-pointer ml-2 hover:text-[#FF7E13] transition-all">
                                            <use xlink:href="#icon-download"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p>Actualment no hi ha fitxers pujats</p>
                    @endif
                </div>
                {{-- Apartado de observaciones --}}
                <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex-flex-col min-w-[300px]">
                    <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-[#FF7E13]">
                        <use xlink:href="#icon-desc"></use>
                    </svg>
                        <p class="font-semibold">Nou fitxer</p>
                    </div>
                    <form action="{{ route("complementary-services.documents.store", $complementaryService) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p class="my-2 text-sm">Afegeix un nou fitxer per al servei de {{ $complementaryService->name  }}</p>
                        <hr class="text-[#AFAFAF] my-4">
                        <button type="button" data-file-input-id="files[]" data-show-uploaded-files-id="uploadedFiles" class="upload-file-button w-full flex flex-col items-center justify-center border-2 border-[#AFAFAF] border-dashed rounded-lg cursor-pointer p-2 gap-2 mb-3 hover:bg-[#f6f6f6] transition-all">
                            <div class="bg-[#E9E9E9] rounded-full p-2">
                                <svg class="w-8 h-8 text-[#011020]">
                                    <use xlink:href="#icon-upload"></use>
                                </svg>
                            </div>
                            <p class="text-[#FF7E13] font-bold text-sm">Fes click per pujar un fitxer <span class="text-[#AFAFAF]"> o arrossega i deixa anar</span></p>
                            <p class="text-[#AFAFAF] text-sm">(PDF, CSV, XLSX, DOC, DOCX)</p>
                        </button>
                        <div id="uploadedFiles" class="mb-5">
                        </div>
                        <input type="file" name="files[]" id="files[]" class="hidden" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.txt,.zip,.rar">
                        <label for="description" class="font-semibold">Descripció del fitxer:</label>
                        <textarea name="description" id="description" placeholder="Introdueix una descripció per el fitxer" class="resize-none border shadow-sm h-24 p-2 rounded-lg border-[#AFAFAF] w-full mb-4 @error('description') border-red-600 @enderror"></textarea>
                        <button type="submit" class="bg-[#FF7E13] w-full text-white rounded-lg p-[10px] font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-plus"></use>
                            </svg>
                            Afegir fitxer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection