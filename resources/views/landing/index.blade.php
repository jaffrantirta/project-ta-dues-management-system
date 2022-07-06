@extends('layouts.landing')
@section('content')
        <!-- Mashead header-->
        <header class="masthead">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="mb-5 mb-lg-0 text-center text-lg-start">
                            <h1 class="display-1 lh-1 mb-3">{{ $title1 }}</h1>
                            <p class="lead fw-normal text-muted mb-5">{{ $subtitle1 }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ $picture1 }}" class="img-fluid" />
                    </div>
                </div>
            </div>
        </header>
        <!-- Quote/testimonial aside-->
        <aside class="text-center bg-gradient-primary-to-secondary">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xl-8">
                        <div class="h2 fs-1 text-white mb-4">"{{ $quotes }}"</div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- App features section-->
        <section id="features">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-8 order-lg-1 mb-5 mb-lg-0">
                        <div class="container-fluid px-5">
                            <div class="row gx-5">
                                @if ($events->count() > 0)
                                    @foreach ($events as $event)
                                        <div class="col-md-6 mb-5">
                                            <!-- Feature item-->
                                            <div class="text-center">
                                                <i class="fa fa-calendar-check icon-feature text-gradient d-block mb-3"></i>
                                                <h3 class="font-alt">{{ $event->name }}</h3>
                                                <p class="text-muted mb-0">{{ $event->event_date }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>Tidak Ada Acara </p>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-lg-0">
                        <div class="px-5 px-sm-0"><img class="img-fluid" src="{{ asset('assets/landing') }}/assets/img/event.svg" /></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic features section-->
        <section class="bg-light">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                    <div class="col-12 col-lg-5">
                        <h2 class="display-4 lh-1 mb-4">{{ $title2 }}</h2>
                        <p class="lead fw-normal text-muted mb-5 mb-lg-0">{{ $subtitle2 }}</p>
                    </div>
                    <div class="col-sm-8 col-md-6">
                        <div class="px-5 px-sm-0"><img class="img-fluid rounded-circle" src="{{ $picture2 }}" /></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Call to action section-->
        {{-- <section class="cta">
            <div class="cta-content">
                <div class="container px-5">
                    <h2 class="text-white display-1 lh-1 mb-4">
                        
                    </h2>
                    <a class="btn btn-outline-light py-3 px-4 rounded-pill" href="https://startbootstrap.com/theme/new-age" target="_blank">Download for free</a>
                </div>
            </div>
        </section> --}}
        <!-- App badge section-->
        <section class="bg-gradient-primary-to-secondary" id="download">
            <div class="container px-5">
                <h2 class="text-center text-white font-alt mb-4">List Anggota Aktif</h2>
                <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center">
                    <a href="{{ route('landing.users.active') }}" class="btn btn-success">Lihat</a>
                </div>
            </div>
        </section>
@endsection