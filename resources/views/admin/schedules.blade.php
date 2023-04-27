@php
    $semesters = array(
            '2018-2019 1st Semester' => '2018-2019 1st Semester', '2018-2019 2nd Semester' => '2018-2019 2nd Semester',
            '2019-2020 1st Semester' => '2019-2020 1st Semester', '2019-2020 2nd Semester' => '2019-2020 2nd Semester',
            '2020-2021 1st Semester' => '2020-2021 1st Semester', '2020-2021 2nd Semester' => '2020-2021 2nd Semester',
            '2021-2022 1st Semester' => '2021-2022 1st Semester', '2021-2022 2nd Semester' => '2021-2022 2nd Semester',
            '2022-2023 1st Semester' => '2022-2023 1st Semester', '2022-2023 2nd Semester' => '2022-2023 2nd Semester',
            '2023-2024 1st Semester' => '2023-2024 1st Semester', '2023-2024 2nd Semester' => '2023-2024 2nd Semester',
            '2024-2025 1st Semester' => '2024-2025 1st Semester', '2024-2025 2nd Semester' => '2024-2025 2nd Semester',
            '2025-2026 1st Semester' => '2025-2026 1st Semester', '2025-2026 2nd Semester' => '2025-2026 2nd Semester',
        );
@endphp

<form id="my-form" action="/admin/schedules" method="GET">
    @csrf
    <input id="keyword" type="text" name="keyword" placeholder="search" value="{{ $keyword ?? $keyword  }}">
    <br>
    <br>
    <label for="semester">Select Semester</label>
    <select id="semester" name="semester">
            <option value="" selected>Choose semester</option>
        @foreach ($semesters as $semester)  
            <option value="{{ $semester }}" @if ($semester == $semester_keyword) selected @endif>{{ $semester }}</option>
        @endforeach
    </select>
    <br>
</form>

@foreach ($schedules as $schedule)
    <li>{{ $schedule->name }}</li>
    <li>{{ $schedule->first_name . " " . $schedule->last_name  }}</li>
    <li>{{ $schedule->created_at }}</li>
    {{-- <li>{{ \Carbon\Carbon::createFromFormat('H:i:s', $attendance->time)->format('h:i A') }}</li> --}}
    <li>{{ $schedule->start_time }}</li>
    <li>{{ $schedule->schedule_status }}</li>
    <li>{{ $schedule->semester }}</li>
    <li><a href="/admin/schedules/{{ $schedule->schedule_id }}">Comment</a></li>
    <hr>
@endforeach

{{ $schedules->links() }}


<script>
    // get a reference to the form, select element, and search field
    const myForm = document.querySelector('#my-form');
    const mySelect = document.querySelector('#semester');
    const mySearch = document.querySelector('#keyword');

    // add an event listener to the select element
    mySelect.addEventListener('change', function() {
        // submit the form when a change occurs
        myForm.submit();
    });

    // add an event listener to the search field
    mySearch.addEventListener('keyup', function(event) {
        // check if the Enter key was pressed
        if (event.key === 'Enter') {
        // submit the form
        myForm.submit();
        }
    });
</script>
