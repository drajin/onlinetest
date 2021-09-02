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
        <h6 class="border-bottom pb-2 mb-0 text-white">All registered Users</h6>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Score</th>
                <th>Time</th>
                <th>Registered at</th>
                <th>Updated at</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($users as $user):  ?>
                <tr>
                    <th><?php echo $user->id; ?></th>
                    <td><?php echo $user->first_name; ?></td>
                    <td><?php echo $user->last_name; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->score; ?></td>
                    <td><?php echo $user->time; ?></td>
                    <td><?php echo $user->created_at; ?></td>
                    <td><?php echo $user->updated_at; ?></td>
                    <td><a href="show.php?id=<?php echo $user->id; ?>" class="btn  btn-sm">View</a></td>
                    <td><a href="edit.php?id=<?php echo $user->id; ?>" class="btn btn-sm">Edit</a></td>
                    <td>
                        <form method="post" action="delete.php?id=<?php echo $user->id; ?>">
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
            <a href="<?php echo URLROOT ?>">View front Page</a>
        </small>
    </div>