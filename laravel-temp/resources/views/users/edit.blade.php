<h1>Edit User</h1>

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama</label><br>
    <input type="text" name="name" value="{{ $user->name }}" required>

    <br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="{{ $user->email }}" required>

    <br><br>

    <label>Role</label><br>
    <select name="role" required>
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
            Admin
        </option>

        <option value="dosen" {{ $user->role == 'dosen' ? 'selected' : '' }}>
            Dosen
        </option>

        <option value="mahasiswa" {{ $user->role == 'mahasiswa' ? 'selected' : '' }}>
            Mahasiswa
        </option>
    </select>

    <br><br>

    <label>NIM</label><br>
    <input type="text" name="nim" value="{{ $user->nim }}">

    <br><br>

    <label>NIP</label><br>
    <input type="text" name="nip" value="{{ $user->nip }}">

    <br><br>

    <label>Prodi</label><br>
    <input type="text" name="prodi" value="{{ $user->prodi }}">

    <br><br>

    <button type="submit">Update</button>
</form>

<br>

<a href="{{ route('users.index') }}">Kembali</a>