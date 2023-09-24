@extends('theme.base')
@section('content')
    <div class="container py-5 text-center">
        <h1 class="">Hola</h1>
        <h3>Si deseas ver la lista de Clientes que posees, por favor da click en el boton de abajo ⬇️ </h3>
        <a href="{{ route('client.index') }}" class="btn btn-primary">Clientes</a>
    </div>
@endsection