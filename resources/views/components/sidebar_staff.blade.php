<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme position-relative staff">
  <div class="app-brand demo">
    <a href="{{ route('staff.dashboard') }}" class="app-brand-link">
        <img src="/assets/img/favicon/fixLogo.png" class="w-25" alt="">
        <span class="app-brand-text demo menu-text fw-bolder ms-2">LMS</span>
    </a>
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
          <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
      <li class="menu-item{{ $active == "dashboard" ? " active" : '' }}">
          <a href="/staff/dashboard" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
          </a>
      </li>
      <li class="menu-item{{ $active == "guestbook" ? " active" : '' }}">
          <a href="{{ route('staff.guestbook.table') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-list-ol"></i>
              <div data-i18n="Analytics">Kunjungan</div>
          </a>
      </li>
      <li class="menu-item{{ $active == "loans" ? " active" : '' }}">
          <a href="{{ route('staff.loans.table') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-list-ul"></i>
              <div data-i18n="Analytics">Daftar Peminjaman</div>
          </a>
      </li>
      <li class="menu-item{{ $active == "categories" || $active == "inventories_list" ? " active" : '' }}">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-book-content"></i>
              <div data-i18n="Layouts">Inventory</div>
          </a>

          <ul class="menu-sub">
              <li class="menu-item{{ $active == "inventories_list" ? " active" : '' }}">
                  <a href="{{ route('staff.inventories.table') }}" class="menu-link">
                      <div data-i18n="Without menu">Tabel Inventory</div>
                  </a>
              </li>
              <li class="menu-item{{ $active == "categories" ? " active" : '' }}">
                  <a href="{{ route("staff.categories.table") }}" class="menu-link">
                      <div data-i18n="Without menu">Kategori</div>
                  </a>
              </li>
          </ul>
      </li>
      <li class="menu-item{{ $active == "info" ? " active" : '' }}">
        <a href="{{ route('staff.info.table') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-news"></i>
            <div data-i18n="Analytics">Info Lab</div>
        </a>
    </li>
    <li class="menu-item{{ $active == "users" ? " active" : '' }}">
        <a href="{{ route('staff.guests.table') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user-pin"></i>
            <div data-i18n="Analytics">Users</div>
        </a>
    </li>
    <li class="menu-item{{ $active == "feedback" ? " active" : '' }}">
        <a href="{{ route('staff.feedback.table') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-info-circle"></i>
            <div data-i18n="Analytics">Feedback</div>
        </a>
    </li>
  </ul>
</aside>
