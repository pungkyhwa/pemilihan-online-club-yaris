@extends('layouts/contentNavbarLayout')
@section('title', 'capresma') 
@section('content')
<h2 class="fw-bold py-3 ">
  Daftar capresma
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
    <h5 class="card-header col-6">Daftar capresma</h5>
    <div class="col-6 d-flex justify-content-end">
       <a href="{{ route('capresma.create') }}" class="btn btn-primary ">Tambah</a>
    </div>
  </div>
  <div class="table-responsive text-nowrap ">
    <table id="table-body" class="table ">
      <thead class="bg-primary bg-opacity-50">
        <tr>
          <th class="text-white">No</th>
          <th class="text-white">Ketua</th>
          <th class="text-white">Wakil</th>
          <th class="text-white">Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      @if(count($capresmas) === 0)
        <tr>
            <td colspan="11">Belum ada capresma yang dibuat.</td>
        </tr>
    @else
      @foreach($capresmas as $capresma)
            <tr>
                <td>{{ ++$i}}</td>
                <td>{{ $capresma->nm_capresma }}</td>
                <td>{{ $capresma->wakil }}</td>
                <td>
                <form action="{{ route('capresma.destroy', ['capresma' => encrypt($capresma->id)]) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('capresma.show', ['capresma' => encrypt($capresma->id)]) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('capresma.edit', ['capresma' => encrypt($capresma->id)]) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
      @endforeach
      @endif
      </tbody>
    </table>
  </div>
</div>
<div class="text-center mt-2">
    <ul class="pagination">
      @if($capresmas->isEmpty())
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
        @if ($capresmas->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a href="{{ $capresmas->previousPageUrl() }}" class="page-link">Previous</a>
            </li>
        @endif

        <!-- Tautan Paginasi -->
        @foreach ($capresmas->getUrlRange(1, $capresmas->lastPage()) as $page => $url)
            @if ($page == $capresmas->currentPage())
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
        @if ($capresmas->hasMorePages())
            <li class="page-item">
                <a href="{{ $capresmas->nextPageUrl() }}" class="page-link">Next</a>
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