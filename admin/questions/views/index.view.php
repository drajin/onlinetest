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
        <h6 class="border-bottom pb-2 mb-0 text-white">Available questions</h6>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th>Question text</th>
                <th>Answer 1</th>
                <th>Answer 2</th>
                <th>Answer 3</th>
                <th>Answer 4</th>
                <th>Correct Answer</th>
                <th>Points</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($questions as $question):  ?>
                <tr>
                    <th><?php echo $question->question_text; ?></th>
                    <td><?php echo $question->answer_1; ?></td>
                    <td><?php echo $question->answer_2; ?></td>
                    <td><?php echo $question->answer_3; ?></td>
                    <td><?php echo $question->answer_4; ?></td>
                    <td><?php echo $question->correct_answer; ?></td>
                    <td><?php echo $question->points; ?></td>
                    <td><a href="show.php?id=<?php echo $question->id; ?>" class="btn  btn-sm">View</a></td>
                    <td><a href="edit.php?id=<?php echo $question->id; ?>" class="btn btn-sm">Edit</a></td>
                    <td>
                        <form method="post" action="delete.php?id=<?php echo $question->id; ?>">
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
        <small class="d-flex justify-content-between mt-3">
            <a class="btn  btn-sm" href="<?php echo URLROOT ?>">Add a New Question</a>
            <a href="<?php echo URLROOT ?>" target="_blank">View front Page</a>
        </small>
    </div>