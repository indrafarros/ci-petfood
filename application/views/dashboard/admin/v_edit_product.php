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
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active">Edit product</li>
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
                        <form action="<?= base_url('dashboard/submitProduct') ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type="text" class="form-control" name="id_product" value="<?= $product['id'] ?>">
                            <div class="form-group">
                                <label for="brand">Brand Name</label>
                                <input type="text" class="form-control" name="brand" id="brand" placeholder="Brand Name" value="<?= $product['brand'] ?>" required>
                            </div>
                            <div class=" form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" value="<?= $product['product_name'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Product Description</label>
                                <textarea name="description" id="description" class="form-control" cols="10" rows="3" required> <?= $product['description'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <input type="text" class="form-control" name="price" id="price" value="Rp. <?= $product['price'] ?>" placeholder="Product Price" required>
                            </div>
                            <div class="form-group">
                                <label for="product_category">Category
                                </label>
                                <select name="product_category" name="product_category" id="product_category" value="" class="form-control">
                                    <option value="2">2</option>
                                    <option value="3" <?php if ($product['category_id'] == 3) echo 'selected="selected"'  ?>>3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="images">Product Images</label>
                                <input type="file" class="form-control" required name="files[]" multiple />
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