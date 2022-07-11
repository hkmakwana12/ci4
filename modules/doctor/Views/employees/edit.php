<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Employees</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= route_to('admin.dash') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= route_to('admin.employees') ?>">Employees</a></li>
                    <li class="breadcrumb-item active">Edit Employees</li>
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
                    <form role="form" action="<?= route_to('admin.employees.edit', $employee->id) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="card-header">
                            <h3 class="card-title">Edit Employees</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="employee_full_name">Full Name</label>
                                    <input type="text" name="employee_full_name" class="form-control <?= ($validation->getError('employee_full_name')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_full_name', $employee->employee_full_name); ?>" id="employee_full_name" tabindex="1">
                                    <?php if ($validation->getError('employee_full_name')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('employee_full_name'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="employee_address">Address</label>
                                    <input type="text" name="employee_address" class="form-control <?= ($validation->getError('employee_address')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_address', $employee->employee_address); ?>" id="employee_address" tabindex="2">
                                    <?php if ($validation->getError('employee_address')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('employee_address'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="employee_aadhar_number">Aadhar Number</label>
                                    <input type="text" class="form-control <?= ($validation->getError('employee_aadhar_number')) ? 'is-invalid' : ''; ?>" name="employee_aadhar_number" value="<?= set_value('employee_aadhar_number', $employee->employee_aadhar_number); ?>" id="employee_aadhar_number" tabindex="3">
                                    <?php if ($validation->getError('employee_aadhar_number')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('employee_aadhar_number'); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="employee_email">Email address</label>
                                    <input type="email" class="form-control <?= ($validation->getError('employee_email')) ? 'is-invalid' : ''; ?>" name="employee_email" value="<?= set_value('employee_email', $employee->employee_email); ?>" id="employee_email" tabindex="4">
                                    <?php if ($validation->getError('employee_email')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('employee_email'); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="employee_phone">Phone No.</label>
                                    <input type="text" name="employee_phone" class="form-control <?= ($validation->getError('employee_phone')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_phone', $employee->employee_phone); ?>" id="employee_phone" tabindex="5">
                                    <?php if ($validation->getError('employee_phone')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('employee_phone'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="employee_sex">Sex</label>
                                    <select id="employee_sex" name="employee_sex" class="form-control <?= ($validation->getError('employee_sex')) ? 'is-invalid' : ''; ?>" tabindex="6">
                                        <option value="Male" <?= ($employee->employee_sex == 'Male') ? 'selected' : set_select('employee_sex', 'Male'); ?>>Male</option>
                                        <option value="Female" <?= ($employee->employee_sex == 'Female') ? 'selected' : set_select('employee_sex', 'Female'); ?>>Female</option>
                                    </select>
                                    <?php if ($validation->getError('employee_sex')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('employee_sex') ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="employee_marital_status">Status</label>
                                    <select id="employee_marital_status" name="employee_marital_status" class="form-control <?= ($validation->getError('employee_marital_status')) ? 'is-invalid' : ''; ?>" tabindex="7">
                                        <option value="Married" <?= ($employee->employee_marital_status == 'Married') ? 'selected' : set_select('employee_marital_status', 'Married'); ?>>Married</option>
                                        <option value="Single" <?= ($employee->employee_marital_status == 'Single') ? 'selected' : set_select('employee_marital_status', 'Single'); ?>>Single</option>
                                        <option value="Widow" <?= ($employee->employee_marital_status == 'Widow') ? 'selected' : set_select('employee_marital_status', 'Widow'); ?>>Widow</option>
                                        <option value="Divorced" <?= ($employee->employee_marital_status == 'Divorced') ? 'selected' : set_select('employee_marital_status', 'Divorced'); ?>>Divorced</option>
                                    </select>
                                    <?php if ($validation->getError('employee_marital_status')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('employee_marital_status') ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="employee_date_of_birth">Date of Birth</label>
                                    <input type="date" name="employee_date_of_birth" class="form-control <?= ($validation->getError('employee_date_of_birth')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_date_of_birth', $employee->employee_date_of_birth); ?>" id="employee_date_of_birth" tabindex="8">
                                    <?php if ($validation->getError('employee_date_of_birth')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('employee_date_of_birth'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="employee_religion">Religion</label>
                                    <input type="text" name="employee_religion" class="form-control <?= ($validation->getError('employee_religion')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_religion', $employee->employee_religion); ?>" id="employee_religion" tabindex="9">
                                    <?php if ($validation->getError('employee_religion')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('employee_religion'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="employee_education">Education</label>
                                    <input type="text" name="employee_education" class="form-control <?= ($validation->getError('employee_education')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_education', $employee->employee_education); ?>" id="employee_education" tabindex="10">
                                    <?php if ($validation->getError('employee_education')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('employee_education'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="employee_occupation">Occupation/Designation</label>
                                    <input type="text" name="employee_occupation" class="form-control <?= ($validation->getError('employee_occupation')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_occupation', $employee->employee_occupation); ?>" id="employee_occupation" tabindex="11">
                                    <?php if ($validation->getError('employee_occupation')) : ?>
                                        <span class="error invalid-feedback"><?= $validation->getError('employee_occupation'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?= route_to('admin.employees') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>