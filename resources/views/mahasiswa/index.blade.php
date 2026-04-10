<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h3>CRUD Mahasiswa Laravel</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM --}}
    <div class="card mb-3">
        <div class="card-header">
            {{ isset($edit) ? 'Edit' : 'Tambah' }} Mahasiswa
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ isset($edit) ? url('/mahasiswa/update/'.$edit->id) : url('/mahasiswa') }}">
                @csrf

                <div class="mb-2">
                    <label>NIM</label>
                    <input type="text"
                           name="nim"
                           class="form-control"
                           value="{{ $edit->nim ?? '' }}"
                           required>
                </div>

                <div class="mb-2">
                    <label>Nama</label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           value="{{ $edit->nama ?? '' }}"
                           required>
                </div>

                <div class="mb-2">
                    <label>Prodi</label>
                    <input type="text"
                           name="prodi"
                           class="form-control"
                           value="{{ $edit->prodi ?? '' }}"
                           required>
                </div>

                <button class="btn btn-primary">
                    {{ isset($edit) ? 'Update' : 'Simpan' }}
                </button>

                @if(isset($edit))
                    <a href="/mahasiswa" class="btn btn-secondary">
                        Batal
                    </a>
                @endif

            </form>

        </div>
    </div>

    {{-- TABLE --}}
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th width="150">Aksi</th>
        </tr>

        @foreach($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->nim }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->prodi }}</td>
                <td>
                    <a href="/mahasiswa/edit/{{ $row->id }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="/mahasiswa/delete/{{ $row->id }}"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Hapus data?')">
                        Hapus
                    </a>
                </td>
            </tr>
        @endforeach

    </table>

</div>

</body>
</html>
