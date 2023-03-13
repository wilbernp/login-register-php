<?php require_once('helpers/validateInputs.php') ?>
<?php require_once('db.php') ?>

<?php

if (isset($_POST['submit_register'])) {
    $errors = validateInputs();
    $notErrors = false;
    if (empty($errors)) {
        $notErrors = true;
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email is invalid';
            $notErrors = false;
        }
        if (strlen($_POST['password']) < 6) {
            $errors['password'] = 'Password must be a contain at least 6 characters';
            $notErrors = false;
        }
        if ($notErrors) {
            $query = "SELECT * FROM `users` WHERE `username` = ? OR `email` = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([
                $_POST['username'],
                $_POST['email']
            ]);

            $findUser = $stmt->fetchObject();
            // echo $findUser->email;
            if ($findUser) {
                if ($findUser->username === $_POST['username']) {
                    $errors['username'] = "Username is not available";
                }
                if ($findUser->email === $_POST['email']) {
                    $errors['email'] = "Email is not available";
                }
            } else {
                $query = "INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)";
                $passwordHashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt = $conn->prepare($query);
                $stmt->execute([
                    $_POST['username'],
                    $_POST['email'],
                    $passwordHashed
                ]);

            }
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <main class="d-flex vh-100 justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="register.php" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" placeholder="Username"
                                        value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"
                                        class="form-control <?php echo (isset($errors['username'])) ? "is-invalid" : ""; ?>">
                                    <div class="invalid-feedback">
                                        <?php echo $errors['username'] ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" id="email" placeholder="Email"
                                        value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"
                                        class="form-control <?php echo (isset($errors['email'])) ? "is-invalid" : ""; ?>">
                                    <div class="invalid-feedback">
                                        <?php echo $errors['email'] ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" placeholder="******"
                                        value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>"
                                        class="form-control <?php echo (isset($errors['password'])) ? "is-invalid" : ""; ?>">
                                    <div class="invalid-feedback">
                                        <?php echo $errors['password'] ?>
                                    </div>
                                </div>

                                <div>
                                    <input id="" class="btn btn-primary w-100" name="submit_register" type="submit"
                                        value="Register">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
</body>

</html>