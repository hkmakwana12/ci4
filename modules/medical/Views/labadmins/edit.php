<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit LabAdmins</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= route_to('admin.dash') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= route_to('admin.labadmins') ?>">LabAdmins</a></li>
                    <li class="breadcrumb-item active">Edit LabAdmins</li>
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
                    <form role="form" action="<?= route_to('admin.labadmins.edit', $labadmin->id) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-header">
                            <h3 class="card-title">Edit LabAdmins</h3>
                        </div>
                        <div class="card-body">
                            <h4>Basic Info</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="user_firstname">First Name</label>
                                    <input type="text" name="user_firstname" class="form-control <?= ($validation->getError('user_firstname')) ? 'is-invalid' : ''; ?>" value="<?= set_value('user_firstname', $labadmin->user_firstname); ?>" id="user_firstname" tabindex="1">
                                    <?php if ($validation->getError('user_firstname')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('user_firstname'); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="user_lastname">Last Name</label>
                                    <input type="text" name="user_lastname" class="form-control <?= ($validation->getError('user_lastname')) ? 'is-invalid' : ''; ?>" value="<?= set_value('user_lastname', $labadmin->user_lastname); ?>" id="user_lastname" tabindex="2">
                                    <?php if ($validation->getError('user_lastname')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('user_lastname'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="user_email">Email address</label>
                                    <input type="email" class="form-control <?= ($validation->getError('user_email')) ? 'is-invalid' : ''; ?>" name="user_email" value="<?= set_value('user_email', $labadmin->user_email); ?>" id="user_email" tabindex="3">
                                    <?php if ($validation->getError('user_email')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('user_email'); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="user_phone">Phone No.</label>
                                    <input type="text" name="user_phone" class="form-control <?= ($validation->getError('user_phone')) ? 'is-invalid' : ''; ?>" value="<?= set_value('user_phone', $labadmin->user_phone); ?>" id="user_phone" tabindex="4">
                                    <?php if ($validation->getError('user_phone')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('user_phone'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" autocomplete="password" class="form-control <?= ($validation->getError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" tabindex="5">
                                    <?php if ($validation->getError('password')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('password'); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" autocomplete="confirm_password" class="form-control" name="confirm_password" id="confirm_password" tabindex="6">
                                </div>
                            </div>
                            <h4>Organization Info</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="organization_type">Organization Type</label>
                                    <select id="organization_type" name="organization_type" class="form-control <?= ($validation->getError('organization_type')) ? 'is-invalid' : ''; ?>" tabindex="7">
                                        <option value="Govt" <?= ($labadmin->organization_type == 'Govt') ? 'selected' : set_select('organization_type', 'Govt'); ?>>Govt</option>
                                        <option value="Pvt" <?= ($labadmin->organization_type == 'Pvt') ? 'selected' : set_select('organization_type', 'Pvt'); ?>>Pvt</option>
                                    </select>
                                    <?php if ($validation->getError('organization_type')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('organization_type') ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="organization_name">Organization Name</label>
                                    <input type="text" name="organization_name" class="form-control <?= ($validation->getError('organization_name')) ? 'is-invalid' : ''; ?>" value="<?= set_value('organization_name', $labadmin->organization_name); ?>" id="organization_name" tabindex="8">
                                    <?php if ($validation->getError('organization_name')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('organization_name'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="address_line_1">Address Line 1</label>
                                    <input type="text" name="address_line_1" class="form-control <?= ($validation->getError('address_line_1')) ? 'is-invalid' : ''; ?>" value="<?= set_value('address_line_1', $labadmin->address_line_1); ?>" id="address_line_1" tabindex="9">
                                    <?php if ($validation->getError('address_line_1')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('address_line_1'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="address_line_2">Address Line 2</label>
                                    <input type="text" name="address_line_2" class="form-control <?= ($validation->getError('address_line_2')) ? 'is-invalid' : ''; ?>" value="<?= set_value('address_line_2', $labadmin->address_line_2); ?>" id="address_line_2" tabindex="10">
                                    <?php if ($validation->getError('address_line_2')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('address_line_2'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="landmark">Landmark</label>
                                    <input type="text" name="landmark" class="form-control <?= ($validation->getError('landmark')) ? 'is-invalid' : ''; ?>" value="<?= set_value('landmark', $labadmin->landmark); ?>" id="landmark" tabindex="11">
                                    <?php if ($validation->getError('landmark')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('landmark'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="pan_number">PAN Number</label>
                                    <input type="text" name="pan_number" class="form-control <?= ($validation->getError('pan_number')) ? 'is-invalid' : ''; ?>" value="<?= set_value('pan_number', $labadmin->pan_number); ?>" id="pan_number" tabindex="12">
                                    <?php if ($validation->getError('pan_number')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('pan_number'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="gst_number">GST Number</label>
                                    <input type="text" name="gst_number" class="form-control <?= ($validation->getError('gst_number')) ? 'is-invalid' : ''; ?>" value="<?= set_value('gst_number', $labadmin->gst_number); ?>" id="gst_number" tabindex="13">
                                    <?php if ($validation->getError('gst_number')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('gst_number'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="designation">Designation</label>
                                    <input type="text" name="designation" class="form-control <?= ($validation->getError('designation')) ? 'is-invalid' : ''; ?>" value="<?= set_value('designation', $labadmin->designation); ?>" id="designation" tabindex="14">
                                    <?php if ($validation->getError('designation')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('designation'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?= route_to('admin.labadmins') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>