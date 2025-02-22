<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign Up </title>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="../../../assets/logo.jpg" />
    <script src="../../../tailwind.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">
</head>

<body class="p-4" style="font-family: 'Poppins';">

<?php
session_start(); // Démarrer la session dès le début

include_once "../../config/config.php";
require "../../../vendor/autoload.php";

use Ramsey\Uuid\Uuid;

$conn = getConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            echo "<script>console.log('Passwords do not match');</script>";
        } else {
            // Vérifier si l'email est déjà utilisé
            $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = :email");
            $checkEmail->execute(['email' => $email]);
            if ($checkEmail->rowCount() > 0) {
                echo "<script>console.log('Email already in use');</script>";
            } else {
                // Hash du mot de passe
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $uuid = Uuid::uuid4()->toString();

                $sql = $conn->prepare("INSERT INTO users (id, username, email, password) VALUES (:id, :username, :email, :password)");
                $result = $sql->execute([
                    'id' => $uuid,
                    'username' => $username,
                    'email' => $email,
                    'password' => $hashedPassword
                ]);

                if ($result) {
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;

                    echo "<script>console.log('Account created successfully'); window.location.href = '../auth/sign-in.php';</script>";
                    exit();
                } else {
                    echo "<script>console.log('Failed to create account');</script>";
                }
            }
        }
    }
}
?>
<form method="post" action="#" class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto rounded-full h-30 w-auto" src="../../../assets/logo.jpg" alt="Your Company">
        <h2 class="mt-10 mb-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900 sm:text-3xl/9">
            Sign up
        </h2>
        <p class="text-center paragraph"> Please complete the following space to create your account. </p>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <div class="space-y-6" id="form">
            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Username</label>
                <div class="mt-2">
                    <input type="text" name="username" id="username"
                           class="block w-full rounded-md bg-gray-900/8 px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500  sm:text-sm/6">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email"
                           class="block w-full rounded-md bg-gray-900/8 px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500  sm:text-sm/6">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Password</label>
                <div class="mt-2 flex justify-between items-center gap-5 w-full rounded-md bg-gray-900/8 px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500  sm:text-sm/6">
                    <input type="password" name="password" id="password"
                           class="block w-full outline-none bg-transparent text-gray-900 placeholder-gray-500 sm:text-sm/6">
                    <i onclick="showPassword()" class="fa fa-eye cursor-pointer"></i>
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Confirm Password</label>
                <div class="mt-2 flex justify-between items-center gap-5 w-full rounded-md bg-gray-900/8 px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500  sm:text-sm/6">
                    <input type="password" name="confirm_password" id="confirm_password"
                           class="block w-full outline-none bg-transparent text-gray-900 placeholder-gray-500 sm:text-sm/6">
                    <i onclick="showConfirmPassword()" class="fa fa-eye cursor-pointer"></i>
                </div>
            </div>


            <div>
                <button type="submit"
                        class="flex w-full justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm/6 font-semibold text-white cursor-pointer shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    ☬ Submit ☬
                </button>
            </div>
        </div>
        <p class="mt-10 text-center"> Already a member? Please <span> <a
                        class="text-red-500 hover:text-red-400 font-bold" href="sign-in.php">sign in</a> </span></p>
    </div>
</form>

</body>


<script>
    function showPassword() {
        var password = document.getElementById("password");
        if (password.type === "password") {
            password.type = "text";
            document.querySelector("i").classList.remove("fa-eye");
            document.querySelector("i").classList.add("fa-eye-slash");
        } else {
            password.type = "password";
            document.querySelector("i").classList.remove("fa-eye-slash");
            document.querySelector("i").classList.add("fa-eye");
        }
    }

    function showConfirmPassword() {
        var password = document.getElementById("confirm_password");
        if (password.type === "password") {
            password.type = "text";
            document.querySelectorAll("i")[1].classList.remove("fa-eye");
            document.querySelectorAll("i")[1].classList.add("fa-eye-slash");
        } else {
            password.type = "password";
            document.querySelectorAll("i")[1].classList.remove("fa-eye-slash");
            document.querySelectorAll("i")[1].classList.add("fa-eye");
        }
    }

    function validatePassword() {
        var password = document.getElementById("password");
        var confirm_password = document.getElementById("confirm_password");

        if (password.value == "") {
            password.setCustomValidity("Please enter your password");
        } else {
            password.setCustomValidity('');
        }

        if (confirm_password.value == "") {
            confirm_password.setCustomValidity("Please confirm your password");
        } else {
            confirm_password.setCustomValidity('');
        }

        if (password.value.length < 8) {
            password.setCustomValidity("Password must be at least 8 characters long");
        } else {
            password.setCustomValidity('');
        }

        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    document.getElementById("password").onchange = validatePassword;
    document.getElementById("confirm_password").onkeyup = validatePassword;

</script>

</html>