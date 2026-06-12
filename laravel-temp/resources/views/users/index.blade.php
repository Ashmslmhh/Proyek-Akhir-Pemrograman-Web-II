<h1>Daftar User</h1>

<a href="{{ route('users.create') }}">Tambah User</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>NIM</th>
        <th>NIP</th>
        <th>Prodi</th>
        <th>Aksi</th>
    </tr>

    @foreach($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->nim ?? '-' }}</td>
            <td>{{ $user->nip ?? '-' }}</td>
            <td>{{ $user->prodi ?? '-' }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}">Edit</a>

                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
git
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus user ini?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>