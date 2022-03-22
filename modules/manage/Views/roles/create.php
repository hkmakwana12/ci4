<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?= $heading; ?></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <?= $breadcrumb; ?>
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
          <form role="form" action="<?= route_to('admin.roles.create'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="role_name">Name</label>
                  <input type="text" name="role_name" class="form-control <?= ($validation->getError('role_name')) ? 'is-invalid' : ''; ?>" value="<?= set_value('role_name'); ?>" id="role_name" placeholder="Enter Name">
                  <?php if ($validation->getError('role_name')) : ?>
                    <span class="error invalid-feedback"><?= $validation->getError('role_name'); ?></span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="role_display_name">Display Name</label>
                  <input type="text" class="form-control <?= ($validation->getError('role_display_name')) ? 'is-invalid' : ''; ?>" name="role_display_name" value="<?= set_value('role_display_name'); ?>" id="role_display_name" placeholder="Enter Display Name">
                  <?php if ($validation->getError('role_display_name')) : ?>
                    <span class="error invalid-feedback"><?= $validation->getError('role_display_name'); ?></span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="role_description">Description</label>
                  <textarea name="role_description" id="role_description" class="form-control <?= ($validation->getError('role_description')) ? 'is-invalid' : ''; ?>" placeholder="Enter Description"><?= set_value('role_description'); ?></textarea>
                  <?php if ($validation->getError('role_description')) : ?>
                    <span class="error invalid-feedback"><?= $validation->getError('role_description'); ?></span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <?php foreach ($permissions as $row) : ?>
                    <div class="icheck-primary d-inline col-3">
                      <input type="checkbox" name="permissions[]" id="<?= $row->permission_name; ?>" value="<?= $row->id; ?>" <?php echo set_checkbox('permissions[]', $row->id); ?> />
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
              <button type="submit" class="btn btn-primary float-right">Submit</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>