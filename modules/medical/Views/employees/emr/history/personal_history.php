<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <?= $this->include('partials/flashmessage'); ?>
        <div class="row">
            <?= $this->include("$viewPath/partials/menu1"); ?>
            <div class="col-md-10">
                <?= $this->include("$viewPath/emr/partials/menu2"); ?>

                <?= $this->include("$viewPath/emr/history/partials/menu3"); ?>

                <form role="form" action="<?= route_to('admin.employees.savePersonalHistory', $employee->id) ?>" method="post" class="needs-validation" novalidate>
                    <?= csrf_field() ?>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Personal History</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-danger">* Leave Blank if no date available</p>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="bcg_date">BCG</label>
                                    <input type="date" name="bcg_date" class="form-control" value="<?= $personal_history->bcg_date ?? "" ?>" id="bcg_date" max='<?= date('Y-m-d') ?>' tabindex="1">
                                    <div class="invalid-feedback">Please enter valid date before todays.</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="je_date">JE</label>
                                    <input type="date" name="je_date" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="je_date" max='<?= date('Y-m-d') ?>' tabindex="2">
                                    <div class="invalid-feedback">Please enter valid date before todays.</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="hepatitis_b_date">Hepatitis B</label>
                                    <input type="date" name="hepatitis_b_date" class="form-control" value="<?= $personal_history->hepatitis_b_date ?? "" ?>" id="hepatitis_b_date" max='<?= date('Y-m-d') ?>' tabindex="3">
                                    <div class="invalid-feedback">Please enter valid date before todays.</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="vitamin_a_date">Vitamin A</label>
                                    <input type="date" name="vitamin_a_date" class="form-control" value="<?= $personal_history->vitamin_a_date ?? "" ?>" id="vitamin_a_date" max='<?= date('Y-m-d') ?>' tabindex="4">
                                    <div class="invalid-feedback">Please enter valid date before todays.</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="opv_date">OPV</label>
                                    <input type="date" name="opv_date" class="form-control" value="<?= $personal_history->opv_date ?? "" ?>" id="opv_date" max='<?= date('Y-m-d') ?>' tabindex="5">
                                    <div class="invalid-feedback">Please enter valid date before todays.</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="dpt_date">DPT</label>
                                    <input type="date" name="dpt_date" class="form-control" value="<?= $personal_history->dpt_date ?? "" ?>" id="dpt_date" max='<?= date('Y-m-d') ?>' tabindex="6">
                                    <div class="invalid-feedback">Please enter valid date before todays.</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="ipv_date">IPV</label>
                                    <input type="date" name="ipv_date" class="form-control" value="<?= $personal_history->ipv_date ?? "" ?>" id="ipv_date" max='<?= date('Y-m-d') ?>' tabindex="7">
                                    <div class="invalid-feedback">Please enter valid date before todays.</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="tt_date">T.T</label>
                                    <input type="date" name="tt_date" class="form-control" value="<?= $personal_history->tt_date ?? "" ?>" id="tt_date" max='<?= date('Y-m-d') ?>' tabindex="8">
                                    <div class="invalid-feedback">Please enter valid date before todays.</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="mr_date">Measless / MR</label>
                                    <input type="date" name="mr_date" class="form-control" value="<?= $personal_history->mr_date ?? "" ?>" id="mr_date" max='<?= date('Y-m-d') ?>' tabindex="9">
                                    <div class="invalid-feedback">Please enter valid date before todays.</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="rota_virus_date">Rota Virus</label>
                                    <input type="date" name="rota_virus_date" class="form-control" value="<?= $personal_history->rota_virus_date ?? "" ?>" id="rota_virus_date" max='<?= date('Y-m-d') ?>' tabindex="10">
                                    <div class="invalid-feedback">Please enter valid date before todays.</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="history_note">Personal History Details</label>
                                    <textarea name="history_note" id="history_note" class="form-control" tabindex="11"><?= $personal_history->history_note ?? "" ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
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