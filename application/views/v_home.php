<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery -->
    <script src="<?= base_url('assets/js/jquery/jquery.min.js') ?>"></script>
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
    <title><?= $title ?></title>
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
                        <a class="nav-link nav-head" href="<?= base_url('product'); ?>">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-head" href="<?= base_url('about'); ?>">About</a>
                    </li>
                </ul>
                <?php if ($this->session->userdata('email')) {
                ?>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="btn btn-danger btn-join dropdown-toggle 12" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="<?= base_url('auth'); ?>"><?= $user['fullname']; ?></a>
                            <div class="dropdown-menu mt-3" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?= base_url('auth') ?>">My Dashboard</a>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
                            </div>
                        </li>
                    </ul>
                    <div class="cart-item">
                        <a class="btn btn-danger btn-join ml-2 text-white" href="<?= base_url('pembayaran') ?>">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <span class="badge badge-warning" id="cart_shop"><?= $count_cart ?></span>
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
    <div class="jumbotron jb-1 jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">You can’t use up <span>creativity.</span><br> The more you use, <br>the more you have.</h1>
            <a href="" class="btn btn-danger btn-join float-right">Shop Now</a>
        </div>
    </div>
    <!-- End Jumbotroon -->

    <!-- Card Info -->
    <div class="container">
        <div class="backTop">Top</div>
        <!-- Panel -->
        <div class="row justify-content-center">
            <div class="col-10 panel-card">
                <div class="row text-center">
                    <div class="col-lg">
                        <i class="fas fa-truck fa-4x float-left"></i>
                        <h4>Free Delivery</h4>

                    </div>
                    <div class="col-lg">
                        <i class="far fa-clock fa-4x float-left"></i>
                        <h4>24 Hours</h4>

                    </div>
                    <div class="col-lg">
                        <i class="fas fa-money-bill-alt fa-4x float-left"></i>
                        <h4>Pay Latter</h4>

                    </div>
                </div>
            </div>
        </div>

        <!-- End Panel -->

        <!-- Content -->
        <div class="row content1">
            <div class="col-lg-6">
                <h2>Choose your own <span>camera</span></h2>
                <p>The best camera for you will vary based on whether or not you'll use the camera daily, monthly, or only a couple of times annually. The more you use the camera, the more it makes sense to invest hundreds of dollars in it</p>
            </div>
            <div class="col-lg-6">
                <img src="<?= base_url('assets/img/content/content-1.jpg') ?>" alt="Content1" class="img-fluid">
            </div>
        </div>

        <!-- End Content 1-->

        <!-- Content 2 -->
        <section class="content2">
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
        </section>
        <!-- End Content 2 -->

        <!-- Content 3 -->
        <section class="content3">
            <div class="row justify-content-center">
                <div class="col-12 justify-content-center d-flex">
                    <h3>What are they saying ?</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6  justify-content-center d-flex">
                    <figure class="figure">
                        <img src="<?= base_url('assets/img/content/foto-3.jpg') ?>" class="figure-img img-fluid rounded-circle" alt="Pembeli 1">
                    </figure>
                    <figure class="figure">
                        <img src="<?= base_url('assets/img/content/foto-1.png') ?>" class="figure-img img-fluid rounded-circle first" alt="Pembeli 2">
                        <figcaption class="figure-caption">
                            <h5>Putri</h5>
                            <p>"Good quality"</p>
                        </figcaption>
                    </figure>
                    <figure class="figure">
                        <img src="<?= base_url('assets/img/content/foto-4.jpg') ?>" class="figure-img img-fluid rounded-circle" alt="Pembeli 3">
                    </figure>
                </div>
            </div>
        </section>
        <!-- End Content 3 -->

        <!-- Content 4 -->
        <section class="content4">
            <div class="row">
                <div class="col-lg-6">
                    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?= base_url('assets/img/content/camera-1.jpg'); ?>" class="d-block w-100" alt="Camera1">
                                <div class="carousel-caption d-none d-md-block">
                                    <a href="" class="btn btn-primary ">Rent this camera</a>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="<?= base_url('assets/img/content/camera-2.jpg'); ?>" class="d-block w-100" alt="Camera2">
                                <div class="carousel-caption d-none d-md-block">
                                    <a href="" class="btn btn-primary ">Rent this camera</a>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="<?= base_url('assets/img/content/camera-3.jpg'); ?>" class="d-block w-100" alt="Camera3">
                                <div class="carousel-caption d-none d-md-block">
                                    <a href="" class="btn btn-primary ">Rent this camera</a>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="<?= base_url('assets/img/content/camera-4.jpg'); ?>" class="d-block w-100" alt="Camera3">
                                <div class="carousel-caption d-none d-md-block">
                                    <a href="" class="btn btn-primary ">Rent this camera</a>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 car-quote">
                    <h3>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h3>
                    <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis iure commodi alias nemo ex totam repellendus non quas esse corrupti minima amet fuga quam, dicta voluptas dolore, molestias reprehenderit et?</p>
                    <a href="" class="btn btn-primary mt-4">See all cameras</a>
                </div>
            </div>
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
                    <p>RENTAL KAMERA<br>@2020 All Right reserved</p>

                </div>
            </div>
        </div>
    </section>

    <!-- End Footer -->

    <script src="<?= base_url('assets/js/popper-min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Toastr JS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Datatables -->
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

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