<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<form role="form" id="deleteForm" action="<?= route_to('admin.roles.delete', 0); ?>" method="post">
  <?= csrf_field(); ?>
</form>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?= $heading; ?></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <?= $breadcrumb; ?>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><?= $heading; ?></h3>
            <div class="card-tool">
              <a class="btn btn-primary mb-2 float-right" href="<?= route_to('admin.roles.create'); ?>"><span class="fas fa-plus">&nbsp;</span>Add</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="rolesTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Display Name</th>
                  <th>Action</th>
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
<?= $this->include('admin/partials/delete_modal'); ?>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- DataTables -->
<script src="<?= base_url(); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- page script -->
<script>
  $(function() {
    $("#rolesTable").DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?= route_to('admin.roles.list'); ?>",
        "data": function(d) {

        }
      },
      "fnDrawCallback": function() {
        $(".deleteRole").on('click', function() {
          url = $("#deleteForm").attr('action');
          url = url.split('/').slice(0, -1).join('/') + '/' + $(this).data("id");
          $("#deleteForm").attr('action', url);
        });
      }
    });
    $(".confirmDelete").click(function() {
      $("#deleteForm").submit();
    });
  });
</script>
<?= $this->endSection(); ?>