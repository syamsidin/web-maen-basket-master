<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ $page_name == 'dashboard' ? '' : 'collapsed'}}" href="/backoffice/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $page_name == 'item' ? '' : 'collapsed'}}" href="/backoffice/item">
          <i class="bi bi-box-seam"></i>
          <span>Data Barang</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ $page_name == 'repository' ? '' : 'collapsed'}}" data-bs-target="#repository-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-door-open"></i><span>Data Ruangan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="repository-nav" class="nav-content collapse {{ $page_name == 'repository' ? 'show' : ''}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="/backoffice/building" class="{{ $sub_page_name == 'building' ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Gedung</span>
            </a>
          </li>
          <li>
            <a href="/backoffice/floor" class="{{ $sub_page_name == 'floor' ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Lantai</span>
            </a>
          </li>
          <li>
            <a href="/backoffice/repository" class="{{ $sub_page_name == 'repository' ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Ruangan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Repository Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="/backoffice/document">
          <i class="bi bi-file-text"></i>
          <span>Data Dokumen Standarisasi</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ $page_name == 'import' ? '' : 'collapsed'}}" data-bs-target="#import-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-spreadsheet"></i><span>Import Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="import-nav" class="nav-content collapse {{ $page_name == 'import' ? 'show' : ''}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="/backoffice/import/category-item" class="{{ $sub_page_name == 'item_category' ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Import Kategori</span>
            </a>
          </li>
          <li>
            <a href="/backoffice/import/item" class="{{ $sub_page_name == 'item' ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Import Barang</span>
            </a>
          </li>
          <li>
            <a href="/backoffice/import/repository" class="{{ $sub_page_name == 'repository' ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Import Ruangan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Import Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Data User</span>
        </a>
      </li>
    </ul>

  </aside><!-- End Sidebar-->