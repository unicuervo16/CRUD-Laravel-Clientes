@extends('theme.base')
@section('content')
    <div class="container py-5 text-center">
        <h1 class=""
            style="font-size: 55px
        color: #FFFFFF;
        background: #b8b8b8;
        text-shadow: 4px 3px 0 #7A7A7A;
        color: #FFFFFF;
        background: #b8b8b8;">
            <u>Listado de Clientes</u>
            <br>
        </h1>
        <a href="#" id="mostrarDescripcion" style="color: black;text-decoration:none; ">Descripción... ¿Que es esto?
            ⬇️</a>

        <p id="parrafoDescripcion" style="display: none">
            Este es un pequeño CRUD (Create - Read - Update - Delete) que realice con Laravel y MySQL, <br>donde en el mismo
            puedes agregar un cliente, visualizarlo, editarlo y eliminarlo.
        </p><br>
        <script>
            document.getElementById('mostrarDescripcion').addEventListener('click', function(event) {
                event.preventDefault();
                var parrafo = document.getElementById('parrafoDescripcion');
                if (parrafo.style.display === 'none') {
                    parrafo.style.display = 'block';
                } else {
                    parrafo.style.display = 'none';
                }
            });
        </script>
        <br>
        <a href="{{ route('client.create') }}" class="btn btn-outline-primary btn-lg"><b>Crear Cliente</b></a>
        <br>

        @if (Session::has('mensaje'))
            <div class="alert alert-info my-5" id="mensajeAlert">
                {{ Session::get('mensaje') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('mensajeAlert').style.display = 'none';
                }, 2000);
            </script>
        @endif

        <table class="table"
            style="border-top:#0B5ED7 2px solid;
        border-right:#0B5ED7 1px dotted;
        border-left:#0B5ED7 1px dotted;">
            <br>

            <thead>
                <tr style="font-size: 20px;">
                    <th>Nombre</th>
                    <th>Saldo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clients as $detail)
                    <tr>
                        <td>{{ $detail->name }}</td>
                        <td>{{ $detail->due }}</td>
                        <td>
                            <a href="{{ route('client.edit', $detail) }}" class="btn btn-outline-warning">Editar</a>

                            <form action="{{ route('client.destroy', $detail) }}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Deseas Eliminar este cliente')">Eliminar</button>
                            </form>
                            <button type="button" class="btn btn-outline-info" data-toggle="modal"
                                data-target="#verClienteModal{{ $detail->id }}">
                                Ver
                            </button>

                            <div class="modal fade" id="verClienteModal{{ $detail->id }}" tabindex="-1"
                                aria-labelledby="verClienteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="verClienteModalLabel">Datos del Cliente</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Nombre:</strong> {{ $detail->name }}</p>
                                            <p><strong>Saldo:</strong> {{ $detail->due }}</p>
                                            <p><strong>Comentarios:</strong> {{ $detail->comments }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Ups! Parece que aun no tiene clientes 🤔<br>Dale al Boton de <b
                                style="color:#0B5ED7">Crear Cliente</b> para agregar uno nuevo!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($clients->count())
            {{ $clients->links() }}
        @endif

    </div>
@endsection
