<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= route_to('admin.dash') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= route_to('admin.users') ?>">Users</a></li>
                    <li class="breadcrumb-item active">Add Users</li>
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
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form user="form" action="<?= route_to('admin.users.create') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-header">
                            <h3 class="card-title">Add Users</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="user_firstname">First Name</label>
                                    <input type="text" name="user_firstname" class="form-control <?= ($validation->getError('user_firstname')) ? 'is-invalid' : ''; ?>" value="<?= set_value('user_firstname'); ?>" id="name" placeholder="Enter First Name">
                                    <?php if ($validation->getError('user_firstname')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('user_firstname'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="user_lastname">Last Name</label>
                                    <input type="text" name="user_lastname" class="form-control <?= ($validation->getError('user_lastname')) ? 'is-invalid' : ''; ?>" value="<?= set_value('user_lastname'); ?>" id="name" placeholder="Enter Last Name">
                                    <?php if ($validation->getError('user_lastname')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('user_lastname'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="user_email">Email address</label>
                                    <input type="email" class="form-control <?= ($validation->getError('user_email')) ? 'is-invalid' : ''; ?>" name="user_email" value="<?= set_value('user_email'); ?>" id="user_email" placeholder="Enter Email address">
                                    <?php if ($validation->getError('user_email')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('user_email'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="user_phone">Phone No.</label>
                                    <input type="text" name="user_phone" class="form-control <?= ($validation->getError('user_phone')) ? 'is-invalid' : ''; ?>" value="<?= set_value('user_phone'); ?>" id="name" placeholder="Enter Phone No.">
                                    <?php if ($validation->getError('user_phone')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('user_phone'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" autocomplete="password" class="form-control <?= ($validation->getError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder=" Enter Password">
                                    <?php if ($validation->getError('password')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('password'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" autocomplete="confirm_password" class="form-control" name="confirm_password" id="confirm_password" placeholder=" Confirm Password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <?php foreach ($roles as $row) : ?>
                                        <div class="icheck-primary d-inline col-3">
                                            <input type="checkbox" name="roles[]" id="<?= $row->role_name; ?>" value="<?= $row->id; ?>" <?php echo set_checkbox('roles[]', $row->id); ?> />
                                            <label for="<?= $row->role_name; ?>">
                                                <?= $row->role_display_name; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php if ($validation->getError('roles')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('roles'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= route_to('admin.users') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>