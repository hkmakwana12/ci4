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
                    <form role="form" action="<?= route_to('admin.stores.create') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-header">
                            <h3 class="card-title">Add Stores</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="store_name">Store Name</label>
                                    <input type="text" name="store_name" class="form-control <?= ($validation->getError('store_name')) ? 'is-invalid' : ''; ?>" value="<?= set_value('store_name') ?>" id="store_name">
                                    <?php if ($validation->getError('store_name')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('store_name') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= route_to('admin.stores') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>