@extends('layouts.admin')
@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <form action="{{ route('general.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="is_pict" value="1">
        <label>Gambar 1</label>
        <img src="{{ asset($picture1) }}" class="img-fluid p-5" alt="">
        <input type="file" name="picture1" class="form-control mb-4">

        <label>Gambar 2</label>
        <img src="{{ asset($picture2) }}" class="img-fluid p-5" alt="">
        <input type="file" name="picture2" class="form-control mb-4">

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