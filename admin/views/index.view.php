<pre>
<?php //var_dump($new_questions); ?>
</pre>

<?php //foreach ($questions as $question) :?>
<!--<ul>-->
<!--    <li>--><?php //echo $question->question_text ?><!--</li>-->
<!--</ul>-->
<?php //endforeach; ?>


<main class="container">

<div class="p-3 my-3 bg-green rounded shadow-sm">
        <h1 class="text-white">You are logged in as <strong><?php echo $_SESSION['email'] ?></strong></h1>
</div>

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Suggestions</h6>
    <div class="d-flex text-muted pt-3">
        <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>

        <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
            <a href="<?php echo URLROOT ?>/admin/users/index.php">
            <div class="d-flex justify-content-between">
                <strong class="text-gray-dark">Users</strong>
            </div>
            <span class="d-block">View, Edit or Delete the Users</span>
            </a>
        </div>
    </div>
    <div class="d-flex text-muted pt-3">
        <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>

        <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
            <a href="<?php echo URLROOT ?>/admin/questions/index.php">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">Quiz questions</strong>
                </div>
                <span class="d-block">View, Edit or Delete the Questions</span>
            </a>
        </div>
    </div>

    <div class="d-flex text-muted pt-3">
        <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>

        <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
<!--            <a href="--><?php //echo URLROOT ?><!--/admin/results/index.php">-->
            <a href="<?php echo URLROOT ?>/admin/questions/index.php">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">Results</strong>
                </div>
                <span class="d-block">View Edit or Delete the Results</span>
            </a>
        </div>
    </div>
    <small class="d-block text-end mt-3">

        <a href="<?php echo URLROOT ?>" target="_blank">View front Page</a>
    </small>
</div>

