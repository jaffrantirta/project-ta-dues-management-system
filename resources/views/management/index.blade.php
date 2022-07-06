@extends('layouts.admin')
@section('content')
<a href="{{ route('managements.create') }}" class="btn btn-primary my-3"><i class="fa fa-plus"></i> Tambah {{ $title }}</a>
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
                <th scope="col">Jabatan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $key => $user)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $user->name }}</td>
                  <td>
                    @foreach ($user->roles as $role)
                        <strong>{{ $role->name }}</strong>
                    @endforeach
                  </td>
                  <td>
                    <a href="#" onclick="unactive('{{ $user->name }}', '{{ $user->id }}')" class="btn btn-danger"><i class="fa fa-trash-can"></i></a>
                    <form id="unactive-form-{{ $user->id }}" action="{{ route('managements.destroy', ['management'=>$user->id]) }}" method="POST" class="d-none">
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
  function unactive(name, id){
    var vId = id
      Swal.fire({
          title: 'Yakin turunkan '+name+' menjadi anggota ?',
          showCancelButton: true,
          confirmButtonColor: 'red',
          confirmButtonText: 'Ya',
          dangerMode: true,
      }).then( function(result){
          if(result.isConfirmed){
              event.preventDefault();document.getElementById('unactive-form-'+vId).submit();
          }
      })
  }
</script>
@endsection