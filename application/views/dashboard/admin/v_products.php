<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <?= $title ?>
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('dashboard/add_product') ?>" class="btn btn-outline-danger mb-4 float-right">
                        Add new products
                    </a>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="menu_table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Brand</th>
                                    <th class="col">Product Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->

    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->


<!-- Modal Add-->
<div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new product category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formAddMenu">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_name">Category name</label>
                        <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Add category name">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" class="form-control" name="tags" id="tags" placeholder="Add category name">
                        <span class="text-sm text-danger font-italic font-weight-bold pl-1">Example : cats, dry, wet</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnAddMenu">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="modalEditCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formSubmitMenu">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="id_edit_category" id="id_edit_category" value="">
                        <label for="menu_edit_category">Category name</label>
                        <input type="text" class="form-control" name="menu_edit_category" id="menu_edit_category" placeholder="Add category name">
                    </div>
                    <div class="form-group">
                        <label for="menu_edit_tags">Category tags</label>
                        <input type="text" class="form-control" name="menu_edit_tags" id="menu_edit_tags" placeholder="Add category name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnSubmitEdit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    data_table();

    function data_table() {
        var table = $('#menu_table').DataTable({
            "responsive": true,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= base_url('dashboard/serverside_get_product') ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                    "width": "auto"
                },
                {
                    "targets": [1],
                    "width": "auto"
                },
                {
                    "targets": [2],
                    "width": "auto"
                },
                {
                    "targets": [3],
                    "width": "auto"
                },
                {
                    "targets": [4],
                    "width": "auto"
                },
                {
                    "targets": [5],
                    "width": "auto"
                },
                {
                    "targets": [6],
                    "width": "auto"
                },
                {
                    "targets": [7],
                    "width": "auto"
                },
                {
                    "targets": [8],
                    "width": "auto"
                }
            ],

        });
    }
    $(document).ready(function() {

        $("#btnAddMenu").click(function(e) {
            e.preventDefault();
            // alert('test');
            const category_name = $('#category_name').val();
            const tags = $('#tags').val();
            if (category_name == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            } else {
                $.ajax({
                    url: "<?= base_url('dashboard/addCategory') ?>",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        category_name: category_name,
                        tags: tags,
                        [csrfName]: csrfHash
                    },
                    success: function(data) {
                        csrfName = data.csrfName;
                        csrfHash = data.csrfHash;
                        $('#modalAddCategory').modal('hide');
                        $('#formAddMenu')[0].reset();
                        Swal.fire(
                            'Add new category successfuly!',
                            'success'
                        )
                        data_table();
                    }
                })
            }
        });



        $(document).on('click', "#btnDeleteProduct", function(e) {
            e.preventDefault();
            var id = $(this).attr('value');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('dashboard/deleteProduct') ?>',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id_product: id,
                            [csrfName]: csrfHash
                        },
                        success: function(data) {
                            csrfName = data.csrfName;
                            csrfHash = data.csrfHash;
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            data_table();
                        }
                    });
                }
            })
        });
        // Get Cateogry info
        $(document).on('click', '#btnEditCategory', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: '<?= base_url('dashboard/getEditCategory') ?>',
                type: 'post',
                dataType: 'json',
                data: {
                    id_category: id,
                    [csrfName]: csrfHash
                },
                success: function(data) {
                    csrfName = data.csrfName;
                    csrfHash = data.csrfHash;
                    $('#modalEditCategory').modal('show');
                    // console.log(data);
                    $('#id_edit_category').val(data.category.id);
                    $('#menu_edit_category').val(data.category.category_name);
                    $('#menu_edit_tags').val(data.category.tags);
                }
            })
        });

        $(document).on('click', '#btnSubmitEdit', function(e) {
            e.preventDefault();
            const id = $('#id_edit_category').val();
            const category_name = $('#menu_edit_category').val();
            const tags = $('#menu_edit_tags').val();
            if (id == '' || category_name == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            } else {
                $.ajax({
                    url: '<?= base_url('dashboard/submitEditCategory') ?>',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        id_edit_category: id,
                        menu_edit_category: category_name,
                        tags: tags,
                        [csrfName]: csrfHash

                    },
                    success: function(data) {
                        csrfName = data.csrfName;
                        csrfHash = data.csrfHash;
                        $('#modalEditCategory').modal('hide');
                        $('#formSubmitMenu')[0].reset();
                        data_table();
                    }
                })
            }
        })
    });
</script>