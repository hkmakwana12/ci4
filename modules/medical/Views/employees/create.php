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
                    <form role="form" action="<?= route_to('admin.employees.create') ?>" method="post" class="needs-validation" novalidate>
                        <?= csrf_field() ?>
                        <div class="card-header">
                            <h3 class="card-title">Add Employees</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="employee_full_name">Full Name</label>
                                    <input type="text" name="employee_full_name" class="form-control <?= ($validation->getError('employee_full_name')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_full_name'); ?>" id="employee_full_name" tabindex="1" required>
                                    <div class="invalid-feedback"><?= ($validation->getError('employee_full_name')) ? $validation->getError('employee_full_name') : 'Please enter valid name' ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="employee_address">Address</label>
                                    <input type="text" name="employee_address" class="form-control <?= ($validation->getError('employee_address')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_address'); ?>" id="employee_address" tabindex="2" required>
                                    <div class="invalid-feedback"><?= ($validation->getError('employee_address')) ? $validation->getError('employee_address') : 'Please enter valid address' ?></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="employee_aadhar_number">Aadhar Number</label>
                                    <input type="text" class="form-control <?= ($validation->getError('employee_aadhar_number')) ? 'is-invalid' : ''; ?>" name="employee_aadhar_number" value="<?= set_value('employee_aadhar_number'); ?>" id="employee_aadhar_number" tabindex="3" required>
                                    <div class="invalid-feedback"><?= ($validation->getError('employee_aadhar_number')) ? $validation->getError('employee_aadhar_number') : 'Please enter valid aadhar number' ?></div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="employee_email">Email address</label>
                                    <input type="email" class="form-control <?= ($validation->getError('employee_email')) ? 'is-invalid' : ''; ?>" name="employee_email" value="<?= set_value('employee_email'); ?>" id="employee_email" tabindex="4" required>
                                    <div class="invalid-feedback"><?= ($validation->getError('employee_email')) ? $validation->getError('employee_email') : 'Please enter valid email' ?></div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="employee_phone">Phone No.</label>
                                    <input type="text" name="employee_phone" class="form-control <?= ($validation->getError('employee_phone')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_phone'); ?>" id="employee_phone" tabindex="5" required>
                                    <div class="invalid-feedback"><?= ($validation->getError('employee_phone')) ? $validation->getError('employee_phone') : 'Please enter valid phone number' ?></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="employee_sex">Sex</label>
                                    <select id="employee_sex" name="employee_sex" class="form-control <?= ($validation->getError('employee_sex')) ? 'is-invalid' : ''; ?>" tabindex="6" required>
                                        <option value="Male" <?= set_select('employee_sex', 'Male'); ?>>Male</option>
                                        <option value="Female" <?= set_select('employee_sex', 'Female'); ?>>Female</option>
                                    </select>
                                    <div class="invalid-feedback"><?= ($validation->getError('employee_sex')) ? $validation->getError('employee_sex') : 'Please select at least one' ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="employee_marital_status">Status</label>
                                    <select id="employee_marital_status" name="employee_marital_status" class="form-control <?= ($validation->getError('employee_marital_status')) ? 'is-invalid' : ''; ?>" tabindex="7" required>
                                        <option value="Married" <?= set_select('employee_marital_status', 'Married'); ?>>Married</option>
                                        <option value="Single" <?= set_select('employee_marital_status', 'Single'); ?>>Single</option>
                                        <option value="Widow" <?= set_select('employee_marital_status', 'Widow'); ?>>Widow</option>
                                        <option value="Divorced" <?= set_select('employee_marital_status', 'Divorced'); ?>>Divorced</option>
                                    </select>
                                    <div class="invalid-feedback"><?= ($validation->getError('employee_marital_status')) ? $validation->getError('employee_marital_status') : 'Please select at least one' ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="employee_date_of_birth">Date of Birth</label>
                                    <input type="date" name="employee_date_of_birth" class="form-control <?= ($validation->getError('employee_date_of_birth')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_date_of_birth'); ?>" id="employee_date_of_birth" tabindex="8" required>
                                    <div class="invalid-feedback"><?= ($validation->getError('employee_date_of_birth')) ? $validation->getError('employee_date_of_birth') : 'Please select date of birth' ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="employee_religion">Religion</label>
                                    <input type="text" name="employee_religion" class="form-control <?= ($validation->getError('employee_religion')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_religion'); ?>" id="employee_religion" tabindex="9" required>
                                    <div class="invalid-feedback"><?= ($validation->getError('employee_religion')) ? $validation->getError('employee_religion') : 'Please enter religion' ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="employee_education">Education</label>
                                    <input type="text" name="employee_education" class="form-control <?= ($validation->getError('employee_education')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_education'); ?>" id="employee_education" tabindex="10" required>
                                    <div class="invalid-feedback"><?= ($validation->getError('employee_education')) ? $validation->getError('employee_education') : 'Please enter education' ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="employee_occupation">Occupation/Designation</label>
                                    <input type="text" name="employee_occupation" class="form-control <?= ($validation->getError('employee_occupation')) ? 'is-invalid' : ''; ?>" value="<?= set_value('employee_occupation'); ?>" id="employee_occupation" tabindex="11" required>
                                    <div class="invalid-feedback"><?= ($validation->getError('employee_occupation')) ? $validation->getError('employee_occupation') : 'Please enter occupation/designation' ?></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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

<?= $this->section('script'); ?>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<?= $this->endSection() ?>