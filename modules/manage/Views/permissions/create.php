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
                    <form role="form" action="<?= route_to('admin.permissions.create') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-header">
                            <h3 class="card-title">Add Permissions</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="permission_name">Name</label>
                                    <input type="text" name="permission_name" class="form-control <?= ($validation->getError('permission_name')) ? 'is-invalid' : ''; ?>" value="<?= set_value('permission_name') ?>" id="permission_name">
                                    <?php if ($validation->getError('permission_name')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('permission_name') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="permission_display_name">Display Name</label>
                                    <input type="text" class="form-control <?= ($validation->getError('permission_display_name')) ? 'is-invalid' : ''; ?>" name="permission_display_name" value="<?= set_value('permission_display_name') ?>" id="permission_display_name">
                                    <?php if ($validation->getError('permission_display_name')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('permission_display_name') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="permission_description">Description</label>
                                    <textarea name="permission_description" id="permission_description" class="form-control <?= ($validation->getError('permission_description')) ? 'is-invalid' : ''; ?>"><?= set_value('permission_description') ?></textarea>
                                    <?php if ($validation->getError('permission_description')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('permission_description') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= route_to('admin.permissions') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>