{{-- @dd($attendances) --}}

@foreach ($attendances as $attendance)
    <li>{{ $attendance->name }}</li>
    <li>{{ $attendance->first_name . " " . $attendance->last_name  }}</li>
    <li>{{ $attendance->day }}</li>
    <li>{{ $attendance->created_at }}</li>
    <li>{{ $attendance->time }}</li>
    <li>{{ $attendance->attendance_status }}</li>
    <li><a href="/faculty/attendance/{{ $attendance->attendance_id }}">Details</a></li>
    <hr>
@endforeach

{{ $attendances->links() }}