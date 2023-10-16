@csrf

<div class="mb-3">
    <label for="name" class="form-label">Articulo</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $post->name) }}">
</div>
 <div class="form-group">
    <label for="category_id">Categorias</label>
    <select name="category_id" id="category_id" class="form-control">
        @foreach ($categories as $title => $id)
            <option {{ $post->category_id == $id ? 'selected="selected"' : '' }} value="{{ $id }}">
                {{ $title }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="posted">Posted</label>
    <select name="state" id="posted" class="form-control">
        @include('dashboard.partials.option-yes-not', ['val' => $post->state])
    </select>
</div>
<input type="hidden" value="{{$post->id}}" name="postid">
<div class="mb-3">
    <label for="description" class="form-label">Contenido</label>
    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $post->description) }}</textarea>
</div>
<div class="form-group">
    <label for="image">Selecciona una imagen:</label>
    <input type="file" name="image" id="imagen">
</div>
<div>
    <img src="{{asset('imagenes/'. $post->image)}}" alt="">
</div>
<div class="text-center">
    <button class="btn btn-success" type="submit">Publicar</button>
    <a href="{{ url()->previous() }}" class="btn btn-danger" type="button">Cancelar</a>
</div>
