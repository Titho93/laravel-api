@extends('layouts.admin')

@section('content')
    <div class="show w-100 p-3">
        <button class="btn btn-dark"><a class="nav-link" href="{{ route('admin.tecnologies.index') }}"><i
                    class="fa-solid fa-rotate-left"></i></a></button>
        <h1>{{ $tecnology->name }}</h1>
        <p>Name: {{ $tecnology->name }}</p>
    </div>
@endsection
