<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <?= $this->include('partials/flashmessage'); ?>
        <div class="row">
            <?= $this->include("$viewPath/partials/menu1"); ?>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Profile Details
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>