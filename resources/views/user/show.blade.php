@extends('layouts.admin')
@section('content')
<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

          <img src="{{ asset($user->profile_picture) }}" alt="Profile" class="rounded-circle">
          <h2>{{ $user->name }}</h2>
          <strong>Bergabung {{ $user->join }}</strong>
          <h3>
            @foreach ($user->roles as $item)
                {{ $item->name }}
            @endforeach
          </h3>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

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
              <h5 class="card-title">Detail Profil</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Nama</div>
                <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Jenis Kelamin</div>
                <div class="col-lg-9 col-md-8">{{ $user->gender }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Nomor Telepon</div>
                <div class="col-lg-9 col-md-8">{{ $user->phone }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Tanggal lahir</div>
                <div class="col-lg-9 col-md-8">{{ $user->birth }}</div>
              </div>

            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
              <form action="{{ route('users.update', ['user'=>$user->id]) }}" method="POST">
                @method('put')
                {{ csrf_field() }}
                <div class="row mb-3">
                  <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="name" type="text" class="form-control" id="name" value="{{ $user->name }}">
                  </div>
                </div>

                <fieldset class="row mb-3">
                  <label for="name" class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="sex" id="gridRadios1" value="male" @if ($user->sex == 'male') checked @endif>
                      <label class="form-check-label" for="gridRadios1">
                        Laki - Laki
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="sex" id="gridRadios2" value="female" @if ($user->sex == 'female') checked @endif>
                      <label class="form-check-label" for="gridRadios2">
                        Perempuan
                      </label>
                    </div>
                  </div>
                </fieldset>

                <div class="row mb-3">
                  <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="phone" class="col-md-4 col-lg-3 col-form-label">Nomor Telepon</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="phone" type="number" class="form-control" id="phone" value="{{ $user->phone }}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="date_of_birth" class="col-md-4 col-lg-3 col-form-label">Tanggal Lahir</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="date_of_birth" type="date" class="form-control" id="date_of_birth">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </div>
              </form><!-- End Profile Edit Form -->

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