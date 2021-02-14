<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">New product</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card-body">
                        <form action="<?= base_url('dashboard/new_product') ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <div class="form-group">
                                <label for="brand">Brand Name</label>
                                <input type="text" class="form-control" name="brand" id="brand" placeholder="Brand Name" required>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Product Description</label>
                                <textarea name="description" id="description" class="form-control" cols="10" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <input type="text" class="form-control" name="price" id="price" placeholder="Product Price" required>
                            </div>
                            <div class="form-group">
                                <label for="product_category">Category
                                </label>
                                <select name="product_category" name="product_category" id="product_category" class="form-control">
                                    <option value="product_category">2</option>
                                    <option value="product_category">3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="images">Product Images</label>
                                <input type="file" class="form-control" required name="files[]" multiple id="photofile" />
                                <div class="preview mt-2" id="preview"></div>
                            </div>
                            <button type="submit" class='mt-3 btn btn-primary float-right'>Save Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    function previewImages() {

        var preview = document.querySelector('#preview');

        if (this.files) {
            [].forEach.call(this.files, readAndPreview);
        }

        function readAndPreview(file) {
            // Make sure `file.name` matches our extensions criteria
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                return alert(file.name + " is not an image");
            } // else...

            var reader = new FileReader();

            reader.addEventListener("load", function() {
                var image = new Image();
                image.height = 100;
                image.title = file.name;
                image.src = this.result;
                preview.appendChild(image);
            });
            reader.readAsDataURL(file);
        }
    }
    document.querySelector('#photofile').addEventListener("change", previewImages);
</script>