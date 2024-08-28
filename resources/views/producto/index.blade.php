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
                Productos <br>
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
                                <td>{{$producto->imagen}}</td>
                                <td>{{$producto->stock}}</td>
                                <td>{{$producto->categoria->nombre}}</td>
                                <td>
                                    <form action="{{route('producto.destroy',$producto->id)}}" method="post">
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
            <div class="card-footer text-muted">
                {{$productos->links()}}
            </div>
        </div>

    </div>

@endsection
