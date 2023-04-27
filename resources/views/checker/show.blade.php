<form action="/checker/attendances/{{ $attendance->id }}" method="POST">
    @csrf
    @method('PUT')
    <div>{{ $attendance->name }}</div>
    <br>
    <div>{{ $attendance->first_name . " " . $attendance->last_name  }}</div>
    <br>
    <label for="">Present</label>
    <input type="radio" name="status" value="Present" {{ ($attendance->attendance_status == "Present") ? "checked" : "" }}>
    <label for="">Absent</label>
    <input type="radio" name="status" value="Absent" {{ ($attendance->attendance_status == "Absent") ? "checked" : "" }}>
    <br>
    <br>
    <textarea name="comments">{{ $attendance->comments }}</textarea>
    <button type="submit">Save</button>
</form>
