<?php
// $tmp = explode(',', $product['picture_path']);
// $file_extension = end($tmp);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap.min.css') ?>">
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merienda+One&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/h_style.css') ?>">
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js" integrity="sha512-M+hXwltZ3+0nFQJiVke7pqXY7VdtWW2jVG31zrml+eteTP7im25FdwtLhIBTWkaHRQyPrhO2uy8glLMHZzhFog==" crossorigin="anonymous"></script>
    <!-- Toast -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="<?= base_url('assets/js/jquery/jquery.min.js') ?>"></script>
    <title><?= $product['product_name'] ?></title>

    <style>
        .navbar {
            background-color: rgb(22, 92, 157) !important;
            position: sticky;
            top: 0;
            z-index: 9999
        }

        .quantity {
            display: inline-block;

        }

        .quantity .input-text.qty {
            width: 35px;
            height: 39px;
            padding: 0 5px;
            text-align: center;
            background-color: transparent;
            border: 1px solid #efefef;
            pointer-events: none;
        }

        .quantity.buttons_added {
            text-align: left;
            position: relative;
            white-space: nowrap;
            vertical-align: top;
        }

        .quantity.buttons_added input {
            display: inline-block;
            margin: 0;
            vertical-align: top;
            box-shadow: none;
        }

        .quantity.buttons_added .minus,
        .quantity.buttons_added .plus {
            padding: 7px 10px 8px;
            height: 41px;
            background-color: #ffffff;
            border: 1px solid #efefef;
            cursor: pointer;
        }

        .quantity.buttons_added .minus {
            border-right: 0;
        }

        .quantity.buttons_added .plus {
            border-left: 0;
        }

        .quantity.buttons_added .minus:hover,
        .quantity.buttons_added .plus:hover {
            background: #eeeeee;
        }

        .quantity input::-webkit-outer-spin-button,
        .quantity input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            margin: 0;
        }

        .quantity.buttons_added .minus:focus,
        .quantity.buttons_added .plus:focus {
            outline: none;
        }

        .product_price {
            background: transparent;
            border: 0;
            border-style: none;
            border-color: transparent;
            outline: none;
            outline-offset: 0;
            box-shadow: none;
            pointer-events: none;
            display: inline-block;
            color: rgb(22, 92, 157);
            font-weight: bold;
            font-size: 30px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Pet Food</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link nav-head" href="<?= base_url('home'); ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-head" href="<?= base_url('product'); ?>">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-head" href="#contact">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-head" href="<?= base_url('blog'); ?>">Blog</a>
                    </li>
                </ul>
                <?php if ($this->session->userdata('email')) {
                ?>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="btn btn-danger btn-join dropdown-toggle 12" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="<?= base_url('auth'); ?>"><?= $this->session->userdata('first_name') ?></a>
                            <div class="dropdown-menu mt-3" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?= base_url('myorder') ?>">My Order</a>

                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
                            </div>
                        </li>
                    </ul>
                    <div class="cart-item">
                        <a class="btn btn-danger btn-join ml-2 text-white" href="<?= base_url('home/mycart') ?>">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <span class="badge badge-warning" id="cart_shop"><?= $mycart ?></span>
                        </a>
                    </div>

                <?php } else { ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-danger btn-join" href="<?= base_url('auth'); ?>">Login</a>
                        </li>
                    </ul>
                <?php } ?>

            </div>
        </div>
    </nav>


    <!-- End Navbar -->

    <!--end shopping-cart -->
    <!-- 
    </div> -->
    <!--end container -->


    <div class="container">
        <div class="backTop"><i class="fas fa-arrow-up"></i></div>

        <div class="col-lg-12 mt-4">
            <p><a href="<?= base_url('home') ?>" style="text-decoration:none">Home</a> / <a href="<?= base_url('product') ?>" style="text-decoration:none">Product</a> / <?= $product['product_name'] ?></p>
            <hr>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card border border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Your cart</h5>
                        <hr>
                        <div class="row mycart">
                            <div class="col-md-4">
                                <form id="userCart" action="" method="">
                                    <input type="hidden" value="0" id="ongkos">
                                    <img src="<?= base_url('uploads/') . $product['picture_path'] ?>" width="55%" alt="">
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex justify-content-between">
                                    <p class="font-weight-bold"><?= $product['product_name'] ?></p>
                                    <!-- <a href="#" class="btn btn-outline-danger trash" data-id="<?= $product['id'] ?>"><i class="fas fa-trash"></i></a> -->
                                </div>
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" step="1" min="1" max="" name="quantity" id="quantity" value="<?= $qty ?>" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                    <input type="button" value="+" class="plus">
                                </div>
                                <br>
                                <br>
                                <input type="text" name="product_price" class="product_price" tabindex="-1" value="Rp <?= number_format($product['price'], 0, ',', '.') ?>">
                                <!-- <h5 style="display:inline-block; color:rgb(22, 92, 157);  font-weight: bold;">Rp <?= number_format($product['price'], 0, ',', '.') ?></h5> -->
                            </div>
                        </div>
                        <hr>
                        <span class="font-weight-bold">Tujuan</span>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="">Provinsi</label>
                                <select name="province" id="province" class="form-control">

                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Kota</label>
                                <select name="city" id="city" class="form-control">

                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Expedisi</label>
                                <select name="expedition" id="expedition" class="form-control">

                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="">Expedisi</label>
                                <select name="cost" id="cost" class="form-control">

                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" required id="address" cols="30" rows="2" required></textarea>
                                <label for="note">Note</label>
                                <textarea class="form-control" id="note" name="note" required cols="30" rows="2" required></textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4 mt-md-0">
                <div class="card border border-secondary sticky-top">
                    <div class="card-body">
                        <h4>Payment method</h4>
                        <hr>
                        <input type="hidden" name="product_id" id="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="email" id="email" value="<?= $session['email'] ?>">
                        <input type="hidden" name="status" id="status" value="PROSES">
                        <input type="hidden" name="price" id="price" " value="">
                        <!-- <input type=" hidden" name="sub_total" id="sub_total" tabindex="-1" value=""> -->

                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <label for="">Pembayaran</label>
                        <select class="form-control" id="payment_method" name="payment_method" required>
                            <option value="">Pilih</option>
                            <option value="BNI">ATM BNI</option>
                            <option value="MANDIRI">ATM Mandiri</option>
                            <option value="BCA">ATM BCA</option>
                        </select>

                        <p id="method"></p>
                        <!-- <label for="address" class="mt-2">Address</label>
                            <textarea name="address" class="form-control" id="address" cols="30" rows="3"></textarea>
                            <label for="note" class="mt-2">Note</label>
                            <textarea class="form-control" id="note" name="note" cols="30" rows="3"></textarea> -->
                        <label for="" class="mt-3">
                            <p><b>Ringkasan</b></p>
                            <hr>
                        </label>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between">
                                    <span>Total Barang</span>
                                    <span id="total_barang"></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Harga Barang</span>
                                    <span id="harga_barang"></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Biaya Kirim</span>
                                    <span id="ongkos_kirim">
                                        <p id="ongkos_kirim_val" style="color:rgb(22, 92, 157); font-weight:bold">Rp. 0</p>
                                    </span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span>Subtotal</span>
                                    <span id="total_harga"></span>
                                </div>
                                <!-- <p>Total Harga</p> -->
                            </div>
                            <!-- <div class="total_harga"> -->
                            <!-- <p style="color:rgb(22, 92, 157);"><?= number_format($product['price'], 0, ',', '.') ?></p> -->
                            <!-- </div> -->
                        </div>
                        <p id="subtotal"></p>
                        <!-- <button type="submit" class="btn btn-lg btn-danger float-right mt-4">Bayar Sekarang</button> -->
                        <a href="javascript:" type="submit" id="submit-form" class="btn btn-lg btn-danger float-right mt-4">Bayar Sekarang</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- End Card -->

    <!-- Contact -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-white">
                    <h3>Contact</h3>
                    <p><i class="fas fa-map-marker-alt"></i> <span>Address : </span>Jl. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Lorem
                        Jakarta Selatan, Indonesia
                        10000</p>
                    <p><i class="fas fa-envelope"></i> <span>Email : </span> rental-123@rental.com</p>
                    <p> <i class="far fa-clock"></i> <span>Open HOURS : </span>Monday - Friday 08.00 - 21-00</p>
                    <p><i class="fab fa-facebook fa-2x"></i> <i class="fab fa-instagram-square fa-2x"></i> <i class="fab fa-youtube fa-2x"></i></p>
                </div>
                <div class="col-lg-6">
                    <div class="embed-responsive embed-responsive-16by9 gmap">
                        <iframe class="embed-responsive-item" allowfullscreen src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15864.538654896973!2d107.00964583441163!3d-6.245978918787904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7d4e5077a5198b54!2sBPJS%20Ketenagakerjaan%20Bekasi%20Kota!5e0!3m2!1sid!2sid!4v1594655236912!5m2!1sid!2sid"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact -->

    <!-- Footer -->
    <section class="footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <p>Pet Food<br>@2021 All Right reserved</p>

                </div>
            </div>
        </div>
    </section>

    <!-- End Footer -->

    <script src="<?= base_url('assets/js/popper-min.js') ?>"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Toastr JS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Datatables -->
    <!-- <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script>
        $("#payment_method").change(function() {
            var getValue = $(this).val();
            $('#method').html('');
            $('#method').append('<div class="alert alert-danger mt-2">' + getValue + '</div>')

        });
        subtotal();

        function subtotal() {
            var numFormat = new Intl.NumberFormat("en-ID");
            var price = <?= $product['price'] ?>;
            var qty = parseInt($('#quantity').val());
            var ongkos_kirim = parseInt($('#ongkos').val());
            var total = price * qty + ongkos_kirim;

            $('#total_barang').html('');
            $('#harga_barang').html('');
            $('#total_harga').html('');
            // $('#ongkos_kirim').html('');
            $('#price').val(total);
            $('#total_barang').append('<p id="total_barang_val" style="color:rgb(22, 92, 157); font-weight:bold">' + qty + '</p>');
            // $('#ongkos_kirim').append('<p id="ongkos_kirim_val" style="color:rgb(22, 92, 157); font-weight:bold">Rp. 0</p>');
            $('#harga_barang').append('<p id="harga_barang_val" style="color:rgb(22, 92, 157); font-weight:bold">Rp. ' + numFormat.format(price) + '</p>');
            $('#total_harga').append('<p id="total_harga_val" style="color:rgb(22, 92, 157); font-weight:bold">Rp. ' + numFormat.format(total) + '</p>');

        }
    </script>
    <script>
        var $backToTop = $(".backTop");
        $backToTop.hide();
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                $backToTop.fadeIn();
            } else {
                $backToTop.fadeOut();
            }
        });

        $backToTop.on('click', function(e) {
            $("html, body").animate({
                scrollTop: 0
            }, 500);
        });
    </script>
    </script>

    <script>
        function increment() {
            jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
                var c = jQuery(b);
                c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
            })
        }
        String.prototype.getDecimals || (String.prototype.getDecimals = function() {
            var a = this,
                b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
        }), jQuery(document).ready(function() {
            increment()
        }), jQuery(document).on("updated_wc_div", function() {
            increment()
        }), jQuery(document).on("click", ".plus, .minus", function() {
            var a = jQuery(this).closest(".quantity").find(".qty"),
                b = parseFloat(a.val()),
                c = parseFloat(a.attr("max")),
                d = parseFloat(a.attr("min")),
                e = a.attr("step");
            b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
            subtotal();
        });
        $(document).ready(function() {
            $('#submit-form').click(function(e) {
                e.preventDefault();
                var product_id = $('#product_id').val();
                // var status = $('#status').val();
                // var quantity = $('#quantity').val();
                // var address = $('#address').val();
                // var note = $('#note').val();
                // var subtotal = $('#subtotal').val();
                // var payment_method = $('#payment_method').val();

                $.ajax({
                    url: '<?= base_url('home/buyNow') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: $('#userCart').serialize(),

                    success: function(data) {
                        // alert(data.order_id);

                        if (data.responce == 'success') {
                            var order_id = data.order_id;

                            location.href = 'ordersuccess?order_id=' + order_id;
                            // window.location = '/home/ordersuccess?username=' + product_id;
                            // window.location.replace("http://sidanmor.com");
                        } else {
                            Swal.fire();
                        }
                    }
                });
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '<?= base_url('API_RajaOngkir/getProvince') ?>',
                type: 'post',
                success: function(res) {
                    // console.log(res)
                    $("select[name=province]").html(res);
                }
            });

            $("select[name=province]").on("change", function(e) {
                e.preventDefault();
                var province_id = $("option:selected", this).attr('province_id');

                $.ajax({
                    url: '<?= base_url('API_RajaOngkir/getCity') ?>',
                    type: 'post',
                    data: 'province_id=' + province_id,
                    success: function(res) {
                        // console.log(res);
                        $("select[name=city]").html(res);
                        $("select[name=cost]").html("<option>Pilih Kota</option>");
                    }
                });
            });

            $("select[name=city]").on("change", function(e) {
                e.preventDefault();
                $('#ongkos_kirim').html('');
                $('#ongkos').val('0');
                $('#ongkos_kirim').append('<p id="ongkos_kirim_val" style="color:rgb(22, 92, 157); font-weight:bold">Rp. 0</p>');
                subtotal();
                $.ajax({
                    url: '<?= base_url('API_RajaOngkir/getExpedition') ?>',
                    type: 'post',

                    success: function(res) {
                        console.log(res);
                        $("select[name=expedition]").html(res);
                        $("select[name=cost]").html("<option> Pilih</option>");

                    }
                })
            })

            $("select[name=expedition]").on("change", function(e) {
                e.preventDefault();
                $('#ongkos_kirim').html('');
                var id_expedition = $("select[name=expedition]").val();
                var id_city = $("option:selected", "select[name=city]").attr('city_id');
                $('#ongkos_kirim').append('<p id="ongkos_kirim_val" style="color:rgb(22, 92, 157); font-weight:bold">Rp. 0</p>');
                $('#ongkos').val('0');
                subtotal();

                // alert(id_city);
                $.ajax({
                    url: '<?= base_url('API_RajaOngkir/getCost') ?>',
                    type: 'post',
                    data: 'id_expedition=' + id_expedition + '&id_city=' + id_city,
                    success: function(res) {
                        $("select[name=cost]").html(res);
                        console.log(res);
                    }
                });
            });

            $("select[name=cost]").on("change", function(e) {
                var numFormat = new Intl.NumberFormat("en-ID");
                var data_value = $("option:selected", this).attr('data_value');
                $('#ongkos').val(data_value);

                $('#ongkos_kirim').html('');
                $('#ongkos_kirim').append('<p id="harga_barang_val" style="color:rgb(22, 92, 157); font-weight:bold">Rp. ' + numFormat.format(data_value) + '</p>');
                subtotal();
                // alert(data_value);
            })
        });
    </script>
</body>

</html>