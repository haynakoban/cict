<form action="/authenticate" method="POST">
    @csrf
    <input type="text" name="username" placeholder="username">
    <input type="password" name="password" placeholder="password">
    <button type="submit">submit</button>
</form>