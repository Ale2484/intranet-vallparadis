@extends("layouts.app")
@section("title", "Documents")
@section("main")
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col mb-7 gap-10 dark:text-white">
    <div class="w-full flex flex-col md:flex-row justify-between items-start md:items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('rrhh.show', $rrhh->id) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió del tema pendent
            </a>
            <h1 class="text-2xl md:text-3xl font-bold text-[#011020] dark:text-white">Documents de {{ $rrhh->topic }}</h1>
            <p class="text-[#AFAFAF]" >Documents del tema pendent seleccionat</p>
        </div>
    </div>
    <div class="flex flex-col-reverse lg:flex-row justify-between gap-10 lg:gap-6">
        {{-- documentos --}}
        <div class="w-full lg:w-8/11 flex flex-col gap-4">
            <h3 class="dark:text-white text-2xl font-bold block lg:hidden">Documents:</h3>
            @if ($documents->count()==0)
                No hi ha documents
            @else
                
            @foreach ($documents as $document)
                <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-full dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between border-b-[#AFAFAF] md:border-b-2 pb-2">
                        <div class="flex items-center gap-4 flex-1 w-full">
                            <div class="flex items-center justify-center w-12 h-12 rounded-lg">
                                <svg class="w-6 h-6 text-gray-600 dark:text-white">
                                    <use xlink:href="#icon-document"></use>
                                </svg>
                            </div>
                            <div class="flex flex-col md:flex-row gap-4 md:gap-5 w-full justify-start">
                                <div class="flex flex-col w-fit">
                                    <p class="font-medium text-[#011020] text-lg dark:text-white">{{ $document->name }}</p>
                                    <p class="text-sm text-[#AFAFAF] dark:text-white">
                                        {{ $document->formatted_size }} • 
                                        Pujat el {{ $document->created_at->format('j/n/Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 self-end">
                            <a href="{{ route('doc.download', basename($document->path)) }}"  
                                class="text-sm py-2 px-4 flex items-center gap-2">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-download"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @if ($document->description)
                    <div class="flex gap-4 items-center pt-4">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg">
                            <svg class="w-6 h-6 text-gray-600 dark:text-white">
                                <use xlink:href="#icon-desc"></use>
                            </svg>
                        </div>
                        <div>
                            {{ $document->description }}
                        </div>
                    </div>
                    @endif
                </div>
            @endforeach
            @endif
        </div>
        <div class="w-full lg:w-1/4">
            {{-- formulario --}}
            <div class="flex flex-col justify-center h-fit border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                <div class="pb-3 border-b-1 border-[#AFAFAF] flex flex-col gap-2">
                    <div class="flex flex-row gap-3">
                        <svg class="w-6 h-6 text-[#FF7E13]">
                            <use xlink:href="#icon-plus"></use>
                        </svg>
                        <div class="font-bold">
                            Nou document 
                        </div>
                    </div>
                    <div class="text-[#5E6468] dark:text-white">
                        Afegeix un nou document per al Tema Pendent: {{ $rrhh->topic }}
                    </div>
                </div>
                <form action="{{ route('rrhh.docs.store', $rrhh->id) }}" method="POST" class="text-[#5E6468] pt-5 flex flex-col dark:text-white" enctype="multipart/form-data" >
                        @csrf
                        @method("POST")
                        <div class="flex flex-col gap-3">
                            <label for="documents">Document</label>
                            <button type="button" data-file-input-id="files[]" data-show-uploaded-files-id="uploadedFiles" class="upload-file-button w-full flex flex-col items-center justify-center border-2 border-[#AFAFAF] border-dashed rounded-lg cursor-pointer p-2 gap-2 mb-3 hover:bg-[#f6f6f6] dark:hover:bg-neutral-700 transition-all">
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
                        <input type="file" name="documents[]" id="files[]" class="hidden" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.txt,.zip,.rar">
                        </div>
                        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                            Afegir Document
                        </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection