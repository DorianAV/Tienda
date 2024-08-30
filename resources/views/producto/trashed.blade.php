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
                    <a href="{{route('producto.index')}}" class="btn btn-success">Regresar</a>
                </div>
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control me-2" placeholder="Buscar productos"
                           style="max-width: 200px;">
                </div>
            </div>
            <div class="card-body">
                <h4 class="card-title">Productos</h4>
                @if($productos->isEmpty())
                    <h3 class="card-title">No hay productos por mostrar</h3>
                @endif
                @if($productos->isNotEmpty())
                    <div class="table-responsive">

                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Imagen</th>
                                <th>Stock</th>
                                <th>Categoria</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productos as $producto)
                                <tr>
                                    <td scope="row">{{$producto->id}}</td>
                                    <td>{{$producto->nombre}}</td>
                                    <td>{{{$producto->descripcion}}}</td>
                                    <td>{{$producto->precio}}</td>
                                    <td>
                                        <img src="{{asset('storage').'/'.$producto->imagen}}" width="200">
                                    </td>
                                    <td>{{$producto->stock}}</td>
                                    <td>{{$producto->categoria->nombre}}</td>
                                    <td class="text-nowrap">
                                        <form action="{{ route('producto.forceDelete', $producto->id) }}" method="POST"
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning">Eliminar</button>
                                        </form>
                                        <form action="{{ route('producto.restore', $producto->id) }}" method="POST"
                                              style="display:inline;">
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
            @if($productos->hasPages())
                <div class="card-footer text-muted">
                    {{$productos->links()}}
                </div>
            @endif
        </div>

    </div>

@endsection
