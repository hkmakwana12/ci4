<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<style>
    .pagination li a {
        position: relative;
        display: block;
        padding: .5rem .75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    .pagination li.active a {
        z-index: 1;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
</style>
<form role="form" id="deleteForm" action="<?= route_to('admin.permissions.delete', 0); ?>" method="post">
    <?= csrf_field(); ?>
</form>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard v3</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v3</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $heading; ?></h3>
                        <div class="card-tool">
                            <a class="btn btn-primary mb-2 float-right" href="<?= route_to('admin.permissions.create'); ?>"><span class="fas fa-plus">&nbsp;</span>Add</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="input-group input-group-sm mb-3" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <?php

                            if ($user_data) {
                                foreach ($user_data as $user) {
                                    echo '
                                <tr>
                                    <td>' . $user->id . '</td>
                                    <td>' . $user->name . '</td>
                                    <td>' . $user->email . '</td>
                                    <td>' . $user->gender . '</td>
                                    <td></td>
                                    <td></td>
                                </tr>';
                                }
                            }

                            ?>
                        </table>
                    </div>
                    <?php

                    if ($pagination_link) {
                        $pagination_link->setPath('admin/permissions');

                        echo $pagination_link->links();
                    }

                    ?>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?= $this->endSection(); ?>