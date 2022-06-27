@extends('layouts.admin')
@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Pilih pengurus dan jabatan</h5>

          <!-- Floating Labels Form -->
          <form class="row g-3" method="POST" action="{{ route('managements.store') }}">
            {{ csrf_field() }}
            <label>Nama pengurus</label>
            <select name="user_id" class="form-control">
              <option>- pilih nama pengurus -</option>
              @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>

            <label>Jabatan</label>
            <select name="role" class="form-control">
              <option>- pilih jabatan -</option>
              <option value="Ketua">Ketua</option>
              <option value="Wakil Ketua">Wakil Ketua</option>
              <option value="Sekretaris">Sekretaris</option>
              <option value="Bendahara">Bendahara</option>
            </select>
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