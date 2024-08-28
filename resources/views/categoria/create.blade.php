@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{url('/categoria')}}" method="POST"enctype="multipart/form-data">
            @csrf
            @include('categoria.form')

        </form>
    </div>


@endsection
