<div>faculties</div>
@foreach ($faculties as $faculty)
    <div>{{ $faculty->first_name }}</div>
@endforeach
{{-- <div>{{ $faculties->links() }}</div> --}}


<div>attendance checker</div>
@foreach ($attendanceCheckers as $checker)
    <div>{{ $checker->first_name }}</div>
@endforeach
{{-- <div>{{ $attendanceCheckers->links() }}</div> --}}