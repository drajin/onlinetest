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
            <div class="col-md-7 offset-1">
                <h1><?php echo $user->first_name .' '. $user->last_name?>'s Result</h1>
                <hr>
                <form method='post' action="" enctype="multipart/form-data">
                    <br><br>
                    <div class="form-group">
                        <label for="points">Score</label>
                        <input name="points" id="points" class="form-control <?php echo (!empty($result_data['points_error'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $result_user->points; ?>">
                        <div class="invalid-feedback"><?php echo $result_data['points_error']?></div>
                    </div>
                    <div class="form-group">
                        <label for="correct_answ">Existing Correct Answers in Quiz</label>
                        <input name="correct_answ" id="correct_answ" class="form-control <?php echo (!empty($result_data['correct_answ_error'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $result_user->correct_answ; ?>">
                            <div class="invalid-feedback"><?php echo $result_data['correct_answ_error']?></div>
                    </div>
                    <div class="form-group">
                        <label for="correct_answ_user">Users Given Correct Answers</label>
                        <input name="correct_answ_user" id="correct_answ_user" class="form-control <?php echo (!empty($result_data['correct_answ_user_error'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $result_user->correct_answ_user; ?>">
                            <div class="invalid-feedback"><?php echo $result_data['correct_answ_user_error']?></div>
                    </div>
                    <br>
                    <button id="submitLogin" class="btn btn-outline-secondary form-control mb-3" type="submit">Save</button>
                </form>
    </div>
            <div class="col-md-4 text-dark">
                <div class="card card-body bg-light">
                    <dl class="dl-horizontal">
                        <dt>Created At:</dt>
                        <dd><?php display_time($result_user->taken_at);  ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Updated At:</dt>
                        <dd><?php display_time($result_user->updated_at); ?></dd>
                    </dl>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <a href="" class="btn btn-block disabled">Edit</a>
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
                            <a class="btn btn-block btn-h1-spacing" role="button"  href="<?php echo URLROOT ?>/admin/results/index.php">Return</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>