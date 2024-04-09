    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../dashboard.php" class="brand-link">
        <img src="../assets/logo/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light font-weight-normal">E-Learning</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center justify-content-center">
          <div class="image">
            <img src="../public/image/<?php if (isset($_SESSION["image"])) echo $_SESSION["image"] ?>" class="elevation-2" alt="User Image">
          </div>
          <div class="info">
            <span class="d-block"> <?php if (isset($_SESSION["name"])) echo strtoupper($_SESSION["name"]) ?></span>
          </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="../dashboard.php" class="nav-link">
                <i class="nav-icon fa-solid fa-house"></i>
                <p>
                  Beranda
                </p>
              </a>
            </li>
            <li class="nav-header">MENU SISWA</li>
            <li class="nav-item">
              <a href="../dashboard/pages/forms/advanced.html" class="nav-link">
                <i class="nav-icon fa-solid fa-book"></i>
                <p>
                  Penugasan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/gallery.html" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Gallery
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/kanban.html" class="nav-link">
                <i class="nav-icon fas fa-columns"></i>
                <p>
                  Kanban Board
                </p>
              </a>
            </li>
            <li class="nav-header">LAIN-LAIN</li>
            <li class="nav-item">
              <a href="../profile" class="nav-link">
                <i class="nav-icon fa-solid fa-user"></i>
                <p>Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./auth/logout.php" class="nav-link">
                <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>