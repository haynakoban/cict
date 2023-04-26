<form action="/admin" method="POST">
    @csrf
    <input type="text" name="fullname" placeholder="fullname">
    <input type="text" name="username" placeholder="username">
    <input type="email" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <input type="password" name="password_confirmation" placeholder="password_confirmation">
    <button type="submit">submit</button>
</form>