<main>
    <?php
    require_once 'views/fixed/heroArea.php';

    if (isset($_SESSION['uspesnaRegistracija'])) {

        echo '<div class="alert alert-success text-center mt-4" role="alert">
        Registration successful! <br> Check your email, we have sent you activation link!
        </div>';

        unset($_SESSION['uspesnaRegistracija']);
    }

    if (isset($_SESSION['uspesnaVerifikacija'])) {
        echo '<div class="alert alert-success text-center mt-4" role="alert">
        Activation successful! <br> You can login now!
        </div>';

        unset($_SESSION['uspesnaVerifikacija']);
    }

    if (isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        echo '<div class="alert alert-warning text-center mt-4" role="alert">';
        echo $errors;
        echo '</div>';

        unset($_SESSION['errors']);
    } elseif (isset($_SESSION['userErrors'])) {
        $errors = $_SESSION['userErrors'];
        echo '<div class="alert alert-warning text-center mt-4" role="alert">';
        foreach ($errors as $e) {
            echo $e;
        }
        echo '</div>';

        unset($_SESSION['userErrors']);
    }
    ?>
    <section class="login_part section_padding ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>New to our Shop?</h2>
                            <p>There are advances being made in science and technology
                                everyday, and a good example of this is the</p>
                            <a href="index.php?page=register" class="btn_3">Create an Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Welcome Back ! <br>
                                Please Sign in now</h3>
                            <form class="row contact_form" onsubmit="return proveraLogovanje();" action="models/loginCheck.php" method="post">
                                <div class="col-md-12 form-group p_star">
                                    <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
                                </div>
                                <span class="col-md-12 form-group invisible" id="emailError">
                                    Enter valid email.
                                </span>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
                                </div>
                                <span class="col-md-12 form-group invisible" id="passwordError">
                                    Incorrect password.
                                </span>
                                <div class="col-md-12 form-group">
                                    <button type="submit" value="submit" name="btnLogin" id="btnLogin" class="btn_3">
                                        log in
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>