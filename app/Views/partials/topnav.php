 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown user-menu">
             <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                 <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
                 <span class="d-none d-md-inline"><?= session()->get('user_firstname') ?> <?= session()->get('user_lastname') ?></span>
             </a>
             <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <!-- User image -->
                 <li class="user-header bg-primary">
                     <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                     <p><?= session()->get('user_firstname') ?> <?= session()->get('user_lastname') ?></p>
                 </li>
                 <!-- Menu Footer-->
                 <li class="user-footer">
                     <a href="#" class="btn btn-default btn-flat">Profile</a>
                     <a href="<?= route_to('logout') ?>" class="btn btn-default btn-flat float-right">Sign out</a>
                 </li>
             </ul>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->