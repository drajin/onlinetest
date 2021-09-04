<main class="container">
<div class="my-3 p-3 transparent rounded shadow-sm">

            <h1 class="display-4 text-center m-3 p-3">Online Test - Admin Area</h1>
            <h3 class="text-center mb-5">Please Log In</h3>

<!--        alert-->
        <section>
            <div class="row">
                <div class="col-6 offset-3">
                    <?php echo $session->display_session_message(); ?>
                </div>
            </div>
        </section>

        <!--login form-->
        <div id="loginView">
        <div class="row">
            <div class="col-6 offset-3">
                <form id="login" action="login.php" name="login" method ="POST">
                    <input id="emailLogin" type="text" placeholder="Email" name="email" class="form-control <?php echo (!empty($admin_data['email_error'])) ? 'is-invalid' : '' ?>"
                           value="<?php echo (!empty($admin_data['email'])) ? $admin_data['email'] : '' ?>">
                    <div class="invalid-feedback"><?php echo $admin_data['email_error']?></div>
                        <br>
                    <input id="passwordLogin" type="password" placeholder="Password" name="password" class="form-control <?php echo (!empty($admin_data['password_error'])) ? 'is-invalid' : '' ?>"
                           value="<?php echo (!empty($admin_data['password'])) ? $admin_data['password'] : '' ?>">
                    <div class="invalid-feedback"><?php echo $admin_data['password_error']?></div>
                        <br>
                        <button id="submitLogin" class="btn btn-outline-secondary form-control mb-3" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

