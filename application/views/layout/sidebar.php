<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('/'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-clipboard-list"></i>
        </div>
        <div class="sidebar-brand-text mx-3">W2O <sup>Projeto</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Cadastrar
      </div>

      <li class="nav-item">
        <a title="Gerenciar Dados do Usuários" class="nav-link" href="<?php echo base_url('empresas'); ?>">
          <i class="fas fa-users-cog"></i>
          <span>Empresa</span></a>
      </li>

      <li class="nav-item">
        <a title="Gerenciar Dados do Sistema" class="nav-link" href="<?php echo base_url('colaboradores'); ?>">
          <i class="fas fa-cogs"></i>
          <span>Colaboradores</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">