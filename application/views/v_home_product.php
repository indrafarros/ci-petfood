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
    <title><?= $title ?></title>

    <style>
        .carousel-cell {
            width: 66%;
            /* height: 200px; */
            margin-right: 10px;
            background: #8C8;
            border-radius: 5px;
            counter-increment: gallery-cell;
        }

        /* cell number */
        .carousel-cell:before {
            display: block;
            text-align: center;
            content: counter(gallery-cell);
            line-height: 200px;
            font-size: 80px;
            color: white;
        }

        .flickity-button {
            background: transparent;
        }

        .card {
            background: #fff;
            border-top-right-radius: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            box-shadow: 0 14px 26px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease-out;
            text-decoration: none;
        }

        .card:hover {
            transform: translateY(-5px) scale(1.005) translateZ(0);
            box-shadow: 0 24px 36px rgba(0, 0, 0, 0.11),
                0 24px 46px var(--box-shadow-color);
        }

        .card:active {
            transform: scale(1) translateZ(0);
            box-shadow: 0 15px 24px rgba(0, 0, 0, 0.11),
                0 15px 24px var(--box-shadow-color);
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
                                <a class="dropdown-item" href="<?= base_url('myorder') ?>">My Order</a>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
                            </div>
                        </li>
                    </ul>
                    <div class="cart-item">
                        <a class="btn btn-danger btn-join ml-2 text-white" href="<?= base_url('pembayaran') ?>">
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
    <!-- Jumbotron -->
    <div class="jb-2">
        <div class="container">

        </div>
    </div>
    <!-- End Jumbotroon -->

    <!-- Card Info -->
    <div class="container">
        <div class="backTop"><i class="fas fa-arrow-up"></i></div>
        <!-- Panel -->
        <div class="row justify-content-center">
            <div class="col-12 panel-card">
                <div class="carousel" data-flickity='{"contain": true, "fade": true, "autoPlay": 4500, "wrapAround": true}'>
                    <div class="carousel-cell"></div>
                    <div class="carousel-cell"></div>
                    <div class="carousel-cell"></div>

                </div>
            </div>
        </div>

        <!-- End Panel -->

        <!-- carousel -->

        <section class="row content1">
            <?php foreach ($product as $pd) :
                $tmp = explode(',', $pd['picture_path']);
                $file_extension = end($tmp);
            ?>
                <div class="col-md-3 col-6 mt-3">

                    <a href="<?= base_url('product/') . $pd['slug']  ?>" style="text-decoration:none">
                        <div class="card h-100">
                            <img src="<?= base_url('uploads/') . $file_extension ?>" class="card-img-top mb-1 mt-1 p-2" style="object-fit: cover; max-height: 160px; width: 180px; border-radius: 10px">
                            <div class="card-body">
                                <div class="justify-content-between mb-0 px-3" style=" height: 40%"> <small class="text-muted mt-1"><b><?= $pd['product_name'] ?> </b></small>
                                </div>
                                <hr class="mt-2">
                                <div class="px-3 pb-4">
                                    <h5 style="display:inline-block; color:rgb(22, 92, 157);  font-weight: bold;">Rp <?= number_format($pd['price'], 0, ',', '.') ?></h5>
                                    <!-- <div class="d-flex flex-column"><span class="text-muted">Fuel Efficiency</span><small class="text-muted">L/100KM&ast;</small></div> -->
                                </div>

                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </section>



        <section class="row content1">

            <?php foreach ($product as $pd) :
                $tmp = explode(',', $pd['picture_path']);
                $file_extension = end($tmp);
            ?>
                <div class="col-md-3 col-6 mt-3">
                    <a href="<?= base_url('product/') . $pd['slug']  ?>" style="text-decoration:none">
                        <div class="card h-100">
                            <img src="<?= base_url('uploads/') . $file_extension ?>" class="card-img-top mb-1 mt-1 p-2" style="object-fit: cover; max-height: 160px; width: 180px; border-radius: 10px">
                            <div class="card-body">
                                <div class="justify-content-between mb-0 px-3" style=" height: 40%"> <small class="text-muted mt-1"><b><?= $pd['product_name'] ?> </b></small>
                                </div>
                                <hr class="mt-2">
                                <div class="px-3 pb-4">
                                    <h5 style="display:inline-block; color:rgb(22, 92, 157);  font-weight: bold;">Rp <?= number_format($pd['price'], 0, ',', '.') ?></h5>
                                    <!-- <div class="d-flex flex-column"><span class="text-muted">Fuel Efficiency</span><small class="text-muted">L/100KM&ast;</small></div> -->
                                </div>

                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </section>

        <!-- <section class="row content1">
            <div class="col-lg-12 text-center mb-3">
                <p class="text-center" style="font-weight: 900; font-size: 40px">Type of Food </p>
            </div>
            <div class="col-lg-6 text-center">
                <img src="<?= base_url('uploads/16128758696022885d8dafc.jpg') ?>" class="img-fluid" width="30%" alt="">
                <h2 class="text-center"><span>Dry</span></h2>
                <p>The best camera for you will vary based on whether or not you'll use the camera daily, monthly, or only a couple of times annually. The more you use the camera, the more it makes sense to invest hundreds of dollars in it</p>
                <a href="" class="btn btn-danger">See more</a>
            </div>
            <div class="col-lg-6 text-center">
                <img src="<?= base_url('uploads/16128758696022885d8dafc.jpg') ?>" class="img-fluid" width="30%" alt="">
                <h2 class="text-center"><span>Wet</span></h2>
                <p>The best camera for you will vary based on whether or not you'll use the camera daily, monthly, or only a couple of times annually. The more you use the camera, the more it makes sense to invest hundreds of dollars in it</p>
                <a href="" class="btn btn-danger">See more</a>
            </div>
        </section> -->

        <section class="content3">

        </section>

        <!-- Content 2 -->
        <!-- <section class="content2">
            <div class="row text-center title">
                <div class="col-12">
                    <h3>Why rent a camera through us ?</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row text-center quote">
                                <div class="col-lg-3">
                                    <i class="fas fa-cash-register fa-4x"></i>
                                    <h4>Easy Payment</h4>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus quis libero, ipsam cumque nesciunt aperiam unde</p>
                                </div>
                                <div class="col-lg-3">
                                    <i class="fas fa-money-bill-alt fa-4x"></i>
                                    <h4>Lowest Price</h4>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus quis libero, ipsam cumque nesciunt aperiam unde</p>
                                </div>
                                <div class="col-lg-3">
                                    <i class="fas fa-camera fa-4x"></i>
                                    <h4>Lots Of Choices</h4>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus quis libero, ipsam cumque nesciunt aperiam unde</p>
                                </div>
                                <div class="col-lg-3">
                                    <i class="fas fa-comment-dots fa-4x"></i>
                                    <h4>24 Hour Support</h4>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus quis libero, ipsam cumque nesciunt aperiam unde</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End Content 2 -->

        <!-- Content 3 -->

        <!-- End Content 3 -->

        <!-- Content 4 -->
        <section class="content4">

        </section>
        <!-- End Content 4 -->

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
</body>

</html>