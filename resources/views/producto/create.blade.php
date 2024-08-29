@extends('layouts.app')
@section('content')
    <div class="container">
        @if(count($errors)>0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
            <strong>Errores!</strong>
                @foreach($errors->all() as $error)
                <br>{{$error}}
                @endforeach
        </div>
        @endif

        <div class="card">
            <div class="card-header">Datos del Producto</div>
            <div class="card-body">
                <form action="{{url('/producto')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('producto.form')
                </form>
            </div>
            </div>
        </div>

@endsection
