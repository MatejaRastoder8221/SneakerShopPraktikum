<main>
    <?php
    require_once 'views/fixed/heroArea.php';

    if (isset($_SESSION['errorsDB'])) {
        echo '<div class="alert alert-danger text-center mt-4" role="alert">
        Server error! <br> Contact administrator for help!
        </div>';

        unset($_SESSION['errorsDB']);
    }


    if (isset($_SESSION['userErrors'])) {
        $data = $_SESSION['userErrors'];
        echo '<div class="alert alert-warning text-center mt-4" role="alert">';
        foreach ($data as $e) {
            echo $e . '<br>';
        }
        echo '</div>';

        unset($_SESSION['userErrors']);
    }
    ?>

    <section class="login_part section_padding ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Welcome ! <br>
                                Please Register Now</h3>
                            <form class="row contact_form" onsubmit="return proveraRegistracije();" action="models/registrationInsert.php" method="post">
                                <!-- name -->
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="name" name="name" value="" placeholder="Name">
                                </div>
                                <span class="col-md-12 form-group invisible" id="imeError">
                                    Enter valid name. Must contain first letter uppercase and at least 3 characters
                                </span>
                                <!-- lastname -->
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="" placeholder="Lastname">
                                </div>
                                <span class="col-md-12 form-group invisible" id="lastNameError">
                                    Enter valid lastname. Must contain first letter uppercase and at least 3 characters
                                </span>
                                <!-- email -->
                                <div class="col-md-12 form-group p_star">
                                    <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
                                </div>
                                <span class="col-md-12 form-group invisible" id="emailError">
                                    Enter valid email.
                                </span>
                                <!-- password -->
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
                                </div>
                                <span class="col-md-12 form-group invisible" id="passwordError">
                                    Enter valid password. Must contain first letter uppercase and at least 6 characters
                                </span>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="testpassword" name="testpassword" value="" placeholder="Re-enter password">
                                </div>
                                <span class="col-md-12 form-group invisible" id="testPasswordError">
                                    Re-type correctly password!
                                </span>
                                <div class="col-md-12 form-group">
                                    <!-- <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" id="f-option" name="selector">
                                        <label for="f-option">Remember me</label>
                                    </div> -->
                                    <button type="submit" value="submit" name="btnRegister" id="btnRegister" class="btn_3">
                                        Register
                                    </button>
                                    <!-- <a class="lost_pass" href="#">forget password?</a> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>