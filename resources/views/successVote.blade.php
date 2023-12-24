@extends('layouts/blankLayout')

@section('title', 'Terimakasih')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card shadow-none bg-transparent border border-primary">
        <div class="card-body">
          <!-- Logo -->
          <div class="d-flex flex-column align-items-center ">
            <span class="app-brand-text demo text-body fw-bolder">Vote Berhasil</span>
            <img width=300px src="{{asset('assets/img/illustrations/done_assets.png')}}" alt="">
            <span class="lead">Terimasih Sudah Vote</span>
            <a href="{{route('verifikasi.logout')}}" class="btn btn-primary mt-4 w-100">Lanjut</a>         
          </div> 
      </div>
    </div>
    <!-- /Register -->
    </div>
  </div>
</div>
@endsection