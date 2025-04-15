@extends('layout')
@section('content')
<h1>Add Student</h1>

@if ($errors->any())
    @foreach($errors ->all() as $error)
        <li> {{ $error }} </li>
    @endforeach
@endif

    <form action="{{ route('students.store') }}" method="POST">
        {{ csrf_field() }}
        <div>
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" value="{{ old('fname') }}">
        </div>
        <div>
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" value="{{ old('lname') }}">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
        </div>
        <select name="course" id="course">
            @foreach ($courses as $course )
                <option value="{{ $course -> id}}">{{ $course -> name }}</option>
            @endforeach
        </select>

        <button type="submit" value="Create">Add Student</button>
    </form>
@endsection