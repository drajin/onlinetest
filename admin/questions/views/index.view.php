<main class="container">


    <!--        alert-->
    <?php echo $session->display_session_message(); ?>



    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0 text-white">Available questions</h6>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th>Questions:</th>
                <th>Will be displayed as:</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($questions as $question):  ?>
                <tr>
                    <th><?php echo $question->question_text; ?></th>
                    <td><?php echo $question->display; ?></td>
                    <td><a href="show.php?id=<?php echo $question->id; ?>" class="btn  btn-sm">View Answers</a></td>
                    <td><a href="edit.php?id=<?php echo $question->id; ?>" class="btn btn-sm">Edit</a></td>
                    <td>
                        <form method="post" action="delete.php?id=<?php echo $question->id; ?>">
                            <input type="hidden" name="_method" value="delete">
                            <div id="operations">
                                <input type="submit" name="commit" class="btn btn-sm" value="Delete" />
                            </div>
                        </form>
                    </td>
                </tr><?php  endforeach; ?>
            </tbody>
        </table>
        <small class="d-flex justify-content-between mt-3">
            <a class="btn  btn-sm" href="<?php echo URLROOT .'/admin/questions/create.php' ?>">Add a New Question</a>
            <a href="<?php echo URLROOT ?>" target="_blank">View front Page</a>
        </small>
    </div>