 <!-- Sidebar Start -->
 <aside class="left-sidebar">
     <!-- Sidebar scroll-->
     <div>
         <div class="brand-logo d-flex align-items-center justify-content-between">
             <a href="./index.html" class="text-nowrap logo-img">
                 <img src="{{ asset('assets/images/logos/long-logo.png') }}" width="180" alt="" />
             </a>
             <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                 <i class="ti ti-x fs-8"></i>
             </div>
         </div>
         <!-- Sidebar navigation-->
         <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
             <ul id="sidebarnav">
                 <li class="nav-small-cap">
                     <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                     <span class="hide-menu">Home</span>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link {{ Request::is('/') ? 'active' : '' }}" href="/"
                         aria-expanded="false">
                         <span>
                             <i class="ti ti-layout-dashboard"></i>
                         </span>
                         <span class="hide-menu">Beranda</span>
                     </a>
                 </li>
                 <li class="nav-small-cap">
                     <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                     <span class="hide-menu">Data Audit Mutu Internal</span>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link {{ Request::is('unit_kerja*') ? 'active' : '' }}" href="/unit_kerja" aria-expanded="false">
                         <span>
                             <i class="ti ti-article"></i>
                         </span>
                         <span class="hide-menu">Daftar Unit Kerja</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link {{ Request::is('indikator_unit_kerja*') ? 'active' : '' }}"  href="/indikator_unit_kerja" aria-expanded="false">
                         <span>
                             <i class="ti ti-table"></i>
                         </span>
                         <span class="hide-menu">Indikator Kinerja Unit Kerja</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link {{ Request::is('jadwal_ami*') ? 'active' : '' }}"  href="/jadwal_ami" aria-expanded="false">
                         <span>
                             <i class="ti ti-calendar-event"></i>
                         </span>
                         <span class="hide-menu">Jadwal Pengisian AMI</span>
                     </a>
                 </li>

                 <li class="nav-small-cap">
                     <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                     <span class="hide-menu">AUTH</span>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link {{ Request::is('daftar_user*') ? 'active' : '' }}" href="/daftar_user" aria-expanded="false">
                         <span>
                             <i class="ti ti-users-group"></i>
                         </span>
                         <span class="hide-menu">Daftar User</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link {{ Request::is('/profile*') ? 'active' : '' }}" href="/profile" aria-expanded="false">
                         <span>
                             <i class="ti ti-user"></i>
                         </span>
                         <span class="hide-menu">Profile</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <a class="sidebar-link {{ Request::is('logout*') ? 'active' : '' }}" href="/login" aria-expanded="false">
                         <span>
                             <i class="ti ti-logout"></i>
                         </span>
                         <span class="hide-menu">Logout</span>
                     </a>
                 </li>
    
             </ul>

         </nav>
         <!-- End Sidebar navigation -->
     </div>
     <!-- End Sidebar scroll-->
 </aside>
 <!--  Sidebar End -->
