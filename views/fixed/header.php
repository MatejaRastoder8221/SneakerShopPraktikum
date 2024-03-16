<body>
    <!--? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                        </div>
                        <!-- Main-menu -->
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul id="navigation">

                                    <!-- ispis iz js-a-->
                                </ul>
                            </nav>
                        </div>
                        <!-- Header Right -->
                        <div class="header-right">
                            <ul>
                                <?php
                                if (isset($_SESSION['user'])) {

                                    echo '
                                        <a href="index.php?page=cart"><i class="mojaIkonica fas fa-shopping-cart"></i></a>
                                        <a href="index.php?page=logout"><i class="mojaIkonica fas fa-sign-out-alt"></i></a>
                                        ';
                                } else {
                                    echo '<a href="index.php?page=login"><i class="fas fa-user mojaIkonica"></i></a>';
                                }
                                ?>


                            </ul>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>