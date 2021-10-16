<main class="container">
    <!--        alert-->
    <?php echo ($session->display_session_message()); ?>
<!--    <section>-->
<!--        <div class="row">-->
<!--            <div class="col-6 offset-3 mt-3">-->
<!--                <div class="alert alert-warning text-center" role="alert">Zasto se iskezi</div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--    <section>-->
<!--        <div id="alerts">-->
<!--            <div class="row">-->
<!--                <div class="alerts d-flex justify-content-center">-->
<!--                    --><?php //echo ($session->display_session_message()); ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->



<div class="my-3 p-3 transparent rounded shadow-sm">

            <h1 class="display-4 text-center m-3 p-3">Online Test - Admin Area</h1>
            <h3 class="text-center mb-5">Please Log In</h3>

        <!--login form-->
        <div id="loginViewAdmin">
        <div class="row">
            <div class="col-6 offset-3">
                <form id="login" action="login.php" name="login" method ="POST">
                    <input id="emailLogin" type="text" placeholder="Email" name="email" class="form-control <?php echo (!empty($admin->email_error)) ? 'is-invalid' : '' ?>"
                           value="<?php echo (!empty($admin->email)) ? $admin->email : '' ?>">
                    <div class="invalid-feedback"><?php echo $admin->email_error?></div>
                        <br>
                    <input id="passwordLogin" type="password" placeholder="Password" name="password" class="form-control <?php echo (!empty($admin->password_error)) ? 'is-invalid' : '' ?>"
                           value="<?php echo (!empty($admin->password)) ? $admin->password : '' ?>">
                    <div class="invalid-feedback"><?php echo $admin->password_error?></div>
                        <br>
                        <button id="submitLogin" class="btn btn-outline-secondary form-control mb-3" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

