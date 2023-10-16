@extends('layouts.app')
@section('content')
    @include('dashboard.partials.validation-error')

    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        {{-- @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Articulo</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Contenido</label>
            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="text-center">
            <button class="btn btn-success btn-sm" type="submit">Publicar</button>
            <button class="btn btn-danger btn-sm" type="button">Cancelar</button>
        </div> --}}
        @include('dashboard.post._form')
    </form>
@endsection
