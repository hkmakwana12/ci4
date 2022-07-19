<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <?= $this->include('partials/flashmessage'); ?>
        <div class="row">
            <?= $this->include("$viewPath/partials/menu1"); ?>
            <div class="col-md-10">
                <?= $this->include("$viewPath/emr/partials/menu2"); ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>