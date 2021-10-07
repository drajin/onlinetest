<main class="container">
    <div id="alerts">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="alerts text-center"></div>
            </div>
        </div>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row">
            <h1 class="text-center">Edit Question</h1>
            <hr>
            <div class="col-md-7 offset-1">

                <form method='post' action="" enctype="multipart/form-data">
                    <br><br>
                    <div class="col-xs-10 col-sm-10 offset-2">
                        <!--                        question-->
                        <div class="form-group">
                            <label class="fs-4 text-center" for="question_text">Question Text</label>
                            <input name="question_text" id="question_text" class="form-control"
                                   value="<?php echo $question->question_text ?>">
                            <div class="invalid-feedback"><?php echo $new_question['question_text_error']?></div>
                        </div>
                        <!--                        how to display question-->
                        <label class="fs-4 text-center mt-3" for="question_display">How would you like to display the answers?</label>
                        <select id="question_display" name="question_display" class="form-select" aria-label="Default select example">
                            <!--<option disabled selected value> -- select an option -- </option>-->
                            <option value="checkbox" <?php if($question->display === 'checkbox') echo'selected'?>>As Checkboxs (multiple correct answers)</option>
                            <option value="radio" <?php if($question->display === 'radio') echo'selected'?>>As Radio buttons</option>
                            <option value="option" <?php if($question->display === 'option') echo'selected'?>>As Drop-down List</option>
                        </select>
                    </div>
                    <br>
                    <p class="fs-4 text-center">Answers</p>
                    <!-- default answer 1-->
                    <?php foreach($answers as $answer) : ?>
                        <div class="row form-group answer">
                            <div class="col-xs-2 col-sm-2 mb-5">
                                <div class="form-check">
                                    <input type="checkbox" name="checkbox[]" value="0" class="form-check-input" id="0" <?php echo ($answer->correct) ? 'checked' : '';?>>
                                    <label class="form-check-label" for="0">Correct</label>
                                </div>

                            </div>
                            <div class="col-xs-10 col-sm-10">
                                <input name="0" id="0" placeholder="Answer" class="form-control answerInput" value="<?php echo $answer->answer_text?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- default answer 2-->

                    <!-- generated answers placeholder-->
                    <div class="generatedAnswers"></div>


                    <br>
                    <div class="col-xs-10 col-sm-10 offset-2">
                        <button id="submitLogin" class="btn btn-outline-secondary form-control mb-3" type="submit">Save</button>
                    </div>
                </form>
            </div>
            <!--                    aside-->
            <div class="col-md-4 text-dark mt-5">
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
                            <a class="btn btn-block btn-h1-spacing" role="button"  href="<?php echo URLROOT ?>/admin/questions/index.php">Return</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
