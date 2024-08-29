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
            <div class="card-header">
                <a href="{{route('producto.create')}}" class="btn btn-success">Crear Nueva Producto</a>
                <a href="{{route('categoria.index')}}" class="btn btn-primary">Categorias</a>
            </div>
            <div class="card-body">
                <h4 class="card-title">Productos</h4>
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
                                    <a href="{{route('producto.stock',$producto->id)}}" class="btn btn-success d-inline-block">Actualizar Stock</a>
                                    <a href="{{route('producto.edit',$producto->id)}}" class="btn btn-warning d-inline-block">Editar</a>
                                    <form action="{{route('producto.destroy',$producto->id)}}" method="post" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Borrar" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            @if($productos->hasPages())
                <div class="card-footer text-muted">
                    {{$productos->links()}}
                </div>
            @endif
        </div>

    </div>

@endsection
