<?php
session_start();
if (!$_SESSION['email']) {
    header('location:../auth/sign-in.php');
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservation</title>

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


    <script>
        /**
         * THIS SCRIPT REQUIRED FOR PREVENT FLICKERING IN SOME BROWSERS
         */
        localStorage.getItem("_x_darkMode_on") === "true" &&
        document.documentElement.classList.add("dark");
    </script>
</head>
<body x-data class="is-header-blur" x-bind="$store.global.documentBody" style="font-family: 'Poppins', Serif" ;>
<!-- App preloader -->
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
                    <!-- Dashboards -->
                    <a href="index.php"
                       class="flex size-11 items-center justify-center rounded-lg outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
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

                    <!-- Tickets -->
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

                    <!-- Reservation -->
                    <a href="reservation.php"
                       class="flex size-11 items-center justify-center rounded-lg bg-primary/10 text-primary outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
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

                    <!-- Employees -->
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

                    <!-- Clients -->
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
    <main class="main-content w-full p-8">
        <!----Breadcrumb Start---->
        <div class="card bg-blue-500/5 dark:bg-navy-500 shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
            <div class="card-body md:py-3 py-5">
                <div class=" items-center grid grid-cols-12 gap-6">
                    <div class="col-span-9 p-5">
                        <h4 class="font-semibold text-xl text-black mb-3">Reservations</h4>
                        <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                            <li class="flex items-center">
                                <a class="opacity-80 text-sm leading-none"
                                   href="index.php">
                                    Home
                                </a>
                            </li>
                            <li>
                                <div class="p-0.5 rounded-full bg-black mx-2.5 flex items-center"></div>
                            </li>
                            <li class="flex items-center text-sm text-link dark:text-blacklink leading-none"
                                aria-current="page">
                                Reservations
                            </li>
                        </ol>
                    </div>
                    <div class="col-span-3 -mb-10">
                        <div class="flex justify-center">
                            <img src="../../../assets/ChatBc.png" alt="" class="md:-mb-7 -mb-4 h-40 w-40"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!----Breadcrumb End---->
        <div class="grid grid-cols-12 gap-6 mt-6">

            <div
                    class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                <div class="card shadow-none border-s border-error">
                    <div class="card-body p-8">
                        <div
                                class="flex justify-between items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-red-500 font-bold" width="40"
                                 height="40" viewBox="0 0 512 512">
                                <g fill="none" stroke="#FF5724" stroke-linecap="round" stroke-width="2em">
                                    <path stroke-linejoin="round" d="m8.5 12.5l2 2l5-5"/>
                                    <path
                                            d="m283.735 52.918l31.295 26.614a42.7 42.7 0 0 0 24.213 10.03l40.947 3.309c20.86 1.686 37.42 18.246 39.106 39.106l3.31 40.947a42.7 42.7 0 0 0 10.029 24.213l26.614 31.294c13.557 15.942 13.557 39.362 0 55.304l-26.614 31.295a42.7 42.7 0 0 0-10.03 24.213l-3.31 40.947c-1.685 20.86-18.246 37.42-39.105 39.106l-40.947 3.31a42.7 42.7 0 0 0-24.213 10.029l-31.295 26.614c-15.942 13.557-39.362 13.557-55.304 0l-31.294-26.614a42.7 42.7 0 0 0-24.213-10.03l-40.947-3.31c-20.86-1.685-37.42-18.246-39.106-39.105l-3.31-40.947a42.7 42.7 0 0 0-10.03-24.213l-26.613-31.295c-13.557-15.942-13.557-39.362 0-55.304l26.614-31.294a42.7 42.7 0 0 0 10.03-24.213l3.309-40.947c1.686-20.86 18.246-37.42 39.106-39.106l40.947-3.31a42.7 42.7 0 0 0 24.213-10.03l31.294-26.613c15.942-13.557 39.362-13.557 55.304 0m21.182 124L256 225.833l-48.918-48.917l-30.165 30.165L225.834 256l-48.917 48.917l30.165 30.165L256 286.165l48.917 48.917l30.165-30.165L286.165 256l48.917-48.918z"
                                    />
                                </g>
                            </svg>
                            <div
                                    class="ms-auto sm:text-start text-end">
                                <h5
                                        class="font-medium text-2xl ">
                                    <?php
                                    include_once '../../config/config.php';
                                    function countReservationsCanceled()
                                    {
                                        $conn = getConnexion();
                                        $query = "SELECT COUNT(*) as total FROM reservations WHERE statut= 'canceled'";
                                        $result = $conn->query($query);
                                        $data = $result->fetch();
                                        return $data['total'];
                                    }

                                    echo "<strong>" . countReservationsCanceled() . "</strong>";
                                    ?>
                                </h5>
                                <p
                                        class="text-error font-medium">Refusées</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                    class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                <div class="card shadow-none border-s border-success">
                    <div class="card-body p-8">
                        <div
                                class="flex justify-between items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                                <g fill="none" stroke="#11b25d" stroke-linecap="round" stroke-width="1.5">
                                    <path stroke-linejoin="round" d="m8.5 12.5l2 2l5-5"/>
                                    <path d="M3.03 13.078a2.5 2.5 0 0 1 0-2.157c.14-.294.38-.576.86-1.14c.192-.225.288-.337.368-.457a2.5 2.5 0 0 0 .376-.907c.028-.142.04-.289.063-.583c.059-.738.088-1.107.197-1.416A2.5 2.5 0 0 1 6.42 4.894c.308-.109.677-.139 1.416-.197c.294-.024.44-.036.582-.064a2.5 2.5 0 0 0 .908-.376c.12-.08.232-.175.456-.367c.564-.48.846-.72 1.14-.861a2.5 2.5 0 0 1 2.157 0c.295.14.577.38 1.14.861c.225.192.337.287.457.367a2.5 2.5 0 0 0 .908.376c.141.028.288.04.582.064c.739.058 1.108.088 1.416.197a2.5 2.5 0 0 1 1.525 1.524M4.894 17.581a2.5 2.5 0 0 0 1.525 1.524c.308.11.677.139 1.416.197c.294.024.44.036.582.064a2.5 2.5 0 0 1 .908.376c.12.08.232.175.456.367c.564.48.846.72 1.14.861a2.5 2.5 0 0 0 2.157 0c.295-.14.577-.38 1.14-.861a5 5 0 0 1 .457-.367a2.5 2.5 0 0 1 .908-.376c.141-.028.288-.04.582-.064c.739-.058 1.108-.088 1.416-.197a2.5 2.5 0 0 0 1.525-1.524c.109-.308.138-.678.197-1.416c.023-.294.035-.441.063-.583c.064-.324.192-.633.376-.907c.08-.12.176-.232.367-.457c.48-.564.721-.846.862-1.14a2.5 2.5 0 0 0 0-2.157"/>
                                </g>
                            </svg>
                            <div
                                    class="ms-auto sm:text-start text-end">
                                <h5
                                        class="font-medium text-2xl ">
                                    <?php
                                    include_once '../../config/config.php';
                                    function countReservationsAccepted()
                                    {
                                        $conn = getConnexion();
                                        $query = "SELECT COUNT(*) as total FROM reservations WHERE statut= 'accepted'";
                                        $result = $conn->query($query);
                                        $data = $result->fetch();
                                        return $data['total'];
                                    }

                                    echo "<strong>" . countReservationsAccepted() . "</strong>";
                                    ?>
                                </h5>
                                <p
                                        class="text-success font-medium">Acceptées</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                    class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                <div class="card shadow-none border-s border-[#118bb2]">
                    <div class="card-body p-8">
                        <div
                                class="flex justify-between items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32">
                                <path fill="#118bb2"
                                      d="M10 18a2 2 0 1 0 0-4a2 2 0 0 0 0 4m6 0a2 2 0 1 0 0-4a2 2 0 0 0 0 4m8-2a2 2 0 1 1-4 0a2 2 0 0 1 4 0m6 0c0 7.732-6.268 14-14 14S2 23.732 2 16S8.268 2 16 2s14 6.268 14 14m-2 0c0-6.627-5.373-12-12-12S4 9.373 4 16s5.373 12 12 12s12-5.373 12-12"/>
                            </svg>
                            <div
                                    class="ms-auto sm:text-start text-end">
                                <h5
                                        class="font-medium text-2xl ">
                                    <?php
                                    include_once '../../config/config.php';
                                    function countReservationsPending()
                                    {
                                        $conn = getConnexion();
                                        $query = "SELECT COUNT(*) as total FROM reservations WHERE statut= 'pending'";
                                        $result = $conn->query($query);
                                        $data = $result->fetch();
                                        return $data['total'];
                                    }

                                    echo "<strong>" . countReservationsPending() . "</strong>";
                                    ?>
                                </h5>
                                <p
                                        class="text-[#118bb2] font-medium">En attente</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                    class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                <div class="card shadow-none border-s border-[#2111b2]">
                    <div class="card-body p-8">
                        <div
                                class="flex justify-between items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                                <path fill="#2111b2"
                                      d="M11.943 1.25c-2.309 0-4.118 0-5.53.19c-1.444.194-2.584.6-3.479 1.494c-.895.895-1.3 2.035-1.494 3.48c-.19 1.411-.19 3.22-.19 5.529v.114c0 2.309 0 4.118.19 5.53c.194 1.444.6 2.584 1.494 3.479c.895.895 2.035 1.3 3.48 1.494c1.411.19 3.22.19 5.529.19h.114c2.309 0 4.118 0 5.53-.19c1.444-.194 2.584-.6 3.479-1.494c.895-.895 1.3-2.035 1.494-3.48c.19-1.411.19-3.22.19-5.529V10.5a.75.75 0 0 0-1.5 0V12c0 2.378-.002 4.086-.176 5.386c-.172 1.279-.5 2.05-1.069 2.62c-.57.569-1.34.896-2.619 1.068c-1.3.174-3.008.176-5.386.176s-4.086-.002-5.386-.176c-1.279-.172-2.05-.5-2.62-1.069c-.569-.57-.896-1.34-1.068-2.619c-.174-1.3-.176-3.008-.176-5.386s.002-4.086.176-5.386c.172-1.279.5-2.05 1.069-2.62c.57-.569 1.34-.896 2.619-1.068c1.3-.174 3.008-.176 5.386-.176h1.5a.75.75 0 0 0 0-1.5z"/>
                                <path fill="#2111b2" fill-rule="evenodd"
                                      d="M19 1.25a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5M16.75 5a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0"
                                      clip-rule="evenodd"/>
                                <path fill="#2111b2"
                                      d="M6.25 14a.75.75 0 0 1 .75-.75h9a.75.75 0 0 1 0 1.5H7a.75.75 0 0 1-.75-.75M7 16.75a.75.75 0 0 0 0 1.5h6a.75.75 0 0 0 0-1.5z"/>
                            </svg>
                            <div
                                    class="ms-auto sm:text-start text-end">
                                <h5
                                        class="font-medium text-2xl ">
                                    <?php
                                    include_once '../../config/config.php';
                                    function countAllReservations()
                                    {
                                        $conn = getConnexion();
                                        $query = "SELECT COUNT(*) as total FROM reservations";
                                        $result = $conn->query($query);
                                        $data = $result->fetch();
                                        return $data['total'];
                                    }

                                    echo "<strong>" . countAllReservations() . "</strong>";
                                    ?>
                                </h5>
                                <p
                                        class="text-[#2111b2] font-medium">Total</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table reservations -->
        <div
                class="mt-4 grid grid-cols-12 gap-4 transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6"
        >

            <div
                    class="lg:col-span-4 md:col-span-12 sm:col-span-12 col-span-12 w-full">
                <div
                        class="sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                    <div
                            class="w-full flex flex-col bg-white p-8 dark:bg-dark  shadow-md dark:shadow-dark-md rounded-md modal-content">
                        <div class="flex min-h-full flex-col justify-center">
                            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                                <img class="mx-auto rounded-full h-30 w-auto mt-8" src="../../../assets/logo.jpg"
                                     alt="Your Company">
                                <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
                                    Compléter les champs pour faire une réservation</h2>
                            </div>

                            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                                <?php

                                include_once '../../config/config.php';
                                require_once '../../../vendor/autoload.php';

                                use Ramsey\Uuid\Uuid;

                                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                                    $nom = trim($_POST["name"]);
                                    $surname = trim($_POST["surname"]);
                                    $telephone = trim($_POST["phone"]);
                                    $service_id = trim($_POST["services"]);
                                    $date = trim($_POST["date"]);
                                    $status = 'pending';

                                    if (!empty($nom) && !empty($surname) && !empty($telephone) && !empty($service_id) && !empty($date)) {
                                        try {
                                            $conn = getConnexion();

                                            // Vérifier si le client existe déjà
                                            $sql = "SELECT id FROM clients WHERE phone = :phone";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bindParam(":phone", $telephone);
                                            $stmt->execute();
                                            $client = $stmt->fetch(PDO::FETCH_ASSOC);

                                            if ($client) {
                                                $client_id = $client["id"];
                                            } else {
                                                // Générer un ID unique
                                                $client_id = Uuid::uuid4()->toString();

                                                // Insérer un nouveau client
                                                $sql = "INSERT INTO clients (id, first_name, last_name, phone) VALUES (:id, :first_name, :last_name, :phone)";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bindParam(":id", $client_id);
                                                $stmt->bindParam(":first_name", $nom);
                                                $stmt->bindParam(":last_name", $surname);
                                                $stmt->bindParam(":phone", $telephone);
                                                $stmt->execute();
                                            }

                                            $reservation_id = Uuid::uuid4()->toString();

                                            $sql = "INSERT INTO reservations (id, first_name, last_name, phone, service, date_reservation, statut) VALUES (:id, :first_name, :last_name, :phone, :service, :date_reservation, :statut)";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute([
                                                ":id" => $reservation_id,
                                                ":first_name" => $nom,
                                                ":last_name" => $surname,
                                                ":phone" => $telephone,
                                                ":service" => $service_id,
                                                ":date_reservation" => $date,
                                                ":statut" => $status
                                            ]);

                                            echo "<script>console.log('Réservation enregistrée avec succès.')</script>";
                                        } catch (PDOException $e) {
                                            echo "Erreur : " . $e->getMessage();
                                        }
                                    } else {
                                        echo "Veuillez remplir tous les champs.";
                                    }
                                }
                                ?>


                                <form class="space-y-6" action="#" method="POST">
                                    <div class="grid lg:grid-cols-2 justify-between gap-3 items-center">
                                        <div>
                                            <label for="name" >Nom du
                                                client</label>
                                            <div class="mt-2">
                                                <input type="text" name="name" id="name"
                                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                            </div>
                                        </div>

                                        <div>
                                            <div class="flex items-center justify-between">
                                                <label for="surname" >Prénom
                                                    du client</label>
                                            </div>
                                            <div class="mt-2">
                                                <input type="text" name="surname" id="surname"
                                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center justify-between">
                                            <label for="phone" >Téléphone
                                                du client</label>
                                        </div>
                                        <div class="mt-2">
                                            <input type="text" name="phone" id="phone"
                                                   class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="date" >Journée
                                            du</label>
                                        <div class="mt-2">
                                            <input type="datetime-local" name="date" id="date"
                                                   class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="services" >Type de
                                            service</label>
                                        <div class="mt-2">
                                            <select id="services" name="services"
                                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                                <option disabled selected>Choisir un service</option>
                                                <?php
                                                include_once '../../config/config.php';

                                                $conn = getConnexion();
                                                $sql = "SELECT id, name FROM services";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($services as $service) {
                                                    echo "<option value='" . htmlspecialchars($service['name']) . "'>" . htmlspecialchars($service['name']) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div>
                                        <button type="submit"
                                                class="flex mb-10 w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                            Enrégistrer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-8 lg:col-span-8 md:col-span-12 sm:col-span-12 col-span-12">
                <div class="card-body">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <?php
                                    // Nombre d'éléments par page
                                    $items_per_page = 10;

                                    // Calcul du numéro de page actuel (par défaut, c'est la page 1)
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $start_from = ($page - 1) * $items_per_page;

                                    // Récupérer le total des réservations pour calculer le nombre de pages
                                    $sql_total = "SELECT COUNT(*) FROM reservations";
                                    $stmt_total = $conn->prepare($sql_total);
                                    $stmt_total->execute();
                                    $total_reservations = $stmt_total->fetchColumn();
                                    $total_pages = ceil($total_reservations / $items_per_page);

                                    // Requête pour récupérer les réservations de la page actuelle
                                    $sql = "SELECT * FROM reservations LIMIT :start_from, :items_per_page";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':start_from', $start_from, PDO::PARAM_INT);
                                    $stmt->bindParam(':items_per_page', $items_per_page, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $reservations = $stmt->fetchAll();

                                    function getInitials($name)
                                    {
                                        $words = explode(" ", $name);
                                        $initials = "";
                                        foreach ($words as $w) {
                                            $initials .= $w[0];
                                        }
                                        return $initials;
                                    }
                                    ?>

                                    <table class="table search-table min-w-full divide-y divide-border divide-slate-150">
                                        <thead>
                                        <tr>
                                            <th class="p-4 ps-0">
                                                <div class="n-chk align-self-center text-center">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input rounded-sm" id="contact-check-all"/>
                                                        <label class="form-check-label" for="contact-check-all"></label>
                                                        <span class="new-control-indicator"></span>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope="col" class="text-left rtl:text-right p-4 font-semibold text-black text-sm">Nom</th>
                                            <th scope="col" class="text-left rtl:text-right p-4 font-semibold text-black text-sm">Prénom</th>
                                            <th scope="col" class="text-left rtl:text-right p-4 font-semibold text-black text-sm">Téléphone</th>
                                            <th scope="col" class="text-left rtl:text-right p-4 font-semibold text-black text-sm">Date de reservation</th>
                                            <th scope="col" class="text-left rtl:text-right p-4 font-semibold text-black text-sm">Services demandés</th>
                                            <th scope="col" class="text-left rtl:text-right p-4 font-semibold text-black text-sm">Status</th>
                                            <th scope="col" class="text-left rtl:text-right p-4 font-semibold text-black text-sm">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-border divide-slate-150">
                                        <?php
                                        foreach ($reservations as $result) {
                                            echo '
                                                <tr class="search-items">
                                                    <td class="p-4 ps-0 whitespace-nowrap">
                                                        <div class="n-chk align-self-center text-center">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input rounded-sm contact-chkbox" id="checkbox' . $result['id'] . '" />
                                                                <label class="form-check-label" for="checkbox' . $result['id'] . '"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="p-4 ps-0 whitespace-nowrap">
                                                        <div class="flex gap-3 items-center">
                                                            <div>
                                                                <p class="rounded-circle bg-indigo-200 items-center justify-center leading-9 text-center font-bold h-9 w-9 rounded-full"> ' . htmlspecialchars($initials = getInitials($result['first_name'])) . htmlspecialchars($initials = getInitials($result['last_name'])) . ' </p>
                                                            </div>
                                                            <div>
                                                                <h6 class="user-name mb-1" data-name="' . htmlspecialchars($result["first_name"]) . '">' . htmlspecialchars($result["first_name"]) . '</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="usr-email-addr text-sm whitespace-nowrap text-bodytext dark:text-blacklink p-4" data-email="' . htmlspecialchars($result["last_name"]) . '">' . htmlspecialchars($result["last_name"]) . '</td>
                                                    <td class="usr-email-addr text-sm whitespace-nowrap text-bodytext dark:text-blacklink p-4" data-email="' . htmlspecialchars($result["phone"]) . '">' . htmlspecialchars($result["phone"]) . '</td>
                                                    <td class="usr-location text-sm whitespace-nowrap text-bodytext dark:text-blacklink p-4" data-location="' . htmlspecialchars($result["date_reservation"]) . '">' . htmlspecialchars($result["date_reservation"]) . '</td>
                                                    <td class="usr-ph-no text-sm whitespace-nowrap text-bodytext dark:text-blacklink p-4" data-phone="' . htmlspecialchars($result["service"]) . '">' . htmlspecialchars($result["service"]) . '</td>
                                                    <td class="usr-ph-no text-sm whitespace-nowrap text-bodytext dark:text-blacklink p-4" data-phone="' . htmlspecialchars($result["statut"]) . '">' . htmlspecialchars($result["statut"]) . '</td>
                                                    <td class="text-sm whitespace-nowrap text-bodytext dark:text-blacklink p-4">
                                                        <div class="action-btn flex gap-3">
                                                            <a  href="javascript:void(0)" x-tooltip.placement.top="\'Accepter\'" class="text-info flex justify-center items-center bg-gray-900/5 p-2 rounded-full edit cursor-pointer">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256"><path fill="#42ca7d" d="M225.86 102.82c-3.77-3.94-7.67-8-9.14-11.57c-1.36-3.27-1.44-8.69-1.52-13.94c-.15-9.76-.31-20.82-8-28.51s-18.75-7.85-28.51-8c-5.25-.08-10.67-.16-13.94-1.52c-3.56-1.47-7.63-5.37-11.57-9.14C146.28 23.51 138.44 16 128 16s-18.27 7.51-25.18 14.14c-3.94 3.77-8 7.67-11.57 9.14c-3.25 1.36-8.69 1.44-13.94 1.52c-9.76.15-20.82.31-28.51 8s-7.8 18.75-8 28.51c-.08 5.25-.16 10.67-1.52 13.94c-1.47 3.56-5.37 7.63-9.14 11.57C23.51 109.72 16 117.56 16 128s7.51 18.27 14.14 25.18c3.77 3.94 7.67 8 9.14 11.57c1.36 3.27 1.44 8.69 1.52 13.94c.15 9.76.31 20.82 8 28.51s18.75 7.85 28.51 8c5.25.08 10.67.16 13.94 1.52c3.56 1.47 7.63 5.37 11.57 9.14c6.9 6.63 14.74 14.14 25.18 14.14s18.27-7.51 25.18-14.14c3.94-3.77 8-7.67 11.57-9.14c3.27-1.36 8.69-1.44 13.94-1.52c9.76-.15 20.82-.31 28.51-8s7.85-18.75 8-28.51c.08-5.25.16-10.67 1.52-13.94c1.47-3.56 5.37-7.63 9.14-11.57c6.63-6.9 14.14-14.74 14.14-25.18s-7.51-18.27-14.14-25.18m-11.55 39.29c-4.79 5-9.75 10.17-12.38 16.52c-2.52 6.1-2.63 13.07-2.73 19.82c-.1 7-.21 14.33-3.32 17.43s-10.39 3.22-17.43 3.32c-6.75.1-13.72.21-19.82 2.73c-6.35 2.63-11.52 7.59-16.52 12.38S132 224 128 224s-9.15-4.92-14.11-9.69s-10.17-9.75-16.52-12.38c-6.1-2.52-13.07-2.63-19.82-2.73c-7-.1-14.33-.21-17.43-3.32s-3.22-10.39-3.32-17.43c-.1-6.75-.21-13.72-2.73-19.82c-2.63-6.35-7.59-11.52-12.38-16.52S32 132 32 128s4.92-9.15 9.69-14.11s9.75-10.17 12.38-16.52c2.52-6.1 2.63-13.07 2.73-19.82c.1-7 .21-14.33 3.32-17.43s10.39-3.22 17.43-3.32c6.75-.1 13.72-.21 19.82-2.73c6.35-2.63 11.52-7.59 16.52-12.38S124 32 128 32s9.15 4.92 14.11 9.69s10.17 9.75 16.52 12.38c6.1 2.52 13.07 2.63 19.82 2.73c7 .1 14.33.21 17.43 3.32s3.22 10.39 3.32 17.43c.1 6.75.21 13.72 2.73 19.82c2.63 6.35 7.59 11.52 12.38 16.52S224 124 224 128s-4.92 9.15-9.69 14.11m-40.65-43.77a8 8 0 0 1 0 11.32l-56 56a8 8 0 0 1-11.32 0l-24-24a8 8 0 0 1 11.32-11.32L112 148.69l50.34-50.35a8 8 0 0 1 11.32 0"/></svg>
                                                            </a>
                                                            <a href="javascript:void(0)" x-tooltip.placement.top="\'Refuser\'" class="text-black delete bg-gray-900/5 p-2 rounded-full cursor-pointer">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-red-500 font-bold" width="25"
                                                                     height="25" viewBox="0 0 512 512">
                                                                    <g fill="none" stroke="#FF5724" stroke-linecap="round" stroke-width="2em">
                                                                        <path stroke-linejoin="round" d="m8.5 12.5l2 2l5-5"/>
                                                                        <path
                                                                                d="m283.735 52.918l31.295 26.614a42.7 42.7 0 0 0 24.213 10.03l40.947 3.309c20.86 1.686 37.42 18.246 39.106 39.106l3.31 40.947a42.7 42.7 0 0 0 10.029 24.213l26.614 31.294c13.557 15.942 13.557 39.362 0 55.304l-26.614 31.295a42.7 42.7 0 0 0-10.03 24.213l-3.31 40.947c-1.685 20.86-18.246 37.42-39.105 39.106l-40.947 3.31a42.7 42.7 0 0 0-24.213 10.029l-31.295 26.614c-15.942 13.557-39.362 13.557-55.304 0l-31.294-26.614a42.7 42.7 0 0 0-24.213-10.03l-40.947-3.31c-20.86-1.685-37.42-18.246-39.106-39.105l-3.31-40.947a42.7 42.7 0 0 0-10.03-24.213l-26.613-31.295c-13.557-15.942-13.557-39.362 0-55.304l26.614-31.294a42.7 42.7 0 0 0 10.03-24.213l3.309-40.947c1.686-20.86 18.246-37.42 39.106-39.106l40.947-3.31a42.7 42.7 0 0 0 24.213-10.03l31.294-26.613c15.942-13.557 39.362-13.557 55.304 0m21.182 124L256 225.833l-48.918-48.917l-30.165 30.165L225.834 256l-48.917 48.917l30.165 30.165L256 286.165l48.917 48.917l30.165-30.165L286.165 256l48.917-48.918z"
                                                                        />
                                                                    </g>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>'
                                            ;
                                        }
                                        ?>
                                        </tbody>
                                    </table>

                                    <!-- Pagination -->
                                    <div class="pagination mx-auto justify-center items-center">
                                        <ul class="flex list-none gap-2">
                                            <?php if ($page > 1): ?>
                                                <li><a href="?page=<?php echo $page - 1; ?>"
                                                       x-tooltip.placement.top="'Précédent'"
                                                       class="text-white bg-blue-500 flex items-center justify-center h-9 w-9 rounded-full">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                             viewBox="0 0 24 24">
                                                            <path fill="currentColor" fill-rule="evenodd"
                                                                  d="M20.75 12a.75.75 0 0 0-.75-.75h-9.25v1.5H20a.75.75 0 0 0 .75-.75"
                                                                  clip-rule="evenodd" opacity="0.5"/>
                                                            <path fill="currentColor"
                                                                  d="M10.75 18a.75.75 0 0 1-1.28.53l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.28.53z"/>
                                                        </svg>
                                                    </a></li>
                                            <?php endif; ?>

                                            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                                <li><a href="?page=<?php echo $i; ?>"
                                                       class="text-blue-500 bg-none border-blue-500 flex items-center border justify-center h-9 w-9 rounded-full <?php if ($i == $page) echo 'font-bold bg-blue-200 border-none'; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php endfor; ?>

                                            <?php if($page < $total_pages): ?>
                                                <li>
                                                    <a href="?page=<?php echo $page + 1; ?>"
                                                       x-tooltip.placement.top="'Suivant'"
                                                       class="bg-blue-500 flex items-center justify-center h-9 w-9 rounded-full text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                             viewBox="0 0 24 24">
                                                            <path fill="currentColor" fill-rule="evenodd"
                                                                  d="M3.25 12a.75.75 0 0 1 .75-.75h9.25v1.5H4a.75.75 0 0 1-.75-.75"
                                                                  clip-rule="evenodd" opacity="0.5"/>
                                                            <path fill="currentColor"
                                                                  d="M13.25 12.75V18a.75.75 0 0 0 1.28.53l6-6a.75.75 0 0 0 0-1.06l-6-6a.75.75 0 0 0-1.28.53z"/>
                                                        </svg>
                                                    </a>
                                                </li>

                                            <?php endif; ?>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table reservations End -->
    </main>
</div>

<div id="x-teleport-target"></div>
<script>
    window.addEventListener("DOMContentLoaded", () => Alpine.start());
</script>
</body>
</html>