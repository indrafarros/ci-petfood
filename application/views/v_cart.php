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
        }

        .qty .hitung {
            color: #555;
            display: inline-block;
            vertical-align: top;
            font-size: 18px;
            font-weight: 300;
            line-height: 30px;
            padding: 0 2px;
            min-width: 35px;
            text-align: center;
            border: 0;
            width: 2%;
        }

        .qty .plus {
            cursor: pointer;
            display: inline-block;
            vertical-align: top;
            /* background:#eee; */
            border: #ddd solid 1px;
            color: #999;
            width: 30px;
            height: 30px;
            border-radius: 5px;
            font: 26px/1 "Arial", sans-serif;
            text-align: center;
        }


        .qty .minus {
            cursor: pointer;
            display: inline-block;
            vertical-align: top;
            /* background:#eee; */
            border: #ddd solid 1px;
            color: #999;
            width: 30px;
            height: 30px;
            font: 26px/1 "Arial", sans-serif;
            text-align: center;
            border-radius: 5px;
            background-clip: padding-box;
        }

        .minus:hover {
            background-color: #eee !important;
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
                        <a class="nav-link nav-head" href="<?= base_url('about'); ?>">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-head" href="<?= base_url('about'); ?>">Blogs</a>
                    </li>
                </ul>
                <?php if ($this->session->userdata('email')) {
                ?>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="btn btn-danger btn-join dropdown-toggle 12" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="<?= base_url('auth'); ?>"><?= $this->session->userdata('first_name') ?></a>
                            <div class="dropdown-menu mt-3" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?= base_url('auth') ?>">My Dashboard</a>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
                            </div>
                        </li>
                    </ul>
                    <div class="cart-item">
                        <a class="btn btn-danger btn-join ml-2 text-white" href="<?= base_url('pembayaran') ?>">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <span class="badge badge-warning" id="cart_shop">0</span>
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

        <!-- navbar -->

        <div class="col-lg-12 mt-4">
            <p><a href="<?= base_url('home') ?>" style="text-decoration:none">Home</a> / <a href="<?= base_url('product') ?>" style="text-decoration:none">Product</a> / <?= $product['product_name'] ?></p>
            <hr>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div>
                            <div class="container">
                                <img src="<?= base_url('uploads/') . $product['picture_path'] ?>" alt="<?= $product['product_name'] ?>" class="img-fluid text-center" style="width:70%;" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-10">
                                <h4>
                                    <?= $product['product_name'] ?> </h4>
                            </div>
                        </div>
                        <br>
                        <h5 style="display:inline-block; color:rgb(22, 92, 157);  font-weight: bold;">Rp <?= number_format($product['price'], 0, ',', '.') ?></h5>
                        <hr class="mt-0">
                        <div class="qty mt-3">
                            <span class="minus">-</span>
                            <input type="number" class="hitung" name="qty" value="1">
                            <span class="plus">+</span>
                        </div>
                        <hr class="mb-0">
                        <br>
                        <?php if ($this->session->userdata('email')) {

                            echo '<a href="' . base_url('home/add_to_cart') . '" class="btn btn-danger"> <i class="fas fa-shopping-cart"></i> Beli Sekarang</a>';
                        } else {
                            echo '<a href="' . base_url('auth/login') . '" class="btn btn-danger checkUser"> <i class="fas fa-shopping-cart"></i> Beli Sekarang</a>';
                        }

                        ?>

                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content3">

    </section>

    <!-- Content 2 -->

    <!-- End Content 2 -->



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

    <!-- Datatables -->
    <!-- <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script>
        // $('.checkUser').on('click', function(e) {
        //     var user = <?= $session['is_login'] ?>;
        //     if (user == true) {

        //     } else {
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Oops...',
        //             text: 'Something went wrong!',
        //             footer: '<a href>Why do I have this issue?</a>'
        //         })

        //     }
        // });

        // function add_to_cart() {


        // }
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

        $(document).ready(function() {
            $('.hitung').prop('disabled', true);
            $(document).on('click', '.plus', function() {
                $('.hitung').val(parseInt($('.hitung').val()) + 1);
            });
            $(document).on('click', '.minus', function() {
                $('.hitung').val(parseInt($('.hitung').val()) - 1);
                if ($('.hitung').val() == 0) {
                    $('.hitung').val(1);
                }
            });
        });
    </script>
</body>

</html>