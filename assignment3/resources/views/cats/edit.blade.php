@extends('layout')

@section('content')
<h1>Edit Cat</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('cats.update', $cat->id) }}" method="POST">
    {{ csrf_field() }}
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $cat->name) }}">
    </div>
    <div class="mb-3">
        <label for="age" class="form-label">Age</label>
        <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $cat->age) }}">
    </div>
    <div class="mb-3">
        <label for="likes" class="form-label">Likes</label>
        <input type="text" class="form-control" id="likes" name="likes" value="{{ old('likes', $cat->likes) }}">
    </div>
    <div class="mb-3">
        <label for="breed" class="form-label">Breed</label>
        <select name="breed" id="breed" class="form-control">
            @foreach ($breeds as $breed)
                <option value="{{ $breed->id }}"
                    {{ $cat->breeds->first()?->id == $breed->id ? 'selected' : '' }}>
                    {{ $breed->name }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Cat</button>
</form>
@endsection
