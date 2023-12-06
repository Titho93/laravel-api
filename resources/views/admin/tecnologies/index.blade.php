@extends('layouts.admin')

@section('content')
    <div class="index w-100 p-3">
        <h1><i class="fa-solid fa-microchip"></i> Tecnologies List</h1>
        <div class="row">
            <div class="col-6 offset-3">
                <form action="{{ route('admin.tecnologies.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="New Tecnologies" name="name">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">New</button>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tecnologies as $tecnology)
                            <tr>
                                <td>
                                    <form action="{{ route('admin.tecnologies.update', $tecnology) }}" method="POST"
                                        id="form-edit">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" class="form-hidden" value="{{ $tecnology->name }}"
                                            name="name" />
                                    </form>
                                </td>
                                <td>
                                    <a class="btn btn-dark" href="{{ route('admin.tecnologies.show', $tecnology) }}"><i
                                            class="fa-solid fa-circle-info" style="color: #ffffff;"></i></a>
                                    <form class="d-inline-block"
                                        action="{{ route('admin.tecnologies.destroy', $tecnology->id) }}" method="POST"
                                        onsubmit="return confirm ('Are you sure DELETE this Tecnology?')">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-dark"><i
                                                class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
