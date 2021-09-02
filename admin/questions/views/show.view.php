<main class="container">
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row">
            <div class="col-md-8 d-flex flex-column justify-content-center align-items-center">
                <br><br>
                <h1><?php echo $question->question_text?></h1>
                <ul class="fs-3">
                    <li><?php echo $question->answer_1 ?></li>
                    <li><?php echo $question->answer_2 ?></li>
                    <li><?php echo $question->answer_3 ?></li>
                    <li><?php echo $question->answer_4 ?></li>
                </ul>

                <p class="fs-3">Correct answer: <span class="badge bg-secondary "><?php echo $question->correct_answer ?></span></p>
            </div>

            <div class="col-md-4 text-dark">
                <div class="card card-body bg-light">
                        <p class="fs-4">Points worth: <span class="badge bg-secondary "><?php echo $question->points ?></span></p>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <a href="<?php echo URLROOT ?>/admin/questions/edit.php?id=<?php echo $question->id; ?>" class="btn btn-block">Edit</a>
                        </div>
                        <div class="col-sm-6">
                            <form method="POST" action="<?php echo URLROOT ?>/admin/questions/delete.php?id=<?php echo $question->id; ?>">
                                <input type="hidden" name="_method" value="delete">
                                <div id="operations">
                                    <input type="submit" name="commit" class="btn btn-block" value="Delete" />
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12">
                            <a class="btn btn-block btn-h1-spacing" role="button"  href="<?php echo URLROOT ?>/admin/questions/index.php">Back to Index</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>