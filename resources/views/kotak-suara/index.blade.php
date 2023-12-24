@extends('layouts/blankLayout')

@section('title', 'Kotak-Suara')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
<!-- Examples -->
<div class="container m-5">
  <h3 class="text-center">Pasangan Calon Ketua Umum</h3>
  <p class="text-center lead">Bijak Lah Dalam Memilih</p>
   @if ($message = Session::get('verified'))
    <div class="alert alert-success" id="success">
        <p class="fw-bold">{{ $message }}</p>
    </div>
  @endif
  <div class="row mb-5">
  @foreach($capresmas as $capresma)
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card shadow-lg h-100">
        <img class="card-img-top" src="{{ asset('storage/capresma/'.$capresma->foto_url) }}" alt="adsads "/>
        <div class="card-body d-flex flex-column">
          <h5 class="card-title  text-capitalize">{{$capresma->nm_capresma.' & '.$capresma->wakil}}</h5>
          <form class="mt-auto" action="{{ route('kotak-suara.update', ['kotak_suara' => encrypt($capresma->id)]) }}" method="POST">
              @csrf 
              @method('PUT')
              <button type="submit" class="btn btn-primary w-100">Vote</button>
          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection