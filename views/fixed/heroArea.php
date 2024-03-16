<!-- Hero Area Start-->
<div class="slider-area ">
    <div class="single-slider slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>
                            <?php
                            if (isset($_GET['page'])) {

                                switch ($page) {

                                    case "shop":
                                        echo "Shop";
                                        break;
                                    case "Documentation":
                                        echo "Documentation";
                                        break;
                                    case "about":
                                        echo "About";
                                        break;
                                    case "contact":
                                        echo "Contact";
                                        break;
                                    case "login":
                                        echo "Login";
                                        break;
                                    case "register":
                                        echo "Register now and become our member";
                                        break;
                                    default:
                                        echo 'nesto';
                                }
                            }
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero Area End-->