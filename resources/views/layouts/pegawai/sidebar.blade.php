<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item {{ request()->routeIs('ajucuti.create' , 'ajucuti.edit') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('ajucuti.index') }}">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">Pengajuan Cuti</span>
            </a>
          </li>
        </ul>
      </nav>

      <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
      <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}" defer></script>