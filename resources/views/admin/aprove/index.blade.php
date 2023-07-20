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
                <h3>Data Cuti</h3>
              </div>
              <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="d-flex justify-content-between mb-3">
                </div>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                        <th>ID Cuti</th>
                        <th>ID User</th>
                        <th>Nama</th>
                        <th>Sisa Cuti</th>
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
                          <td>
                            @foreach ($ajucuti->users as $user)
                                {{ $user->id }}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($ajucuti->users as $user)
                                {{ $user->name }}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($ajucuti->users as $user)
                                {{ $user->jml_cuti }}
                            @endforeach
                        </td>
                          <td>{{ $ajucuti->mulai_cuti }}</td>
                          <td>{{ $ajucuti->selesai_cuti }}</td>
                          <td>{{ $ajucuti->alasan }}</td>
                          <td>{{ $ajucuti->status }}</td>
                          <td class="text-center">
                            <div class="btn-group" role="group">
                              @if ($ajucuti->status === 'tunggu')
                                <form action="{{ route('aprove.setuju', $ajucuti->id) }}" method="POST">
                                  @csrf
                                  <button type="submit" class="btn btn-success btn-sm">Setuju</button>
                                </form>
                                <form action="{{ route('aprove.tolak', $ajucuti->id) }}" method="POST">
                                  @csrf
                                  <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                              @elseif ($ajucuti->status === 'setuju')
                                <div>
                                  <button class="btn btn-success btn-sm" disabled>Setuju</button>
                                </div>
                              @elseif ($ajucuti->status === 'tolak')
                                <div>
                                  <button class="btn btn-danger btn-sm" disabled>Tolak</button>
                                </div>
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