<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<form role="form" id="deleteForm" action="<?= route_to('admin.permissions.delete', 0); ?>" method="post">
    <?= csrf_field(); ?>
</form>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard v3</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v3</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $heading; ?></h3>
                        <div class="card-tool">
                            <a class="btn btn-primary mb-2 float-right" href="<?= route_to('admin.permissions.create'); ?>"><span class="fas fa-plus">&nbsp;</span>Add</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table" class="table table-hover" data-toggle="table" data-url="<?= route_to('admin.permissions.list'); ?>" data-page-list="[5,10, 25, 50, 100, all]" data-pagination="true" data-search="true" data-show-refresh="true" data-show-columns="true" data-show-columns-toggle-all="true" data-sort-order="desc" data-buttons-class="primary" data-side-pagination="server" data-addrbar="1" data-show-footer="" data-toolbar="#customerDeleteMultiple">
                            <thead>
                                <tr>
                                    <th data-checkbox="true"></th>
                                    <th data-sortable="true" data-field="permission_name">Name</th>
                                    <th data-sortable="true" data-field="permission_display_name">Display Name</th>
                                    <th data-width="150" data-formatter="customerActionFormatter" data-events="handleEvents">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.3/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.3/extensions/addrbar/bootstrap-table-addrbar.min.js"></script>

<script>
    var $table = $('#table')
    var $remove = $('#remove')
    var selections = []


    $(function() {
        $table.on(
            'check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table',
            function() {
                $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
            }
        );
        $remove.click(function() {
            var ids = $.map($table.bootstrapTable('getSelections'), function(row) {
                return row.id;
            });
        });
    });

    <?= $this->endSection(); ?>