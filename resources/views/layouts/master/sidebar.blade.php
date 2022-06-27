<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ (request()->is('home')) ? '' : 'collapsed' }}" href="{{ route('home') }}">
          <i class="fa fa-gauge"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{ (request()->is('managements*')) ? '' : 'collapsed' }}" href="{{ route('managements.index') }}">
          <i class="fa fa-gauge"></i>
          <span>Pengurus STT</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{ (request()->is('users*')) ? '' : 'collapsed' }}" href="{{ route('users.index') }}">
          <i class="fa fa-gauge"></i>
          <span>Anggota Aktif</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{ (request()->is('events*')) ? '' : 'collapsed' }}" data-bs-target="#event-nav" data-bs-toggle="collapse" href="#">
          <i class="fa fa-calendar-day"></i><span>Acara</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="event-nav" class="nav-content collapse {{ (request()->is('events*')) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('events.index') }}" class="{{ (request()->is('events*')) ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>List Acara</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link {{ (request()->is('settings*')) ? '' : 'collapsed' }}" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="fa fa-gears"></i><span>Pengaturan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse {{ (request()->is('settings*')) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('settings.penalty.fee') }}" class="{{ (request()->is('settings/penalty/fee*')) ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Biaya Denda</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="fa fa-file-excel"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="charts-chartjs.html">
              <i class="bi bi-circle"></i><span>Laporan Anggota Aktif</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>Laporan Denda</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>Arsip Anggota Tidak Aktif</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

    </ul>

  </aside><!-- End Sidebar-->