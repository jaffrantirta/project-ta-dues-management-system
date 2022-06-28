@extends('layouts.admin')
@section('content')
    <section class="section dashboard">
      <div class="row">

        {{-- acara yang akan datang --}}
        <div class="col-lg-8">
          <div class="row">

            <strong class="mb-2">Acara yang akan datang</strong>

            {{-- perulangan untuk menampilkan acara --}}
            @foreach ($events as $event)
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <div class="d-flex align-items-center mt-3">
                    {{-- <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div> --}}
                    <div class="ps-3">
                      <h6>{{ $event->name }}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ $event->event_date }}</span>

                    </div>
                  </div>
                </div>

                @if (!$event->is_passed)
                <a href="{{ route('events.users.index', ['event'=>$event->id]) }}" class="m-3 btn btn-primary">
                  Mulai acara
                </a>
                @endif
              </div>
            </div>
            @endforeach

            @if (count($events) > 0)
            <a href="{{ route('events.index') }}" class="col-xxl-4 col-md-6 mt-5">
              <div class="info-card sales-card">

                <div class="card-body">
                  <div class="d-flex align-items-center mt-3">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-arrow-right-circle"></i>
                    </div>
                    <div class="ps-3">
                      <h6>Lihat lainnya</h6>
                    </div>
                  </div>
                </div>

              </div>
            </a>

            @else

            <h3>Tidak ada acara dalam waktu dekat ini</h3>

            @endif

            
            <div class="col-12 row">

              <div class="col-xxl-6 col-md-6">
                <div class="card info-card sales-card">
  
                  <div class="card-header">
                    <strong>Anggota Aktif</strong>
                  </div>
                  <div class="card-body">
                    <div class="d-flex align-items-center mt-3">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fa fa-person-circle-check"></i>
                      </div>
                      <div class="ps-3">
                        <h6 class="text-success small pt-1 fw-bold">{{ $active_users }}</h6>

                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="col-xxl-6 col-md-6">
                <div class="card info-card sales-card">
  
                  <div class="card-header">
                    <strong>Anggota Tidak Aktif</strong>
                  </div>
                  <div class="card-body">
                    <div class="d-flex align-items-center mt-3">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fa fa-person-circle-xmark"></i>
                      </div>
                      <div class="ps-3">
                        <h6 class="text-success small pt-1 fw-bold">{{ $unactive_users }}</h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="col-xxl-12 col-md-6">
                <div class="card info-card sales-card">
  
                  <div class="card-header">
                    <strong>Total Denda Belum Lunas</strong>
                  </div>
                  <div class="card-body">
                    <div class="d-flex align-items-center mt-3">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fa fa-sack-dollar"></i>
                      </div>
                      <div class="ps-3">
                        <h6 class="text-success small pt-1 fw-bold">Rp{{ number_format($penalty) }}</h6>

                      </div>
                    </div>
                  </div>

                </div>
              </div>
              
            </div>

          </div>
        </div>

        
        <div class="col-lg-4">

          
          <div class="card">

            <div class="card-body pb-0">
              <h5 class="card-title">Jenis Kelamin Anggota <span>| Semua</span></h5>

              <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
              <p hidden id="gender"><?php echo json_encode($gender) ?></p>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    series: [{
                      name: 'Jenis Kelamin',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: JSON.parse(document.getElementById('gender').innerHTML)
                    }]
                  });
                });
              </script>

            </div>
          </div>

        </div>

      </div>
    </section>
@endsection