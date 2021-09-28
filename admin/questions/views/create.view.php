<main class="container">
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row">
            <div class="col-md-7 offset-1">
                <h1>Add a new Question</h1>
                <hr>
                <form method='post' action="" enctype="multipart/form-data">
                    <br><br>
                    <div class="col-xs-10 col-sm-10 offset-2">
                        <div class="form-group">
                            <label class="fs-4 text-center mt-3" for="question_text">Add Question Text</label>
                            <input name="question_text" id="question_text" class="form-control <?php echo (!empty($new_question['question_text_error'])) ? 'is-invalid' : '' ?>"
                                   value="<?php echo (!empty($new_question['question_text'])) ? $new_question['question_text'] : '' ?>">
                            <div class="invalid-feedback"><?php echo $new_question['question_text_error']?></div>
                        </div>
                        <label class="fs-4 text-center mt-3" for="question_form">How would you like to display the answers?</label>
                        <select id="question_form" class="form-select" aria-label="Default select example">
                            <option disabled selected value> -- select an option -- </option>
                            <option value="1">As Checkboxs (multiple correct answers)</option>
                            <option value="2">As Radio buttons</option>
                            <option value="3">As Drop-down List</option>
                        </select>
                    </div>
                    <br>
<!--                    <form class="form-inline">-->
<!--                        <label class="checkbox">-->
<!--                            <input type="checkbox" name="keywords" value="__option__">-->
<!--                        </label>-->
<!--                        <input type="text" name="keywords_other_option" value="" placeholder="Other">-->
<!--                    </form>-->
                    <p class="fs-4 text-center">Answers</p>
                    <div class="row form-group answer">
                        <div class="col-xs-2 col-sm-2 mb-5">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Correct</label>
                            </div>
                        </div>
                        <div class="col-xs-10 col-sm-10">
                            <input name="answer_1" id="answer_1" placeholder="Answer" class="form-control<?php echo (!empty($new_question['answer_1_error'])) ? 'is-invalid' : '' ?>"
                                   value="<?php echo (!empty($new_question['answer_1'])) ? $new_question['answer_1'] : '' ?>">
                            <div class="invalid-feedback"><?php echo $new_question['answer_1_error']?></div>
                        </div>
                    </div>

                    <div class="row form-group answer">
                        <div class="col-xs-2 col-sm-2 mb-5">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Correct</label>
                            </div>

                        </div>
                        <div class="col-xs-10 col-sm-10">
                            <input name="answer_1" id="answer_1" placeholder="Answer" class="form-control <?php echo (!empty($new_question['answer_1_error'])) ? 'is-invalid' : '' ?>"
                                   value="<?php echo (!empty($new_question['answer_1'])) ? $new_question['answer_1'] : '' ?>">
                            <div class="invalid-feedback"><?php echo $new_question['answer_1_error']?></div>
                        </div>
                    </div>
                    <div class="newAnswers"></div>



<!--staro-->
<!--                    <div class="form-group">-->
<!--                        <label for="answer_1">Answer 1</label>-->
<!--                        <input name="answer_1" id="answer_1" class="form-control --><?php //echo (!empty($new_question['answer_1_error'])) ? 'is-invalid' : '' ?><!--"-->
<!--                               value="--><?php //echo (!empty($new_question['answer_1'])) ? $new_question['answer_1'] : '' ?><!--">-->
<!--                        <div class="invalid-feedback">--><?php //echo $new_question['answer_1_error']?><!--</div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="answer_2">Answer 2</label>-->
<!--                        <input name="answer_2" id="answer_2" class="form-control --><?php //echo (!empty($new_question['answer_2_error'])) ? 'is-invalid' : '' ?><!--"-->
<!--                               value="--><?php //echo (!empty($new_question['answer_2'])) ? $new_question['answer_2'] : '' ?><!--">-->
<!--                        <div class="invalid-feedback">--><?php //echo $new_question['answer_2_error']?><!--</div>-->
<!--                    </div>-->


                    <br>
                    <button id="submitLogin" class="btn btn-outline-secondary form-control mb-3" type="submit">Save</button>
                </form>
            </div>
            <div class="col-md-4 text-dark">
                <div class="card card-body bg-light">
                    <a href="" class="btn btn-block addAnswer">Add Another Answer</a>
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

    <script>



    </script>