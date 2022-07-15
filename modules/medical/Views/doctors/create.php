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
                    <form role="form" action="<?= route_to('admin.doctors.create') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-header">
                            <h3 class="card-title">Add Doctors</h3>
                        </div>
                        <div class="card-body">
                            <h4>Basic Info</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="user_firstname">First Name</label>
                                    <input type="text" name="user_firstname" class="form-control <?= ($validation->getError('user_firstname')) ? 'is-invalid' : ''; ?>" value="<?= set_value('user_firstname'); ?>" id="user_firstname" tabindex="1">
                                    <?php if ($validation->getError('user_firstname')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('user_firstname'); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="user_lastname">Last Name</label>
                                    <input type="text" name="user_lastname" class="form-control <?= ($validation->getError('user_lastname')) ? 'is-invalid' : ''; ?>" value="<?= set_value('user_lastname'); ?>" id="user_lastname" tabindex="2">
                                    <?php if ($validation->getError('user_lastname')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('user_lastname'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="user_email">Email address</label>
                                    <input type="email" class="form-control <?= ($validation->getError('user_email')) ? 'is-invalid' : ''; ?>" name="user_email" value="<?= set_value('user_email'); ?>" id="user_email" tabindex="3">
                                    <?php if ($validation->getError('user_email')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('user_email'); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="user_phone">Phone No.</label>
                                    <input type="text" name="user_phone" class="form-control <?= ($validation->getError('user_phone')) ? 'is-invalid' : ''; ?>" value="<?= set_value('user_phone'); ?>" id="user_phone" tabindex="4">
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
                            <h4>Doctor Info</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="address_line_1">Address Line 1</label>
                                    <input type="text" name="address_line_1" class="form-control <?= ($validation->getError('address_line_1')) ? 'is-invalid' : ''; ?>" value="<?= set_value('address_line_1'); ?>" id="address_line_1" tabindex="7">
                                    <?php if ($validation->getError('address_line_1')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('address_line_1'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="address_line_2">Address Line 2</label>
                                    <input type="text" name="address_line_2" class="form-control <?= ($validation->getError('address_line_2')) ? 'is-invalid' : ''; ?>" value="<?= set_value('address_line_2'); ?>" id="address_line_2" tabindex="8">
                                    <?php if ($validation->getError('address_line_2')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('address_line_2'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="landmark">Landmark</label>
                                    <input type="text" name="landmark" class="form-control <?= ($validation->getError('landmark')) ? 'is-invalid' : ''; ?>" value="<?= set_value('landmark'); ?>" id="landmark" tabindex="9">
                                    <?php if ($validation->getError('landmark')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('landmark'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="uhc_number">UHC Number</label>
                                    <input type="text" name="uhc_number" class="form-control <?= ($validation->getError('uhc_number')) ? 'is-invalid' : ''; ?>" value="<?= set_value('uhc_number'); ?>" id="uhc_number" tabindex="10">
                                    <?php if ($validation->getError('uhc_number')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('uhc_number'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="registration_number">Registration Number</label>
                                    <input type="text" name="registration_number" class="form-control <?= ($validation->getError('registration_number')) ? 'is-invalid' : ''; ?>" value="<?= set_value('registration_number'); ?>" id="registration_number" tabindex="11">
                                    <?php if ($validation->getError('registration_number')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('registration_number'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="designation">Designation</label>
                                    <input type="text" name="designation" class="form-control <?= ($validation->getError('designation')) ? 'is-invalid' : ''; ?>" value="<?= set_value('designation'); ?>" id="designation" tabindex="12">
                                    <?php if ($validation->getError('designation')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('designation'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= route_to('admin.doctors') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>