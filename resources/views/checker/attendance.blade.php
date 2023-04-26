<form action="/checker/update/{{ $attendance->id }}" method="POST">
    @csrf
    <div>{{ $attendance->name }}</div>
    <br>
    <div>{{ $attendance->first_name . " " . $attendance->last_name  }}</div>
    <br>
    <label for="">Present</label>
    <input type="radio" name="status" value="Present">
    <label for="">Absent</label>
    <input type="radio" name="status" value="Absent">
    <br>
    <br>
    <textarea name="comments">{{ $attendance->comments }}</textarea>
    <button type="submit">Save</button>
</form>
