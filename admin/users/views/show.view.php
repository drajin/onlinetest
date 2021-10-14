<main class="container">

    <!--        alert-->
    <section>
        <div class="row">
            <div class="col-6 offset-3 mt-3">
                <?php echo $session->display_session_message() ?>
            </div>
        </div>
    </section>


<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="row">
        <div class="col-md-8 d-flex flex-column justify-content-center align-items-center">
            <br><br>
            <h1><?php echo $user->first_name .' '. $user->last_name; ?></h1>
            <p class="lead"><?php echo $user->email?></p>
        </div>

        <div class="col-md-4 text-dark">
            <div class="card card-body bg-light">
                <dl class="dl-horizontal">
                    <dt>Created At:</dt>
                    <dd><?php display_time($user->created_at); ?></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Updated At:</dt>
                    <dd><?php display_time($user->updated_at); ?></dd>
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
                        <a class="btn btn-block btn-h1-spacing" role="button"  href="<?php echo URLROOT ?>/admin/users/index.php">Return</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Score</th>
                    <th>Quiz Correct Answers</th>
                    <th>Users Correct Answers</th>
                    <th>Taken at</th>
                    <th>Updated at</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($user_results as $result):  ?>
                    <tr>
                        <td><?php echo $result->id; ?></td>
                        <td><span class="badge bg-secondary "><?php echo $result->points; ?></span></td>
                        <td><?php echo $result->correct_answ; ?></td>
                        <td><?php echo $result->correct_answ_user; ?></td>
                        <td><?php display_time($result->taken_at); ?></td>
                        <td><?php display_time($result->updated_at); ?></td>
                        <td><a href="<?php echo URLROOT ?>/admin/results/edit.php?id=<?php echo $result->id; ?>" class="btn btn-sm">Edit</a></td>
                        <td>
                            <form method="post" action="<?php echo URLROOT ?>/admin/results/delete.php?id=<?php echo $result->id; ?>">
                                <input type="hidden" name="_method" value="delete">
                                <div id="operations">
                                    <input type="submit" name="commit" class="btn btn-sm" value="Delete" />
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php  endforeach; ?>
                </tbody>
            </table>
            <small class="d-block text-end mt-3">
                <a href="<?php echo URLROOT ?>" target="_blank">View front Page</a>
            </small>
        </div>


    </div>
</div>
</div>