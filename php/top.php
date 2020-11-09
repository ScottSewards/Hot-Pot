<?php
require("functions.php");

$ipAddress = $_SERVER["REMOTE_ADDR"];
if(!in_array($ipAddress, array("127.0.0.1", "::1"))) {
  $isLocalhost = false;
  $connection = mysqli_connect("localhost", "sewardsm_admin", "CaptainTommy1997", "sewardsm_signature");
} else {
  $isLocalhost = true;
  $connection = mysqli_connect("localhost", "root", "", "sme");
}

if(mysqli_connect_error()) die();

session_start();
if(isset($_GET["sign-out"])) session_destroy();
if(isset($_SESSION["id"])) $id = $_SESSION["id"];
if(isset($_SESSION["signature"])) $signature = $_SESSION["signature"];
if(isset($_SESSION["email"])) $email = $_SESSION["email"];
?>
<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <?php echo $isLocalhost ? "<base href='http://localhost/PHP-Hot-Pot/'>" : "<base href='https://sewards.me/'>"; ?>
    <meta charset='UTF-8'>
    <!--meta name='description' content='No description.'-->
    <meta name='viewport' content='width = device-width, initial-scale = 1.0'>
    <!--meta name='theme-color' content='<?php echo $themeColour; ?>'-->
    <!--meta http-equiv='Content-Security-Policy' content=''/> <PREVENT CLICKBAIT-->
    <title>s.me <?php if(!empty($title)) echo " - " . $title; ?></title>
    <!--link rel='shortcut icon' href=''-->
    <link rel='stylesheet' type='text/css' href='css/variables.css'/>
    <link rel='stylesheet' type='text/css' href='css/content/forms.min.css'/>
    <link rel='stylesheet' type='text/css' href='css/content/media.css'/>
    <link rel='stylesheet' type='text/css' href='css/content/sections.min.css'/>
    <link rel='stylesheet' type='text/css' href='css/content/text.min.css'/>
    <link rel='stylesheet' type='text/css' href='css/layouts.min.css'/>
    <link rel='stylesheet' type='text/css' href='css/components.min.css'/>
    <script type='text/javascript' src='js/main.js'>
    </script>
  </head>
  <body>
    <nav>
      <div>
        <ul>
          <li id='index-link'><a href='index.php'>Index</a></li>
          <li id='search-link'><a href='search.php'>Search</a></li>
          <li id='contact-link'><a href='contact.php'>Contact</a></li>
          <li id='settings-link'><a href='settings.php'>Settings</a></li>
          <?php
          if(isset($signature)) {
            echo "<li id='dashboard-link'><a href='dashboard.php'>Dashboard</a></li>";
            echo "<li id='sign-out-link'><a href='signature.php?sign-out'>Sign-out</a></li>";
          } else {
            echo "<li id='sign-in-link'><a href='sign-in.php'>Sign-in</a></li>";
            echo "<li id='sign-up-link'><a href='sign-up.php'>Sign-up</a></li>";
          }
          ?>
        </ul>
      </div>
    </nav>
    <?php
    /*
    if($content) echo "
    <aside id='content'>
      <ul>
        <li>Link 1</li>
        <li>Link 2</li>
        <li>Link 3</li>
        <li>Link 4</li>
        <li>Link 5</li>
      </ul>
    </aside>";
    */
    ?>
    <!--aside id='sidebar'>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </aside-->
