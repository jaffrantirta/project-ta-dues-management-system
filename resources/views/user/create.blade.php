@extends('layouts.admin')
@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Isi data diri anggota</h5>

          <!-- Floating Labels Form -->
          <form class="row g-3" method="POST" action="{{ route('users.store') }}">
            {{ csrf_field() }}
            <div class="col-md-12">
              <div class="form-floating">
                <input name="id_number" value="{{ old('id_number') }}" type="number" class="form-control @error('id_number') is-invalid @enderror" id="floatingIDNumber" placeholder="Nomor KTP">
                <label for="floatingIDNumber">Nomor KTP</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" id="floatingName" placeholder="Nama Lengkap">
                <label for="floatingName">Nama Lengkap</label>
              </div>
            </div>
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sex" id="gridRadios1" value="male" checked>
                  <label class="form-check-label" for="gridRadios1">
                    Laki - Laki
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sex" id="gridRadios2" value="female">
                  <label class="form-check-label" for="gridRadios2">
                    Perempuan
                  </label>
                </div>
              </div>
            </fieldset>
            <div class="col-md-6">
              <div class="form-floating">
                <input name="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" id="floatingEmail" placeholder="Email">
                <label for="floatingEmail">Email</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input name="phone" value="{{ old('phone') }}" type="number" class="form-control @error('phone') is-invalid @enderror" id="floatingPhone" placeholder="Telepon">
                <label for="floatingPhone">Telepon</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-12">
                <div class="form-floating">
                  <input name="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="floatingDate" placeholder="Tanggal Lahir">
                  <label for="floatingDate">Tanggal Lahir</label>
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