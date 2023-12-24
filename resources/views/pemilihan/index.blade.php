@extends('layouts/contentNavbarLayout')
@section('title', 'capresma') 
@section('content')
<h2 class="fw-bold py-3 ">
    Daftar yang sudah memilih
</h2>
@if ($message = Session::get('success'))

<div class="alert alert-success" id="success">
    <p class="fw-bold">{{ $message }}</p>
</div>

@endif
@if ($message = Session::get('error'))

<div class="alert alert-danger" id="success">
    <p class="fw-bold">{{ $message }}</p>
</div>

@endif
<div class="card">
  <div class="row d-flex align-items-center px-2">
    <h5 class="card-header col-6">Daftar</h5>
    <div class="col-6 d-flex justify-content-end">
     
    </div>
  </div>
  <div class="table-responsive text-nowrap ">
    <table id="table-body" class="table">
      <thead class="bg-primary bg-opacity-50">
        <tr>
          <th class="text-white">No</th>
          <th class="text-white">Kode</th>
          <th class="text-white">Nama Pemilih</th>
          <th class="text-white">Paslon</th>
          <th class="text-white">waktu</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      @if(count($pemilihans) === 0)
        <tr>
            <td colspan="11">Belum ada capresma yang dibuat.</td>
        </tr>
    @else
      @foreach($pemilihans as $capresma)
            <tr>
                <td>{{ ++$i}}</td>
                <td>{{ $capresma->nim }}</td>
                <td>{{ $capresma->nm_mahasiswa }}</td>
                <td>{{ $capresma->nm_capresma }}, {{ $capresma->wakil }}</td>
                <td>{{ $capresma->created_at }}</td>
                
            </tr>
      @endforeach
      @endif
      </tbody>
    </table>
  </div>
</div>
<div class="text-center mt-2">
    <ul class="pagination">
      @if($pemilihans->isEmpty())
            <li class="page-item disabled">
            <span class="page-link">Previous</span>
            </li>

            <li class="page-item active">
                <span class="page-link">0</span>
            </li>

            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
      @else
        <!-- Tombol "Previous" -->
        @if ($pemilihans->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a href="{{ $pemilihans->previousPageUrl() }}" class="page-link">Previous</a>
            </li>
        @endif

        <!-- Tautan Paginasi -->
        @foreach ($pemilihans->getUrlRange(1, $pemilihans->lastPage()) as $page => $url)
            @if ($page == $pemilihans->currentPage())
                <li class="page-item active">
                    <span class="page-link">{{ $page }}</span>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                </li>
            @endif
        @endforeach

        <!-- Tombol "Next" -->
        @if ($pemilihans->hasMorePages())
            <li class="page-item">
                <a href="{{ $pemilihans->nextPageUrl() }}" class="page-link">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        @endif
     @endif
    </ul>
</div>



@endsection