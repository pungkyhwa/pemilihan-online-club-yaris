@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <div class="card">
        <div class="card-body">
       
          <div class="app-brand justify-content-center">
              <span class="h1 fw-bolder">Verifikasi</span>
          </div>

          <h4 class="mb-2">Hayooo...👋</h4>
          <p class="mb-4">Aplikasi Sudah Di Tutup</p>

          <form id="formAuthentication" class="mb-3" action="" method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Kode</label>
              <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukan Kode Anda" autofocus disabled>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" disabled>Masuk Untuk Mulai Voting</button>
            </div>
          </form>

          <p class="text-center">
            <span>Kode Tidak terdaftar?</span>
            <a href="https://wa.me/62895388254466">
              <span>Hubungi tim LPSI</span>
            </a>
          </p>
          @if ($message = Session::get('error'))
          <div class="alert alert-danger" id="success">
              <p class="fw-bold">{{ $message }}</p>
          </div>
        @endif
        </div>
      </div>
     
    </div>
    
    <!-- /Register -->
  </div>
</div>
</div>
@endsection
