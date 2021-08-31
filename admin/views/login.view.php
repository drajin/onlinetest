<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <title>Admin</title>
</head>
<body>
<div class="container">


    <!--login form-->
    <div id="loginView">
        <h1 class="display-4 text-center m-3 p-3">Welcome Admin,</h1>
        <h3 class="text-center mb-5">please log in</h3>
        <div class="row">
            <div class="col-6 offset-3">
                <form id="login" action="login.php" name="login" method ="POST">
                    <input id="emailLogin" type="text" placeholder="Email" name="email" class="form-control">
                    <div class="invalid-feedback"></div>
                    <br>
                    <input id="passwordLogin" type="password" placeholder="Password" name="password" class="form-control">
                    <div class="invalid-feedback"></div>
                    <br>
                    <button id="submitLogin" class="btn btn-outline-secondary form-control mb-3" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>