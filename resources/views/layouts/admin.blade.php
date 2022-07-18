<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title ?? '' }} - {{ env('APP_NAME') }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('storage/logo/logo.png') }}" rel="icon">
  <link href="{{ asset('storage/logo/logo.png') }}" rel="apple-touch-icon">
  <link rel = "icon" href="{{ asset('storage/logo/logo.png') }}" type = "image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/admin') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('assets/admin') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('assets/admin') }}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('assets/admin') }}/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{ asset('assets/admin') }}/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{ asset('assets/admin') }}/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('assets/admin') }}/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/admin') }}/css/style.css" rel="stylesheet">

  {{-- sweet alert 2 --}}
  <script src="{{ asset('assets/admin') }}/js/sweetalert.js"></script>
</head>

<body>
  @include('layouts.master.header')
  @include('layouts.master.sidebar')
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>{{ $title ?? '' }}</h1>
    </div><!-- End Page Title -->

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show rounded-5" role="alert">
                    <strong>{{ $error }}</strong>
                </div>
                @endforeach
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-5" role="alert">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
      @yield('content')
    </main><!-- End #main -->
  @include('layouts.master.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/admin') }}/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{ asset('assets/admin') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/admin') }}/vendor/chart.js/chart.min.js"></script>
  <script src="{{ asset('assets/admin') }}/vendor/echarts/echarts.min.js"></script>
  <script src="{{ asset('assets/admin') }}/vendor/quill/quill.min.js"></script>
  <script src="{{ asset('assets/admin') }}/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{ asset('assets/admin') }}/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{ asset('assets/admin') }}/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/admin') }}/js/main.js"></script>

</body>

</html>