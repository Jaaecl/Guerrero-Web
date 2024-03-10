<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <a href="/market/admin/home.php">
            <img src="/market/assets/img/logo.png" alt="Supermercado El Bosque" class="brand-image" width="90px">
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/market/admin/home.php" style="cursor: pointer;" class="nav-link">
              <i class="nav-icon fa-solid fa-house"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/market/admin/vista/pedidos.php" style="cursor: pointer;" class="nav-link">
              <i class="nav-icon fa-solid fa-receipt"></i>
              <p>
                Pedidos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-bag-shopping"></i>
              <p>
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/market/admin/vista/inventario.php" style="cursor: pointer;" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inventario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/market/admin/vista/proveedores.php" style="cursor: pointer;" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proveedores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/market/admin/vista/categorias.php" style="cursor: pointer;" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorías</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/market/admin/home.php#ventas" style="cursor: pointer;" class="nav-link">
              <i class="nav-icon fa-solid fa-square-poll-vertical"></i>
              <p>
                Ventas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/market/admin/vista/usuarios.php" style="cursor: pointer;" class="nav-link">
              <i class="nav-icon fa-solid fa-users"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/market/admin/vista/historial.php" style="cursor: pointer;" class="nav-link">
              <i class="nav-icon fa-regular fa-calendar"></i>
              <p>
                Historial
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>