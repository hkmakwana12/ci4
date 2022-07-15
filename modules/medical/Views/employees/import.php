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
                    <form role="form" action="<?= route_to('admin.employees.import') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="card-header">
                            <h3 class="card-title">Import Employees</h3>
                            <div class="card-tool">
                                <a class="btn btn-outline-primary btn-sm float-right" href="/sample/employees.xlsx"><span class="fas fa-download">&nbsp;</span>Sample Download</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (!isset($employees)) : ?>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="file">Excel File</label>
                                        <input type="file" name="file" class="form-control <?= ($validation->getError('file')) ? 'is-invalid' : ''; ?>" value="<?= set_value('file'); ?>" id="file" tabindex="1" required>
                                        <?php if ($validation->getError('file')) : ?>
                                            <span class="error invalid-feedback"><?= $validation->getError('file'); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Email Id</th>
                                                <th>Phone Number</th>
                                                <th>Aadhar Number</th>
                                                <th>Action</th>
                                            </tr>
                                            <input type="hidden" name="action" value="import_data" />
                                            <?php foreach ($employees as $key => $employee) : ?>
                                                <tr>
                                                    <input type="hidden" name="employee_full_name[]" value="<?= $employee['0'] ?>" />
                                                    <input type="hidden" name="employee_address[]" value="<?= $employee['1'] ?>" />
                                                    <input type="hidden" name="employee_aadhar_number[]" value="<?= $employee['2'] ?>" />
                                                    <input type="hidden" name="employee_email[]" value="<?= $employee['3'] ?>" />
                                                    <input type="hidden" name="employee_phone[]" value="<?= $employee['4'] ?>" />
                                                    <input type="hidden" name="employee_sex[]" value="<?= $employee['5'] ?>" />
                                                    <input type="hidden" name="employee_marital_status[]" value="<?= $employee['6'] ?>" />
                                                    <input type="hidden" name="employee_date_of_birth[]" value="<?= date('Y-m-d', strtotime($employee['7'])) ?>" />
                                                    <input type="hidden" name="employee_religion[]" value="<?= $employee['8'] ?>" />
                                                    <input type="hidden" name="employee_education[]" value="<?= $employee['9'] ?>" />
                                                    <input type="hidden" name="employee_occupation[]" value="<?= $employee['10'] ?>" />

                                                    <td><?= $employee['0'] ?></td>
                                                    <td><?= $employee['3'] ?></td>
                                                    <td><?= $employee['4'] ?></td>
                                                    <td><?= $employee['2'] ?></td>
                                                    <td><button type="button" class="btn btn-sm btn-outline-danger deleteItem" data-id="<?= $key ?>"><i class="fas fa-trash"></i></button></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><?= (!isset($employees)) ? 'Submit' : 'Save Data' ?></button>
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
<script type="text/javascript">
    $('.deleteItem').click(function() {
        $confirm = confirm('Are you sure you want to delete?');
        if ($confirm == true) {
            $(this).closest('tr').remove();
        }
    })
</script>

<?= $this->endSection() ?>