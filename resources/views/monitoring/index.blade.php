
@extends('layouts/contentNavbarLayout')

@section('title', 'Monitoring')

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
  <!-- Order Statistics -->
  <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-4">
    <h3 class="">Monitoring Pemilihan</h3>
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Data Mahasiswa Yg Sedang Memilih</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content align-items-center mb-3">
        </div>
        <ul  class="p-0 m-0">
          <li class="d-flex mb-5">
            <div id="realtime-data-list" class="me-2">
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection

