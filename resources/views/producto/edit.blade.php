@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{route('producto.update',$producto->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('producto.form')
        </form>

    </div>



@endsection
