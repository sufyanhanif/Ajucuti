@extends('layouts.admin')

@section('content')

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My App</title>
    
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <style>
      th {
        text-align: center;
      }
      td {
        text-align: center;
      }
    </style>

  </head>
  <body>
    <div id="app">
      <div class="main-wrapper">
        <div class="main-content">
          <div class="container">
            <div class="card mt-5">
              <div class="card-header" style="background-color: #4169E1	; color: white; text-align: center;">
                <h3>Data Pegawai</h3>
              </div>
              <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <p>
                  <a class="btn btn-primary" href="{{ route('users.create') }}">Menambah User</a>
                  <a class="btn btn-warning" href="{{ route('users.sisa_cuti') }}">Reset Sisa Cuti</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Alamat</th>
                      <th>Telepon</th>
                      <th>Role</th>
                      <th>Sisa Cuti</th>
                      <th colspan="3">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $pegawai)
                      <tr>
                        <td>{{ $pegawai->id }}</td>
                        <td>{{ $pegawai->name }}</td>
                        <td>{{ $pegawai->email }}</td>
                        <td>{{ $pegawai->alamat }}</td>
                        <td>{{ $pegawai->telepon }}</td>
                        <td>{{ $pegawai->role }}</td>
                        <td>{{ $pegawai->jml_cuti }}</td>
                        <td>
                          <a href="{{ route('users.edit', $pegawai->id) }}" class="btn btn-secondary btn-sm mr-2">Edit</a>
                        </td>
                        <td>
                          <form action="{{ route('users.destroy' , $pegawai->id) }}" method="POST">
                            @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data ini ?')">Hapus</button>
                        </form>
                        </td>
                        <td>
                        <form action="{{ route('users.reset_pass', ['id' => $pegawai->id]) }}" method="POST">
                          <!-- Form fields and submit button -->
                          @csrf
                          @method('PUT')
                          <button class="btn btn-warning btn-sm ml-2 " onclick="return confirm('Anda yakin me reset password ini ?')">Reset</button>
                      </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="6">
                            No record found!
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}" defer></script>
    
  </body>
</html>

@endsection