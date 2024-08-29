@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($errors)>0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Errores!</strong>
                @foreach($errors->all() as $error)
                    <br>- {{ $error }}
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">Stock del Producto</div>
            <div class="card-body">
                <form action="{{ route('producto.updateStock', $producto->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row mb-3">
                        <div class="col">
                            <label for="nombre">Nombre</label>
                            <p class="form-control-plaintext" id="nombre">{{ $producto->nombre }}</p>
                        </div>
                        <div class="col">
                            <label for="categoria">Categoría</label>
                            <p class="form-control-plaintext" id="categoria">{{ $producto->categoria->nombre }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="precio">Precio</label>
                            <p class="form-control-plaintext" id="precio">{{ $producto->precio }}</p>
                        </div>
                        <div class="col">
                            <label for="imagen">Imagen</label>
                            <br>
                            <img src="{{ asset('storage/'.$producto->imagen) }}" alt="Imagen del Producto" class="img-fluid rounded shadow" width="150">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="descripcion">Descripción</label>
                            <p class="form-control-plaintext" id="descripcion">{{ $producto->descripcion }}</p>
                        </div>
                        <div class="col">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control form-control-sm" id="stock" name="stock" value="{{ $producto->stock }}">
                        </div>
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-primary">Actualizar Stock</button>
                        <a href="{{route('producto.index')}}" class="btn btn-success">Regresar</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
