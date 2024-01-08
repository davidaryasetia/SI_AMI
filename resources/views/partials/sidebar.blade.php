 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <!-- End Dashboard Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link {{($title == "Beranda") ? "" : "collapsed"}}" href="\">
          <i class="bi bi-grid"></i>
          <span>Beranda</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{($title == "Indikator Unit Kerja" || $title == "Data User" || $title == "Unit Kerja" || $title == "Tambah Unit Kerja") ? "" : "collapsed"}}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Data Audit</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content {{($title == "Beranda") ? "collapse" : ""}}" data-bs-parent="#sidebar-nav">
            <a href="\unit" class="{{($title == "Unit Kerja") ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Unit Kerja</span>
            </a>
          </li>
          <li>
            <a href="\indikator" class="{{($title == "Indikator Unit Kerja" || $title == "Tambah Unit Kerja") ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Indikator Unit Kerja</span>
            </a>
          </li>
          <li>
            <a href="\data_user" class="{{($title == "Data User") ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Data User</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link {{($title == "Jadwal Pengisian") ? "" : "collapsed"}}" href="\jadwal">
          <i class="bi bi-book"></i>
          <span>Buat Jadwal</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{($title == "Profile User") ? "" : "collapsed"}}" href="\profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="\login">
          <i class="bi bi bi-box-arrow-in-right"></i>
          <span>Keluar</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <!-- End Contact Page Nav -->


    </ul>

  </aside><!-- End Sidebar-->
