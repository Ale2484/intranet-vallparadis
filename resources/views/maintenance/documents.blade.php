@extends("layouts.app")
@section("title", "Documents")
@section("main")
<div class="min-w-fit w-9/10 mx-auto flex flex-col mb-7 gap-10">
    <div class="w-full flex flex-row justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('maintenance.show', $maintenance->id) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió del manteniment
            </a>
            <h1 class="text-3xl font-bold text-[#011020]">Documents de {{ $maintenance->topic }}</h1>
            <p class="text-[#AFAFAF]" >Documents del manteniment seleccionat</p>
        </div>
    </div>
    <div class="flex flex-row justify-between gap-5">
        {{-- documentos --}}
        <div class="w-8/11 flex flex-col gap-4">
            @if ($documents->count()==0)
                No hi ha documents
            @else
                
            @foreach ($documents as $document)
                <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-full">
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="flex items-center justify-center w-12 h-12 rounded-lg">
                                <svg class="w-6 h-6 text-gray-600">
                                    <use xlink:href="#icon-document"></use>
                                </svg>
                            </div>
                            <div class="flex gap-5 w-full justify-start">
                                <div class="flex flex-col w-fit">
                                    <p class="font-medium text-[#011020] text-lg">{{ $document->name }}</p>
                                    <p class="text-sm text-[#AFAFAF]">
                                        {{ $document->formatted_size }} • 
                                        Pujat el {{ $document->created_at->format('j/n/Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('doc.download', basename($document->path)) }}"  
                                class="text-sm py-2 px-4 flex items-center gap-2">
                                <svg class="w-8 h-8">
                                    <use xlink:href="#icon-download"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
        <div class="w-1/4 min-w-min">
            {{-- formulario --}}
            <div class="flex flex-col justify-center h-fit border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                <div class="pb-3 border-b-1 border-[#AFAFAF] flex flex-col gap-2">
                    <div class="flex flex-row gap-3">
                        <svg class="w-6 h-6 text-[#FF7E13]">
                            <use xlink:href="#icon-plus"></use>
                        </svg>
                        <div class="font-bold">
                            Nou document 
                        </div>
                    </div>
                    <div class="text-[#5E6468]">
                        Afegeix un nou document per al centre: {{ $maintenance->name }}
                    </div>
                </div>
                <form action="{{ route('maintenance.docs.store', $maintenance->id) }}" method="POST" class="text-[#5E6468] pt-5 flex flex-col gap-7" enctype="multipart/form-data" >
                        @csrf
                        @method("POST")
                        <div class="flex flex-col gap-3">
                            <label for="documents">Document</label>
                            <input type="file" 
                                name="documents[]" 
                                id="documents" 
                                multiple 
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.txt,.zip,.rar">
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