@extends('layouts.admin')
@section('content')

{{-- <a href="{{ route('events.create') }}" class="btn btn-primary my-3"><i class="fa fa-plus"></i> Tambah {{ $title }}</a> --}}
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card table-responsive">
        <div class="card-body p-3">
          <form action="{{ route('settings.penalty.fee.store') }}" method="POST">
            @csrf
            <input class="form-control" name="penalty_fee" placeholder="Masukan biaya benda" value="{{ $penalty_fee }}" /> 
            <input class="btn btn-primary mt-2" type="submit" value="Simpan"/>
          </form>
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