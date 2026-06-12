<h1>Edit User</h1>

<form action="/users/{{ $user->id }}" method="POST">

    @csrf
    @method('PUT')

    <input type="text"
           name="name"
           value="{{ $user->name }}">

    <br><br>

    <input type="email"
           name="email"
           value="{{ $user->email }}">

    <br><br>

    <button type="submit">
        Update
    </button>

</form>