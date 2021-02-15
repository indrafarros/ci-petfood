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
    <title><?= $title ?></title>

    <style>
        h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }



        .bulet {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }

        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }

        .navbar {
            background-color: rgb(22, 92, 157) !important;
            /* position: sticky; */
            top: 0;
            z-index: 1020
        }
    </style>

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light ">
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
                        <a class="nav-link nav-head" href="<?= base_url('about'); ?>">Contacts</a>
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


    <!-- Card Info -->
    <div class="container">
        <div class="backTop"><i class="fas fa-arrow-up"></i></div>
        <div class="col-lg-12 mt-4">
            <p><a href="<?= base_url('home') ?>" style="text-decoration:none">Home</a> / My Order</p>
            <hr>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card border border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Your cart</h5>
                        <hr>
                        <div class="row">
                            <table class="table table-borderless table-responsive">
                                <tbody>
                                    <?php
                                    $value = 0;
                                    $value_qty = 0;
                                    foreach ($product as $me) :

                                    ?>

                                        <tr>
                                            <td class="w-25"><img class="img-fluid" src="<?= base_url('uploads/') . $me['picture_path'] ?>" /></td>
                                            <!-- <td> <img src="<?= base_url('uploads/') . $me['picture_path'] ?>" class="img-responsive" style="width:250px" alt=""></td> -->
                                            <td class="text-center"><?= $me['product_name'] ?></td>
                                            <td class="text-center"> <?= $me['qty'] ?></td>
                                            <td class="float-right"><?= $me['sub_total'] ?></td>
                                            <td class="text-center"><a href="#" class="text-danger trash"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                    <?php
                                        $value += $me['sub_total'];
                                        $value_qty += $me['qty'];
                                    endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
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
                            <div class="col-md-6 mt-3">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" required id="address" cols="30" rows="2" required></textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="note">Note</label>
                                <textarea class="form-control" id="note" name="note" required cols="30" rows="2" required></textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Total Barang</span>
                                        <span id="total_barang" style="color:rgb(22, 92, 157); font-weight:bold"><?= $value_qty ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Biaya Kirim</span>
                                        <span id="ongkos_kirim" style="color:rgb(22, 92, 157); font-weight:bold">Rp. 0</span>
                                        <input type="hidden" value="0" id="ongkos">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Subtotal</span>
                                        <span id="total_harga" style="color:rgb(22, 92, 157); font-weight:bold">Rp. <?= number_format($value, 0, '.', ',') ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="float-right">
                                    <input type="hidden" id="value" value="<?= $value ?>">
                                    <input type="hidden" id="value_qty" value="<?= $value_qty ?>">
                                    <button type="button" class="btn btn-outline-danger btn-md"> Bayar Sekarang </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- End Card -->

    <!-- Contact -->
    <section class="contact">
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


    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>


    <script>
        // subtotal();
        $(document).on("click", ".trash", function(e) {
            e.preventDefault();

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
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })

        function subtotal() {
            var numFormat = new Intl.NumberFormat("en-ID");
            var price = parseInt($('#value').val());
            var qty = parseInt($('#value_qty').val());
            var ongkos_kirim = parseInt($('#ongkos').val());
            // var total = price * qty + ongkos_kirim;
            var total = ongkos_kirim + price;
            // $('#total_barang').html('');

            $('#total_harga').html('');
            // $('#price').val(total);
            // $('#total_barang').append('<p id="total_barang_val" style="color:rgb(22, 92, 157); font-weight:bold">' + qty + '</p>');
            $('#total_harga').append('<p id="total_harga_val" style="color:rgb(22, 92, 157); font-weight:bold">Rp. ' + numFormat.format(total) + '</p>');

        }

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
                $('#ongkos_kirim').append('<span id="ongkos_kirim_val" style="color:rgb(22, 92, 157); font-weight:bold">Rp. 0</span>');
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
                $('#ongkos_kirim').append('<span id="ongkos_kirim_val" style="color:rgb(22, 92, 157); font-weight:bold">Rp. 0</span>');
                $('#ongkos').val('0');
                subtotal();

                // alert(id_city);
                $.ajax({
                    url: '<?= base_url('API_RajaOngkir/getCost') ?>',
                    type: 'post',
                    data: 'id_expedition=' + id_expedition + '&id_city=' + id_city,
                    success: function(res) {
                        $("select[name=cost]").html(res);
                        // console.log(res);
                    }
                });
            });

            $("select[name=cost]").on("change", function(e) {
                var numFormat = new Intl.NumberFormat("en-ID");
                var data_value = $("option:selected", this).attr('data_value');
                $('#ongkos').val(data_value);

                $('#ongkos_kirim').html('');
                $('#ongkos_kirim').append('<span id="harga_barang_val" style="color:rgb(22, 92, 157); font-weight:bold">Rp. ' + numFormat.format(data_value) + '</span>');
                subtotal();
                // alert(data_value);
            })
        });
    </script>
</body>

</html>