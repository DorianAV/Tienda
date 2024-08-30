@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Session::has('mensaje'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
                <strong>{{ Session::get('mensaje') }}</strong>
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <a href="{{route('categoria.index')}}" class="btn btn-success">Regresar</a>
                </div>
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control me-2" placeholder="Buscar productos"
                           style="max-width: 200px;">
                </div>

            </div>
            <div class="card-body">
                <h4 class="card-title">Categorias</h4>
                @if($categorias->isEmpty())
                    <h3 class="card-title">No hay categorias por mostrar</h3>
                @endif
                @if($categorias->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>

                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categorias as $categoria)
                                <tr>
                                    <td scope="row">{{$categoria->id}}</td>
                                    <td>{{$categoria->nombre}}</td>
                                    <td>{{{$categoria->descripcion}}}</td>

                                    <td class="text-nowrap">
                                        <form action="{{ route('categoria.forceDelete', $categoria->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning">Eliminar</button>
                                        </form>
                                        <form action="{{ route('categoria.restore', $categoria->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Restaurar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                @endif
            </div>
            @if($categorias->hasPages())
                <div class="card-footer text-muted">
                    {{$categorias->links()}}
                </div>
            @endif

        </div>

    </div>

@endsection
