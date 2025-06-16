<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ $page_name == 'dashboard' ? '' : 'collapsed'}}" href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $page_name == 'repository' ? '' : 'collapsed'}}" href="/backoffice/repository">
          <i class="bi bi-door-open"></i>
          <span>Data Ruangan</span>
        </a>
      </li><!-- End Repository Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $page_name == 'item' ? '' : 'collapsed'}}" data-bs-target="#data-item-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-box-seam"></i><span>Data Barang</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="data-item-nav" class="nav-content collapse {{ $page_name == 'item' ? 'show' : ''}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="/backoffice/category-item" class="{{ $sub_page_name == 'category' ? 'active' : ''}}">
              <i class="bi bi-circle"></i><span>Kategori</span>
            </a>
          </li>
          <li>
            <a href="/backoffice/item" class="{{ $sub_page_name == 'used' ? 'active' : ''}}">
              <i class="bi bi-circle"></i><span>Terpakai</span>
            </a>
          </li>
          <li>
            <a href="/backoffice/not-used-item" class="{{ $sub_page_name == 'not_used' ? 'active' : ''}}">
              <i class="bi bi-circle"></i><span>Tak Terpakai</span>
            </a>
          </li>
        </ul>
      </li><!-- End Item Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Data User</span>
        </a>
      </li><!-- End User Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->