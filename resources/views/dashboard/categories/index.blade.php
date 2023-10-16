@extends('layouts.app')

@section('content')

    @include('dashboard.partials.validation-error')
    <div class="container">
 <H1>Categorias</H1>
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                    <tr>
                        <td>id</td>
                        <td>Nombre</td>
                        <td>Descripción</td>
                        <td></td>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->id }}
                            </td>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                {{ $category->description }}
                                {{-- {{ $post->category }} --}}
                            </td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary">Actualizar</a>

                                <form id="formDelete" method="POST" action="{{ route('category.destroy', ['id'=>$category->id] ) }}"
                                      data-action="{{ route('category.destroy',  ['id'=>$category->id]) }}" style="width: 57%;float: right;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                                </form>

                            </td>
                        </tr>
                        <!-- Modal -->
                    @endforeach
                    </tbody>
                </table>

                {{ $categories->links() }}
            </div>
            <div class="col-md-4">
                <h2>Crear categoria</h2>
                <form action="{{route('category.store')}}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 mb-3" href="">
                        Crear
                    </button>
                </form>
            </div>
        </div>

    </div>

@endsection
