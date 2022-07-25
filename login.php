<?php
require_once 'utils.php';

if (isset($_POST["submit"])) {

    $email =  htmlspecialchars($_POST["email"]);
    $password =  htmlspecialchars($_POST["password"]);
    loginUser($dbConnection, $email, $password);

    // echo $email . $password;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Sign Up Form</title>
    <link<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,500;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="bg-success rounded  text-white font-weight-bold" id="info-card">

    </div>
    <div class="container">
        <form class="form" id="login" action="login.php" method="POST">
            <h1 class="form__title">Login</h1>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="email" class="form__input-group form-control" placeholder="Input email" name="email" required>
                <div class="form__input_error-message text-danger text-center"></div>
            </div>
            <div class="form__input-group">
                <!-- form__input--error -->
                <input type="password" class="form__input-group  form-control" placeholder="Input Password " name="password" required>
                <div class="form__input_error-message"> </div>
            </div>
            <div class="form__input_error-message text-danger text-center mb-4 font-weight-bold" id="error-div"></div>

            <input class="form__button" name="submit" type="submit" value="Continue"></input>
            <!-- <p class="form__text">
                <a href="#" class="form__link">Forgot your password? </a>
            </p> -->
            <p class="form__text mt-4">
                <a class="form__link" id="Link Create Account" href="signup.php">Don't have an account? Create account</a>
            </p>

        </form>
    </div>
    <script src="./js/todo.js"></script>
</body>

</html>