@extends('layouts.landing')
@section('content')
        <!-- Mashead header-->
        <header class="masthead">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-12">
                        <div class="mb-5 mb-lg-0 text-center text-lg-start">
                            <h1 class="display-1 lh-1 mb-3">Anggota Aktif {{ env('APP_NAME') }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <section class="bg-white" id="download">
            <div class="container px-5">
                <div class="col-lg-12">

                    <div class="card table-responsive">
                      <div class="card-body">
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Bergabung</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($users as $key => $user)
                              <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->join }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
              
                      </div>
                    </div>
              
                  </div>
            </div>
        </section>
@endsection