@extends('layouts/contentNavbarLayout')

@section('title', ' Tambah Jenis Tagihan')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Tambah Jenis Tagihan</h4>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
  <div class="col-xl-6">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tagihan</h5> <small class="text-muted float-end">Tambah Jenis Tagihan</small>
      </div>
      <div class="card-body">
        <form action="{{ route('capresma.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Nama Ketua</label>
            <input type="text" name="ketua" class="form-control" id="basic-default-fullname" placeholder="bulan+nomor e.g:JUL/009" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Nama Wakil</label>
            <input type="text" name="wakil" class="form-control" id="basic-default-fullname" placeholder="nim mahasiswa" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Visi</label>
            <textarea class="form-control" name="visi" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label  class="form-label" for="basic-default-fullname">Misi</label>
            <textarea class="form-control" name="misi" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label  class="form-label" for="basic-default-fullname">Fakultas</label>
            <select  class="form-control" name="fakultas">
              <option value="-">Pilih Fakultas</option>
              <option value="FTIK">FTIK</option>
              <option value="FT">FT</option>
              <option value="FEBI">FEBI</option>
              <option value="FIK">FIK</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label">Foto</label>
            <input class="form-control" name="photoUrl" type="file" id="formFile" accept="image/*">
          </div>
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
