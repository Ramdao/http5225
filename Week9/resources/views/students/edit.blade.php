@extends('layout')
@section('content')
<h1>Edit Student</h1>

@if ($errors->any())
    @foreach($errors ->all() as $error)
        <li> {{ $error }} </li>
    @endforeach
@endif

    <form action="{{ route('students.update', $student-> id) }}" method="POST">
        {{ csrf_field() }}
        @method('PUT')
        <div>
            <label for="fname">First Name:</label>
            <input type="text" name="fname" placeholder="fname" value="{{ old('fname') ?? $student -> fname }}">
        </div>
        <div>
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" placeholder="lname" value="{{ old('lname') ?? $student -> lname }}">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="email" value="{{ old('email') ?? $student -> email }}">
        </div>
        <button type="submit" value="Create">Add Student</button>
    </form>
@endsection