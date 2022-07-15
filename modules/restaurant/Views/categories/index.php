<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<form role="form" id="deleteForm" action="<?= route_to('admin.categories.delete', 0); ?>" method="post">
    <?= csrf_field(); ?>
    <input type="hidden" name="delete_id" id="delete_id" />
</form>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?= $this->include('partials/flashmessage'); ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories</h3>
                        <div class="card-tool">
                            <a class="btn btn-primary btn-sm float-right" href="<?= route_to('admin.categories.create'); ?>"><span class="fas fa-plus">&nbsp;</span>Add</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8 mb-4">
                                <button type="button" id="deleteBtn" class="btn btn-danger" disabled data-toggle="modal" data-target="#modal-delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                            <div class="col-sm-4 mb-4 pull-right">
                                <form action="">
                                    <div class="input-group">
                                        <input type="search" name="search" class="form-control" value="<?= $search ?>">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php $sortVal = $sort == 'ASC' ? "DESC" : "ASC"; ?>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th class="text-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="master_checkbox">
                                                <label for="master_checkbox">
                                                </label>
                                            </div>
                                        </th>
                                        <th>Store</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    if ($categories) : ?>
                                        <?php foreach ($categories as $category) : ?>
                                            <tr>
                                                <td class="text-center">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" class="sub_checkbox" id="sub_checkbox<?= $category->id ?>" data-id="<?= $category->id ?>">
                                                        <label for="sub_checkbox<?= $category->id ?>">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td><?= $category->store_name ?></td>
                                                <td><?= $category->category_name ?></td>
                                                <td width="150px">
                                                    <a href="<?= route_to('admin.categories.edit', $category->id) ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <button type="button" class="btn btn-sm btn-danger deleteItem" data-toggle="modal" data-target="#modal-delete" data-id="<?= $category->id ?>">Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                    else : ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No records found</td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <?php
                        if ($pagination_link) {
                            $pagination_link->setPath('admin/categories');
                            echo $pagination_link->links();
                        }
                        ?>
                    </div>
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
<?= $this->include('partials/delete-modal'); ?>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#master_checkbox').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_checkbox").prop('checked', true);
            } else {
                $(".sub_checkbox").prop('checked', false);
            }
        });

        // Checkbox 
        var selected = [];
        $(".sub_checkbox,#master_checkbox").change(function() {
            selected = [];
            $('.sub_checkbox:checked').each(function() {
                selected.push($(this).data("id"));
            });
            if (selected.length > 0)
                $("#deleteBtn").prop("disabled", false);
            else
                $("#deleteBtn").prop("disabled", true);

        })
        $("#deleteBtn").click(function() {
            $("#delete_id").val(selected);
        })
        $(".deleteItem").click(function() {
            $("#delete_id").val($(this).data("id"));
        })
        $("#confirmDeleteBtn").click(function() {
            $("#deleteForm").submit()
        })
    });
</script>
<?= $this->endSection(); ?>