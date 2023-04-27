<form action="/admin/keys" method="GET">
    @csrf
    <input type="text" name="keyword" placeholder="search" value="{{ $keyword ?? $keyword  }}">
    <button type="submit">search</button>
</form>

@foreach ($rooms as $room)
    <li>{{ $room->name }}</li>
    <li>{{ ($room->status == 'available') ? '1: available' : '2: borrowed' }}</li>
    <li><a href="/admin/keys/{{ $room->id }}">see details</a></li>
    <hr>
@endforeach

{{ $rooms->links() }}