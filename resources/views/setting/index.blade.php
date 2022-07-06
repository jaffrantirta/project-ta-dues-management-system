@extends('layouts.admin')
@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <form action="{{ route('general.store') }}" method="POST">
        @csrf
        <label>Judul 1</label>
        <input type="text" name="title1" class="form-control mb-4" value="{{ $title1 }}">

        <label>Sub-Judul 1</label>
        <input type="text" name="subtitle1" class="form-control mb-4" value="{{ $subtitle1 }}">

        <label>Kutipan</label>
        <input type="text" name="quotes" class="form-control mb-4" value="{{ $quotes }}">

        <label>Judul 2</label>
        <input type="text" name="title2" class="form-control mb-4" value="{{ $title2 }}">

        <label>Sub-Judul 2</label>
        <input type="text" name="subtitle2" class="form-control mb-4" value="{{ $subtitle2 }}">

        <input type="submit" value="Simpan" class="btn btn-primary">
      </form>

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