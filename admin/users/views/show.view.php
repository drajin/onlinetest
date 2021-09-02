<main class="container">
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="row">
        <div class="col-md-8 d-flex flex-column justify-content-center align-items-center">
            <br><br>
            <h1><?php echo $user->first_name .' '. $user->last_name; ?></h1>
            <p class="lead"><?php echo $user->email?></p>
            <p class="fs-4">Score: <span class="badge bg-secondary "><?php echo $user->score ?></span></p>
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
                        <a href="<?php echo URLROOT ?>/admin/users/edit.php?id=<?php echo $user->id; ?>" class="btn btn-block">Edit</a>
                    </div>
                    <div class="col-sm-6">
                        <form method="POST" action="<?php echo URLROOT ?>/admin/users/delete.php?id=<?php echo $user->id; ?>">
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
</div>