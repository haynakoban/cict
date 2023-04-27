@foreach ($rooms as $room)
    <li>{{ $room->name }}</li>
    <li>{{ ($room->status == 'available') ? '1: available' : '2: borrowed' }}</li>
    <li><a href="#">see details</a></li>
    <hr>
@endforeach

{{ $rooms->links() }}