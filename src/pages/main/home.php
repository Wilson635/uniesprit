<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('location:../auth/sign-in.php');
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags  -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

    <title>Home</title>
    <link rel="icon" type="image/png" href="images/favicon.png" />

    <!-- CSS Assets -->
    <link rel="stylesheet" href="../../components/app.css" />

    <!-- Javascript Assets -->
    <script src="../../../scipt.js"></script>
    <script src="../../../tailwind.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                    <a href="home.php"
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
                       x-tooltip.placement.right="'Analyse'">
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

                    <!-- Elements -->
                    <!--                    <a href="elements-avatar.html"-->
                    <!--                       class="flex size-11 items-center justify-center rounded-lg outline-hidden transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"-->
                    <!--                       x-tooltip.placement.right="'Elements'">-->
                    <!--                        <svg class="size-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                    <!--                            <path-->
                    <!--                                    d="M13.3111 14.75H5.03356C3.36523 14.75 2.30189 12.9625 3.10856 11.4958L5.24439 7.60911L7.24273 3.96995C8.07689 2.45745 10.2586 2.45745 11.0927 3.96995L13.1002 7.60911L14.0627 9.35995L15.2361 11.4958C16.0427 12.9625 14.9794 14.75 13.3111 14.75Z"-->
                    <!--                                    fill="currentColor"/>-->
                    <!--                            <path fill-opacity="0.3"-->
                    <!--                                  d="M21.1667 15.2083C21.1667 18.4992 18.4992 21.1667 15.2083 21.1667C11.9175 21.1667 9.25 18.4992 9.25 15.2083C9.25 15.0525 9.25917 14.9058 9.26833 14.75H13.3108C14.9792 14.75 16.0425 12.9625 15.2358 11.4958L14.0625 9.36C14.4292 9.28666 14.8142 9.25 15.2083 9.25C18.4992 9.25 21.1667 11.9175 21.1667 15.2083Z"-->
                    <!--                                  fill="currentColor"/>-->
                    <!--                        </svg>-->
                    <!--                    </a>-->
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

                    <!-- Profile -->
                    <div x-data="usePopper({placement:'right-end',offset:12})"
                         @click.outside="isShowPopper && (isShowPopper = false)" class="flex">
                        <button @click="isShowPopper = !isShowPopper" x-ref="popperRef"
                                class="avatar size-12 cursor-pointer">
                            <img class="rounded-full" src="../../../assets/logo.jpg" alt="avatar"/>
                            <span
                                    class="absolute right-0 size-3.5 rounded-full border-2 border-white bg-success dark:border-navy-700"></span>
                        </button>

                        <div :class="isShowPopper && 'show'" class="popper-root fixed" x-ref="popperRoot">
                            <div
                                    class="popper-box w-64 rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-600 dark:bg-navy-700">
                                <div
                                        class="flex items-center space-x-4 rounded-t-lg bg-slate-100 py-5 px-4 dark:bg-navy-800">
                                    <div class="avatar size-14">
                                        <img class="rounded-full" src="../../../assets/logo.jpg" alt="avatar"/>
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
        <div class="w-full px-[var(--margin-x)] pb-8">
            <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
                <div
                        class="col-span-12 grid grid-cols-12 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 py-5 sm:py-6">
                    <div class="col-span-12 sm:col-span-6 lg:col-span-4">
                        <div class="px-4 text-white sm:px-5">
                            <div class="-mt-1 flex items-center space-x-2">
                                <h2 class="text-base font-medium tracking-wide">Balance</h2>
                            </div>

                            <div class="mt-3">
                                <p class="text-2xl font-semibold">6 556 XAF</p>
                            </div>

                            <div class="mt-4 flex space-x-7">
                                <div>
                                    <p class="text-indigo-100">Income</p>
                                    <div class="mt-1 flex items-center space-x-2">
                                        <div class="flex size-7 items-center justify-center rounded-full bg-black/20">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                            </svg>
                                        </div>
                                        <p class="text-base font-medium">2 225 XAF</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-indigo-100">Clients</p>
                                    <div class="mt-1 flex items-center space-x-2">
                                        <div class="flex size-7 items-center justify-center rounded-full bg-black/20">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                 viewBox="0 0 24 24">
                                                <circle cx="12" cy="6" r="4" fill="currentColor" />
                                                <path fill="currentColor"
                                                      d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5"
                                                      opacity="0.5" />
                                            </svg>
                                        </div>
                                        <p class="text-base font-medium">22</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 mt-5 sm:col-span-6 sm:mt-0 lg:col-span-8">
                        <div class="swiper px-5 sm:pl-0"
                             x-init="$nextTick(()=>new Swiper($el,{  slidesPerView: 'auto', spaceBetween: 16}))">
                            <div class="swiper-wrapper">
                                <div
                                        class="swiper-slide relative h-40 w-64 shrink-0 rounded">
                                    <div
                                            class="absolute inset-0 flex flex-col bg-[url('../../../assets/bg.jpg')] bg-cover bg-no-repeat justify-between rounded-lg border border-white/10 p-5">
                                    </div>
                                </div>
                                <div
                                        class="swiper-slide relative h-40 w-64 shrink-0 rounded">
                                    <div
                                            class="absolute inset-0 flex flex-col bg-[url('../../../assets/bg1.jpg')] bg-cover bg-no-repeat justify-between rounded-lg border border-white/10 p-5">
                                    </div>
                                </div>
                                <div
                                        class="swiper-slide relative h-40 w-64 shrink-0 rounded">
                                    <div
                                            class="absolute inset-0 flex flex-col bg-[url('../../../assets/bg.jpg')] bg-cover bg-no-repeat justify-between rounded-lg border border-white/10 p-5">
                                    </div>
                                </div>
                                <div
                                        class="swiper-slide relative h-40 w-64 shrink-0 rounded">
                                    <div
                                            class="absolute inset-0 flex flex-col bg-[url('../../../assets/bg.jpg')] bg-cover bg-no-repeat justify-between rounded-lg border border-white/10 p-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card group col-span-12 pb-5 lg:col-span-8">
                    <div class="my-3 flex flex-col justify-between px-4 sm:flex-row sm:items-center sm:px-5">
                        <div class="flex flex-1 items-center justify-between space-x-2 sm:flex-initial">
                            <h2 class="text-sm-plus font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                History
                            </h2>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex cursor-pointer items-center space-x-2">
                                <div class="size-3 rounded-full bg-accent"></div>
                                <p>Sales</p>
                            </div>
                            <div class="flex cursor-pointer items-center space-x-2">
                                <div class="size-3 rounded-full bg-info"></div>
                                <p>Profit</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-4 px-4 sm:gap-5 sm:px-5 lg:gap-6 lg:px-5">
                        <div class="col-span-12 sm:order-last sm:col-span-6 sm:mt-2 xl:col-span-7">
                            <div class="ax-transparent-gridline">
                                <div
                                        x-init="$nextTick(() => { $el._x_chart = new ApexCharts($el,pages.charts.historyTransactionsLine); $el._x_chart.render() });">
                                </div>
                            </div>
                        </div>
                        <div
                                class="col-span-12 rounded-lg bg-slate-50 p-3 dark:bg-navy-600 sm:col-span-6 xl:col-span-5">
                            <div class="space-y-4">
                                <div class="flex cursor-pointer items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar">
                                            <img class="rounded-full" src="../../../assets/logo.jpg" alt="avatar" />
                                        </div>
                                        <div>
                                            <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                Konnor Guzman
                                            </p>
                                            <p class="text-xs text-slate-400 line-clamp-1 dark:text-navy-200">
                                                Dec 21, 2021 - 08:05
                                            </p>
                                        </div>
                                    </div>
                                    <p class="font-medium text-success">660 XAF</p>
                                </div>
                                <div class="flex cursor-pointer items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar">
                                            <img class="rounded-full" src="../../../assets/logo.jpg" alt="avatar" />
                                        </div>
                                        <div>
                                            <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                Henry Curtis
                                            </p>
                                            <p class="text-xs text-slate-400 line-clamp-1 dark:text-navy-200">
                                                Dec 19, 2021 - 11:55
                                            </p>
                                        </div>
                                    </div>
                                    <p class="font-medium text-success">333 XAF</p>
                                </div>
                                <div class="flex cursor-pointer items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar">
                                            <img class="rounded-full" src="../../../assets/logo.jpg" alt="avatar" />
                                        </div>
                                        <div>
                                            <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                Derrick Simmons
                                            </p>
                                            <p class="text-xs text-slate-400 line-clamp-1 dark:text-navy-200">
                                                Dec 16, 2021 - 14:45
                                            </p>
                                        </div>
                                    </div>
                                    <p class="font-medium text-success">674 XAF</p>
                                </div>
                                <div class="flex cursor-pointer items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar">
                                            <img class="rounded-full" src="../../../assets/logo.jpg" alt="avatar" />
                                        </div>
                                        <div>
                                            <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                Kartina West
                                            </p>
                                            <p class="text-xs text-slate-400 line-clamp-1 dark:text-navy-200">
                                                Dec 13, 2021 - 11:30
                                            </p>
                                        </div>
                                    </div>
                                    <p class="font-medium text-success">547 XAF</p>
                                </div>
                                <div class="flex cursor-pointer items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar">
                                            <img class="rounded-full" src="../../../assets/logo.jpg" alt="avatar" />
                                        </div>
                                        <div>
                                            <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                Samantha Shelton
                                            </p>
                                            <p class="text-xs text-slate-400 line-clamp-1 dark:text-navy-200">
                                                Dec 10, 2021 - 09:41
                                            </p>
                                        </div>
                                    </div>
                                    <p class="font-medium text-success">736 XAF</p>
                                </div>
                                <div class="flex cursor-pointer items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar">
                                            <img class="rounded-full" src="../../../assets/logo.jpg" alt="avatar" />
                                        </div>
                                        <div>
                                            <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                Joe Perkins
                                            </p>
                                            <p class="text-xs text-slate-400 line-clamp-1 dark:text-navy-200">
                                                Dec 06, 2021 - 11:41
                                            </p>
                                        </div>
                                    </div>
                                    <p class="font-medium text-success">558 XAF</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card col-span-12 px-4 pb-5 sm:px-5 lg:col-span-4">
                    <div class="flex items-center justify-between py-3">
                        <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                            Calculator
                        </h2>
                        <divclass="inline-flex">
                        <button
                                class="btn -mr-1 size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="#4086d4"
                                      d="M12 22c-4.243 0-6.364 0-7.682-1.465C3 19.072 3 16.714 3 12s0-7.071 1.318-8.536S7.758 2 12 2s6.364 0 7.682 1.464C21 4.93 21 7.286 21 12s0 7.071-1.318 8.535S16.242 22 12 22"
                                      opacity="0.5" />
                                <path fill="#4086d4"
                                      d="M15 6H9c-.465 0-.697 0-.888.051a1.5 1.5 0 0 0-1.06 1.06C7 7.304 7 7.536 7 8s0 .697.051.888a1.5 1.5 0 0 0 1.06 1.06C8.304 10 8.536 10 9 10h6c.465 0 .697 0 .888-.051a1.5 1.5 0 0 0 1.06-1.06C17 8.696 17 8.464 17 8s0-.697-.051-.888a1.5 1.5 0 0 0-1.06-1.06C15.697 6 15.464 6 15 6m-7 8a1 1 0 1 0 0-2a1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2a1 1 0 0 0 0 2m4-4a1 1 0 1 0 0-2a1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2a1 1 0 0 0 0 2m4-4a1 1 0 1 0 0-2a1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                            </svg>
                        </button>
                        </divclass=>
                    </div>
                    <div class="mt-2 space-y-4">
                        <label class="block">
                            <span class="text-xs-plus">Pay to</span>
                            <div class="mt-1.5 flex h-9 -space-x-px">
                                <input
                                        class="form-input w-full rounded-l-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Price" type="text" />
                                <select
                                        class="form-select rounded-r-lg border border-slate-300 bg-white px-3 py-2 pr-9 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                    <option>XAF</option>
                                </select>
                            </div>
                        </label>
                        <div>
                            <span class="text-xs-plus">Amount</span>

                            <div class="mt-1.5 flex h-9 -space-x-px">
                                <input
                                        class="form-input w-full rounded-l-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Price" type="text" />
                                <select
                                        class="form-select rounded-r-lg border border-slate-300 bg-white px-3 py-2 pr-9 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                    <option>XAF</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col bottom-0 justify-end">
                        <div class="mt-2 flex justify-between">
                            <p>Total:</p>
                            <p class="font-medium text-slate-700 dark:text-navy-100">3 XAF</p>
                        </div>
                        <button
                                class="btn mt-5 h-10 w-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            Calculate
                    </div>
                    </button>
                </div>
            </div>
        </div>
        <div
                class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6"
        >
            <div class="col-span-12 lg:col-span-8">
                <div class="flex items-center justify-between space-x-2">
                    <h2
                            class="text-base font-medium tracking-wide text-slate-800 line-clamp-1 dark:text-navy-100"
                    >
                        Sales Overview
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
                                Last month
                            </button>
                            <button
                                    @click="activeTab = 'tabAll'"
                                    :class="activeTab === 'tabAll' ? 'bg-white shadow-sm dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                    class="btn shrink-0 px-3 py-1 text-xs-plus font-medium"
                            >
                                Last year
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
                                    $6,556.55
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
                                this month
                            </p>
                        </div>
                        <div class="mt-3 flex items-center space-x-2">
                            <div class="ax-transparent-gridline w-28">
                                <div
                                        x-init="$nextTick(() => { $el._x_chart = new ApexCharts($el,pages.charts.analyticsSalesThisMonth); $el._x_chart.render() });"
                                ></div>
                            </div>
                            <div class="flex items-center space-x-0.5">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="size-4 text-success"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                >
                                    <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M7 11l5-5m0 0l5 5m-5-5v12"
                                    />
                                </svg>
                                <p class="text-sm-plus text-slate-800 dark:text-navy-100">
                                    3.2%
                                </p>
                            </div>
                        </div>
                        <button
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
                            <span> Download Report</span>
                        </button>
                    </div>

                    <div class="ax-transparent-gridline grid w-full grid-cols-1">
                        <div
                                x-init="$nextTick(() => { $el._x_chart = new ApexCharts($el,pages.charts.analyticsSalesOverview); $el._x_chart.render() });"
                        ></div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4">
                <div
                        class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-2"
                >
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between space-x-1">
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                $67.6k
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
                        <p class="mt-1 text-xs-plus">Income</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                12.6K
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
                        <p class="mt-1 text-xs-plus">Completed</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                143
                            </p>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="size-5 text-warning"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                            >
                                <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <p class="mt-1 text-xs-plus">Pending</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                651
                            </p>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="size-5 text-info"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                            >
                                <path
                                        d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"
                                />
                                <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"
                                />
                            </svg>
                        </div>
                        <p class="mt-1 text-xs-plus">Dispatch</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between space-x-1">
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                46k
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
                        <p class="mt-1 text-xs-plus">Products</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                8.8k
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
                        <p class="mt-1 text-xs-plus">Customers</p>
                    </div>
                </div>
            </div>
            <div class="card col-span-12 lg:col-span-8">
                <div class="flex items-center justify-between py-3 px-4">
                    <h2
                            class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
                    >
                        Projects Status
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

                        <div
                                x-ref="popperRoot"
                                class="popper-root"
                                :class="isShowPopper && 'show'"
                        >
                            <div
                                    class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700"
                            >
                                <ul>
                                    <li>
                                        <a
                                                href="#"
                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                        >Action</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                                href="#"
                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                        >Another Action</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                                href="#"
                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                        >Something else</a
                                        >
                                    </li>
                                </ul>
                                <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
                                <ul>
                                    <li>
                                        <a
                                                href="#"
                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                        >Separated Link</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-y-4 pb-3 sm:grid-cols-3">
                    <div
                            class="flex flex-col justify-between border-4 border-transparent border-l-info px-4"
                    >
                        <div>
                            <p
                                    class="text-base font-medium text-slate-600 dark:text-navy-100"
                            >
                                Web Design
                            </p>
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Design Learn Management System
                            </p>
                            <div class="badge mt-2 bg-info/10 text-info dark:bg-info/15">
                                UI/UX Design
                            </div>
                        </div>
                        <div>
                            <div class="mt-8">
                                <p class="font-inter">
                  <span
                          class="text-2xl font-medium text-slate-600 dark:text-navy-100"
                  >%55.</span
                  ><span class="text-xs">23</span>
                                </p>
                                <p class="mt-1 text-xs">June 08, 2021</p>
                            </div>
                            <div class="mt-8 flex items-center justify-between space-x-2">
                                <div class="flex -space-x-3">
                                    <div class="avatar size-8 hover:z-10">
                                        <img
                                                class="rounded-full ring-2 ring-white dark:ring-navy-700"
                                                src="images/avatar/avatar-16.jpg"
                                                alt="avatar"
                                        />
                                    </div>
                                    <div class="avatar size-8 hover:z-10">
                                        <div
                                                class="is-initial rounded-full bg-info text-xs-plus uppercase text-white ring-2 ring-white dark:ring-navy-700"
                                        >
                                            jd
                                        </div>
                                    </div>
                                    <div class="avatar size-8 hover:z-10">
                                        <img
                                                class="rounded-full ring-2 ring-white dark:ring-navy-700"
                                                src="images/avatar/avatar-20.jpg"
                                                alt="avatar"
                                        />
                                    </div>
                                </div>
                                <button
                                        class="btn size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                        />
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                            class="flex flex-col justify-between border-4 border-transparent border-l-secondary px-4"
                    >
                        <div>
                            <p
                                    class="text-base font-medium text-slate-600 dark:text-navy-100"
                            >
                                Mobile App
                            </p>
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Ecommerce Application
                            </p>
                            <div
                                    class="badge mt-2 bg-secondary/10 text-secondary dark:bg-secondary-light/15 dark:text-secondary-light"
                            >
                                Ecommerce
                            </div>
                        </div>
                        <div>
                            <div class="mt-8">
                                <p class="font-inter">
                  <span
                          class="text-2xl font-medium text-slate-600 dark:text-navy-100"
                  >%14.</span
                  ><span class="text-xs">84</span>
                                </p>
                                <p class="mt-1 text-xs">May 01, 2021</p>
                            </div>
                            <div class="mt-8 flex items-center justify-between space-x-2">
                                <div class="flex -space-x-3">
                                    <div class="avatar size-8 hover:z-10">
                                        <img
                                                class="rounded-full ring-2 ring-white dark:ring-navy-700"
                                                src="images/avatar/avatar-16.jpg"
                                                alt="avatar"
                                        />
                                    </div>
                                    <div class="avatar size-8 hover:z-10">
                                        <div
                                                class="is-initial rounded-full bg-success text-xs-plus uppercase text-white ring-2 ring-white dark:ring-navy-700"
                                        >
                                            uh
                                        </div>
                                    </div>
                                    <div class="avatar size-8 hover:z-10">
                                        <img
                                                class="rounded-full ring-2 ring-white dark:ring-navy-700"
                                                src="images/avatar/avatar-14.jpg"
                                                alt="avatar"
                                        />
                                    </div>
                                </div>
                                <button
                                        class="btn size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                        />
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                            class="flex flex-col justify-between border-4 border-transparent border-l-warning px-4"
                    >
                        <div>
                            <p
                                    class="text-base font-medium text-slate-600 dark:text-navy-100"
                            >
                                Design System
                            </p>
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                Create LMS design system on figma
                            </p>
                            <div class="mt-2 flex space-x-1.5">
                                <div
                                        class="badge bg-warning/10 text-warning dark:bg-warning/15"
                                >
                                    LMS
                                </div>
                                <div
                                        class="badge bg-warning/10 text-warning dark:bg-warning/15"
                                >
                                    Figma
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="mt-8">
                                <p class="font-inter">
                  <span
                          class="text-2xl font-medium text-slate-600 dark:text-navy-100"
                  >%87.</span
                  ><span class="text-xs">40</span>
                                </p>
                                <p class="mt-1 text-xs">September 16, 2021</p>
                            </div>
                            <div class="mt-8 flex items-center justify-between space-x-2">
                                <div class="flex -space-x-3">
                                    <div class="avatar size-8 hover:z-10">
                                        <img
                                                class="rounded-full ring-2 ring-white dark:ring-navy-700"
                                                src="images/avatar/avatar-11.jpg"
                                                alt="avatar"
                                        />
                                    </div>
                                    <div class="avatar size-8 hover:z-10">
                                        <div
                                                class="is-initial rounded-full bg-error text-xs-plus uppercase text-white ring-2 ring-white dark:ring-navy-700"
                                        >
                                            pm
                                        </div>
                                    </div>
                                    <div class="avatar size-8 hover:z-10">
                                        <img
                                                class="rounded-full ring-2 ring-white dark:ring-navy-700"
                                                src="images/avatar/avatar-10.jpg"
                                                alt="avatar"
                                        />
                                    </div>
                                </div>
                                <button
                                        class="btn size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                        />
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4">
                <div class="flex items-center justify-between">
                    <h2
                            class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
                    >
                        Customer Satisfaction
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

                        <div
                                x-ref="popperRoot"
                                class="popper-root"
                                :class="isShowPopper && 'show'"
                        >
                            <div
                                    class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700"
                            >
                                <ul>
                                    <li>
                                        <a
                                                href="#"
                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                        >Action</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                                href="#"
                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                        >Another Action</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                                href="#"
                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                        >Something else</a
                                        >
                                    </li>
                                </ul>
                                <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
                                <ul>
                                    <li>
                                        <a
                                                href="#"
                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                        >Separated Link</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <p>
            <span class="text-3xl text-slate-700 dark:text-navy-100"
            >9.7</span
            >
                        <span class="text-xs text-success">+2.1%</span>
                    </p>
                    <p class="text-xs-plus">Performance score</p>
                </div>
                <div class="mt-4 flex h-2 space-x-1">
                    <div
                            class="w-5/12 rounded-full bg-primary dark:bg-accent"
                            x-tooltip.primary="'Exellent'"
                    ></div>
                    <div
                            class="w-2/12 rounded-full bg-success"
                            x-tooltip.success="'Very Good'"
                    ></div>
                    <div
                            class="w-2/12 rounded-full bg-info"
                            x-tooltip.info="'Good'"
                    ></div>

                    <div
                            class="w-2/12 rounded-full bg-warning"
                            x-tooltip.warning="'Poor'"
                    ></div>
                    <div
                            class="w-1/12 rounded-full bg-error"
                            x-tooltip.error="'Very Poor'"
                    ></div>
                </div>

                <div class="is-scrollbar-hidden mt-4 min-w-full overflow-x-auto">
                    <table class="w-full font-inter">
                        <tbody>
                        <tr>
                            <td class="whitespace-nowrap py-2">
                                <div class="flex items-center space-x-2">
                                    <div
                                            class="size-3.5 rounded-full border-2 border-primary dark:border-accent"
                                    ></div>
                                    <p
                                            class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
                                    >
                                        Exellent
                                    </p>
                                </div>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    1 029
                                </p>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right">42%</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-2">
                                <div class="flex items-center space-x-2">
                                    <div
                                            class="size-3.5 rounded-full border-2 border-success"
                                    ></div>
                                    <p
                                            class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
                                    >
                                        Very Good
                                    </p>
                                </div>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    426
                                </p>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right">18%</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-2">
                                <div class="flex items-center space-x-2">
                                    <div
                                            class="size-3.5 rounded-full border-2 border-info"
                                    ></div>
                                    <p
                                            class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
                                    >
                                        Good
                                    </p>
                                </div>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    326
                                </p>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right">14%</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-2">
                                <div class="flex items-center space-x-2">
                                    <div
                                            class="size-3.5 rounded-full border-2 border-warning"
                                    ></div>
                                    <p
                                            class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
                                    >
                                        Poor
                                    </p>
                                </div>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    395
                                </p>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right">17%</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-2">
                                <div class="flex items-center space-x-2">
                                    <div
                                            class="size-3.5 rounded-full border-2 border-error"
                                    ></div>
                                    <p
                                            class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
                                    >
                                        Very Poor
                                    </p>
                                </div>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    129
                                </p>
                            </td>
                            <td class="whitespace-nowrap py-2 text-right">9%</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div
                class="mt-4 grid grid-cols-12 gap-4 bg-slate-150 py-5 dark:bg-navy-800 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6"
        >
            <div
                    class="col-span-12 flex flex-col px-[var(--margin-x)] transition-all duration-[.25s] lg:col-span-3 lg:pr-0"
            >
                <h2
                        class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-xl"
                >
                    Top Sellers
                </h2>

                <p class="mt-3 grow">
                    The top sellers is calculated based on the sales of a product and
                    undergoes hourly updations.
                </p>

                <div class="mt-4">
                    <p>Sales Growth</p>
                    <div class="mt-1.5 flex items-center space-x-2">
                        <div
                                class="flex size-7 items-center justify-center rounded-full bg-success/15 text-success"
                        >
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="size-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                            >
                                <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 11l5-5m0 0l5 5m-5-5v12"
                                />
                            </svg>
                        </div>
                        <p
                                class="text-base font-medium text-slate-700 dark:text-navy-100"
                        >
                            $2,225.22
                        </p>
                    </div>
                </div>
            </div>
            <div
                    class="is-scrollbar-hidden col-span-12 flex space-x-4 overflow-x-auto px-[var(--margin-x)] transition-all duration-[.25s] lg:col-span-9 lg:pl-0"
            >
                <div class="card w-72 shrink-0 space-y-9 rounded-xl p-4 sm:px-5">
                    <div class="flex items-center justify-between space-x-2">
                        <div class="flex items-center space-x-3">
                            <div class="avatar">
                                <img
                                        class="mask is-squircle"
                                        src="../../../assets/logo.jpg"
                                        alt="image"
                                />
                            </div>
                            <div>
                                <p
                                        class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    Travis Fuller
                                </p>
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    Employee
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="relative cursor-pointer">
                                <button
                                        class="btn size-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                        />
                                    </svg>
                                </button>
                                <div
                                        class="absolute top-0 right-0 -m-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-primary px-1 text-tiny font-medium leading-none text-white dark:bg-accent"
                                >
                                    2
                                </div>
                            </div>
                            <div class="relative cursor-pointer">
                                <button
                                        class="btn size-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                        />
                                    </svg>
                                </button>
                                <div
                                        class="absolute top-0 right-0 -m-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-primary px-1 text-tiny font-medium leading-none text-white dark:bg-accent"
                                >
                                    4
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-2">
                        <div>
                            <p class="text-xs-plus">Sells</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                2 348
                            </p>
                        </div>
                        <div>
                            <p class="text-xs-plus">Target</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                3 000
                            </p>
                        </div>
                        <div>
                            <p class="text-xs-plus">Clients</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                78
                            </p>
                        </div>
                    </div>
                    <div class="grow">
                        <div class="flex w-full space-x-1">
                            <div
                                    x-tooltip="'Phone Calls'"
                                    class="h-2 w-4/12 rounded-full bg-primary dark:bg-accent"
                            ></div>
                            <div
                                    x-tooltip="'Chats Messages'"
                                    class="h-2 w-3/12 rounded-full bg-success"
                            ></div>
                            <div
                                    x-tooltip="'Emails'"
                                    class="h-2 w-5/12 rounded-full bg-info"
                            ></div>
                        </div>
                        <div class="mt-2 flex flex-wrap">
                            <div
                                    class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div
                                        class="size-2 rounded-full bg-primary dark:bg-accent"
                                ></div>
                                <div class="flex space-x-1 text-xs leading-6">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Calls</span
                  >
                                    <span>33%</span>
                                </div>
                            </div>
                            <div
                                    class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div class="size-2 rounded-full bg-success"></div>
                                <div class="flex space-x-1 text-xs">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Chat Messages</span
                  >
                                    <span>17%</span>
                                </div>
                            </div>
                            <div
                                    class="mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div class="size-2 rounded-full bg-info"></div>
                                <div class="flex space-x-1 text-xs">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Emails</span
                  >
                                    <span>50%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card w-72 shrink-0 space-y-9 rounded-xl p-4 sm:px-5">
                    <div class="flex items-center justify-between space-x-2">
                        <div class="flex items-center space-x-3">
                            <div class="avatar">
                                <img
                                        class="mask is-squircle"
                                        src="../../../assets/logo.jpg"
                                        alt="image"
                                />
                            </div>
                            <div>
                                <p
                                        class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    Travis Fuller
                                </p>
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    Employee
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="relative cursor-pointer">
                                <button
                                        class="btn size-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                        />
                                    </svg>
                                </button>
                                <div
                                        class="absolute top-0 right-0 -m-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-primary px-1 text-tiny font-medium leading-none text-white dark:bg-accent"
                                >
                                    2
                                </div>
                            </div>
                            <div class="relative cursor-pointer">
                                <button
                                        class="btn size-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                        />
                                    </svg>
                                </button>
                                <div
                                        class="absolute top-0 right-0 -m-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-primary px-1 text-tiny font-medium leading-none text-white dark:bg-accent"
                                >
                                    4
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-2">
                        <div>
                            <p class="text-xs-plus">Sells</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                2 348
                            </p>
                        </div>
                        <div>
                            <p class="text-xs-plus">Target</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                3 000
                            </p>
                        </div>
                        <div>
                            <p class="text-xs-plus">Clients</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                78
                            </p>
                        </div>
                    </div>
                    <div class="grow">
                        <div class="flex w-full space-x-1">
                            <div
                                    x-tooltip="'Phone Calls'"
                                    class="h-2 w-4/12 rounded-full bg-primary dark:bg-accent"
                            ></div>
                            <div
                                    x-tooltip="'Chats Messages'"
                                    class="h-2 w-3/12 rounded-full bg-success"
                            ></div>
                            <div
                                    x-tooltip="'Emails'"
                                    class="h-2 w-5/12 rounded-full bg-info"
                            ></div>
                        </div>
                        <div class="mt-2 flex flex-wrap">
                            <div
                                    class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div
                                        class="size-2 rounded-full bg-primary dark:bg-accent"
                                ></div>
                                <div class="flex space-x-1 text-xs leading-6">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Calls</span
                  >
                                    <span>33%</span>
                                </div>
                            </div>
                            <div
                                    class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div class="size-2 rounded-full bg-success"></div>
                                <div class="flex space-x-1 text-xs">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Chat Messages</span
                  >
                                    <span>17%</span>
                                </div>
                            </div>
                            <div
                                    class="mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div class="size-2 rounded-full bg-info"></div>
                                <div class="flex space-x-1 text-xs">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Emails</span
                  >
                                    <span>50%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card w-72 shrink-0 space-y-9 rounded-xl p-4 sm:px-5">
                    <div class="flex items-center justify-between space-x-2">
                        <div class="flex items-center space-x-3">
                            <div class="avatar">
                                <img
                                        class="mask is-squircle"
                                        src="../../../assets/logo.jpg"
                                        alt="image"
                                />
                            </div>
                            <div>
                                <p
                                        class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    Travis Fuller
                                </p>
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    Employee
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="relative cursor-pointer">
                                <button
                                        class="btn size-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                        />
                                    </svg>
                                </button>
                                <div
                                        class="absolute top-0 right-0 -m-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-primary px-1 text-tiny font-medium leading-none text-white dark:bg-accent"
                                >
                                    2
                                </div>
                            </div>
                            <div class="relative cursor-pointer">
                                <button
                                        class="btn size-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                        />
                                    </svg>
                                </button>
                                <div
                                        class="absolute top-0 right-0 -m-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-primary px-1 text-tiny font-medium leading-none text-white dark:bg-accent"
                                >
                                    4
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-2">
                        <div>
                            <p class="text-xs-plus">Sells</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                2 348
                            </p>
                        </div>
                        <div>
                            <p class="text-xs-plus">Target</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                3 000
                            </p>
                        </div>
                        <div>
                            <p class="text-xs-plus">Clients</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                78
                            </p>
                        </div>
                    </div>
                    <div class="grow">
                        <div class="flex w-full space-x-1">
                            <div
                                    x-tooltip="'Phone Calls'"
                                    class="h-2 w-4/12 rounded-full bg-primary dark:bg-accent"
                            ></div>
                            <div
                                    x-tooltip="'Chats Messages'"
                                    class="h-2 w-3/12 rounded-full bg-success"
                            ></div>
                            <div
                                    x-tooltip="'Emails'"
                                    class="h-2 w-5/12 rounded-full bg-info"
                            ></div>
                        </div>
                        <div class="mt-2 flex flex-wrap">
                            <div
                                    class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div
                                        class="size-2 rounded-full bg-primary dark:bg-accent"
                                ></div>
                                <div class="flex space-x-1 text-xs leading-6">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Calls</span
                  >
                                    <span>33%</span>
                                </div>
                            </div>
                            <div
                                    class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div class="size-2 rounded-full bg-success"></div>
                                <div class="flex space-x-1 text-xs">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Chat Messages</span
                  >
                                    <span>17%</span>
                                </div>
                            </div>
                            <div
                                    class="mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div class="size-2 rounded-full bg-info"></div>
                                <div class="flex space-x-1 text-xs">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Emails</span
                  >
                                    <span>50%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card w-72 shrink-0 space-y-9 rounded-xl p-4 sm:px-5">
                    <div class="flex items-center justify-between space-x-2">
                        <div class="flex items-center space-x-3">
                            <div class="avatar">
                                <img
                                        class="mask is-squircle"
                                        src="../../../assets/logo.jpg"
                                        alt="image"
                                />
                            </div>
                            <div>
                                <p
                                        class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    Travis Fuller
                                </p>
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    Employee
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="relative cursor-pointer">
                                <button
                                        class="btn size-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                        />
                                    </svg>
                                </button>
                                <div
                                        class="absolute top-0 right-0 -m-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-primary px-1 text-tiny font-medium leading-none text-white dark:bg-accent"
                                >
                                    2
                                </div>
                            </div>
                            <div class="relative cursor-pointer">
                                <button
                                        class="btn size-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                        />
                                    </svg>
                                </button>
                                <div
                                        class="absolute top-0 right-0 -m-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-primary px-1 text-tiny font-medium leading-none text-white dark:bg-accent"
                                >
                                    4
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-2">
                        <div>
                            <p class="text-xs-plus">Sells</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                2 348
                            </p>
                        </div>
                        <div>
                            <p class="text-xs-plus">Target</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                3 000
                            </p>
                        </div>
                        <div>
                            <p class="text-xs-plus">Clients</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                78
                            </p>
                        </div>
                    </div>
                    <div class="grow">
                        <div class="flex w-full space-x-1">
                            <div
                                    x-tooltip="'Phone Calls'"
                                    class="h-2 w-4/12 rounded-full bg-primary dark:bg-accent"
                            ></div>
                            <div
                                    x-tooltip="'Chats Messages'"
                                    class="h-2 w-3/12 rounded-full bg-success"
                            ></div>
                            <div
                                    x-tooltip="'Emails'"
                                    class="h-2 w-5/12 rounded-full bg-info"
                            ></div>
                        </div>
                        <div class="mt-2 flex flex-wrap">
                            <div
                                    class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div
                                        class="size-2 rounded-full bg-primary dark:bg-accent"
                                ></div>
                                <div class="flex space-x-1 text-xs leading-6">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Calls</span
                  >
                                    <span>33%</span>
                                </div>
                            </div>
                            <div
                                    class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div class="size-2 rounded-full bg-success"></div>
                                <div class="flex space-x-1 text-xs">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Chat Messages</span
                  >
                                    <span>17%</span>
                                </div>
                            </div>
                            <div
                                    class="mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div class="size-2 rounded-full bg-info"></div>
                                <div class="flex space-x-1 text-xs">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Emails</span
                  >
                                    <span>50%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card w-72 shrink-0 space-y-9 rounded-xl p-4 sm:px-5">
                    <div class="flex items-center justify-between space-x-2">
                        <div class="flex items-center space-x-3">
                            <div class="avatar">
                                <img
                                        class="mask is-squircle"
                                        src="../../../assets/logo.jpg"
                                        alt="image"
                                />
                            </div>
                            <div>
                                <p
                                        class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    Travis Fuller
                                </p>
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    Employee
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="relative cursor-pointer">
                                <button
                                        class="btn size-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                        />
                                    </svg>
                                </button>
                                <div
                                        class="absolute top-0 right-0 -m-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-primary px-1 text-tiny font-medium leading-none text-white dark:bg-accent"
                                >
                                    2
                                </div>
                            </div>
                            <div class="relative cursor-pointer">
                                <button
                                        class="btn size-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                        />
                                    </svg>
                                </button>
                                <div
                                        class="absolute top-0 right-0 -m-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-primary px-1 text-tiny font-medium leading-none text-white dark:bg-accent"
                                >
                                    4
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-2">
                        <div>
                            <p class="text-xs-plus">Sells</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                2 348
                            </p>
                        </div>
                        <div>
                            <p class="text-xs-plus">Target</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                3 000
                            </p>
                        </div>
                        <div>
                            <p class="text-xs-plus">Clients</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                78
                            </p>
                        </div>
                    </div>
                    <div class="grow">
                        <div class="flex w-full space-x-1">
                            <div
                                    x-tooltip="'Phone Calls'"
                                    class="h-2 w-4/12 rounded-full bg-primary dark:bg-accent"
                            ></div>
                            <div
                                    x-tooltip="'Chats Messages'"
                                    class="h-2 w-3/12 rounded-full bg-success"
                            ></div>
                            <div
                                    x-tooltip="'Emails'"
                                    class="h-2 w-5/12 rounded-full bg-info"
                            ></div>
                        </div>
                        <div class="mt-2 flex flex-wrap">
                            <div
                                    class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div
                                        class="size-2 rounded-full bg-primary dark:bg-accent"
                                ></div>
                                <div class="flex space-x-1 text-xs leading-6">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Calls</span
                  >
                                    <span>33%</span>
                                </div>
                            </div>
                            <div
                                    class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div class="size-2 rounded-full bg-success"></div>
                                <div class="flex space-x-1 text-xs">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Chat Messages</span
                  >
                                    <span>17%</span>
                                </div>
                            </div>
                            <div
                                    class="mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div class="size-2 rounded-full bg-info"></div>
                                <div class="flex space-x-1 text-xs">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Emails</span
                  >
                                    <span>50%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card w-72 shrink-0 space-y-9 rounded-xl p-4 sm:px-5">
                    <div class="flex items-center justify-between space-x-2">
                        <div class="flex items-center space-x-3">
                            <div class="avatar">
                                <img
                                        class="mask is-squircle"
                                        src="../../../assets/logo.jpg"
                                        alt="image"
                                />
                            </div>
                            <div>
                                <p
                                        class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100"
                                >
                                    Travis Fuller
                                </p>
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    Employee
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="relative cursor-pointer">
                                <button
                                        class="btn size-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                        />
                                    </svg>
                                </button>
                                <div
                                        class="absolute top-0 right-0 -m-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-primary px-1 text-tiny font-medium leading-none text-white dark:bg-accent"
                                >
                                    2
                                </div>
                            </div>
                            <div class="relative cursor-pointer">
                                <button
                                        class="btn size-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25"
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="size-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                    >
                                        <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                        />
                                    </svg>
                                </button>
                                <div
                                        class="absolute top-0 right-0 -m-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-primary px-1 text-tiny font-medium leading-none text-white dark:bg-accent"
                                >
                                    4
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-2">
                        <div>
                            <p class="text-xs-plus">Sells</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                2 348
                            </p>
                        </div>
                        <div>
                            <p class="text-xs-plus">Target</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                3 000
                            </p>
                        </div>
                        <div>
                            <p class="text-xs-plus">Clients</p>
                            <p
                                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                            >
                                78
                            </p>
                        </div>
                    </div>
                    <div class="grow">
                        <div class="flex w-full space-x-1">
                            <div
                                    x-tooltip="'Phone Calls'"
                                    class="h-2 w-4/12 rounded-full bg-primary dark:bg-accent"
                            ></div>
                            <div
                                    x-tooltip="'Chats Messages'"
                                    class="h-2 w-3/12 rounded-full bg-success"
                            ></div>
                            <div
                                    x-tooltip="'Emails'"
                                    class="h-2 w-5/12 rounded-full bg-info"
                            ></div>
                        </div>
                        <div class="mt-2 flex flex-wrap">
                            <div
                                    class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div
                                        class="size-2 rounded-full bg-primary dark:bg-accent"
                                ></div>
                                <div class="flex space-x-1 text-xs leading-6">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Calls</span
                  >
                                    <span>33%</span>
                                </div>
                            </div>
                            <div
                                    class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div class="size-2 rounded-full bg-success"></div>
                                <div class="flex space-x-1 text-xs">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Chat Messages</span
                  >
                                    <span>17%</span>
                                </div>
                            </div>
                            <div
                                    class="mb-1 inline-flex items-center space-x-2 font-inter"
                            >
                                <div class="size-2 rounded-full bg-info"></div>
                                <div class="flex space-x-1 text-xs">
                  <span
                          class="font-medium text-slate-700 dark:text-navy-100"
                  >Emails</span
                  >
                                    <span>50%</span>
                                </div>
                            </div>
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
    window.addEventListener("DOMContentLoaded", () => Alpine.start());
</script>
</body>

</html>