<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../auth/sign-in.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags  -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>

    <title>Home</title>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="../../../assets/logo.jpg"/>

    <!-- CSS Assets -->
    <link rel="stylesheet" href="../../components/app.css"/>

    <!-- Javascript Assets -->
    <script src="../../../script.js"></script>
    <script src="../../../tailwind.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"/>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- Dark mode -->
    <script>
        /**
         * THIS SCRIPT REQUIRED FOR PREVENT FLICKERING IN SOME BROWSERS
         */
        localStorage.getItem("_x_darkMode_on") === "true" &&
        document.documentElement.classList.add("dark");
    </script>
</head>

<body x-data class="is-header-blur" x-bind="$store.global.documentBody" style="font-family: 'Poppins',serif;">
<!-- App preloader-->
<div class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900">
    <div class="app-preloader-inner relative inline-block size-48"></div>
</div>

<!-- Page Wrapper -->
<div id="root" class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900" x-cloak>
    <!-- Sidebar -->
    <div class="sidebar print:hidden">
        <!-- Main Sidebar -->
        <div class="main-sidebar">
            <div
                    class="flex h-full w-full flex-col items-center border-r border-slate-150 bg-white dark:border-navy-700 dark:bg-navy-800">
                <!-- Application Logo -->
                <div class="flex pt-4">
                    <a href="/">
                        <img class="rounded-full size-11 transition-transform duration-500 ease-in-out hover:rotate-[360deg]"
                             src="../../../assets/logo.jpg" alt="logo"/>
                    </a>
                </div>

                <!-- Main Sections Links -->
                <div class="is-scrollbar-hidden flex grow flex-col space-y-4 overflow-y-auto pt-6">
                    <!-- Dashobards -->
                    <a href="index.php"
                       class="flex size-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
                       x-tooltip.placement.right="'Dashboards'">
                        <svg class="size-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-opacity=".3"
                                  d="M5 14.059c0-1.01 0-1.514.222-1.945.221-.43.632-.724 1.453-1.31l4.163-2.974c.56-.4.842-.601 1.162-.601.32 0 .601.2 1.162.601l4.163 2.974c.821.586 1.232.88 1.453 1.31.222.43.222.935.222 1.945V19c0 .943 0 1.414-.293 1.707C18.414 21 17.943 21 17 21H7c-.943 0-1.414 0-1.707-.293C5 20.414 5 19.943 5 19v-4.94Z"/>
                            <path fill="currentColor"
                                  d="M3 12.387c0 .267 0 .4.084.441.084.041.19-.04.4-.204l7.288-5.669c.59-.459.885-.688 1.228-.688.343 0 .638.23 1.228.688l7.288 5.669c.21.163.316.245.4.204.084-.04.084-.174.084-.441v-.409c0-.48 0-.72-.102-.928-.101-.208-.291-.355-.67-.65l-7-5.445c-.59-.459-.885-.688-1.228-.688-.343 0-.638.23-1.228.688l-7 5.445c-.379.295-.569.442-.67.65-.102.208-.102.448-.102.928v.409Z"/>
                            <path fill="currentColor"
                                  d="M11.5 15.5h1A1.5 1.5 0 0 1 14 17v3.5h-4V17a1.5 1.5 0 0 1 1.5-1.5Z"/>
                            <path fill="currentColor"
                                  d="M17.5 5h-1a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5Z"/>
                        </svg>
                    </a>

                    <!-- Apps -->
                    <a href="apps-list.php"
                       class="flex size-11 items-center justify-center rounded-lg outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                       x-tooltip.placement.right="'Tickets'">
                        <svg class="size-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M5 8H19V16C19 17.8856 19 18.8284 18.4142 19.4142C17.8284 20 16.8856 20 15 20H9C7.11438 20 6.17157 20 5.58579 19.4142C5 18.8284 5 17.8856 5 16V8Z"
                                    fill="currentColor" fill-opacity="0.3"/>
                            <path
                                    d="M12 8L11.7608 5.84709C11.6123 4.51089 10.4672 3.5 9.12282 3.5V3.5C7.68381 3.5 6.5 4.66655 6.5 6.10555V6.10555C6.5 6.97673 6.93539 7.79026 7.66025 8.2735L9.5 9.5"
                                    stroke="currentColor" stroke-linecap="round"/>
                            <path
                                    d="M12 8L12.2392 5.84709C12.3877 4.51089 13.5328 3.5 14.8772 3.5V3.5C16.3162 3.5 17.5 4.66655 17.5 6.10555V6.10555C17.5 6.97673 17.0646 7.79026 16.3397 8.2735L14.5 9.5"
                                    stroke="currentColor" stroke-linecap="round"/>
                            <rect x="4" y="8" width="16" height="3" rx="1" fill="currentColor"/>
                            <path d="M12 11V15" stroke="currentColor" stroke-linecap="round"/>
                        </svg>
                    </a>

                    <!-- Pages And Layouts -->
                    <a href="reservation.php"
                       class="flex size-11 items-center justify-center rounded-lg outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                       x-tooltip.placement.right="'Reservations'">
                        <svg class="size-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M9.85714 3H4.14286C3.51167 3 3 3.51167 3 4.14286V9.85714C3 10.4883 3.51167 11 4.14286 11H9.85714C10.4883 11 11 10.4883 11 9.85714V4.14286C11 3.51167 10.4883 3 9.85714 3Z"
                                    fill="currentColor"/>
                            <path
                                    d="M9.85714 12.8999H4.14286C3.51167 12.8999 3 13.4116 3 14.0428V19.757C3 20.3882 3.51167 20.8999 4.14286 20.8999H9.85714C10.4883 20.8999 11 20.3882 11 19.757V14.0428C11 13.4116 10.4883 12.8999 9.85714 12.8999Z"
                                    fill="currentColor" fill-opacity="0.3"/>
                            <path
                                    d="M19.757 3H14.0428C13.4116 3 12.8999 3.51167 12.8999 4.14286V9.85714C12.8999 10.4883 13.4116 11 14.0428 11H19.757C20.3882 11 20.8999 10.4883 20.8999 9.85714V4.14286C20.8999 3.51167 20.3882 3 19.757 3Z"
                                    fill="currentColor" fill-opacity="0.3"/>
                            <path
                                    d="M19.757 12.8999H14.0428C13.4116 12.8999 12.8999 13.4116 12.8999 14.0428V19.757C12.8999 20.3882 13.4116 20.8999 14.0428 20.8999H19.757C20.3882 20.8999 20.8999 20.3882 20.8999 19.757V14.0428C20.8999 13.4116 20.3882 12.8999 19.757 12.8999Z"
                                    fill="currentColor" fill-opacity="0.3"/>
                        </svg>
                    </a>

                    <!-- Forms -->
                    <a href="employee.php"
                       class="flex size-11 items-center justify-center rounded-lg outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                       x-tooltip.placement.right="'Employés'">
                        <svg class="size-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-opacity="0.25"
                                  d="M21.0001 16.05V18.75C21.0001 20.1 20.1001 21 18.7501 21H6.6001C6.9691 21 7.3471 20.946 7.6981 20.829C7.7971 20.793 7.89609 20.757 7.99509 20.712C8.31009 20.586 8.61611 20.406 8.88611 20.172C8.96711 20.109 9.05711 20.028 9.13811 19.947L9.17409 19.911L15.2941 13.8H18.7501C20.1001 13.8 21.0001 14.7 21.0001 16.05Z"
                                  fill="currentColor"/>
                            <path fill-opacity="0.5"
                                  d="M17.7324 11.361L15.2934 13.8L9.17334 19.9111C9.80333 19.2631 10.1993 18.372 10.1993 17.4V8.70601L12.6384 6.26701C13.5924 5.31301 14.8704 5.31301 15.8244 6.26701L17.7324 8.17501C18.6864 9.12901 18.6864 10.407 17.7324 11.361Z"
                                  fill="currentColor"/>
                            <path
                                    d="M7.95 3H5.25C3.9 3 3 3.9 3 5.25V17.4C3 17.643 3.02699 17.886 3.07199 18.12C3.09899 18.237 3.12599 18.354 3.16199 18.471C3.20699 18.606 3.252 18.741 3.306 18.867C3.315 18.876 3.31501 18.885 3.31501 18.885C3.32401 18.885 3.32401 18.885 3.31501 18.894C3.44101 19.146 3.585 19.389 3.756 19.614C3.855 19.731 3.95401 19.839 4.05301 19.947C4.15201 20.055 4.26 20.145 4.377 20.235L4.38601 20.244C4.61101 20.415 4.854 20.559 5.106 20.685C5.115 20.676 5.11501 20.676 5.11501 20.685C5.25001 20.748 5.385 20.793 5.529 20.838C5.646 20.874 5.76301 20.901 5.88001 20.928C6.11401 20.973 6.357 21 6.6 21C6.969 21 7.347 20.946 7.698 20.829C7.797 20.793 7.89599 20.757 7.99499 20.712C8.30999 20.586 8.61601 20.406 8.88601 20.172C8.96701 20.109 9.05701 20.028 9.13801 19.947L9.17399 19.911C9.80399 19.263 10.2 18.372 10.2 17.4V5.25C10.2 3.9 9.3 3 7.95 3ZM6.6 18.75C5.853 18.75 5.25 18.147 5.25 17.4C5.25 16.653 5.853 16.05 6.6 16.05C7.347 16.05 7.95 16.653 7.95 17.4C7.95 18.147 7.347 18.75 6.6 18.75Z"
                                    fill="currentColor"/>
                        </svg>
                    </a>

                    <!-- Components -->
                    <a href="clientContacts.php"
                       class="flex size-11 items-center justify-center rounded-lg outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                       x-tooltip.placement.right="'Clients'">
                        <svg class="size-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-opacity="0.5"
                                  d="M14.2498 16C14.2498 17.5487 13.576 18.9487 12.4998 19.9025C11.5723 20.7425 10.3473 21.25 8.99976 21.25C6.10351 21.25 3.74976 18.8962 3.74976 16C3.74976 13.585 5.39476 11.5375 7.61726 10.9337C8.22101 12.4562 9.51601 13.6287 11.1173 14.0662C11.5548 14.1887 12.0185 14.25 12.4998 14.25C12.981 14.25 13.4448 14.1887 13.8823 14.0662C14.1185 14.6612 14.2498 15.3175 14.2498 16Z"
                                  fill="currentColor"/>
                            <path
                                    d="M17.75 9.00012C17.75 9.68262 17.6187 10.3389 17.3825 10.9339C16.7787 12.4564 15.4837 13.6289 13.8825 14.0664C13.445 14.1889 12.9813 14.2501 12.5 14.2501C12.0187 14.2501 11.555 14.1889 11.1175 14.0664C9.51625 13.6289 8.22125 12.4564 7.6175 10.9339C7.38125 10.3389 7.25 9.68262 7.25 9.00012C7.25 6.10387 9.60375 3.75012 12.5 3.75012C15.3962 3.75012 17.75 6.10387 17.75 9.00012Z"
                                    fill="currentColor"/>
                            <path fill-opacity="0.3"
                                  d="M21.25 16C21.25 18.8962 18.8962 21.25 16 21.25C14.6525 21.25 13.4275 20.7425 12.5 19.9025C13.5763 18.9487 14.25 17.5487 14.25 16C14.25 15.3175 14.1187 14.6612 13.8825 14.0662C15.4837 13.6287 16.7787 12.4562 17.3825 10.9337C19.605 11.5375 21.25 13.585 21.25 16Z"
                                  fill="currentColor"/>
                        </svg>
                    </a>

                    <!-- Boissons Page -->
                    <a href="boisson-gest.php"
                       class="flex size-11 items-center justify-center rounded-lg outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                       x-tooltip.placement.right="'Gestion des boissons'">
                        <svg class="size-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M13.3111 14.75H5.03356C3.36523 14.75 2.30189 12.9625 3.10856 11.4958L5.24439 7.60911L7.24273 3.96995C8.07689 2.45745 10.2586 2.45745 11.0927 3.96995L13.1002 7.60911L14.0627 9.35995L15.2361 11.4958C16.0427 12.9625 14.9794 14.75 13.3111 14.75Z"
                                    fill="currentColor"/>
                            <path fill-opacity="0.3"
                                  d="M21.1667 15.2083C21.1667 18.4992 18.4992 21.1667 15.2083 21.1667C11.9175 21.1667 9.25 18.4992 9.25 15.2083C9.25 15.0525 9.25917 14.9058 9.26833 14.75H13.3108C14.9792 14.75 16.0425 12.9625 15.2358 11.4958L14.0625 9.36C14.4292 9.28666 14.8142 9.25 15.2083 9.25C18.4992 9.25 21.1667 11.9175 21.1667 15.2083Z"
                                  fill="currentColor"/>
                        </svg>
                    </a>

                    <!-- Services Page -->
                    <a href="services.php"
                       class="flex size-11 items-center justify-center rounded-lg outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                       x-tooltip.placement.right="'Nos services'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="M4.979 9.685C2.993 8.891 2 8.494 2 8s.993-.89 2.979-1.685l2.808-1.123C9.773 4.397 10.767 4 12 4s2.227.397 4.213 1.192l2.808 1.123C21.007 7.109 22 7.506 22 8s-.993.89-2.979 1.685l-2.808 1.124C14.227 11.603 13.233 12 12 12s-2.227-.397-4.213-1.191z"/>
                            <path fill="currentColor" fill-rule="evenodd"
                                  d="M2 8c0 .494.993.89 2.979 1.685l2.808 1.124C9.773 11.603 10.767 12 12 12s2.227-.397 4.213-1.191l2.808-1.124C21.007 8.891 22 8.494 22 8s-.993-.89-2.979-1.685l-2.808-1.123C14.227 4.397 13.233 4 12 4s-2.227.397-4.213 1.192L4.98 6.315C2.993 7.109 2 7.506 2 8"
                                  clip-rule="evenodd"/>
                            <path fill="currentColor"
                                  d="m5.766 10l-.787.315C2.993 11.109 2 11.507 2 12s.993.89 2.979 1.685l2.808 1.124C9.773 15.603 10.767 16 12 16s2.227-.397 4.213-1.191l2.808-1.124C21.007 12.891 22 12.493 22 12s-.993-.89-2.979-1.685L18.234 10l-2.021.809C14.227 11.603 13.233 12 12 12s-2.227-.397-4.213-1.191z"
                                  opacity="0.7"/>
                            <path fill="currentColor"
                                  d="m5.766 14l-.787.315C2.993 15.109 2 15.507 2 16s.993.89 2.979 1.685l2.808 1.124C9.773 19.603 10.767 20 12 20s2.227-.397 4.213-1.192l2.808-1.123C21.007 16.891 22 16.494 22 16c0-.493-.993-.89-2.979-1.685L18.234 14l-2.021.809C14.227 15.603 13.233 16 12 16s-2.227-.397-4.213-1.191z"
                                  opacity="0.4"/>
                        </svg>
                    </a>

                    <!-- Ventes Page -->
                    <a href="sales.php"
                       class="flex size-11 items-center justify-center rounded-lg outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                       x-tooltip.placement.right="'Nos Ventes'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="M3.045 11.75c.126.714.303 1.541.51 2.507l.428 2c.487 2.273.731 3.409 1.556 4.076S7.526 21 9.85 21h4.3c2.324 0 3.486 0 4.31-.667c.826-.667 1.07-1.803 1.556-4.076l.429-2c.207-.966.384-1.793.51-2.507z"
                                  opacity="0.5"/>
                            <path fill="currentColor" fill-rule="evenodd"
                                  d="M9.25 14a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75"
                                  clip-rule="evenodd"/>
                            <path fill="currentColor"
                                  d="M8.33 2.665a.75.75 0 0 1 1.341.67l-1.835 3.67Q8.56 7 9.422 7h5.156q.863-.001 1.586.005l-1.835-3.67a.75.75 0 0 1 1.342-.67l2.201 4.402c1.353.104 2.202.37 2.75 1.047c.436.539.576 1.209.525 2.136H21q.075 0 .146.014a13 13 0 0 1-.19 1.486H3.045a13 13 0 0 1-.192-1.486A1 1 0 0 1 3 10.25h-.147c-.051-.927.09-1.597.525-2.136c.548-.678 1.397-.943 2.75-1.047z"/>
                        </svg>
                    </a>

                    <!-- Charges Page -->
                    <a href="charges.php"
                       class="flex size-11 items-center justify-center rounded-lg outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                       x-tooltip.placement.right="'Nos Charges'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                                  d="M8.672 7.542h6.656c3.374 0 5.062 0 6.01.987s.724 2.511.278 5.56l-.422 2.892c-.35 2.391-.525 3.587-1.422 4.303s-2.22.716-4.867.716h-5.81c-2.646 0-3.97 0-4.867-.716s-1.072-1.912-1.422-4.303l-.422-2.892c-.447-3.049-.67-4.573.278-5.56s2.636-.987 6.01-.987M8 18c0-.414.373-.75.833-.75h6.334c.46 0 .833.336.833.75s-.373.75-.833.75H8.833c-.46 0-.833-.336-.833-.75"
                                  clip-rule="evenodd"/>
                            <path fill="currentColor"
                                  d="M8.51 2h6.98c.233 0 .41 0 .567.015c1.108.109 2.014.775 2.399 1.672H5.544c.385-.897 1.292-1.563 2.4-1.672C8.099 2 8.278 2 8.51 2"
                                  opacity="0.4"/>
                            <path fill="currentColor"
                                  d="M6.31 4.723c-1.39 0-2.53.84-2.91 1.953l-.024.07a8 8 0 0 1 1.232-.253c1.08-.138 2.446-.138 4.032-.138h6.892c1.586 0 2.952 0 4.032.138c.42.054.834.133 1.232.253l-.023-.07c-.38-1.114-1.52-1.953-2.911-1.953z"
                                  opacity="0.7"/>
                        </svg>
                    </a>
                </div>

                <!-- Bottom Links -->
                <div class="flex flex-col items-center space-y-3 py-3">
                    <!-- Settings -->
                    <a href="settings.php"
                       x-tooltip.placement.right="'Paramètres'"
                       class="flex size-11 items-center justify-center rounded-lg outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg class="size-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-opacity="0.3" fill="currentColor"
                                  d="M2 12.947v-1.771c0-1.047.85-1.913 1.899-1.913 1.81 0 2.549-1.288 1.64-2.868a1.919 1.919 0 0 1 .699-2.607l1.729-.996c.79-.474 1.81-.192 2.279.603l.11.192c.9 1.58 2.379 1.58 3.288 0l.11-.192c.47-.795 1.49-1.077 2.279-.603l1.73.996a1.92 1.92 0 0 1 .699 2.607c-.91 1.58-.17 2.868 1.639 2.868 1.04 0 1.899.856 1.899 1.912v1.772c0 1.047-.85 1.912-1.9 1.912-1.808 0-2.548 1.288-1.638 2.869.52.915.21 2.083-.7 2.606l-1.729.997c-.79.473-1.81.191-2.279-.604l-.11-.191c-.9-1.58-2.379-1.58-3.288 0l-.11.19c-.47.796-1.49 1.078-2.279.605l-1.73-.997a1.919 1.919 0 0 1-.699-2.606c.91-1.58.17-2.869-1.639-2.869A1.911 1.911 0 0 1 2 12.947Z"/>
                            <path fill="currentColor"
                                  d="M11.995 15.332c1.794 0 3.248-1.464 3.248-3.27 0-1.807-1.454-3.272-3.248-3.272-1.794 0-3.248 1.465-3.248 3.271 0 1.807 1.454 3.271 3.248 3.271Z"/>
                        </svg>
                    </a>

                    <!-- Logout -->
                    <a href="../auth/logout.php"
                       x-tooltip.placement.right="'Déconnexion'"
                       class="flex size-11 items-center justify-center rounded-lg outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg class="size-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5">
                                <path d="M12 20a8 8 0 1 1 0-16" opacity="0.5"/>
                                <path stroke-linejoin="round" d="M10 12h10m0 0l-3-3m3 3l-3 3"/>
                            </g>
                        </svg>
                    </a>

                    <!-- Profile -->
                    <div x-data="usePopper({placement:'right-end',offset:12})"
                         @click.outside="isShowPopper && (isShowPopper = false)" class="flex">
                        <button @click="isShowPopper = !isShowPopper" x-ref="popperRef"
                                class="avatar size-12 cursor-pointer">
                            <img class="rounded-full" src="../../../assets/user-7.jpg" alt="avatar"/>
                            <span
                                    class="absolute right-0 size-3.5 rounded-full border-2 border-white bg-success dark:border-navy-700"></span>
                        </button>

                        <div :class="isShowPopper && 'show'" class="popper-root fixed" x-ref="popperRoot">
                            <div
                                    class="popper-box w-64 rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-600 dark:bg-navy-700">
                                <div
                                        class="flex items-center space-x-4 rounded-t-lg bg-slate-100 py-5 px-4 dark:bg-navy-800">
                                    <div class="avatar size-14">
                                        <img class="rounded-full" src="../../../assets/user-7.jpg" alt="avatar"/>
                                    </div>
                                    <div>
                                        <p
                                                class="text-base font-medium text-slate-700 focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                                            <?php echo $_SESSION['username']; ?>
                                        </p>
                                        <p class="text-xs text-slate-400 dark:text-navy-300">
                                            <?php echo $_SESSION['email']; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col pt-2 pb-5">
                                    <a href="userProfile.php"
                                       class="group flex items-center space-x-3 py-2 px-4 tracking-wide outline-hidden transition-all hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600">
                                        <div
                                                class="flex size-8 items-center justify-center rounded-lg bg-warning text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>

                                        <div>
                                            <h2
                                                    class="font-medium text-slate-700 transition-colors group-hover:text-primary group-focus:text-primary dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light">
                                                Profile
                                            </h2>
                                            <div class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                                                Your profile setting
                                            </div>
                                        </div>
                                    </a>
                                    <a href="settings.php"
                                       class="group flex items-center space-x-3 py-2 px-4 tracking-wide outline-hidden transition-all hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600">
                                        <div
                                                class="flex size-8 items-center justify-center rounded-lg bg-success text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>

                                        <div>
                                            <h2
                                                    class="font-medium text-slate-700 transition-colors group-hover:text-primary group-focus:text-primary dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light">
                                                Settings
                                            </h2>
                                            <div class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                                                Webapp settings
                                            </div>
                                        </div>
                                    </a>
                                    <div class="mt-3 px-4">
                                        <button class="btn h-9 w-full space-x-2 bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="1.5"
                                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            <a href="../auth/logout.php">Logout</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- App Header Wrapper-->
    <?php include "../../components/navbar.php" ?>

    <!-- Main Content Wrapper -->
    <main class="main-content w-full pb-8">
        <div
                class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6"
        >
            <!---Welcome back Card--->
            <div class="lg:col-span-8 md:col-span-12 sm:col-span-12 col-span-12">
                <div class="card bg-slate-150 dark:bg-navy-700 mb-0 overflow-hidden">
                    <div class="card-body pb-10">
                        <div class="grid grid-cols-12">
                            <div class="lg:col-span-7 p-8 md:col-span-7 sm:col-span-12 col-span-12">
                                <div class="flex gap-3 items-center mb-7">
                                    <div class="rounded-full overflow-hidden">
                                        <img src="../../../assets/user-7.jpg"
                                             class="h-20 w-20" alt="">
                                    </div>
                                    <div class="flex flex-col text-left justify-start">
                                        <h5 class="text-lg">
                                            Welcome back <strong><?php echo $_SESSION['username']; ?></strong>
                                        </h5>
                                        <p class="mt-5 ">Êtes - vous prêt à démarrer la journée ?</p>
                                    </div>

                                </div>
                            </div>
                            <div class="lg:col-span-5 md:col-span-5 sm:col-span-12 col-span-12">
                                <div class="sm:absolute relative right-0 rtl:right-auto rtl:left-0 -bottom-8">
                                    <img src="../../../assets/welcome-bg.svg" alt=""
                                         class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---Welcome back Card End--->

            <!---Date Cards--->
            <div class="lg:col-span-4 md:col-span-12 sm:col-span-12 col-span-12">
                <div class="card bg-indigo-500 p-8 overflow-hidden">
                    <div class="card-body pb-0">
                        <?php
                        setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra'); // Définir la langue en français
                        $date_fr = strftime('%A, %d %B %Y'); // Format long : Lundi 04 Mars 2024
                        ?>
                        <h5 class="card-title text-xl text-white"><?php echo ucfirst($date_fr); ?></h5>

                        <div class="flex justify-center mt-3">
                            <img src="../../../assets/piggy.png" class="w-50" alt/>
                        </div>
                    </div>
                    <div class="px-2 pb-2">
                        <div>
                            <div class="bg-white/8 backdrop-blur rounded-lg">
                                <div id="live-clock"
                                     class="text-5xl text-white p-5 font-bold justify-center text-center items-center">
                                    <!-- L'heure sera mise à jour ici -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---Date Cards End--->

            <!---Count data database--->
            <div class="col-span-12 lg:col-span-8">
                <div class="flex items-center justify-between space-x-2">
                    <h2
                            class="text-base font-medium tracking-wide text-slate-800 line-clamp-1 dark:text-navy-100"
                    >
                        Aperçu des revenues
                    </h2>
                    <div
                            x-data="{activeTab:'tabRecent'}"
                            class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200"
                    >
                        <div class="tabs-list flex p-1">
                            <button
                                    @click="activeTab = 'tabRecent'"
                                    :class="activeTab === 'tabRecent' ? 'bg-white shadow-sm dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                    class="btn shrink-0 px-3 py-1 text-xs-plus font-medium"
                            >
                                Dernier mois
                            </button>
                            <button
                                    @click="activeTab = 'tabAll'"
                                    :class="activeTab === 'tabAll' ? 'bg-white shadow-sm dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                    class="btn shrink-0 px-3 py-1 text-xs-plus font-medium"
                            >
                                Dernière année
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:space-x-7">
                    <div
                            class="mt-4 flex shrink-0 flex-col items-center sm:items-start"
                    >
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="size-8 text-info"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.5"
                        >
                            <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"
                            />
                            <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"
                            />
                        </svg>
                        <div class="mt-4">
                            <div class="flex items-center space-x-1">
                                <p
                                        class="text-2xl font-semibold text-slate-700 dark:text-navy-100"
                                >
                                    <?php
                                    include_once '../../config/config.php';

                                    function sumTicketsMonth(): string
                                    {
                                        $conn = getConnexion();

                                        $queryRevenuVentes = "SELECT SUM(prix_total) AS total_revenu FROM ventes WHERE date_vente >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                                        $queryRevenuTickets = "SELECT SUM(price) AS total_revenu FROM tickets WHERE service_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                                        $queryRevenuDepenses = "SELECT SUM(montant) AS total_revenu FROM paiements WHERE date_paiement >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";

                                        $revenuVentes = $conn->query($queryRevenuVentes)->fetch(PDO::FETCH_ASSOC)['total_revenu'] ?? 0;
                                        $revenuTickets = $conn->query($queryRevenuTickets)->fetch(PDO::FETCH_ASSOC)['total_revenu'] ?? 0;
                                        $revenuDepenses = $conn->query($queryRevenuDepenses)->fetch(PDO::FETCH_ASSOC)['total_revenu'] ?? 0;

                                        return number_format(($revenuVentes + $revenuTickets) - $revenuDepenses, 2, ',', ' ');
                                    }

                                    echo "<strong>" . sumTicketsMonth() . " Fcfa</strong>";
                                    ?>
                                </p>
                                <button
                                        class="btn size-6 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                        />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                ce mois
                            </p>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center space-x-1">
                                <p
                                        class="text-2xl font-semibold text-slate-700 dark:text-navy-100"
                                >
                                    <?php
                                    include_once '../../config/config.php';

                                    function sumTicketsTrimester(): string
                                    {
                                        $conn = getConnexion();

//                                        $query = "SELECT SUM(price) AS total FROM tickets WHERE QUARTER(service_date) = QUARTER(CURRENT_DATE()) AND YEAR(service_date) = YEAR(CURRENT_DATE())";
//                                        $result = $conn->query($query);
//
//                                        if ($result) {
//                                            $row = $result->fetch(PDO::FETCH_ASSOC);
//                                            return isset($row['total']) ? $row['total'] : 0;
//                                        }
//
//                                        return 0;
                                        $queryRevenuVentes = "SELECT SUM(prix_total) AS total_revenu FROM ventes WHERE QUARTER(date_vente) = QUARTER(CURRENT_DATE())";
                                        $queryRevenuTickets = "SELECT SUM(price) AS total_revenu FROM tickets WHERE QUARTER(service_date) = QUARTER(CURRENT_DATE())";
                                        $queryRevenuDepenses = "SELECT SUM(montant) AS total_revenu FROM paiements WHERE QUARTER(date_paiement) = QUARTER(CURRENT_DATE())";

                                        $revenuVentes = $conn->query($queryRevenuVentes)->fetch(PDO::FETCH_ASSOC)['total_revenu'] ?? 0;
                                        $revenuTickets = $conn->query($queryRevenuTickets)->fetch(PDO::FETCH_ASSOC)['total_revenu'] ?? 0;
                                        $revenuDepenses = $conn->query($queryRevenuDepenses)->fetch(PDO::FETCH_ASSOC)['total_revenu'] ?? 0;

                                        return number_format(($revenuVentes + $revenuTickets) - $revenuDepenses, 2, ',', ' ');
                                    }

                                    echo "<strong>" . sumTicketsTrimester() . " Fcfa</strong>";
                                    ?>
                                </p>
                                <button
                                        class="btn size-6 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                        />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                ce trimestre
                            </p>
                        </div>
                        <a href="../../components/export-rapport.php"
                           class="btn mt-8 space-x-2 rounded-full border border-slate-300 px-3 text-xs-plus font-medium text-slate-700 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-100 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                        >
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="size-4.5 text-slate-400 dark:text-navy-300"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                            >
                                <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"
                                />
                            </svg>
                            <span> Télécharger le rapport</span>
                        </a>
                    </div>

                    <div class="ax-transparent-gridline grid w-full grid-cols-1">
                        <div
                                x-init="$nextTick(() => { $el._x_chart = new ApexCharts($el,pages.charts.analyticsSalesOverview); $el._x_chart.render() });"
                        ></div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4"
            >
                <div
                        class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-2"
                >
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between space-x-1">
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                <?php
                                include_once '../../config/config.php';

                                function sumTickets(): string
                                {
                                    $conn = getConnexion();

                                    $query = "SELECT SUM(price) AS total FROM tickets WHERE DATE(service_date) = current_date()";
                                    $result = $conn->query($query);

                                    $queryDeps = "SELECT SUM(montant) AS total FROM paiements WHERE DATE(date_paiement) = current_date()";
                                    $resultDeps = $conn->query($queryDeps);

                                    $queryRevenuVentes = "SELECT SUM(prix_total) AS total FROM ventes WHERE DATE(date_vente) = current_date()";
                                    $resultsVentes = $conn->query($queryRevenuVentes);

                                    $row = $result->fetch(PDO::FETCH_ASSOC);
                                    $rows = $resultDeps->fetch(PDO::FETCH_ASSOC);
                                    $rowVentes = $resultsVentes->fetch(PDO::FETCH_ASSOC);

                                    $ticketTotal = $row['total'] ?? 0;
                                    $paymentTotal = $rows['total'] ?? 0;
                                    $VentesTotal = $rowVentes['total'] ?? 0;

                                    $difference = ($ticketTotal + $VentesTotal) - $paymentTotal;
                                    return number_format($difference, 2, '.', ' ');
                                }

                                echo "<strong>" . sumTickets() . "</strong>";

                                ?>

                            </p>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="size-5 text-primary dark:text-accent"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                            >
                                <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <p class="mt-1 text-xs-plus">Revenue Journalier</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                <?php
                                include_once '../../config/config.php';
                                function countReservations()
                                {
                                    $conn = getConnexion();
                                    $query = "SELECT COUNT(*) as total FROM reservations";
                                    $result = $conn->query($query);
                                    $data = $result->fetch();
                                    return $data['total'];
                                }

                                echo "<strong>" . countReservations() . "</strong>";
                                ?>
                            </p>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="size-5 text-success"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                            >
                                <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
                                />
                            </svg>
                        </div>
                        <p class="mt-1 text-xs-plus">Reservations</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                <?php
                                include_once '../../config/config.php';
                                function countEmployees()
                                {
                                    $conn = getConnexion();
                                    $query = "SELECT COUNT(*) as total FROM employees";
                                    $result = $conn->query($query);
                                    $data = $result->fetch();
                                    return $data['total'];
                                }

                                echo "<strong>" . countEmployees() . "</strong>";
                                ?>
                            </p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="#b2b211" d="M10 12.25a.75.75 0 1 0 0 1.5h4a.75.75 0 0 0 0-1.5z"/>
                                <path fill="#b2b211" fill-rule="evenodd"
                                      d="M7.32 4.275A3.75 3.75 0 0 1 11 1.25h2a3.75 3.75 0 0 1 3.68 3.025a6.75 6.75 0 0 1 5.07 6.445v5.655a5.27 5.27 0 0 1-4.126 5.143a25.9 25.9 0 0 1-11.248 0a5.27 5.27 0 0 1-4.126-5.143V10.72a6.75 6.75 0 0 1 5.07-6.445m1.695-.335A2.25 2.25 0 0 1 11 2.75h2c.86 0 1.607.482 1.986 1.19a19.8 19.8 0 0 0-5.971 0m11.235 6.971v2.596a21.4 21.4 0 0 1-16.5 0V10.74a5.25 5.25 0 0 1 4.207-5.074c.084-.02.124-.028.164-.037a18.25 18.25 0 0 1 7.759 0l.163.037l.167.037a5.25 5.25 0 0 1 4.04 5.207m-16.5 5.464v-1.252a22.9 22.9 0 0 0 13 1.04V17a.75.75 0 0 0 1.5 0v-1.209a23 23 0 0 0 2-.668v1.252a3.77 3.77 0 0 1-2.951 3.68c-3.49.775-7.108.775-10.598 0a3.77 3.77 0 0 1-2.95-3.68"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="mt-1 text-xs-plus">Employés</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between space-x-1">
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                <?php
                                include_once '../../config/config.php';
                                function countServices()
                                {
                                    $conn = getConnexion();
                                    $query = "SELECT COUNT(*) as total FROM services";
                                    $result = $conn->query($query);
                                    $data = $result->fetch();
                                    return $data['total'];
                                }

                                echo "<strong>" . countServices() . "</strong>";
                                ?>
                            </p>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="size-5 text-secondary"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                            >
                                <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                />
                            </svg>
                        </div>
                        <p class="mt-1 text-xs-plus">Services</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                <?php
                                include_once '../../config/config.php';
                                function countClient()
                                {
                                    $conn = getConnexion();
                                    $query = "SELECT COUNT(*) as total FROM clients";
                                    $result = $conn->query($query);
                                    $data = $result->fetch();
                                    return $data['total'];
                                }

                                echo "<strong>" . countClient() . "</strong>";
                                ?>
                            </p>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="size-5 text-error"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                            >
                                <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                />
                            </svg>
                        </div>
                        <p class="mt-1 text-xs-plus">Clients</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                <?php
                                include_once '../../config/config.php';
                                function countUsers()
                                {
                                    $conn = getConnexion();
                                    $query = "SELECT COUNT(*) as total FROM users";
                                    $result = $conn->query($query);
                                    $data = $result->fetch();
                                    return $data['total'];
                                }

                                echo "<strong>" . countUsers() . "</strong>";
                                ?>
                            </p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="none" stroke="#b27811" stroke-width="1.5">
                                    <circle cx="12" cy="6" r="4"/>
                                    <path stroke-linecap="round"
                                          d="M18 9c1.657 0 3-1.12 3-2.5S19.657 4 18 4M6 9C4.343 9 3 7.88 3 6.5S4.343 4 6 4"/>
                                    <ellipse cx="12" cy="17" rx="6" ry="4"/>
                                    <path stroke-linecap="round"
                                          d="M20 19c1.754-.385 3-1.359 3-2.5s-1.246-2.115-3-2.5M4 19c-1.754-.385-3-1.359-3-2.5s1.246-2.115 3-2.5"/>
                                </g>
                            </svg>
                        </div>
                        <p class="mt-1 text-xs-plus">Utilisateurs</p>
                    </div>
                </div>
            </div>
            <!---Count data database End--->

            <div class="card col-span-12 lg:col-span-8">
                <div class="flex items-center justify-between py-3 px-4">
                    <h2
                            class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
                    >
                        Aperçu des ventes & charges
                    </h2>
                    <div
                            x-data="usePopper({placement:'bottom-end',offset:4})"
                            @click.outside="isShowPopper && (isShowPopper = false)"
                            class="inline-flex"
                    >
                        <button
                                x-ref="popperRef"
                                @click="isShowPopper = !isShowPopper"
                                class="btn size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                        >
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="size-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                            >
                                <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-y-4 pb-3 sm:grid-cols-3">
                    <div
                            class="flex flex-col justify-between border-4 border-transparent border-l-indigo-500 px-4"
                    >
                        <div>
                            <p
                                    class="text-base font-medium text-slate-600 dark:text-navy-100"
                            >
                                Statistiques hebdomadaires
                            </p>
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Ventes moyennes
                            </p>
                            <!--                            <div class="badge mt-2 bg-info/10 text-info dark:bg-info/15">-->
                            <!--                                UI/UX Design-->
                            <!--                            </div>-->
                        </div>
                        <div>
                            <div class="mt-8">
                                <p class="font-inter">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div
                                                class="bg-indigo-100 h-10 w-10 flex justify-center items-center rounded-md">
                                            <svg class="text-indigo-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M6.26 21.388H6c-.943 0-1.414 0-1.707-.293C4 20.804 4 20.332 4 19.389v-1.112c0-.518 0-.777.133-1.009s.334-.348.736-.582c2.646-1.539 6.403-2.405 8.91-.91q.253.151.45.368a1.49 1.49 0 0 1-.126 2.134a1 1 0 0 1-.427.24q.18-.021.345-.047c.911-.145 1.676-.633 2.376-1.162l1.808-1.365a1.89 1.89 0 0 1 2.22 0c.573.433.749 1.146.386 1.728c-.423.678-1.019 1.545-1.591 2.075s-1.426 1.004-2.122 1.34c-.772.373-1.624.587-2.491.728c-1.758.284-3.59.24-5.33-.118a15 15 0 0 0-3.017-.308"
                                                      opacity="0.5"/>
                                                <path fill="currentColor"
                                                      d="M10.861 3.363C11.368 2.454 11.621 2 12 2s.632.454 1.139 1.363l.13.235c.145.259.217.388.329.473s.252.117.532.18l.254.058c.984.222 1.476.334 1.593.71s-.218.769-.889 1.553l-.174.203c-.19.223-.285.334-.328.472s-.029.287 0 .584l.026.27c.102 1.047.152 1.57-.154 1.803s-.767.02-1.688-.404l-.239-.11c-.261-.12-.392-.18-.531-.18s-.27.06-.531.18l-.239.11c-.92.425-1.382.637-1.688.404s-.256-.756-.154-1.802l.026-.271c.029-.297.043-.446 0-.584s-.138-.25-.328-.472l-.174-.203c-.67-.784-1.006-1.177-.889-1.553s.609-.488 1.593-.71l.254-.058c.28-.063.42-.095.532-.18s.184-.214.328-.473zm8.569 4.319c.254-.455.38-.682.57-.682s.316.227.57.682l.065.117c.072.13.108.194.164.237s.126.058.266.09l.127.028c.492.112.738.167.796.356s-.109.384-.444.776l-.087.101c-.095.112-.143.168-.164.237s-.014.143 0 .292l.013.135c.05.523.076.785-.077.901s-.383.01-.844-.202l-.12-.055c-.13-.06-.196-.09-.265-.09c-.07 0-.135.03-.266.09l-.119.055c-.46.212-.69.318-.844.202c-.153-.116-.128-.378-.077-.901l.013-.135c.014-.15.022-.224 0-.292c-.021-.07-.069-.125-.164-.237l-.087-.101c-.335-.392-.503-.588-.444-.776s.304-.244.796-.356l.127-.028c.14-.032.21-.048.266-.09c.056-.043.092-.108.164-.237zm-16 0C3.685 7.227 3.81 7 4 7s.316.227.57.682l.065.117c.072.13.108.194.164.237s.126.058.266.09l.127.028c.492.112.738.167.797.356c.058.188-.11.384-.445.776l-.087.101c-.095.112-.143.168-.164.237s-.014.143 0 .292l.013.135c.05.523.076.785-.077.901s-.384.01-.844-.202l-.12-.055c-.13-.06-.196-.09-.265-.09c-.07 0-.135.03-.266.09l-.119.055c-.46.212-.69.318-.844.202c-.153-.116-.128-.378-.077-.901l.013-.135c.014-.15.022-.224 0-.292c-.021-.07-.069-.125-.164-.237l-.087-.101c-.335-.392-.503-.588-.445-.776c.059-.189.305-.244.797-.356l.127-.028c.14-.032.21-.048.266-.09c.056-.043.092-.108.164-.237z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <?php
                                            include_once "../../config/config.php";

                                            $pdo = getConnexion();

                                            $query = "SELECT b.nom, SUM(v.quantite_vendue) AS total_vendu
                                                  FROM ventes v
                                                  JOIN boissons b ON v.boisson_id = b.id
                                                  WHERE v.date_vente >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                                                  GROUP BY b.id
                                                  ORDER BY total_vendu DESC
                                                  LIMIT 1";

                                            $stmt = $pdo->query($query);
                                            $meilleure_vente = $stmt->fetch(PDO::FETCH_ASSOC);

                                            // Vérifier si un produit a été trouvé
                                            $nom_produit = $meilleure_vente ? $meilleure_vente['nom'] : 'Aucune vente';
                                            $total_vendu = $meilleure_vente ? $meilleure_vente['total_vendu'] : 0;

                                            ?>
                                            <h6 class="text-base">Meilleure Vente</h6>
                                            <p class=" dark:text-darklink "><?= htmlspecialchars($nom_produit) ?></p>
                                        </div>
                                    </div>
                                    <span
                                            class="bg-indigo-100 text-indigo-500 p-2 rounded-full">+<?= $total_vendu ?>
                                    </span>

                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                            class="flex flex-col justify-between border-4 border-transparent border-l-green-600 px-4"
                    >
                        <div>
                            <p
                                    class="text-base font-medium text-slate-600 dark:text-navy-100"
                            >
                                Aperçu des ventes
                            </p>
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Chaque mois
                            </p>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2">
                            <div class="mt-8">
                                <p class="font-inter">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div
                                                class="bg-green-100 h-10 w-10 flex justify-center items-center rounded-md">
                                            <svg class="text-green-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M16 16h3a3 3 0 1 1-3 3.001zM5 16l3 .001v3a3 3 0 1 1-3-3"/>
                                                <path fill="currentColor" fill-rule="evenodd"
                                                      d="M19 8h-3V5a3 3 0 1 1 3 3M8 8V5a3 3 0 1 0-3 3z"
                                                      clip-rule="evenodd"/>
                                                <path fill="currentColor" d="M16 8H8v8h8z" opacity="0.5"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <?php
                                            include_once "../../config/config.php";

                                            $pdo = getConnexion();

                                            // Récupérer les revenus (chiffre d'affaires) du mois
                                            $queryRevenuVentes = "SELECT SUM(prix_total) AS total_revenu FROM ventes WHERE date_vente >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                                            $queryRevenuTickets = "SELECT SUM(price) AS total_revenu FROM tickets WHERE service_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";

                                            $revenuVentes = $pdo->query($queryRevenuVentes)->fetch(PDO::FETCH_ASSOC)['total_revenu'] ?? 0;
                                            $revenuTickets = $pdo->query($queryRevenuTickets)->fetch(PDO::FETCH_ASSOC)['total_revenu'] ?? 0;

                                            $revenuTotal = $revenuVentes + $revenuTickets;

                                            // Récupérer les dépenses du mois
                                            $queryDepensesVentes = "SELECT SUM(b.prix_achat * v.quantite_vendue) AS total_depenses 
                                                    FROM ventes v
                                                    JOIN boissons b ON v.boisson_id = b.id
                                                    WHERE v.date_vente >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                                            $queryDepensesPaiements = "SELECT SUM(montant) AS total_depenses 
                                                   FROM paiements 
                                                   WHERE date_paiement >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";

                                            $depensesVentes = $pdo->query($queryDepensesVentes)->fetch(PDO::FETCH_ASSOC)['total_depenses'] ?? 0;
                                            $depensesPaiements = $pdo->query($queryDepensesPaiements)->fetch(PDO::FETCH_ASSOC)['total_depenses'] ?? 0;

                                            $depensesTotal = $depensesVentes + $depensesPaiements;

                                            // Calcul des bénéfices (évite les valeurs négatives)
                                            $benefices = max(0, $revenuTotal - $depensesTotal);

                                            // Récupérer le nombre de charges
                                            $queryCharges = "SELECT COUNT(*) AS total_charges FROM charges WHERE charges.date_debut >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                                            $totalCharges = $pdo->query($queryCharges)->fetch(PDO::FETCH_ASSOC)['total_charges'] ?? 0;

                                            //Récupérer le total des paiements effectués
                                            $queryPaiements = "SELECT SUM(montant) AS total_paiements FROM paiements WHERE date_paiement >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                                            $totalPaiements = $pdo->query($queryPaiements)->fetch(PDO::FETCH_ASSOC)['total_paiements'] ?? 0;
                                            ?>

                                            <h6 class="text-base"><?= number_format($benefices, 2, ',', ' ') ?></h6>
                                            <p class=" dark:text-darklink ">Bénéfice</p>
                                        </div>
                                    </div>

                                </div>
                                </p>
                            </div>
                            <div class="mt-8">
                                <p class="font-inter">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div
                                                class="bg-green-100 h-10 w-10 flex justify-center items-center rounded-md">
                                            <svg class="text-green-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M16 16h3a3 3 0 1 1-3 3.001zM5 16l3 .001v3a3 3 0 1 1-3-3"/>
                                                <path fill="currentColor" fill-rule="evenodd"
                                                      d="M19 8h-3V5a3 3 0 1 1 3 3M8 8V5a3 3 0 1 0-3 3z"
                                                      clip-rule="evenodd"/>
                                                <path fill="currentColor" d="M16 8H8v8h8z" opacity="0.5"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="text-base"><?= number_format($depensesTotal, 2, ',', ' ') ?></h6>
                                            <p class=" dark:text-darklink ">Dépenses</p>
                                        </div>
                                    </div>

                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                            class="flex flex-col justify-between border-4 border-transparent border-l-red-500 px-4"
                    >
                        <div>
                            <p
                                    class="text-base font-medium text-slate-600 dark:text-navy-100"
                            >
                                Aperçu des charges
                            </p>
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Mensuellement
                            </p>
                        </div>
                        <div>
                            <div class="mt-8">
                                <p class="font-inter">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div
                                                class="bg-red-100 h-10 w-10 flex justify-center items-center rounded-md">
                                            <svg class="text-red-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M8.422 20.618C10.178 21.54 11.056 22 12 22V12L2.638 7.073l-.04.067C2 8.154 2 9.417 2 11.942v.117c0 2.524 0 3.787.597 4.801c.598 1.015 1.674 1.58 3.825 2.709z"/>
                                                <path fill="currentColor"
                                                      d="m17.577 4.432l-2-1.05C13.822 2.461 12.944 2 12 2c-.945 0-1.822.46-3.578 1.382l-2 1.05C4.318 5.536 3.242 6.1 2.638 7.072L12 12l9.362-4.927c-.606-.973-1.68-1.537-3.785-2.641"
                                                      opacity="0.7"/>
                                                <path fill="currentColor"
                                                      d="m21.403 7.14l-.041-.067L12 12v10c.944 0 1.822-.46 3.578-1.382l2-1.05c2.151-1.129 3.227-1.693 3.825-2.708c.597-1.014.597-2.277.597-4.8v-.117c0-2.525 0-3.788-.597-4.802"
                                                      opacity="0.5"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="text-base"><?= number_format($totalCharges) ?></h6>
                                            <p>Charges</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="mt-8">
                                <p class="font-inter">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div
                                                class="bg-red-100 h-10 w-10 flex justify-center items-center rounded-md">
                                            <svg class="text-red-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M8.422 20.618C10.178 21.54 11.056 22 12 22V12L2.638 7.073l-.04.067C2 8.154 2 9.417 2 11.942v.117c0 2.524 0 3.787.597 4.801c.598 1.015 1.674 1.58 3.825 2.709z"/>
                                                <path fill="currentColor"
                                                      d="m17.577 4.432l-2-1.05C13.822 2.461 12.944 2 12 2c-.945 0-1.822.46-3.578 1.382l-2 1.05C4.318 5.536 3.242 6.1 2.638 7.072L12 12l9.362-4.927c-.606-.973-1.68-1.537-3.785-2.641"
                                                      opacity="0.7"/>
                                                <path fill="currentColor"
                                                      d="m21.403 7.14l-.041-.067L12 12v10c.944 0 1.822-.46 3.578-1.382l2-1.05c2.151-1.129 3.227-1.693 3.825-2.708c.597-1.014.597-2.277.597-4.8v-.117c0-2.525 0-3.788-.597-4.802"
                                                      opacity="0.5"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="text-base"><?= number_format($totalPaiements, 2, ',', ' ') ?></h6>
                                            <p>Montant décaissé</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4">
                <div class="flex items-center justify-between">
                    <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        Satisfaction client
                    </h2>
                </div>

                <?php
                // Connexion à la base de données (à adapter)
                include_once '../../config/config.php';

                $pdo = getConnexion();

                // Récupérer le total des tickets
                $totalQuery = $pdo->query("SELECT COUNT(*) as total FROM tickets WHERE appreciation IS NOT NULL");
                $total = $totalQuery->fetch(PDO::FETCH_ASSOC)['total'];

                // Récupérer le nombre de tickets satisfaits et pas satisfaits
                $query = $pdo->query("
                    SELECT appreciation, COUNT(*) as count
                    FROM tickets
                    WHERE appreciation IS NOT NULL
                    GROUP BY appreciation
                ");

                $stats = ['Satisfaite' => 0, 'Pas satisfaite' => 0];
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $stats[$row['appreciation']] = $row['count'];
                }

                // Calcul des pourcentages
                $percentages = [
                    'Satisfaite' => ($total > 0) ? round(($stats['Satisfaite'] / $total) * 100) : 0,
                    'Pas Satisfaite' => ($total > 0) ? round(($stats['Pas Satisfaite'] / $total) * 100) : 0
                ];

                // Récupération des données
                $query = $pdo->query("
                    SELECT 
                        COUNT(CASE WHEN appreciation = 'Satisfaite' THEN 1 END) AS satisfaite_count,
                        COUNT(*) AS total_feedback
                    FROM tickets
                ");

                $result = $query->fetch(PDO::FETCH_ASSOC);

                $satisfaite_count = $result['satisfaite_count'];
                $total_feedback = $result['total_feedback'];

                // Calcul du score de satisfaction sur 10
                $satisfaction_score = $total_feedback > 0 ? ($satisfaite_count / $total_feedback) * 10 : 0;

                // Compter le nombre de tickets avec une note satisfaisante
                $query = $pdo->query("SELECT COUNT(*) as total FROM tickets WHERE appreciation = 'Satisfaite'");
                $total_notes_satisfy = $query->fetch(PDO::FETCH_ASSOC)['total'];

                // Compter le nombre de tickets avec une note insatisfaisante
                $query = $pdo->query("SELECT COUNT(*) as total FROM tickets WHERE appreciation = 'Pas Satisfaite'");
                $total_notes_unsatisfy = $query->fetch(PDO::FETCH_ASSOC)['total'];
                ?>


                <div class="mt-3">
                    <p>
                        <span class="text-3xl text-slate-700 dark:text-navy-100">
                            <?= number_format($satisfaction_score, 1) ?>
                        </span>
                        <span class="text-xs text-success"><?= $percentages['Satisfaite'] ?>%</span>
                    </p>
                    <p class="text-xs-plus">Taux de satisfaction</p>
                </div>
                <div class="mt-4 flex h-2 space-x-1 w-full">
                    <div class="w-<?= $percentages['Satisfaite'] ?>/12 rounded-full bg-primary dark:bg-accent"
                         x-tooltip.primary="'Satisfaite'"></div>
                    <div class="w-<?= $percentages['Pas Satisfaite'] ?>/12 rounded-full bg-error"
                         x-tooltip.error="'Pas satisfaite'"></div>
                </div>
                <div class="is-scrollbar-hidden mt-4 min-w-full overflow-x-auto">
                    <table class="w-full font-inter">
                        <tbody>
                        <tr>
                            <td class="whitespace-nowrap py-2">
                                <div class="flex items-center space-x-2">
                                    <div class="size-3.5 rounded-full border-2 border-primary dark:border-accent"></div>
                                    <p class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                        Satisfaite</p>
                                </div>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right">
                                <p class="font-medium text-slate-700 dark:text-navy-100"><?= $total_notes_satisfy ?></p>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right"><?= $percentages['Satisfaite'] ?>%</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-2">
                                <div class="flex items-center space-x-2">
                                    <div class="size-3.5 rounded-full border-2 border-error"></div>
                                    <p class="font-medium tracking-wide text-slate-700 dark:text-navy-100">Pas
                                        satisfaite</p>
                                </div>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right">
                                <p class="font-medium text-slate-700 dark:text-navy-100"> <?= $total_notes_unsatisfy ?> </p>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right"><?= $percentages['Pas Satisfaite'] ?>%</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="w-full px-[var(--margin-x)] pb-8">
            <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">

                <div class="card group col-span-12 pb-5 lg:col-span-8">
                    <div class="my-3 flex flex-col justify-between px-4 sm:flex-row sm:items-center sm:px-5">
                        <div class="flex flex-1 items-center justify-between space-x-2 sm:flex-initial">
                            <h2 class="text-sm-plus font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                Historique Journalier
                            </h2>
                        </div>

                        <?php
                        // Supposons que l'email de l'utilisateur est stocké dans une variable $email
                        $email = $_SESSION['email'] ?? ''; // Par exemple

                        if ($email == 'ngahemeniw@gmail.com' || $email == 'ngahemeni@gmail.com') {
                            ?>
                            <form action="../../config/export-excel-all.php?date=<?php echo date('Y-m-d'); ?>" method="GET">
                                <div class="flex items-center space-x-4">
                                    <input type="date" name="date" id="date" class="px-4 py-2 rounded-lg border">
                                    <div>
                                        <button type="submit"
                                                class="flex cursor-pointer items-center bg-gray-900/5 px-5 py-1.5 rounded-lg space-x-2">
                                            <!-- SVG ici -->
                                            <div>
                                                <!-- ... (SVG) ... -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                     viewBox="0 0 32 32">
                                                    <defs>
                                                        <linearGradient id="vscodeIconsFileTypeExcel0" x1="4.494"
                                                                        x2="13.832"
                                                                        y1="-2092.086" y2="-2075.914"
                                                                        gradientTransform="translate(0 2100)"
                                                                        gradientUnits="userSpaceOnUse">
                                                            <stop offset="0" stop-color="#18884f"/>
                                                            <stop offset=".5" stop-color="#117e43"/>
                                                            <stop offset="1" stop-color="#0b6631"/>
                                                        </linearGradient>
                                                    </defs>
                                                    <path fill="#185c37"
                                                          d="M19.581 15.35L8.512 13.4v14.409A1.19 1.19 0 0 0 9.705 29h19.1A1.19 1.19 0 0 0 30 27.809V22.5Z"/>
                                                    <path fill="#21a366"
                                                          d="M19.581 3H9.705a1.19 1.19 0 0 0-1.193 1.191V9.5L19.581 16l5.861 1.95L30 16V9.5Z"/>
                                                    <path fill="#107c41" d="M8.512 9.5h11.069V16H8.512Z"/>
                                                    <path d="M16.434 8.2H8.512v16.25h7.922a1.2 1.2 0 0 0 1.194-1.191V9.391A1.2 1.2 0 0 0 16.434 8.2"
                                                          opacity="0.1"/>
                                                    <path d="M15.783 8.85H8.512V25.1h7.271a1.2 1.2 0 0 0 1.194-1.191V10.041a1.2 1.2 0 0 0-1.194-1.191"
                                                          opacity="0.2"/>
                                                    <path d="M15.783 8.85H8.512V23.8h7.271a1.2 1.2 0 0 0 1.194-1.191V10.041a1.2 1.2 0 0 0-1.194-1.191"
                                                          opacity="0.2"/>
                                                    <path d="M15.132 8.85h-6.62V23.8h6.62a1.2 1.2 0 0 0 1.194-1.191V10.041a1.2 1.2 0 0 0-1.194-1.191"
                                                          opacity="0.2"/>
                                                    <path fill="url(#vscodeIconsFileTypeExcel0)"
                                                          d="M3.194 8.85h11.938a1.193 1.193 0 0 1 1.194 1.191v11.918a1.193 1.193 0 0 1-1.194 1.191H3.194A1.19 1.19 0 0 1 2 21.959V10.041A1.19 1.19 0 0 1 3.194 8.85"/>
                                                    <path fill="#fff"
                                                          d="m5.7 19.873l2.511-3.884l-2.3-3.862h1.847L9.013 14.6c.116.234.2.408.238.524h.017q.123-.281.26-.546l1.342-2.447h1.7l-2.359 3.84l2.419 3.905h-1.809l-1.45-2.711A2.4 2.4 0 0 1 9.2 16.8h-.024a1.7 1.7 0 0 1-.168.351l-1.493 2.722Z"/>
                                                    <path fill="#33c481"
                                                          d="M28.806 3h-9.225v6.5H30V4.191A1.19 1.19 0 0 0 28.806 3"/>
                                                    <path fill="#107c41" d="M19.581 16H30v6.5H19.581Z"/>
                                                </svg>
                                            </div>
                                            <p>Excel</p>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <?php
                        } else {
                            ?>
                            <form action="../../config/export-excel.php" method="GET">
                                <div class="flex items-center space-x-4">
                                    <!-- <input type="date" name="date" id="date" class="px-4 py-2 rounded-lg border"> -->
                                    <div>
                                        <button type="submit"
                                                class="flex cursor-pointer items-center bg-gray-900/5 px-5 py-1.5 rounded-lg space-x-2">
                                            <!-- SVG ici -->
                                            <div>
                                                <!-- ... (SVG) ... -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                     viewBox="0 0 32 32">
                                                    <defs>
                                                        <linearGradient id="vscodeIconsFileTypeExcel0" x1="4.494"
                                                                        x2="13.832"
                                                                        y1="-2092.086" y2="-2075.914"
                                                                        gradientTransform="translate(0 2100)"
                                                                        gradientUnits="userSpaceOnUse">
                                                            <stop offset="0" stop-color="#18884f"/>
                                                            <stop offset=".5" stop-color="#117e43"/>
                                                            <stop offset="1" stop-color="#0b6631"/>
                                                        </linearGradient>
                                                    </defs>
                                                    <path fill="#185c37"
                                                          d="M19.581 15.35L8.512 13.4v14.409A1.19 1.19 0 0 0 9.705 29h19.1A1.19 1.19 0 0 0 30 27.809V22.5Z"/>
                                                    <path fill="#21a366"
                                                          d="M19.581 3H9.705a1.19 1.19 0 0 0-1.193 1.191V9.5L19.581 16l5.861 1.95L30 16V9.5Z"/>
                                                    <path fill="#107c41" d="M8.512 9.5h11.069V16H8.512Z"/>
                                                    <path d="M16.434 8.2H8.512v16.25h7.922a1.2 1.2 0 0 0 1.194-1.191V9.391A1.2 1.2 0 0 0 16.434 8.2"
                                                          opacity="0.1"/>
                                                    <path d="M15.783 8.85H8.512V25.1h7.271a1.2 1.2 0 0 0 1.194-1.191V10.041a1.2 1.2 0 0 0-1.194-1.191"
                                                          opacity="0.2"/>
                                                    <path d="M15.783 8.85H8.512V23.8h7.271a1.2 1.2 0 0 0 1.194-1.191V10.041a1.2 1.2 0 0 0-1.194-1.191"
                                                          opacity="0.2"/>
                                                    <path d="M15.132 8.85h-6.62V23.8h6.62a1.2 1.2 0 0 0 1.194-1.191V10.041a1.2 1.2 0 0 0-1.194-1.191"
                                                          opacity="0.2"/>
                                                    <path fill="url(#vscodeIconsFileTypeExcel0)"
                                                          d="M3.194 8.85h11.938a1.193 1.193 0 0 1 1.194 1.191v11.918a1.193 1.193 0 0 1-1.194 1.191H3.194A1.19 1.19 0 0 1 2 21.959V10.041A1.19 1.19 0 0 1 3.194 8.85"/>
                                                    <path fill="#fff"
                                                          d="m5.7 19.873l2.511-3.884l-2.3-3.862h1.847L9.013 14.6c.116.234.2.408.238.524h.017q.123-.281.26-.546l1.342-2.447h1.7l-2.359 3.84l2.419 3.905h-1.809l-1.45-2.711A2.4 2.4 0 0 1 9.2 16.8h-.024a1.7 1.7 0 0 1-.168.351l-1.493 2.722Z"/>
                                                    <path fill="#33c481"
                                                          d="M28.806 3h-9.225v6.5H30V4.191A1.19 1.19 0 0 0 28.806 3"/>
                                                    <path fill="#107c41" d="M19.581 16H30v6.5H19.581Z"/>
                                                </svg>
                                            </div>
                                            <p>Excel</p>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <?php
                        }
                        ?>



                    </div>

                    <div class="grid grid-cols-12 gap-4 px-4 sm:gap-5 sm:px-5 lg:gap-6 lg:px-5">
                        <div
                                class="col-span-12 rounded-lg bg-slate-50 p-3 dark:bg-navy-600">
                            <div class="space-y-4">
                                <?php
                                include_once '../../config/config.php';
                                $conn = getConnexion();

                                // Nombre d'éléments par page
                                $limit = 10;

                                // Récupérer la page actuelle
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $offset = ($page - 1) * $limit;

                                // Requête SQL avec LIMIT et OFFSET pour la pagination
                                $sql = "
                                    SELECT t.id AS ticket_id, t.service_date, t.appreciation, t.price AS ticket_price, 
                                           c.first_name AS client_first_name, c.last_name AS client_last_name, c.phone AS client_phone,
                                           s.name AS service_name, e.first_name AS employee_first_name, e.last_name AS employee_last_name
                                    FROM tickets t
                                    JOIN clients c ON t.client_id = c.id
                                    JOIN services s ON t.service_id = s.id
                                    JOIN employees e ON t.employee_id = e.id
                                    WHERE t.service_date >= CURRENT_DATE
                                    ORDER BY t.service_date DESC
                                    LIMIT :limit OFFSET :offset
                                ";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                                $stmt->execute();
                                $tickets = $stmt->fetchAll();

                                // Calculer le nombre total de tickets
                                $totalSql = "SELECT COUNT(*) FROM tickets WHERE service_date >= CURRENT_DATE";
                                $totalStmt = $conn->prepare($totalSql);
                                $totalStmt->execute();
                                $totalTickets = $totalStmt->fetchColumn();
                                $totalPages = ceil($totalTickets / $limit);

                                foreach ($tickets as $ticket) {
                                    echo '
                                        <div class="flex cursor-pointer items-center text-left justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="avatar">
                                                    <img class="rounded-full" src="../../../assets/logo.jpg" alt="avatar"/>
                                                </div>
                                                <div>
                                                    <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                        ' . htmlspecialchars($ticket['client_first_name']) . ' ' . htmlspecialchars($ticket['client_last_name']) . '
                                                    </p>
                                                    <p class="text-xs text-slate-400 line-clamp-1 dark:text-navy-200">
                                                        ' . htmlspecialchars($ticket['service_date']) . '
                                                    </p>
                                                </div>
                                            </div>
                                            <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                ' . htmlspecialchars($ticket['service_name']) . '
                                            </p>
                                            <div>
                                                <p class="text-xs text-slate-400 line-clamp-1 dark:text-navy-200">
                                                    Effectué(e) par
                                                </p>
                                                <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                    ' . htmlspecialchars($ticket['employee_first_name']) . ' ' . htmlspecialchars($ticket['employee_last_name']) . '
                                                </p>
                                            </div>
                                            <p class="font-medium text-success">' . htmlspecialchars($ticket['ticket_price']) . ' Fcfa</p>
                                        </div>
                                    ';
                                }
                                ?>

                                <!-- Pagination -->
                                <div class="pagination">
                                    <ul class="flex list-none gap-2">
                                        <!-- Lien vers la page précédente -->
                                        <?php if ($page > 1): ?>
                                            <li><a href="?page=<?php echo $page - 1; ?>"
                                                   class="text-white bg-blue-500 flex items-center justify-center h-9 w-9 rounded-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                         height="24" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                              d="M17.75 19a.75.75 0 0 1-1.32.488l-6-7a.75.75 0 0 1 0-.976l6-7A.75.75 0 0 1 17.75 5z"
                                                              opacity="0.5"/>
                                                        <path fill="currentColor" fill-rule="evenodd"
                                                              d="M13.488 19.57a.75.75 0 0 0 .081-1.058L7.988 12l5.581-6.512a.75.75 0 1 0-1.138-.976l-6 7a.75.75 0 0 0 0 .976l6 7a.75.75 0 0 0 1.057.082"
                                                              clip-rule="evenodd"/>
                                                    </svg>
                                                </a></li>
                                        <?php endif; ?>

                                        <!-- Lien vers chaque page -->
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li><a href="?page=<?php echo $i; ?>"
                                                   class="text-blue-500 bg-none border-blue-500 flex items-center border justify-center h-9 w-9 rounded-full <?php if ($i == $page) echo 'font-bold bg-blue-200 border-none'; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <!-- Lien vers la page suivante -->
                                        <?php if ($page < $totalPages): ?>
                                            <li><a href="?page=<?php echo $page + 1; ?>"
                                                   class="bg-blue-500 flex items-center justify-center h-9 w-9 rounded-full text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                         height="24" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                              d="M6.25 19a.75.75 0 0 0 1.32.488l6-7a.75.75 0 0 0 0-.976l-6-7A.75.75 0 0 0 6.25 5z"
                                                              opacity="0.5"/>
                                                        <path fill="currentColor" fill-rule="evenodd"
                                                              d="M10.512 19.57a.75.75 0 0 1-.081-1.058L16.012 12l-5.581-6.512a.75.75 0 1 1 1.139-.976l6 7a.75.75 0 0 1 0 .976l-6 7a.75.75 0 0 1-1.058.082"
                                                              clip-rule="evenodd"/>
                                                    </svg>
                                                </a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card group col-span-12 pb-5 lg:col-span-4">
                    <div class="my-3 flex flex-col justify-between px-4 sm:flex-row sm:items-center sm:px-5">
                        <div class="flex flex-1 items-center justify-between space-x-2 sm:flex-initial">
                            <h2 class="text-sm-plus font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                Nos services
                            </h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-4 px-4 sm:gap-5 sm:px-5 lg:gap-6 lg:px-5">
                        <div
                                class="col-span-12 rounded-lg bg-slate-50 p-3 dark:bg-navy-600">
                            <div class="space-y-4">
                                <?php
                                include_once '../../config/config.php';

                                $conn = getConnexion();

                                // Nombre d'éléments par page
                                $limit = 10;

                                // Récupérer la page actuelle
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $offset = ($page - 1) * $limit;

                                // Requête SQL avec LIMIT et OFFSET pour la pagination
                                $sql = "SELECT * FROM services ORDER BY price ASC LIMIT :limit OFFSET :offset";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                                $stmt->execute();
                                $result = $stmt->fetchAll();

                                // Calculer le nombre total de services
                                $totalSql = "SELECT COUNT(*) FROM services";
                                $totalStmt = $conn->prepare($totalSql);
                                $totalStmt->execute();
                                $totalServices = $totalStmt->fetchColumn();
                                $totalPages = ceil($totalServices / $limit);

                                // Affichage des services
                                foreach ($result as $row) {
                                    echo '
                                        <div class="flex cursor-pointer items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="avatar">
                                                    <img class="rounded-full" src="../../../assets/logo.jpg" alt="avatar" />
                                                </div>
                                                <div>
                                                    <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                        ' . htmlspecialchars($row['name']) . '
                                                    </p>
                                                </div>
                                            </div>
                                            <p class="font-medium text-success">' . htmlspecialchars($row['price']) . ' Fcfa</p>
                                        </div>';
                                }
                                ?>

                            </div>
                        </div>
                        <!-- Pagination -->
                        <div class="pagination">
                            <ul class="flex list-none gap-2">
                                <!-- Lien vers la page précédente -->
                                <?php if ($page > 1): ?>
                                    <li><a href="?page=<?php echo $page - 1; ?>"
                                           class="text-white bg-blue-500 flex items-center justify-center h-9 w-9 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M17.75 19a.75.75 0 0 1-1.32.488l-6-7a.75.75 0 0 1 0-.976l6-7A.75.75 0 0 1 17.75 5z"
                                                      opacity="0.5"/>
                                                <path fill="currentColor" fill-rule="evenodd"
                                                      d="M13.488 19.57a.75.75 0 0 0 .081-1.058L7.988 12l5.581-6.512a.75.75 0 1 0-1.138-.976l-6 7a.75.75 0 0 0 0 .976l6 7a.75.75 0 0 0 1.057.082"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </a></li>
                                <?php endif; ?>

                                <!-- Lien vers chaque page -->
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li><a href="?page=<?php echo $i; ?>"
                                           class="text-blue-500 bg-none border-blue-500 flex items-center border justify-center h-9 w-9 rounded-full <?php if ($i == $page) echo 'font-bold bg-blue-200 border-none'; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <!-- Lien vers la page suivante -->
                                <?php if ($page < $totalPages): ?>
                                    <li><a href="?page=<?php echo $page + 1; ?>"
                                           class="bg-blue-500 flex items-center justify-center h-9 w-9 rounded-full text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M6.25 19a.75.75 0 0 0 1.32.488l6-7a.75.75 0 0 0 0-.976l-6-7A.75.75 0 0 0 6.25 5z"
                                                      opacity="0.5"/>
                                                <path fill="currentColor" fill-rule="evenodd"
                                                      d="M10.512 19.57a.75.75 0 0 1-.081-1.058L16.012 12l-5.581-6.512a.75.75 0 1 1 1.139-.976l6 7a.75.75 0 0 1 0 .976l-6 7a.75.75 0 0 1-1.058.082"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<!--
    This is a place for Alpine.js Teleport feature
    @see https://alpinejs.dev/directives/teleport
  -->
<div id="x-teleport-target"></div>
<script>
    function updateClock() {
        const now = new Date();
        const formattedTime = now.toLocaleTimeString('fr-FR', {hour: '2-digit', minute: '2-digit', second: '2-digit'});
        document.getElementById('live-clock').textContent = formattedTime;
    }

    // Mettre à jour l'heure immédiatement et toutes les secondes
    updateClock();
    setInterval(updateClock, 1000);
</script>
<script>
    window.addEventListener("DOMContentLoaded", () => Alpine.start());
</script>
</body>

</html>