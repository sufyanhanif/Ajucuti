@extends('layouts.pegawai')

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
      .colspan-1 {
      grid-column-end: span 1;
      }
  
    .colspan-2 {
    grid-column-end: span 2;
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
                <h3>Pengajuan Cuti</h3>
              </div>
              <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="d-flex justify-content-between mb-3">
                  <div>
                    <a class="btn btn-primary" href="{{ route('ajucuti.create') }}">Ajukan Cuti</a>
                  </div>
                  <div>
                    <span class="ml-2">Sisa Cuti: {{ auth()->user()->jml_cuti }}</span>
                  </div>
                </div>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Mulai Cuti</th>
                      <th>Selesai Cuti</th>
                      <th>Alasan</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($ajucutis as $ajucuti)
                      <tr>
                        <td>{{ $ajucuti->id }}</td>
                        <td>{{ $ajucuti->mulai_cuti}}</td>
                        <td>{{ $ajucuti->selesai_cuti }}</td>
                        <td>{{ $ajucuti->alasan }}</td>
                        <td>{{ $ajucuti->status }}</td>
                        <td>
                          <div class="btn-group" role="group">
                            @if ($ajucuti->status === 'setuju')
                              <button class="btn btn-success btn-sm mr-2" disabled>Setuju</button>
                            @elseif ($ajucuti->status === 'tolak')
                              <button class="btn btn-danger btn-sm mr-2" disabled>Tolak</button>
                            @else
                              <table>
                                <tr>
                                  <td>
                                    <a href="{{ route('ajucuti.edit', $ajucuti->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                  </td>
                                  <td>
                                    <form action="{{ route('ajucuti.destroy', $ajucuti->id) }}" method="POST">
                                      @csrf
                                      <button class="btn btn-danger btn-sm ml-2" onclick="return confirm('Anda yakin membatalkan pengajuan cuti ?')">Batal</button>
                                    </form>
                                  </td>
                                </tr>
                              </table>
                            @endif
                          </div>
                        </td>
                   
                      @endforeach
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