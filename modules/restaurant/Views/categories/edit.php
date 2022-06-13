<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Categories</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= route_to('admin.dash') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= route_to('admin.categories') ?>">Categories</a></li>
                    <li class="breadcrumb-item active">Edit Categories</li>
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
                    <form role="form" action="<?= route_to('admin.categories.edit', $category->id) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-header">
                            <h3 class="card-title">Edit Categories</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="store_id">Store</label>
                                    <select id="store_id" name="store_id" class="form-control <?= ($validation->getError('store_id')) ? 'is-invalid' : ''; ?>">
                                        <option value="">Select Store</option>
                                        <?php foreach ($stores as $store) : ?>
                                            <option value="<?= $store->id ?>" <?= ($category->store_id == $store->id) ? 'selected' : set_select('store_id', $store->id); ?>><?= $store->store_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if ($validation->getError('store_id')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('store_id') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="category_name">Category Name</label>
                                    <input type="text" name="category_name" class="form-control <?= ($validation->getError('category_name')) ? 'is-invalid' : ''; ?>" value="<?= set_value('category_name', $category->category_name) ?>" id="category_name" placeholder="Enter Category Name">
                                    <?php if ($validation->getError('category_name')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('category_name') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?= route_to('admin.categories') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>