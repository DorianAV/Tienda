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
                    <a href="{{route('categoria.create')}}" class="btn btn-success">Crear Nueva Categoria</a>
                    <a href="{{route('producto.index')}}" class="btn btn-primary">Productos</a>
                </div>
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control me-2" placeholder="Buscar productos"
                           style="max-width: 200px;">
                    <a href="{{ route('categoria.trashed') }}" class="btn btn-danger">Papelera</a>
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
                                        <a href="{{route('categoria.edit',$categoria->id)}}"
                                           class="btn btn-warning d-inline-block">Editar</a>
                                        <form action="{{route('categoria.destroy',$categoria->id)}}"
                                              class="d-inline-block"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Borrar" class="btn btn-danger d-inline-block">
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
