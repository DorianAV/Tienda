@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{route('categoria.update',$categoria->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('categoria.form')
        </form>
    </div>
@endsection
