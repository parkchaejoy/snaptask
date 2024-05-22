<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Add New Project​, Add Task, Edit Task">
    <meta name="description" content="">
    <title>Add Project</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Add-Project.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.9.2, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "SnapTask",
            "logo": "images/4.png"
        }
    </script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Add Project">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>

<body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en">
    <header class="u-clearfix u-header u-palette-1-dark-2 u-header" id="sec-3e90">
        <div class="u-clearfix u-sheet u-sheet-1">
            <a href="Homepage.php" class="u-image u-logo u-image-1" data-image-width="4000" data-image-height="2000"
                title="Home">
                <img src="images/4.png" class="u-logo-image u-logo-image-1" alt="SnapTask Logo">
            </a>
            <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1">
                <div class="menu-collapse" style="font-size: 1.25rem; letter-spacing: 0px;">
                    <a class="u-button-style u-custom-color u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-hover-color u-custom-text-shadow u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base"
                        href="#">
                        <svg class="u-svg-link" viewBox="0 0 24 24">
                            <use xlink:href="#menu-hamburger"></use>
                        </svg>
                        <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px"
                            y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <rect y="1" width="16" height="2"></rect>
                                <rect y="7" width="16" height="2"></rect>
                                <rect y="13" width="16" height="2"></rect>
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="u-custom-menu u-nav-container">
                    <ul class="u-custom-font u-heading-font u-nav u-unstyled u-nav-1">
                        <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-white"
                                href="Homepage.php" style="padding: 10px 20px; text-shadow: 2px 2px 8px rgba(0,0,0,0.4);">Home</a>
                        </li>
                        <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-white"
                                href="formlogin.php" style="padding: 10px 20px; text-shadow: 2px 2px 8px rgba(0,0,0,0.4);">Login</a>
                        </li>
                    </ul>
                </div>
                <div class="u-custom-menu u-nav-container-collapse">
                    <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
                        <div class="u-inner-container-layout u-sidenav-overflow">
                            <div class="u-menu-close"></div>
                            <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
                                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="homepage.php">Home</a>
                                </li>
                                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="formlogin.php">Login</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
                </div>
            </nav>
        </div>
    </header>
    <section class="u-clearfix u-image u-shading u-section-1" id="sec-9b3a" data-image-width="1792"
        data-image-height="1024">
        <div class="u-clearfix u-sheet u-sheet-1">
            <div class="u-align-center u-container-style u-group u-opacity u-opacity-70 u-radius-50 u-shape-round u-white u-group-1">
                <div class="u-container-layout u-container-layout-1">
                    <span class="u-icon u-icon-circle u-palette-1-base u-icon-1">
                        <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 42 42" style="">
                            <use xlink:href="#svg-0f1e"></use>
                        </svg>
                        <svg class="u-svg-content" viewBox="0 0 42 42" x="0px" y="0px" id="svg-0f1e"
                            style="enable-background:new 0 0 42 42;">
                            <polygon points="42,19 23,19 23,0 19,0 19,19 0,19 0,23 19,23 19,42 23,42 23,23 42,23 "></polygon>
                        </svg>
                    </span>
                    <h3 class="u-custom-font u-heading-font u-text u-text-default u-text-1">Add Project</h3>
                    <div class="custom-expanded u-form u-form-1">
                        <form id="form-add-project" action="tambahproject.php" method="post"
                            class="u-clearfix u-form-horizontal u-form-spacing-10 u-inner-form" style="padding: 10px;">
                            <div class="u-form-group u-form-name">
                                <label for="name" class="u-custom-font u-heading-font u-label">Project Name</label>
                                <input type="text" placeholder="New project name" id="name" name="name"
                                    class="u-input u-input-rectangle" required="">
                            </div>
                            <div class="u-align-center u-form-group u-form-submit">
                                <a id="addTaskBtn"
                                    class="u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius u-btn-1"
                                    data-animation-name="" data-animation-duration="0" data-animation-delay="0"
                                    data-animation-direction="">Add Project </a>
                                <input type="submit" value="submit" class="u-form-control-hidden">
                            </div>
                            <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been
                                sent. </div>
                            <input type="hidden" value="" name="recaptchaResponse">
                            <input type="hidden" name="formServices" value="7aecdde4-52ec-eafd-9ba8-27c5bdd970df">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-75f3">
        <div class="u-clearfix u-sheet u-sheet-1">
            <p class="u-small-text u-text u-text-variant u-text-1">Copyright Kelompok 5 RPL</p>
        </div>
    </footer>
    <section class="u-backlink u-clearfix u-grey-80">
        <p class="u-text">
            <span>This site was created with the </span>
            <a class="u-link" href="https://nicepage.com/" target="_blank" rel="nofollow">
                <span>Nicepage</span>
            </a>
        </p>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("#form-add-project");

            form.addEventListener("submit", function(event) {
                event.preventDefault();

                // Ambil nilai input nama proyek
                const projectName = document.querySelector("#name").value;

                // Kirim permintaan AJAX untuk menambahkan proyek
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "tambahproject.php");
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    // Redirect ke homepage setelah menambahkan proyek
                    window.location.href = "homepage.php";
                };
                xhr.send("name=" + encodeURIComponent(projectName));
            });
        });
    </script>

</body>

</html>
