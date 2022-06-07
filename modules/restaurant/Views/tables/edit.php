<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Tables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= route_to('admin.dash') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= route_to('admin.tables') ?>">Tables</a></li>
                    <li class="breadcrumb-item active">Edit Tables</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

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
                    <form role="form" action="<?= route_to('admin.tables.edit', $table->id) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-header">
                            <h3 class="card-title">Edit Tables</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="table_number">Table Number</label>
                                    <input type="text" name="table_number" class="form-control <?= ($validation->getError('table_number')) ? 'is-invalid' : ''; ?>" value="<?= set_value('table_number', $table->table_number) ?>" id="table_number" placeholder="Enter Table Number">
                                    <?php if ($validation->getError('table_number')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('table_number') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="table_name">Table Name</label>
                                    <input type="text" name="table_name" class="form-control <?= ($validation->getError('table_name')) ? 'is-invalid' : ''; ?>" value="<?= set_value('table_name', $table->table_name) ?>" id="table_name" placeholder="Enter Table Name">
                                    <?php if ($validation->getError('table_name')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('table_name') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="table_capacity">Table Capacity</label>
                                    <input type="number" name="table_capacity" class="form-control <?= ($validation->getError('table_capacity')) ? 'is-invalid' : ''; ?>" value="<?= set_value('table_capacity', $table->table_capacity ?? 0) ?>" id="table_capacity" placeholder="Enter Table Capacity" min="0">
                                    <?php if ($validation->getError('table_capacity')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('table_capacity') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="table_description">Table Description</label>
                                    <textarea name="table_description" id="table_description" class="form-control <?= ($validation->getError('table_description')) ? 'is-invalid' : ''; ?>" placeholder="Enter Table Description"><?= set_value('table_description', $table->table_description) ?></textarea>
                                    <?php if ($validation->getError('table_description')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('table_description') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?= route_to('admin.tables') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>