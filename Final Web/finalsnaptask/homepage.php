<?php
session_start();
include 'configgabung.php';

if (!isset($_SESSION['username'])) {
    header("Location: proseslogin.php");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    if (isset($_GET['project_id'])) {
        $project_id = $_GET['project_id'];
        $username = $_SESSION['username'];

        $conn->beginTransaction();

        try {
            $stmt = $conn->prepare("DELETE FROM Tasks WHERE project_id = ?");
            $stmt->execute([$project_id]);

            $stmt = $conn->prepare("DELETE FROM Projects WHERE project_id = ? AND username = ?");
            $stmt->execute([$project_id, $username]);

            $conn->commit();
            header("Location: homepage.php");
            exit;
        } catch (PDOException $e) {
            $conn->rollback();
            die("Error: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Welcome, <?php echo $_SESSION['username']; ?>!, Your Projects:">
    <meta name="description" content="">
    <title>Homepage</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Home.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.9.2, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Home">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
<body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en">
<header class="u-clearfix u-header u-palette-1-dark-2 u-header" id="sec-3e90">
    <div class="u-clearfix u-sheet u-sheet-1">
        <a href="Home.html" class="u-image u-logo u-image-1" data-image-width="4000" data-image-height="2000" title="Home">
            <img src="images/4.png" class="u-logo-image u-logo-image-1">
        </a>
        <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1">
            <div class="menu-collapse" style="font-size: 1.25rem; letter-spacing: 0px;">
                <a class="u-button-style u-custom-color u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-hover-color u-custom-text-shadow u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
                    <svg class="u-svg-link" viewBox="0 0 24 24"><use xlink:href="#menu-hamburger"></use></svg>
                    <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><g><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect></g></svg>
                </a>
            </div>
            <div class="u-custom-menu u-nav-container">
                <ul class="u-custom-font u-heading-font u-nav u-unstyled u-nav-1">
                    <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-white" href="Home.html" style="padding: 10px 20px; text-shadow: 2px 2px 8px rgba(0,0,0,0.4);">Home</a></li>
                    <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-white" href="Login.html" style="padding: 10px 20px; text-shadow: 2px 2px 8px rgba(0,0,0,0.4);">Login</a></li>
                </ul>
            </div>
            <div class="u-custom-menu u-nav-container-collapse">
                <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
                    <div class="u-inner-container-layout u-sidenav-overflow">
                        <div class="u-menu-close"></div>
                        <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
                            <li class="u-nav-item"><a class="u-button-style u-nav-link" href="Home.html">Home</a></li>
                            <li class="u-nav-item"><a class="u-button-style u-nav-link" href="Login.html">Login</a></li>
                        </ul>
                    </div>
                </div>
                <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
            </div>
        </nav>
    </div>
</header>
<section class="skrollable u-clearfix u-image u-parallax u-shading u-section-1" id="sec-3d68" data-image-width="1792" data-image-height="1024">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h1 class="u-align-center u-text u-text-1">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <a href="formproject.php" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius u-btn-1">Add Project</a>
        <h2 class="u-align-left u-text u-text-2">Your Projects:</h2>
        <div class="u-expanded-width u-list u-list-1">
            <div class="u-repeater u-repeater-1">
                <?php
                $username = $_SESSION['username'];
                $stmt = $conn->prepare("SELECT project_id, name FROM Projects WHERE username = ?");
                $stmt->execute([$username]);
                $projects = $stmt->fetchAll();

                foreach ($projects as $project):
                ?>
                <div class="u-container-style u-list-item u-opacity u-opacity-50 u-repeater-item u-shape-rectangle">
                    <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
                        <img alt="" class="u-expanded-width u-image u-image-default u-image-1" data-image-width="2000" data-image-height="1333" src="images/90fc53c9.svg" data-href="#">
                        <h3 class="u-align-left u-custom-font u-heading-font u-text u-text-default u-text-3"><?php echo $project['name']; ?></h3>
                        <a href="projectdetail.php?project_id=<?php echo $project['project_id']; ?>" class="u-active-none u-align-left u-border-hover-palette-2-base u-border-none u-btn u-button-style u-hover-none u-btn-2">see details</a>
                        <a href="homepage.php?action=delete&project_id=<?php echo $project['project_id']; ?>" class="u-active-none u-align-left u-border-hover-palette-2-base u-border-none u-btn u-button-style u-hover-none u-btn-3" onclick="return confirm('Are you sure you want to delete this project and all its tasks?');">Delete</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-75f3">
    <div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Sample text. Click to select the text box. Click again or double click to start editing the text.</p>
    </div>
</footer>
</body>
</html>
