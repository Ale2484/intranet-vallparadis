
@if (session("success"))
    <p>{{ session("success") }}</p>
@endif


<h1>Centros: </h1>
@foreach ($centers as $center )
    <a href="{{ route("centers.show", $center->id) }}">{{ $center->name }}</a>
    <br>
@endforeach


<br>
<form action="{{ route("centers.store") }}" method="post">
    @csrf
    <input type="text" name="name" id="name" placeholder="Nombre">
    <input type="text" name="address" id="address" placeholder="Direccion">
    <input type="tel" name="phone" id="phone" placeholder="Telefono">
    
    <button type="submit" name="submit" id="submit">Eliminar</button>
</form>