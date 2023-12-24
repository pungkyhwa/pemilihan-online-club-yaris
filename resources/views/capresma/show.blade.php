@extends('layouts/blankLayout')

@section('title', 'Detail Passlon')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection
@section('content')
<div class="container m-5">
  <a href="{{ route('capresma.index')}}" type="button" class="btn btn-primary">
      <span class="tf-icons bx bx-arrow-back"></span> 
  </a>
  <div class="row mb-5 justify-content-center">
    <div class="col-md-8 col-lg-6 mb-3">
      <div class="card h-100">
        <img class="card-img-top"  src="{{ asset('storage/capresma/'.$capresma->foto_url) }}" alt="adsads"/>
        <div class="card-body">
          <h5 class="card-title">{{ $capresma->nm_capresma.' (ketua)'.' & '.$capresma->wakil.' (wakil)' }}</h5>
            <h6 class="card-title fw-bold">Visi</h6>
            <p class="card-text">
            {{$capresma->visi}}
            </p>
            <h6 class="card-title fw-bold">Misi</h6>
            <p class="card-text">
            {{$capresma->misi}}
            </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection