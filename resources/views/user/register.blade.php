<form action="{{ route('register') }}" method="POST">
    @csrf
    <input type="hidden" name="role" value="faculty">
    <input type="text" name="employee_id" placeholder="employee_id">
    <input type="text" name="first_name" placeholder="first_name">
    <input type="text" name="middle_name" placeholder="middle_name">
    <input type="text" name="last_name" placeholder="last_name">
    <input type="text" name="username" placeholder="username">
    <input type="email" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <input type="text" name="position" placeholder="position">
    <input type="text" name="course_program" placeholder="course_program">
    <input type="text" name="dob" placeholder="date of birth">
    <input type="number" name="age" placeholder="age">
    <input type="text" name="address" placeholder="address">
    <button type="submit">submit</button>
</form>

