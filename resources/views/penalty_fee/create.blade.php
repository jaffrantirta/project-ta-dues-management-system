@extends('layouts.admin')
@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Buat acara</h5>

          <!-- Floating Labels Form -->
          <form class="row g-3" method="POST" action="{{ route('events.store') }}">
            {{ csrf_field() }}
            <div class="col-md-12">
              <div class="form-floating">
                <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" id="floatingName" placeholder="Nama Acara (Contoh:Rapat Bulan April)">
                <label for="floatingName">Nama Acara</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="floatingDesk" placeholder="Deskripsi" style="height: 100px;"></textarea>
                <label for="floatingDesk">Deskripsi</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-12">
                <div class="form-floating">
                  <input name="date_time" type="datetime-local" class="form-control @error('date_time') is-invalid @enderror" id="floatingDate" placeholder="Tanggal Acara">
                  <label for="floatingDate">Tanggal Acara</label>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- End floating Labels Form -->

        </div>
      </div>

    </div>
  </div>
</section>
@endsection