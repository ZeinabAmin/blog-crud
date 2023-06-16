<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "blog-crud");

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password']; //maybe password contain spaces

    $errors = [];

    if (empty($email)) {
        $errors[] = "email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "email is not valid";
    } elseif (strlen($email) > 255) {
        $errors[] = "min length <= 255 length ";
    }

    if (empty($password)) {
        $errors[] = "password is required";
    } elseif (!is_string($password)) {
        $errors[] = "password must be string";
    }

    if (empty($errors)) {
        //check email
        $query = "select * from `users` where email='$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) { //true or false
            //check password

            $user = mysqli_fetch_assoc($result);
            // print_r($user);
            // echo password_hash("123456",PASSWORD_DEFAULT);
            $isLogin = password_verify($password, $user['password']);
            if ($isLogin) {
                $SESSION['isLogin'] = true;
                $SESSION['userId'] = $user['id'];
                $SESSION['uuserEmail'] = $email;
                header("location:index.php");
            } else {
                $_SESSION['errors'] = ["password is not correct"];
                $_SESSION['errors'] = ["credentials are not correct"];
            }
        } else {
            $_SESSION['errors'] = ["this account is not exist"]; //email
            $_SESSION['errors'] = ["credentials are not correct"];
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("location:login.php");
    }
}
