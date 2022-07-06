@extends('layouts.admin')
@section('content')
<strong>Total denda : Rp.{{ number_format($total_penalty) }}</strong><br>
<strong>Total anggota : {{ $total_members }} orang</strong><br>
<strong>Total denda belum terbayar : Rp.{{ number_format($total_penalty_not_paid) }}</strong><br>
<strong>Total anggota yang belum membayar : {{ $total_members_not_paid }} orang</strong><br>
{{-- <a href="{{ route('events.create') }}" class="btn btn-primary my-3"><i class="fa fa-plus"></i> Tambah {{ $title }}</a> --}}
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
                <th scope="col">Nama Anggota</th>
                <th scope="col">Nama Acara</th>
                <th scope="col">Tanggal Acara</th>
                <th scope="col">Denda</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($penalties as $key => $penalty)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $penalty->user->name }}</td>
                  <td>{{ $penalty->event->name }}</td>
                  <td>{{ $penalty->event->event_date }}</td>
                  <td>{{ $penalty->fee_text }}</td>
                  <td>
                    @if (!$penalty->is_paid)
                      <a onclick="paid('{{ $penalty->user->name }}', '{{ $penalty->id }}')" class="btn btn-primary"><i class="fa fa-check"></i> Tandai sudah bayar</a>
                      <form id="paid-form-{{ $penalty->id }}" action="{{ route('penalties.paid', ['userPenalty'=>$penalty->id]) }}" method="POST" class="d-none">
                        @csrf
                      </form>
                    @else
                      <strong style="color: green">LUNAS</strong>
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
  function paid(name, id){
    var vId = id;
      Swal.fire({
          title: name+' sudah membayar ?',
          showCancelButton: true,
          confirmButtonColor: 'red',
          confirmButtonText: 'Ya',
          dangerMode: true,
      }).then( function(result){
          if(result.isConfirmed){
              event.preventDefault();document.getElementById('paid-form-'+vId).submit();
          }
      })
  }
</script>
@endsection