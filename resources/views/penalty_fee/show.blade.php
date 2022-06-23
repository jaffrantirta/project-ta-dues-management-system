@extends('layouts.admin')
@section('content')
<section class="section profile">
  <div class="row">
    <div class="col-xl-12">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button>
            </li>

            {{-- <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
            </li> --}}

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">Detail Acara</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Nama Acara</div>
                <div class="col-lg-9 col-md-8">{{ $event->name }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Tanggak dan waktu</div>
                <div class="col-lg-9 col-md-8">{{ $event->event_date }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Deskripsi</div>
                <div class="col-lg-9 col-md-8">{{ $event->description }}</div>
              </div>

            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <form class="row g-3" method="POST" action="{{ route('events.update', ['event'=>$event->id]) }}">
                @method('put')
                {{ csrf_field() }}
                <div class="col-md-12">
                  <div class="form-floating">
                    <input name="name" value="{{ $event->name }}" type="text" class="form-control @error('name') is-invalid @enderror" id="floatingName" placeholder="Nama Acara (Contoh:Rapat Bulan April)">
                    <label for="floatingName">Nama Acara</label>
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
                <div class="col-md-12">
                  <div class="form-floating">
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="floatingDesk" placeholder="Deskripsi" style="height: 100px;">{{ $event->description }}</textarea>
                    <label for="floatingDesk">Deskripsi</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form>

                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="password" type="password" class="form-control" id="currentPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
              </form><!-- End Change Password Form -->

            </div>

          </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>
</section>
@endsection