<form action="/admin/schedules" method="POST">
    @csrf
    <input type="text" name="subject_name" placeholder="Subject Name">
    <input type="text" name="section_name" placeholder="Section Name">
    <br>

    <label for="user_id">Select Faculty Name</label>
    <select id="user_id" name="user_id">
         @foreach ($users as $user)  
            <option value="{{ $user->user_id }}">{{ $user->first_name . " " . $user->last_name}}</option>
        @endforeach
    </select>
    <br>

    <label for="room_id">Select Room Name</label>
    <select id="room_id" name="room_id">
         @foreach ($rooms as $room)  
            <option value="{{ $room->id }}">{{ $room->name }}</option>
        @endforeach
    </select>
    <br>

    <br>
    <label for="">Both G1 and G2</label>
    <input type="radio" name="group" value="BOTH">
    <label for="">G1</label>
    <input type="radio" name="group" value="G1">
    <label for="">G2</label>
    <input type="radio" name="group" value="G2">
    <br>
    
    <label for="day">Select Day</label>
    <select id="day" name="day">
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        <option value="Sunday">Sunday</option>
    </select>
    <br>

    @php
        $times = array(
            '06:00 AM' => '06:00 AM', '06:30 AM' => '06:30 AM',
            '07:00 AM' => '07:00 AM', '07:30 AM' => '07:30 AM',
            '08:00 AM' => '08:00 AM', '08:30 AM' => '08:30 AM',
            '09:00 AM' => '09:00 AM', '09:30 AM' => '09:30 AM',
            '10:00 AM' => '10:00 AM', '10:30 AM' => '10:30 AM',
            '11:00 AM' => '11:00 AM', '11:30 AM' => '11:30 AM',
            '12:00 PM' => '12:00 PM', '12:30 PM' => '12:30 PM',
            '01:00 PM' => '01:00 PM', '01:30 PM' => '01:30 PM',
            '02:00 PM' => '02:00 PM', '02:30 PM' => '02:30 PM',
            '03:00 PM' => '03:00 PM', '03:30 PM' => '03:30 PM',
            '04:00 PM' => '04:00 PM', '04:30 PM' => '04:30 PM',
            '05:00 PM' => '05:00 PM', '05:30 PM' => '05:30 PM',
            '06:00 PM' => '06:00 PM', '06:30 PM' => '06:30 PM',
            '07:00 PM' => '07:00 PM', '07:30 PM' => '07:30 PM',
            '08:00 PM' => '08:00 PM', '08:30 PM' => '08:30 PM',
            '09:00 PM' => '09:00 PM', '09:30 PM' => '09:30 PM',
            '10:00 PM' => '10:00 PM', '10:30 PM' => '10:30 PM',
        );

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

    <label for="start_time">Select Time Start</label>
    <select id="start_time" name="start_time">
        @foreach ($times as $time)  
            <option value="{{ $time }}">{{ $time }}</option>
        @endforeach
    </select>
    <br>

    <label for="end_time">Select Time End</label>
    <select id="end_time" name="end_time">
        @foreach ($times as $time)  
            <option value="{{ $time }}">{{ $time }}</option>
        @endforeach
    </select>
    <br>

    <label for="semester">Select Semester</label>
    <select id="semester" name="semester">
        @foreach ($semesters as $semester)  
            <option value="{{ $semester }}">{{ $semester }}</option>
        @endforeach
    </select>
    <br>
    <button type="submit">submit</button>
</form>