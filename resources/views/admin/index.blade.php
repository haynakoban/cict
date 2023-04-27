<form action="/admin" method="GET">
    @csrf
    <input type="text" name="keyword" placeholder="search">
    <button type="submit">search</button>
</form>

<div>faculties</div>
@foreach ($faculties as $faculty)
    <div>name: {{ $faculty->first_name . ' ' . $faculty->last_name }}</div>
    <div>username: {{ $faculty->username }}</div>
    <div>email: {{ $faculty->email }}</div>
    {{-- <div>last login: {{ 
        $faculty->last_login == null 
        ? 'No History' 
        : \Carbon\Carbon::parse($faculty->last_login)
            ->diffForHumans(['short' => true]) 
        }}</div> --}} 
        {{-- uncomment the line above this comment for short version of time display
            from : 1 hour ago => 1h ago  --}}
    <div>last login: {{ $faculty->last_login == null ? 'No History' : \Carbon\Carbon::parse($faculty->last_login)->diffForHumans() }}</div> 
    <div>status: {{ $faculty->status }}</div>
    <hr>
@endforeach
<div>{{ $faculties->links() }}</div>


<br>
<br>
<br>
<div>attendance checker</div>
@foreach ($attendanceCheckers as $checker)
    <div>{{ $checker->first_name }}</div>
@endforeach
{{-- <div>{{ $attendanceCheckers->links() }}</div> --}}