<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item {{ request()->routeIs('users.create' ,  'users.edit') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.data-pegawai') }}">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Data Pegawai</span>
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('ajucutis.create' , 'ajucutis.edit') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('ajucutis.index') }}">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">Pengajuan Cuti</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('aprove.index') }}">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">Data Cuti</span>
            </a>
          </li>
          
        </ul>
      </nav>

      <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
      <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}" defer></script>