@extends('layouts.app')
@section('content')
    <div class="container">


        <form action="{{url('/producto')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('producto.form')
        </form>
    </div>

@endsection
