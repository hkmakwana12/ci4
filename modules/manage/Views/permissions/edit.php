<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?= $heading ?></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <?= $breadcrumb ?>
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
          <form role="form" action="<?= route_to('admin.permissions.edit', $permission->id) ?>" method="post">
            <?= csrf_field() ?>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="permission_name">Name</label>
                  <input type="text" name="permission_name" class="form-control <?= ($validation->getError('permission_name')) ? 'is-invalid' : ''; ?>" value="<?= set_value('permission_name', $permission->permission_name) ?>" id="permission_name" placeholder="Enter Name">
                  <?php if ($validation->getError('permission_name')) : ?>
                    <span class="error invalid-feedback"><?= $validation->getError('permission_name') ?></span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="permission_display_name">Display Name</label>
                  <input type="text" class="form-control <?= ($validation->getError('permission_display_name')) ? 'is-invalid' : ''; ?>" name="permission_display_name" value="<?= set_value('permission_display_name', $permission->permission_display_name) ?>" id="permission_display_name" placeholder="Enter Display Name">
                  <?php if ($validation->getError('permission_display_name')) : ?>
                    <span class="error invalid-feedback"><?= $validation->getError('permission_display_name') ?></span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="permission_description">Description</label>
                  <textarea name="permission_description" id="permission_description" class="form-control <?= ($validation->getError('permission_description')) ? 'is-invalid' : ''; ?>" placeholder="Enter Description"><?= set_value('permission_description', $permission->permission_description) ?></textarea>
                  <?php if ($validation->getError('permission_description')) : ?>
                    <span class="error invalid-feedback"><?= $validation->getError('permission_description') ?></span>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-info float-right">Update</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>