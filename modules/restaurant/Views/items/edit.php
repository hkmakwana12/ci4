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
                    <form role="form" action="<?= route_to('admin.items.edit', $item->id) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-header">
                            <h3 class="card-title">Edit Items</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="store_id">Store</label>
                                    <select id="store_id" name="store_id" class="form-control <?= ($validation->getError('store_id')) ? 'is-invalid' : ''; ?>">
                                        <option value="">Select Store</option>
                                        <?php foreach ($stores as $store) : ?>
                                            <option value="<?= $store->id ?>" <?= ($item->store_id == $store->id) ? 'selected' : set_select('store_id', $store->id); ?>><?= $store->store_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if ($validation->getError('store_id')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('store_id') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="category_id">Category</label>
                                    <select id="category_id" name="category_id" class="form-control <?= ($validation->getError('category_id')) ? 'is-invalid' : ''; ?>">
                                        <option value="">Select Category</option>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?= $category->id ?>" <?= ($item->category_id == $category->id) ? 'selected' : set_select('category_id', $category->id); ?>><?= $category->category_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if ($validation->getError('category_id')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('category_id') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="item_name">Item Name</label>
                                    <input type="text" name="item_name" class="form-control <?= ($validation->getError('item_name')) ? 'is-invalid' : ''; ?>" value="<?= set_value('item_name', $item->item_name) ?>" id="item_name">
                                    <?php if ($validation->getError('item_name')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('item_name') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="item_price">Price</label>
                                    <input type="text" name="item_price" class="form-control <?= ($validation->getError('item_price')) ? 'is-invalid' : ''; ?>" value="<?= set_value('item_price', $item->item_price ?? 0) ?>" id="item_price">
                                    <?php if ($validation->getError('item_price')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('item_price') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="item_description">Item Description</label>
                                    <textarea name="item_description" id="item_description" class="form-control <?= ($validation->getError('item_description')) ? 'is-invalid' : ''; ?>"><?= set_value('item_description', $item->item_description) ?></textarea>
                                    <?php if ($validation->getError('item_description')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('item_description') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?= route_to('admin.items') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>