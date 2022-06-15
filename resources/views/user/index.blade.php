@extends('layouts.admin')
@section('content')
<a href="{{ route('users.create') }}" class="btn btn-primary my-3"><i class="fa fa-plus"></i> Tambah {{ $title }}</a>
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card table-responsive">
        <div class="card-body">
          <h5 class="card-title">List {{ $title }}</h5>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Bergabung</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $key => $user)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->phone }}</td>
                  <td>{{ $user->birth }}</td>
                  <td>{{ $user->join }}</td>
                  <td>
                    <a href="{{ route('users.show', ['user'=>$user->id]) }}" class="btn btn-warning btn-"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="unactive()" class="btn btn-danger btn-"><i class="fa fa-circle-xmark"></i></a>
                    <form id="unactive-form" action="{{ route('users.destroy', ['user'=>$user->id]) }}" method="POST" class="d-none">
                      @method('delete')
                      @csrf
                    </form>
                  </td>
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
<script>
  function unactive(){
      Swal.fire({
          title: 'Yakin non-aktifkan ?',
          showCancelButton: true,
          confirmButtonColor: 'red',
          confirmButtonText: 'Ya',
          dangerMode: true,
      }).then( function(result){
          if(result.isConfirmed){
              event.preventDefault();document.getElementById('unactive-form').submit();
          }
      })
  }
</script>
@endsection