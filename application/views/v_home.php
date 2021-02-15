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
        /* .navbar {
            background-color: rgb(22, 92, 157) !important;
        } */
        .navbar {
            background-color: rgb(22, 92, 157) !important;
            position: sticky;
            top: 0;
            z-index: 1020
        }

        .product-img {
            width: 12%;
            padding: 5px;
        }

        .carousel-cell {

            width: 100%;
            /* height: 200px; */
            margin-right: 50px;
            background: #8C8;
            border-radius: 10px;
            counter-increment: gallery-cell;
            color: white;
        }

        /* cell number */
        .carousel-cell:before {
            display: block;
            text-align: center;
            content: counter(gallery-cell);
            line-height: 300px;
            font-size: 80px;

        }

        .flickity-button {
            background: transparent;
        }

        .car-panel {
            background-color: #fff;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
            /* border-radius: 5px; */
            /* margin-top: -205px; */
            background-image: linear-gradient(to bottom, rgb(22, 92, 157), rgba(0, 0, 0, 0.1));
            padding: 25px;
        }


        .flickity-page-dots {
            bottom: -22px;
        }

        /* dots are lines */
        .flickity-page-dots .dot {
            height: 4px;
            width: 40px;
            margin: 0;
            border-radius: 0;
        }

        .flickity-button {
            background: transparent;
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
    <!-- Jumbotron -->
    <div class="carosh">
        <div style=" width:100% !important">
            <div class="col-12 car-panel">
                <div class="carousel" data-flickity='{"fade": true, "wrapAround": true, "autoPlay": 4500}'>
                    <div class="carousel-cell"></div>
                    <div class="carousel-cell"></div>
                    <div class="carousel-cell"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Jumbotroon -->

    <!-- <section class="row justify-content-center" style="width: 100%!important">
        <div style="margin-left: 30px; width:100% !important">
            <div class="col-12 car-panel">
                <div class="carousel" data-flickity='{"fade": true, "wrapAround": true, "autoPlay": 4500}'>
                    <div class="carousel-cell"></div>
                    <div class="carousel-cell"></div>
                    <div class="carousel-cell"></div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- <section class="row justify-content-center">
        <div style="width:90% !important">
            <div class="col-12 card shadow-sm" style="margin-top: -205px;">
                <div class="carousel p-4" data-flickity='{"fade": true, "wrapAround": true, "autoPlay": 4500}'>
                    <div class="carousel-cell"></div>
                    <div class="carousel-cell"></div>
                    <div class="carousel-cell"></div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Card Info -->
    <div class="container">
        <div class="backTop"><i class="fas fa-arrow-up"></i></div>

        <!-- Panel -->
        <!-- <div class="row justify-content-center">
            <div class="col-12 panel-card" style="margin-top: -200px!important">
                <div class="carousel" data-flickity='{"contain": true, "fade": true, "autoPlay": 4500, "wrapAround": true}'>
                    <div class="carousel-cell"></div>
                    <div class="carousel-cell"></div>
                    <div class="carousel-cell"></div>
                </div>
            </div>
        </div> -->

        <!-- End Panel -->

        <!-- Content -->
        <div class="row content1 shadow-sm">
            <div class="col-lg-6">
                <h2>Give your buddy best <span>food</span></h2>
                <p style="font-size: 22px; font-weight: 400;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat ipsam debitis illo accusamus sit ipsa fugiat expedita ea saepe nemo earum sequi libero illum omnis enim rerum reiciendis, eveniet aspernatur.</p>
            </div>
            <div class="col-lg-6 text-center">
                <img src="<?= base_url('assets/img/content/petdog.jpg') ?>" alt="Content1" class="img-fluid">
            </div>
        </div>

        <section class="row content1">
            <div class="col-lg-12 text-center">
                <p class="text-center" style="font-weight: 900; font-size: 34px; color:#EA2D1D">Provide nutrition for health. Enrich his life </p>
                <p class="text-center" style="font-weight: 400; font-size: 22px; ">Get the nutritional and health advice you will need to help your cat thrive at every stage of its life. Explore the various articles, information and guides below! </p>
                <a href="" class="btn btn-secondary btn-lg" style="border-radius: 50px">See more </a>
            </div>
        </section>
        <!-- End Content 1-->

        <!-- Content  -->
        <section class="row content1 shadow-sm">
            <div class="col-lg-6 text-center">
                <img src="<?= base_url('assets/img/content/cat-birman.jfif') ?>" style="height: 300px" alt="Content1" class="img-fluid">
            </div>
            <div class="col-lg-6">
                <h2>Healthy start in<span> life</span></h2>
                <p style="font-size: 22px; font-weight: 400;">Kitten childhood is full of profound changes in physique and behavior, and it has to deal with a difficult learning curve for new owners. Find out how you can give your kitten the best start in life so that they develop into strong, healthy cats. </p>
            </div>
        </section>
        <!-- End Content  -->


        <section class="row content1 shadow-sm">
            <div class="col-lg-12 text-center">
                <p class="text-center" style="font-weight: 900; font-size: 28px">Product Brand </p>
                <img src="<?= base_url('assets/img/brand/royal-canin.png') ?>" alt="" class="product-img">
                <img src="<?= base_url('assets/img/brand/american-journey.png') ?>" alt="" class="product-img">
                <img src="<?= base_url('assets/img/brand/Tile-Orijen.jpg') ?>" alt="" class="product-img">
                <img src="<?= base_url('assets/img/brand/Tile-Acana-4-updated.jpg') ?>" alt="" class="product-img">
                <img src="<?= base_url('assets/img/brand/Nulo-1x.jpg') ?>" alt="" class="product-img">
                <img src="<?= base_url('assets/img/brand/kong.png') ?>" alt="" class="product-img">
            </div>
        </section>

        <section class="row content1 shadow-sm">
            <div class="col-lg-12 text-center mb-3">
                <p class="text-center" style="font-weight: 900; font-size: 40px">Type of Food </p>
            </div>
            <div class="col-lg-6 text-center">
                <h2 class="text-center"><span>Dry</span></h2>
                <img src="<?= base_url('uploads/16128758696022885d8dafc.jpg') ?>" class="img-fluid" width="30%" alt="">
                <p style="font-size: 16px; font-weight: 400;">The best camera for you will vary based on whether or not you'll use the camera daily, monthly, or only a couple of times annually. The more you use the camera, the more it makes sense to invest hundreds of dollars in it</p>
                <a href="" class="btn btn-danger">See more</a>
            </div>
            <div class="col-lg-6 text-center">
                <h2 class="text-center"><span>Wet</span></h2>
                <img src="<?= base_url('uploads/16128758696022885d8dafc.jpg') ?>" class="img-fluid" width="30%" alt="">
                <p style="font-size: 16px; font-weight: 400;">The best camera for you will vary based on whether or not you'll use the camera daily, monthly, or only a couple of times annually. The more you use the camera, the more it makes sense to invest hundreds of dollars in it</p>
                <a href="" class="btn btn-danger">See more</a>
            </div>
        </section>

        <!-- Content 3 -->
        <!-- <section class="content3">

        </section> -->
        <!-- End Content 3 -->

        <!-- Content 4 -->

        <!-- End Content 4 -->

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