<?php
session_start();
include 'configgabung.php';

if (!isset($_SESSION['username'])) {
    header("Location: proseslogin.php");
    exit;
}

if (!isset($_GET['project_id'])) {
    header("Location: homepage.php");
    exit;
}

$project_id = $_GET['project_id'];
$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM Projects WHERE project_id = ? AND username = ?");
$stmt->execute([$project_id, $username]);
$project = $stmt->fetch();

if (!$project) {
    header("Location: error.php");
    exit;
}

$stmt = $conn->prepare("SELECT task_id, title, due_date FROM Tasks WHERE project_id = ?");
$stmt->execute([$project_id]);
$tasks = $stmt->fetchAll();

$today_tasks = array();
$tomorrow_tasks = array();
$upcoming_tasks = array();

foreach ($tasks as $task) {
    $due_date = strtotime($task['due_date']);
    $today = strtotime(date('Y-m-d'));
    if ($due_date == $today) {
        $today_tasks[] = $task;
    } elseif ($due_date == strtotime('+1 day', $today)) {
        $tomorrow_tasks[] = $task;
    } else {
        $upcoming_tasks[] = $task;
    }
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Project 1">
    <meta name="description" content="">
    <title>Project Detail</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Project-Detail.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.9.2, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
    
    
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "SnapTask",
		"logo": "images/4.png"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Project Detail">
    <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
  <body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en"><header class="u-clearfix u-header u-palette-1-dark-2 u-header" id="sec-3e90"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="Home.html" class="u-image u-logo u-image-1" data-image-width="4000" data-image-height="2000" title="Home">
          <img src="images/4.png" class="u-logo-image u-logo-image-1">
        </a>
        <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1">
          <div class="menu-collapse" style="font-size: 1.25rem; letter-spacing: 0px;">
            <a class="u-button-style u-custom-color u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-hover-color u-custom-text-shadow u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
              <svg class="u-svg-link" viewBox="0 0 24 24"><use xlink:href="#menu-hamburger"></use></svg>
              <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><g><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect>
</g></svg>
            </a>
          </div>
          <div class="u-custom-menu u-nav-container">
            <ul class="u-custom-font u-heading-font u-nav u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-white" href="Home.html" style="padding: 10px 20px; text-shadow: 2px 2px 8px rgba(0,0,0,0.4);">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-white" href="Login.html" style="padding: 10px 20px; text-shadow: 2px 2px 8px rgba(0,0,0,0.4);">Login</a>
</li></ul>
          </div>
          <div class="u-custom-menu u-nav-container-collapse">
            <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-inner-container-layout u-sidenav-overflow">
                <div class="u-menu-close"></div>
                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Home.html">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Login.html">Login</a>
</li></ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>
      </div></header>
    <section class="u-clearfix u-image u-shading u-section-1" id="sec-7317" data-image-width="250" data-image-height="143">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <h1 class="u-align-left u-text u-text-1">Project 1</h1>
        <div class="u-expanded-width u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-border-1 u-border-white u-container-style u-list-item u-opacity u-opacity-70 u-palette-1-dark-1 u-radius u-repeater-item u-shape-round u-list-item-1">
                <div class="u-container-layout u-similar-container u-container-layout-1">
                    <h3 class="u-align-left u-custom-font u-heading-font u-text u-text-default u-text-2">Today</h3>
                    <ul class="u-align-left u-spacing-50 u-text u-text-3">
                        <?php foreach ($today_tasks as $task): ?>
                            <li><?php echo $task['title']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="u-clearfix u-group-elements u-group-elements-1">
                        <!-- Ubah link sesuai dengan tugas -->
                        <?php foreach ($today_tasks as $task): ?>
                            <a href="markasdone.php?task_id=<?php echo $task['task_id']; ?>&project_id=<?php echo $project_id; ?>" class="u-border-none u-btn u-btn-round u-button-style u-dialog-link u-hover-white u-palette-1-base u-radius u-btn-1">Done</a>
                            <a href="hapustask.php?task_id=<?php echo $task['task_id']; ?>&project_id=<?php echo $project_id; ?>" class="u-border-none u-btn u-btn-round u-button-style u-dialog-link u-hover-white u-palette-2-light-2 u-radius u-btn-2">❌</a>
                            <a href="edittask.php?task_id=<?php echo $task['task_id']; ?>&project_id=<?php echo $project_id; ?>" class="u-border-none u-btn u-btn-round u-button-style u-dialog-link u-hover-white u-palette-5-dark-2 u-radius u-btn-3">✏️</a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
    
            <div class="u-repeater u-repeater-1">
            <div class="u-border-1 u-border-white u-container-style u-list-item u-opacity u-opacity-70 u-palette-1-dark-1 u-radius u-repeater-item u-shape-round u-list-item-2">
                <div class="u-container-layout u-similar-container u-container-layout-2">
                    <h3 class="u-align-left u-custom-font u-heading-font u-text u-text-default u-text-2">Tomorrow</h3>
                    <ul class="u-align-left u-spacing-50 u-text u-text-4">
                        <?php foreach ($tomorrow_tasks as $task): ?>
                            <li><?php echo $task['title']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="u-clearfix u-group-elements u-group-elements-4">
                        <!-- Ubah link sesuai dengan tugas -->
                        <?php foreach ($tomorrow_tasks as $task): ?>
                            <a href="markasdone.php?task_id=<?php echo $task['task_id']; ?>&project_id=<?php echo $project_id; ?>" class="u-border-none u-btn u-btn-round u-button-style u-dialog-link u-hover-white u-palette-1-base u-radius u-btn-1">Done</a>
                            <a href="hapustask.php?task_id=<?php echo $task['task_id']; ?>&project_id=<?php echo $project_id; ?>" class="u-border-none u-btn u-btn-round u-button-style u-dialog-link u-hover-white u-palette-2-light-2 u-radius u-btn-2">❌</a>
                            <a href="edittask.php?task_id=<?php echo $task['task_id']; ?>&project_id=<?php echo $project_id; ?>" class="u-border-none u-btn u-btn-round u-button-style u-dialog-link u-hover-white u-palette-5-dark-2 u-radius u-btn-3">✏️</a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
    
            <div class="u-border-1 u-border-white u-container-style u-list-item u-opacity u-opacity-70 u-palette-1-dark-1 u-radius u-repeater-item u-shape-round u-list-item-3">
                <div class="u-container-layout u-similar-container u-container-layout-3">
                    <h3 class="u-align-left u-custom-font u-heading-font u-text u-text-default u-text-6">Upcoming</h3>
                    <ul class="u-align-left u-spacing-50 u-text u-text-7">
                        <?php foreach ($upcoming_tasks as $task): ?>
                            <li><?php echo $task['title']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="u-clearfix u-group-elements u-group-elements-7">
                        <!-- Ubah link sesuai dengan tugas -->
                        <?php foreach ($upcoming_tasks as $task): ?>
                            <a href="markasdone.php?task_id=<?php echo $task['task_id']; ?>&project_id=<?php echo $project_id; ?>" class="u-border-none u-btn u-btn-round u-button-style u-dialog-link u-hover-white u-palette-1-base u-radius u-btn-1">Done</a>
                            <a href="hapustask.php?task_id=<?php echo $task['task_id']; ?>&project_id=<?php echo $project_id; ?>" class="u-border-none u-btn u-btn-round u-button-style u-dialog-link u-hover-white u-palette-2-light-2 u-radius u-btn-2">❌</a>
                            <a href="edittask.php?task_id=<?php echo $task['task_id']; ?>&project_id=<?php echo $project_id; ?>" class="u-border-none u-btn u-btn-round u-button-style u-dialog-link u-hover-white u-palette-5-dark-2 u-radius u-btn-3">✏️</a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <a href="#sec-5eeb" class="u-border-none u-btn u-btn-round u-button-style u-dialog-link u-hover-palette-1-light-1 u-palette-1-base u-radius u-btn-28">Add Task </a>
      </div>
    </section>
    
    
    
    
    
    
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-75f3"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Copyright Kelompok 5 RPL</p>
      </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
      <p class="u-text">
        <span>This site was created with the </span>
        <a class="u-link" href="https://nicepage.com/" target="_blank" rel="nofollow">
          <span>Nicepage</span>
        </a>
      </p>
    </section>
  <section class="u-align-center u-black u-clearfix u-container-style u-dialog-block u-opacity u-opacity-70 u-valign-middle u-dialog-section-6" id="sec-5eeb">
      <div class="u-align-center u-border-1 u-border-white u-container-style u-dialog u-radius u-shape-round u-white u-dialog-1">
        <div class="u-container-layout u-valign-bottom u-container-layout-1">
          <h2 class="u-text u-text-default u-text-1">Add Task</h2>
          <div class="custom-expanded u-form u-form-1">
            <form action="https://forms.nicepagesrv.com/v2/form/process" class="u-clearfix u-form-spacing-19 u-form-vertical u-inner-form" style="padding: 0px;" source="email" name="form">
              <div class="u-form-group u-form-name u-form-group-1">
                <label for="name-3e72" class="u-form-control-hidden u-label"></label>
                <input type="text" placeholder="Enter task title" id="name-3e72" name="name" class="u-border-2 u-border-grey-25 u-input u-input-rectangle u-radius-5" required="">
              </div>
              <div class="u-form-date u-form-group u-form-group-2">
                <label for="email-3e72" class="u-form-control-hidden u-label">Email</label>
                <input type="text" placeholder="Insert due date" id="email-3e72" name="date" class="u-border-2 u-border-grey-25 u-input u-input-rectangle u-radius-5" required="required" data-date-format="mm/dd/yyyy">
              </div>
              <div class="u-form-group u-form-message u-form-group-3">
                <label for="message-3e72" class="u-form-control-hidden u-label">Message</label>
                <textarea placeholder="Enter task description" rows="4" cols="50" id="message-3e72" name="description" class="u-border-2 u-border-grey-25 u-input u-input-rectangle u-radius-5"></textarea>
              </div>
              <div class="u-form-group u-form-select u-form-group-4">
                <label for="select-4341" class="u-label">Status</label>
                <div class="u-form-select-wrapper">
                  <select id="select-4341" name="select" class="u-border-2 u-border-grey-25 u-input u-input-rectangle u-radius u-input-4">
                    <option value="To-Do" selected="selected" data-calc="">To-Do</option>
                    <option value="On-going" data-calc="">On-going</option>
                    <option value="Testing" data-calc="">Testing</option>
                    <option value="Done" data-calc="">Done</option>
                  </select>
                  <svg class="u-caret u-caret-svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" style="fill:currentColor;" xml:space="preserve"><polygon class="st0" points="8,12 2,4 14,4 "></polygon></svg>
                </div>
              </div>
              <div class="u-align-left u-form-group u-form-submit u-form-group-5">
                <a href="#" class="u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius u-btn-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">Done</a>
                <input type="submit" value="submit" class="u-form-control-hidden">
              </div>
              <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
              <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
              <input type="hidden" value="" name="recaptchaResponse">
              <input type="hidden" name="formServices" value="7aecdde4-52ec-eafd-9ba8-27c5bdd970df">
            </form>
          </div>
        </div><button class="u-dialog-close-button u-icon u-text-grey-50 u-icon-1">
        <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 413.348 413.348" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-1ce9"></use></svg>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 413.348 413.348" id="svg-1ce9"><path d="m413.348 24.354-24.354-24.354-182.32 182.32-182.32-182.32-24.354 24.354 182.32 182.32-182.32 182.32 24.354 24.354 182.32-182.32 182.32 182.32 24.354-24.354-182.32-182.32z"></path></svg>
      </button>
      </div>
</body></html>