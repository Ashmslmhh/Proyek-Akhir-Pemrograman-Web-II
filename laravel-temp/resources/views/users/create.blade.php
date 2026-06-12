<h1>Tambah User</h1>

<form action="/users" method="POST">

    @csrf

    <input type="text" name="name" placeholder="Nama">

    <br><br>

    <input type="email" name="email" placeholder="Email">

    <br><br>

    <select name="role">
        <option value="admin">Admin</option>
        <option value="dosen">Dosen</option>
        <option value="mahasiswa">Mahasiswa</option>
    </select>

    <br><br>

    <input type="text" name="nim" placeholder="NIM">

    <br><br>

    <input type="text" name="nip" placeholder="NIP">

    <br><br>

    <input type="text" name="prodi" placeholder="Prodi">

    <br><br>

    <button type="submit">
        Simpan
    </button>

</form>