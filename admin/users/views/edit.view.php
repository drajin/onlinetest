<main class="container">
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row">
            <div class="col-md-7 offset-1">
                <h1>Edit User</h1>
                <hr>
                <form method='post' action="" enctype="multipart/form-data">
                    <br><br>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input name="first_name" id="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input name="last_name" id="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" id="email" class="form-control" value="<?php echo $user->email; ?>">
                    </div>
                    <br>
                    <button id="submitLogin" class="btn btn-outline-secondary form-control mb-3" type="submit">Submit</button>
                </form>
    </div>
            <div class="col-md-4 text-dark">
                <div class="card card-body bg-light">
                    <dl class="dl-horizontal">
                        <dt>Created At:</dt>
                        <dd><?php echo $user->created_at; ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Updated At:</dt>
                        <dd><?php echo $user->updated_at; ?></dd>
                    </dl>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <a href="" class="btn btn-block">Edit</a>
                        </div>
                        <div class="col-sm-6">
                            <form method="POST" action="">
                                <input type="hidden" name="_method" value="delete">
                                <div id="operations">
                                    <input type="submit" name="commit" class="btn btn-block" value="Delete" />
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12">
                            <a class="btn btn-block btn-h1-spacing" role="button"  href="<?php echo URLROOT ?>/admin/users/index.php">Back to Index</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>