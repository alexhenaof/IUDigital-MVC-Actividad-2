@extends('layouts.app')
@section('content')
    @include('dashboard.partials.validation-error')

    <form action="{{ route('post.update', $post) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @include('dashboard.post._form')
    </form>

@endsection
