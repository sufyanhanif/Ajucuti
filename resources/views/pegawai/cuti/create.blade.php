@extends('layouts.pegawai')

@section('content')

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My App</title>
    
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    
  </head>
  <body>
    <div id="app">
      <div class="main-wrapper">
        <div class="main-content">
          <div class="container">
            <form method="post" action="{{ route('ajucuti.store') }}">
              @csrf
              <div class="card mt-5">
                <div class="card-header">
                  <div class="d-flex justify-content-between align-items-center">
                  <h3>Ajukan Cuti</h3>
                  <a href="{{ route('ajucuti.index') }}" class="btn btn-danger mb-12">Back</a>
                  </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <div class="alert-title"><h4>Whoops!</h4></div>
                          There are some problems with your input.
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                      </div> 
                    @endif


                    @if (session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="mb-3">
                      <label class="form-label">Mulai Cuti</label>
                      <input type="date" class="form-control" name="mulai_cuti" value="{{ old('mulai_cuti') }}">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Selesai Cuti</label>
                      <input type="date" class="form-control" name="selesai_cuti" value="{{ old('selesai_cuti') }}">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Alasan</label>
                      <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
                    </div>
                <div class="card-footer">
                  <button class="btn btn-primary" type="submit">Create</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}" defer></script>

  </body>
</html>

@endsection