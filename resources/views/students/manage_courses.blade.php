@extends('layouts.app') <!-- use your main layout -->

@section('content')
<div class="container">
    <h3>Manage Courses for {{ $studentModel->name }}</h3>

    <form action="{{ route('students.updateCourses', $studentModel->id) }}" method="POST">
        @csrf
        @foreach($courses as $course)
            <div>
                <input type="checkbox" name="courses[]" value="{{ $course->id }}"
                    {{ $studentModel->courses->contains($course->id) ? 'checked' : '' }}>
                {{ $course->courseName }}
            </div>
        @endforeach

        <button type="submit">Update Courses</button>
    </form>
</div>
@endsection
