<form action="/admin/keys" method="POST">
    @csrf
    <input type="hidden" name="room_id" value="{{ $room->id }}">
    <input type="hidden" name="room_status" value="{{ $room->status }}">
    <input type="text" disabled value="{{ $room->name }}">
    <br><br>

    <label for="user_id">Select Faculty</label>
    <select id="user_id" name="user_id">
        @foreach ($users as $user)  
            <option value="{{ $user->id }}">{{ $user->first_name . " " . $user->last_name }}</option>
        @endforeach
    </select>
    <br>


    @if ($room->status == 'available')
        <button type="submit" style="color:green">Lent Key</button>
    @else
        <button type="submit" style="color:red">Return Key</button>
    @endif
</form>
{{-- <li>{{ ($room->status == 'available') ? '1: available' : '2: borrowed' }}</li> --}}
