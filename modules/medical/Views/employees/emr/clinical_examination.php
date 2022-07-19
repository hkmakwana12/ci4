<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <?= $this->include('partials/flashmessage'); ?>
        <div class="row">
            <?= $this->include("$viewPath/partials/menu1"); ?>
            <div class="col-md-10">
                <?= $this->include("$viewPath/emr/partials/menu2"); ?>

                <form role="form" action="<?= route_to('admin.employees.savePersonalHistory', $employee->id) ?>" method="post" class="needs-validation" novalidate>
                    <?= csrf_field() ?>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Clinical Examination</h3>
                        </div>
                        <div class="card-body">
                            <h5>Physical Examination</h5>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="temperature">Temperature</label>
                                    <div class="input-group">
                                        <input type="text" name="temperature" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="temperature" tabindex="1" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">&#8457;</span>
                                        </div>
                                        <div class="invalid-feedback">Enter valid data</div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="pr">PR</label>
                                    <div class="input-group">
                                        <input type="text" name="pr" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="pr" tabindex="1" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">bpm</span>
                                        </div>
                                        <div class="invalid-feedback">Enter valid data</div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="rr">RR</label>
                                    <div class="input-group">
                                        <input type="text" name="rr" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="rr" tabindex="1" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">p/min</span>
                                        </div>
                                        <div class="invalid-feedback">Enter valid data</div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="bp">BP</label>
                                    <div class="input-group">
                                        <input type="text" name="bp" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="bp" tabindex="1" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">mmHg</span>
                                        </div>
                                        <div class="invalid-feedback">Enter valid data</div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="bp_rank">BP Rank</label>
                                    <select id="bp_rank" name="bp_rank" class="form-control" tabindex="6" required>
                                        <option value="Normal" <?= ($employee->bp_rank ?? "" == 'Normal') ? 'selected' : ""; ?>>Normal</option>
                                        <option value="Abnormal" <?= ($employee->bp_rank ?? "" == 'Abnormal') ? 'selected' : ""; ?>>Abnormal</option>
                                        <option value="Hypertension" <?= ($employee->bp_rank ?? "" == 'Hypertension') ? 'selected' : ""; ?>>Hypertension</option>
                                        <option value="Hypotension" <?= ($employee->bp_rank ?? "" == 'Hypotension') ? 'selected' : ""; ?>>Hypotension</option>
                                    </select>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="head_circumference">Head circumference</label>
                                    <div class="input-group">
                                        <input type="text" name="head_circumference" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="head_circumference" tabindex="1" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                        <div class="invalid-feedback">Enter valid data</div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="spo2">SpO2</label>
                                    <div class="input-group">
                                        <input type="text" name="spo2" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="spo2" tabindex="1" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <div class="invalid-feedback">Enter valid data</div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="height">Height</label>
                                    <div class="input-group">
                                        <input type="text" name="height" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="height" tabindex="1" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                        <div class="invalid-feedback">Enter valid data</div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="weight">Weight</label>
                                    <div class="input-group">
                                        <input type="text" name="weight" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="weight" tabindex="1" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                        <div class="invalid-feedback">Enter valid data</div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="bmi">BMI</label>
                                    <input type="text" name="bmi" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="bmi" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="bsa">BSA</label>
                                    <div class="input-group">
                                        <input type="text" name="bsa" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="bsa" tabindex="1" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">p/m<sup>3</sup></span>
                                        </div>
                                        <div class="invalid-feedback">Enter valid data</div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="bmi_rank">BMI Rank</label>
                                    <input type="text" name="bmi_rank" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="bmi_rank" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="cvp">CVP</label>
                                    <input type="text" name="cvp" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="cvp" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="glucose">Glucose</label>
                                    <div class="input-group">
                                        <input type="text" name="glucose" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="glucose" tabindex="1" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">mg/dl</span>
                                        </div>
                                        <div class="invalid-feedback">Enter valid data</div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="conjuctiva">Conjuctiva</label>
                                    <input type="text" name="conjuctiva" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="conjuctiva" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="nails">Nails</label>
                                    <input type="text" name="nails" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="nails" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="mm">M M</label>
                                    <input type="text" name="mm" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="mm" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="skin">Skin</label>
                                    <input type="text" name="skin" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="skin" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="throat">Throat</label>
                                    <input type="text" name="throat" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="throat" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="nose">Nose</label>
                                    <input type="text" name="nose" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="nose" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="ear">Ear</label>
                                    <input type="text" name="ear" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="ear" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="tongue">Tongue</label>
                                    <input type="text" name="tongue" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="tongue" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="glands">Glands</label>
                                    <input type="text" name="glands" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="glands" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="anthropometry">Anthropometry</label>
                                    <select id="anthropometry" name="anthropometry" class="form-control" tabindex="6" required>
                                        <option value="Stunted">>Stunted</option>
                                        <option value="Wasted">Wasted</option>
                                    </select>
                                    <div class="invalid-feedback">Enter valid data</div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="anthropometry_remark">Anthropometry Remark</label>
                                    <input type="text" name="anthropometry_remark" class="form-control" value="<?= $personal_history->je_date ?? "" ?>" id="anthropometry_remark" tabindex="1" required>
                                    <div class="invalid-feedback">Enter valid data</div>
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