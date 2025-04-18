@extends('layout')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4 text-purple-300">Add New Cat</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cats.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="name" class="form-label">Cat Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age:</label>
            <input type="number" id="age" name="age" value="{{ old('age') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="likes" class="form-label">Likes:</label>
            <input type="text" id="likes" name="likes" value="{{ old('likes') }}" class="form-control">
        </div>
        <select name="breed" id="breed">
            @foreach ($breeds as $breed )
                <option value="{{ $breed -> id}}">{{ $breed -> name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Add Cat</button>
    </form>
</div>
@endsection
