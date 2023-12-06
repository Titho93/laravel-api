@extends('layouts.admin')

@section('content')
    <div class="show w-100 p-3">
        <button class="btn btn-dark"><a class="nav-link" href="{{ route('admin.projects.index') }}"><i
                    class="fa-solid fa-rotate-left"></i></a></button>
        <div class="image">
            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}">
        </div>
        <h1>{{ $project->name }}</h1>
        @if ($project->type)
            <p>Type: <strong>{{ $project->type->name }}</strong></p>
        @endif
        @php
            $date = date_create($project->date);
        @endphp

        <p>Tecnology:
            @forelse ($project->tecnologies as $tecnology)
                {{ $tecnology->name }}
            @empty
                -
            @endforelse
        </p>
        <p>Creation Date {{ date_format($date, 'd/m/Y') }}</p>
        <p>Bio: {{ $project->description }}</p>
    </div>
@endsection
