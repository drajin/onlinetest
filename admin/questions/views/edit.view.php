<main class="container">
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row">
            <div class="col-md-7 offset-1">
                <h1>Edit Question</h1>
                <hr>
                <form method='post' action="" enctype="multipart/form-data">
                    <br><br>
                    <div class="form-group">
                        <label for="question_text">Question</label>
                        <input name="question_text" id="question_text" class="form-control <?php echo (!empty($question_data['question_text_error'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $question->question_text; ?>">
                        <div class="invalid-feedback"><?php echo $question_data['question_text_error']?></div>
                    </div>
                    <div class="form-group">
                        <label for="answer_1">Answer 1</label>
                        <input name="answer_1" id="answer_1" class="form-control <?php echo (!empty($question_data['answer_1_error'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $question->answer_1; ?>">
                        <div class="invalid-feedback"><?php echo $question_data['answer_1_error']?></div>
                    </div>
                    <div class="form-group">
                        <label for="answer_2">Answer 2</label>
                        <input name="answer_2" id="answer_2" class="form-control <?php echo (!empty($question_data['answer_2_error'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $question->answer_2; ?>">
                        <div class="invalid-feedback"><?php echo $question_data['answer_2_error']?></div>
                    </div>
                    <div class="form-group">
                        <label for="answer_3">Answer 3</label>
                        <input name="answer_3" id="answer_3" class="form-control <?php echo (!empty($question_data['answer_3_error'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $question->answer_3; ?>">
                        <div class="invalid-feedback"><?php echo $question_data['answer_3_error']?></div>
                    </div>
                    <div class="form-group">
                        <label for="answer_4">Answer 4</label>
                        <input name="answer_4" id="answer_4" class="form-control <?php echo (!empty($question_data['answer_4_error'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $question->answer_4; ?>">
                        <div class="invalid-feedback"><?php echo $question_data['answer_4_error']?></div>
                    </div>
                    <div class="form-group">
                        <label for="correct_answer">Correct Answer</label>
                        <input name="correct_answer" id="correct_answer" class="form-control <?php echo (!empty($question_data['correct_answer_error'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $question->correct_answer; ?>">
                        <div class="invalid-feedback"><?php echo $question_data['correct_answer_error']?></div>
                    </div>
                    <div class="form-group">
                        <label for="points">Points</label>
                        <input name="points" id="points" type="number" class="form-control <?php echo (!empty($question_data['points_error'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $question->points; ?>">
                        <div class="invalid-feedback"><?php echo $question_data['points_error']?></div>
                    </div>

                    <br>
                    <button id="submitLogin" class="btn btn-outline-secondary form-control mb-3" type="submit">Save</button>
                </form>
            </div>
            <div class="col-md-4 text-dark">
                <div class="card card-body bg-light">
                    <a href="" class="btn btn-block disabled">Add more Time</a>
<!--                    TODO add more time option-->
<!--                        <form method="POST" action="/action_page.php">-->
<!--                            <label for="time">Add more Time:</label>-->
<!--                            <select name="time" class="form-select" aria-label="Default select example">-->
<!--                                <option selected value="30">30s</option>-->
<!--                                <option value="2">1min</option>-->
<!--                                <option value="3">1:30s</option>-->
<!--                            </select>-->
<!--                            <div id="operations">-->
<!--                                <input type="submit" name="time" class="btn btn-block mt-3" value="Add" />-->
<!--                            </div>-->
<!--                        </form>-->
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
                            <a class="btn btn-block btn-h1-spacing" role="button"  href="<?php echo URLROOT ?>/admin/questions/index.php">Back to Index</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>