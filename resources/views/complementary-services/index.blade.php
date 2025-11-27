@extends("layouts.app")

@section("title", "Veure els cursos")

@section("main")

<form action="{{ route("complementary-services.store") }}" method="POST" class="bg-white p-5" enctype="multipart/form-data">
    @csrf
    <input type="file" name="document" id="document">

    <button type="submit">Subir archivo</button>
</form>

@if ($documents->isNotEmpty())
    @foreach ($documents as $document )
        <a href="{{ route("document.download", $document) }}">{{ $document->file_path }}</a>
    @endforeach
@else
<p>Aun no hay documentos subidos</p>
@endif
@endsection