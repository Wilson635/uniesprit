<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Connexion </title>
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="../../../assets/logo.jpg" />
    <script src="../../../tailwind.js"></script>
    <script src="../../../script.js"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body class="p-4" style="font-family: 'Poppins';">

<?php
session_start();
include_once "../../config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        try {
            $query = "SELECT id, password, email FROM users WHERE username = :username LIMIT 1";
            $stmt = getConnexion()->prepare($query);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];

                header('Location: ../main/index.php');
                exit();
            }

            echo "<script>console.log('Identifiants invalides');</script>";
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    } else {
        echo "<script>console.log('Veuillez remplir tous les champs');</script>";
    }
}
?>


    <form method="post" action="#" class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto rounded-full h-30 w-auto" src="../../../assets/logo.jpg" alt="Your Company">
            <h2 class="mt-10 mb-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900 sm:text-3xl/9">
                Connexion
            </h2>
            <p class="text-center paragraph"> Veuillez entre vos informations de connexion. </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="space-y-6" id="form">
                <div>
                    <label for="username" class="block text-sm/6 font-medium text-gray-900">Nom d'utilisateur</label>
                    <div class="mt-2">
                        <input type="text" name="username" id="username" 
                            class="block w-full rounded-md bg-gray-900/8 px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500  sm:text-sm/6">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Mot de passe</label>
                    <div class="mt-2 flex justify-between items-center gap-5 w-full rounded-md bg-gray-900/8 px-3.5 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500  sm:text-sm/6">
                        <input type="password" name="password" id="password" 
                            class="block w-full outline-none bg-transparent text-gray-900 placeholder-gray-500 sm:text-sm/6">
                        <i onclick="showPassword()" class="fa fa-eye cursor-pointer"></i>
                    </div>
                </div>


                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm/6 font-semibold text-white cursor-pointer shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        ☬ Envoyer ☬
                    </button>
                </div>
            </div>
            <p class="mt-10 text-center"> Veuillez contacter en cas de soucis <span> <a x-tooltip.placement.top="'Mon mobile : +237 670 74 38 08'" class="text-red-500 hover:text-red-400 font-bold">l'administrateur.</a> </span> </p>
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
</script>

</html>