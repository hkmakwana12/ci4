<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

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
                    <form role="form" action="<?= route_to('admin.roles.edit', $role->id) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-header">
                            <h3 class="card-title">Edit Roles</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="role_name">Name</label>
                                    <input type="text" name="role_name" class="form-control <?= ($validation->getError('role_name')) ? 'is-invalid' : ''; ?>" value="<?= set_value('role_name', $role->role_name) ?>" id="role_name">
                                    <?php if ($validation->getError('role_name')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('role_name') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="role_display_name">Display Name</label>
                                    <input type="text" class="form-control <?= ($validation->getError('role_display_name')) ? 'is-invalid' : ''; ?>" name="role_display_name" value="<?= set_value('role_display_name', $role->role_display_name) ?>" id="role_display_name">
                                    <?php if ($validation->getError('role_display_name')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('role_display_name') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="role_description">Description</label>
                                    <textarea name="role_description" id="role_description" class="form-control <?= ($validation->getError('role_description')) ? 'is-invalid' : ''; ?>"><?= set_value('role_description', $role->role_description) ?></textarea>
                                    <?php if ($validation->getError('role_description')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('role_description') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <?php foreach ($permissions as $row) : ?>
                                        <div class="icheck-primary d-inline col-3">
                                            <input type="checkbox" name="permissions[]" id="<?= $row->permission_name; ?>" value="<?= $row->id; ?>" <?php echo ((in_array($row->id, $role_permissions))) ? 'checked' : set_checkbox('permissions[]', $row->id); ?> />
                                            <label for="<?= $row->permission_name; ?>">
                                                <?= $row->permission_display_name; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?= route_to('admin.roles') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>