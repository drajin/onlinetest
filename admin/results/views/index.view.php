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
        <h6 class="border-bottom pb-2 mb-0 text-white">All Results</h6>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
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
            <?php foreach($results as $result):  ?>
                <tr>
                    <td><?php echo $result->first_name; ?></td>
                    <td><?php echo $result->last_name; ?></td>
                    <td><?php echo $result->points; ?></td>
                    <td><?php echo $result->number_of_correct_answ; ?></td>
                    <td><?php echo $result->user_correct_answers; ?></td>
                    <td><?php display_time($result->taken_at); ?></td>
                    <td><?php display_time($result->updated_at); ?></td>
                    <td><a href="edit.php?id=<?php echo $result->id; ?>" class="btn btn-sm">Edit</a></td>
                    <td>
                        <form method="post" action="delete.php?id=<?php echo $result->id; ?>">
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