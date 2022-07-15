<?php $uri = service('uri'); ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= route_to('admin.dash') ?>" class="brand-link">
        <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= route_to('admin.dash') ?>" class="nav-link <?= !($uri->getSegment(2)) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= route_to('admin.employers') ?>" class="nav-link <?= ($uri->getSegment(2) == 'employers') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Employers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= route_to('admin.doctors') ?>" class="nav-link <?= ($uri->getSegment(2) == 'doctors') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>Doctors</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= route_to('admin.labadmins') ?>" class="nav-link <?= ($uri->getSegment(2) == 'labadmins') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-flask"></i>
                        <p>LabAdmins</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="<?= route_to('admin.stores') ?>" class="nav-link">
                        <i class="nav-icon fas fa-map-marker"></i>
                        <p>Stores</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= route_to('admin.tables') ?>" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Tables</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= route_to('admin.categories') ?>" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= route_to('admin.items') ?>" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Items</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="<?= route_to('admin.employees') ?>" class="nav-link <?= ($uri->getSegment(2) == 'employees') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Employees</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= route_to('admin.users') ?>" class="nav-link <?= ($uri->getSegment(2) == 'users') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= route_to('admin.roles') ?>" class="nav-link <?= ($uri->getSegment(2) == 'roles') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <?php //if (can('user-permission')) : 
                ?>
                <li class="nav-item">
                    <a href="<?= route_to('admin.permissions') ?>" class="nav-link <?= ($uri->getSegment(2) == 'permissions') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>Permissions</p>
                    </a>
                </li>
                <?php //endif; 
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>