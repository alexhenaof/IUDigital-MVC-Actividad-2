@extends('layouts.app')
@section('content')
    @include('dashboard.partials.validation-error')
<div class="container">
    <form action="{{ route('category.update', $category) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        <h2>Actualizar categoria</h2>

            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{$category->description}}</textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3 mb-3" href="">
                Guardar
            </button>
        <a href="{{ url()->previous() }}" class="btn btn-danger" type="button">Cancelar</a>


    </form>
</div>
@endsection
