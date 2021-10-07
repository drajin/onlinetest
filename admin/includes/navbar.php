

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Main navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo URLROOT ?>/admin">Home</a>
        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($users)){ echo 'active';} ?>"
                       href="<?php echo URLROOT ?>/admin/users/index.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($questions)){ echo 'active';} ?>"
                       href="<?php echo URLROOT ?>/admin/questions/index.php">Quiz questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($results)){ echo 'active';} ?>"
                       href="#">Results</a>
<!--                       href="--><?php //echo URLROOT ?><!--/admin/results.php">Results</a>-->
                </li>
            </ul>
            <a href="<?php echo URLROOT ?>/admin/logout.php" class="btn logoutBtn" role="button" aria-pressed="true">Logout</a>
        </div>
    </div>
</nav>