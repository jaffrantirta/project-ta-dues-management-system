@extends('layouts.admin')
@section('content')
<a href="{{ route('events.create') }}" class="btn btn-primary my-3"><i class="fa fa-plus"></i> Tambah {{ $title }}</a>
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
                <th scope="col">Tanggal Acara</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($events as $key => $event)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $event->name }}</td>
                  <td>{{ $event->event_date }}</td>
                  <td>
                    <a href="{{ route('events.show', ['event'=>$event->id]) }}" class="btn btn-warning btn-"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('events.users.index', ['event'=>$event->id]) }}" class="btn btn-primary btn-"><i class="fa fa-users"></i></a>
                    <a href="{{ route('events.penalties.index', ['event'=>$event->id]) }}" class="btn btn-success btn-"><i class="fa fa-money-bill"></i></a>
                    <a href="#" onclick="unactive('{{ $event->name }}', '{{ $event->id }}')" class="btn btn-danger btn-"><i class="fa fa-circle-xmark"></i></a>
                    <form id="unactive-form-{{ $event->id }}" action="{{ route('events.destroy', ['event'=>$event->id]) }}" method="POST" class="d-none">
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
    var vId = id;
      Swal.fire({
          title: 'Yakin non-aktifkan '+name+' ?',
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