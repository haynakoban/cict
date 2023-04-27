@foreach ($histories as $history)
    <li>{{ $history->name }}</li>
    <li>{{ $history->first_name . " " . $history->last_name  }}</li>
    <li>{{ $history->created_at }}</li>
    <li>{{ $history->time }}</li>
    <li>{{ $history->key_status }}</li>
    <hr>
@endforeach

{{ $histories->links() }}