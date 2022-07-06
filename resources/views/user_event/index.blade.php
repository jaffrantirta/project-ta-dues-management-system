@extends('layouts.admin')
@section('content')
@if ($event->is_done)
  <strong style="color: red">Acara sudah selesai</strong>
@else
  <a onclick="done('{{ $event->name }}', '{{ $event->id }}')" class="btn btn-warning my-3">Tutup acara ini dan cetak denda</a>
@endif
<form id="done-form" action="{{ route('events.done', ['event'=>$event->id]) }}" method="POST" class="d-none">
  @csrf
</form>
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card table-responsive">
        <div class="card-body">
          <h5 class="card-title">List {{ $title }} "{{ $event->name }}"</h5>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Status</th>
                <th scope="col">Hadir pada pukul</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $key => $user)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $user->name }}</td>
                  <td>
                    @if (count($user->user_event) == 0)
                      @if ($event->is_done)
                        <small style="color: red">Tidak hadir</small>  
                      @else
                        <small style="color: yellow">Belum hadir</small>
                      @endif
                    @else
                        <small style="color: green">Hadir</small>
                    @endif
                  </td>
                  <td>
                    @if (count($user->user_event) == 0)
                      @if ($event->is_done)
                        <small style="color: red">-</small>  
                      @else
                        <a onclick="attend('{{ $user->name }}', '{{ $user->id }}')" class="btn btn-primary btn-"><i class="fa fa-check"></i> Tandai hadir</a>
                        <form id="attend-form-{{ $user->id }}" action="{{ route('events.users.store', ['event'=>$event->id]) }}" method="POST" class="d-none">
                          @csrf
                          <input type="text" name="user_id" value="{{ $user->id }}">
                        </form>
                      @endif
                    @else
                        <small>{{ $user->user_event[0]->attend_time }}</small>
                    @endif
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
  function attend(name, id){
    var vId = id;
      Swal.fire({
          title: name+' hadir ?',
          showCancelButton: true,
          confirmButtonText: 'Ya',
          dangerMode: true,
      }).then( function(result){
          if(result.isConfirmed){
              event.preventDefault();document.getElementById('attend-form-'+vId).submit();
          }
      })
  }
  function done(name, id){
    var vId = id;
      Swal.fire({
          title: name+' sudah selesai ?',
          showCancelButton: true,
          confirmButtonText: 'Ya',
          dangerMode: true,
      }).then( function(result){
          if(result.isConfirmed){
              event.preventDefault();document.getElementById('done-form').submit();
          }
      })
  }
</script>
@endsection