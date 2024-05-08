 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">
         <!-- End Dashboard Nav -->

         <li class="nav-heading">Pages</li>

         <li class="nav-item">
             <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="/">
                 <i class="bi bi-grid"></i>
                 <span>Beranda</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link {{ Request::is('data_audit*') ? '' : 'collapsed' }}" data-bs-target="#components-nav"
                 data-bs-toggle="collapse" href="#">
                 <i class="bi bi-menu-button-wide"></i><span>Data Audit</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="components-nav" class="nav-content" data-bs-parent="#sidebar-nav">
                 <a href="/data_audit/unit_kerja" class="{{ Request::is('data_audit/unit_kerja*') ? 'active' : '' }}">
                     <i class="bi bi-circle"></i><span>Unit Kerja</span>
                 </a>
         </li>
         <li>
             <a href="/data_audit/indikator_unit_kerja"
                 class="{{ Request::is('data_audit/indikator_unit_kerja*') ? 'active' : '' }}">
                 <i class="bi bi-circle"></i><span>Indikator Unit Kerja</span>
             </a>
         </li>
         <li>
             <a href="/data_audit/data_user_pengguna"
                 class="{{ Request::is('data_audit/data_user_pengguna*') ? 'active' : '' }}">
                 <i class="bi bi-circle"></i><span>Data User</span>
             </a>
         </li>
     </ul>
     </li>

     <li class="nav-item">
         <a class="nav-link {{ $title == 'Jadwal Pengisian' ? '' : 'collapsed' }}" href="\jadwal">
             <i class="bi bi-book"></i>
             <span>Buat Jadwal</span>
         </a>
     </li>
     <li class="nav-item">
         <a class="nav-link {{ Request::is('user_profile/profile') ? '' : 'collapsed' }}" href="/user_profile/profile">
             <i class="bi bi-person"></i>
             <span>Profile</span>
         </a>
     </li>

     <li class="nav-item">
         <a class="nav-link collapsed" href="/auth/login">
             <i class="bi bi bi-box-arrow-in-right"></i>
             <span>Keluar</span>
         </a>
     </li><!-- End F.A.Q Page Nav -->

     <!-- End Contact Page Nav -->


     </ul>

 </aside><!-- End Sidebar-->
