@extends('layouts.admin')

@section('content')
    <div class="container p-4">
        <button class="btn btn-dark"><a class="nav-link" href="{{ route('admin.projects.index') }}"><i
                    class="fa-solid fa-rotate-left"></i></a></button>
        <h1 class="d-inline-block p-4"><i class="fa-solid fa-file-import"></i> Insert New Projects</h1>

        <div class="row">
            <div class="col-8">
                <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method($method)
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        @foreach ($tecnologies as $tecnology)
                            <input type="checkbox" class="btn-check" id="tecnology_{{ $tecnology->id }}" autocomplete="off"
                                name='tecnologies[]' value='{{ $tecnology->id }}'
                                @if ($project?->tecnologies->contains($tecnology->id)) checked @endif>
                            <label class="btn btn-outline-primary"
                                for="tecnology_{{ $tecnology->id }}">{{ $tecnology->name }}</label>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image"
                            value="{{ old('image', $project?->image) }}">
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="dateformat" class="form-control" id="date" name="date">
                    </div>
                    <div class="form-floating mb-5">
                        <textarea class="form-control" placeholder="Description" id="description" name="description" style="height: 200px"></textarea>
                        <label for="floatingTextarea2">Description</label>
                    </div>


                    <div class="p-5">
                        <button type="submit" class="btn btn-dark">Send</button>
                        <button type="reset" class="btn btn-dark">Retry</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
