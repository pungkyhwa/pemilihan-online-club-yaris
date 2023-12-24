@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Data KPUM')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Data Pemilihan Umum 😁</h5>
            <p class="mb-0">semua data ditampilkan secara transparant tetapi tetap menjaga privasi</p>
            <p id="countdown">data akan di perbearui setelah 5 menit</p>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="row">
  <!-- Order Statistics -->
  <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Statistics</h5>
        </div>
       
      </div>
      <div class="card-body">
        <div class="d-flex justify-content align-items-center mb-3">
          <p class="mt-2">
            Total Vote  <span class="fw-bold"> {{ $resultAll}}</span> dari <span class="fw-bold"> {{ $totalMhs}}</span> Pemilih
          </p>
        </div>
        <ul class="p-0 m-0">
        @foreach($capresmas as $capresma)
        @php
         $data = $capresma->jumlah_vote /$totalMhs * 100;
         $percentageFloat = floatval($data);
        $dataHasil = round($percentageFloat, 2);
        @endphp
          <li class="d-flex mb-5">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-user'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0 ">{{$capresma->nm_capresma.' & '.$capresma->wakil}}</h6>
                <small class="mb-0">Vote Didapat : {{$capresma->jumlah_vote}}</small>
                <br>
                <small class="mb-0">{{$dataHasil.'%'}}</small>
              </div>
              <div class="progress w-100">
                <div class="progress-bar" role="progressbar" style="width: {{$dataHasil}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$dataHasil}}%</div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  <div class="row gy-4 mb-4" id="sortable-cards">
    <h3>Data Yang Sudah Voting</h3>
    @foreach($resultDone as $item)
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="card drag-item cursor-pointer mb-lg-0 mb-4">
        <div class="card-body text-center">
          <h2>
            <i class="bx bx-pie-chart text-primary display-6"></i>
          </h2>
          <h4>{{$item['nama_prodi']}}</h4>
          <h5>{{$item['nilai']}}</h5>
        </div>
      </div>
    </div>
    @endforeach
  </div> 
  <div class="row gy-4 mb-4" id="sortable-cards">
    <h3>Data Yang Belum Voting</h3>
    @foreach($resultBlm as $item)
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="card drag-item cursor-pointer mb-lg-0 mb-4">
        <div class="card-body text-center">
          <h2>
            <i class="bx bx-pie-chart text-primary display-6"></i>
          </h2>
          <h4>{{$item['nama_prodi']}}</h4>
          <h5>{{$item['nilai']}}</h5>
        </div>
      </div>
    </div>
    @endforeach
  </div> 
  <!--/ Order Statistics -->

</div>

<script>
  // Waktu dalam detik
  let countdownTime = 300;
  function updateCountdown() {
      const countdownElement = document.getElementById('countdown');
      const minutes = Math.floor(countdownTime / 60);
      const seconds = countdownTime % 60;
      countdownElement.textContent = `Data akan diperbarui setelah ${minutes} menit ${seconds} detik`;
      if (countdownTime === 0) {
          // Jika waktu habis, lakukan refresh
          location.reload();
      } else {
          // Kurangi waktu setiap detik
          countdownTime--;
          // Perbarui setiap detik
          setTimeout(updateCountdown, 1000);
      }
  }
  // Mulai countdown
  updateCountdown();
</script>

@endsection
