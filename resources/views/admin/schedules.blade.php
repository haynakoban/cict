
@foreach ($schedules as $schedule)
    <li>{{ ($schedule->schedule_status) ? $schedule->schedule_status : 'Null'}}</li>
    <li>{{ $schedule->first_name . " " . $schedule->last_name  }}</li>
    <li>{{ $schedule->name  }}</li>
    <br>
    <li>{{ $schedule->subject_name }}</li>
    <li>{{ $schedule->section_name }}</li>
    <li>{{ $schedule->group }}</li>
    <li>{{ $schedule->day }}</li>
    <li>{{ $schedule->start_time }}</li>
    <li>{{ $schedule->end_time }}</li>
    <li><a href="#">see details</a></li>
    <hr>
@endforeach

{{ $schedules->links() }}