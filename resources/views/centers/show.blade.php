<h1>El nombre del centro es: {{ $center->name }}</h1>

<p>Direccion: {{ $center->address }}</p>

<p>Telefono: {{ $center->phone }}</p>


<a href="{{ route("centers.index") }}">Ver centros</a>


<form action="{{ route("centers.destroy", $center->id) }}" method="post">
    @csrf
    @method("DELETE")

    <button type="submit">Eliminar</button>
</form>