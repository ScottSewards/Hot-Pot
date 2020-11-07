<?php
require("php/functions.php");

$ipAddress = $_SERVER['REMOTE_ADDR'];
if(!in_array($ipAddress, array('127.0.0.1', '::1'))) {
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
    <?php echo $isLocalhost ? "<base href='http://localhost/PHP-Hot-Pot/'>" : "<base href='http://PHP-Hot-Pot/'>"; ?>
    <meta charset='UTF-8'>
    <!--meta name="description" content="No description."-->
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <!--meta name="theme-color" content="<?php echo $themeColour; ?>"-->
    <!--meta http-equiv="Content-Security-Policy" content=""/> <PREVENT CLICKBAIT-->
    <title>s.me <?php if(!empty($title)) echo " - " . $title; ?></title>
    <!--link rel="shortcut icon" href=""-->
    <link rel='stylesheet' type="text/css" href="css/variables.css">
    <link rel='stylesheet' type="text/css" href="css/content/forms.min.css">
    <link rel='stylesheet' type="text/css" href="css/content/media.css">
    <link rel='stylesheet' type="text/css" href="css/content/sections.min.css">
    <link rel='stylesheet' type="text/css" href="css/content/tables.css">
    <link rel='stylesheet' type="text/css" href="css/content/text.min.css">
    <link rel='stylesheet' type="text/css" href="css/layouts/layout.min.css">
    <link rel='stylesheet' type="text/css" href="css/components.min.css">
    <link rel='stylesheet' type="text/css" href="css/custom.min.css">
  </head>
  <body>
    <nav class='stick wide'>
      <div>
        <ul>
          <li><a href='index.php'>Index</a></li>
          <li><a href='search.php'>Search</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="settings.php">Settings</a></li>
          <?php
          if(isset($signature)) {
            echo "<li><a href='dashboard.php'>Dashboard</a></li>";
            echo "<li><a href='signature.php?sign-out'>Sign-out</a></li>";
          } else {
            echo "<li><a href='sign-in.php'>Sign-in</a></li>";
            echo "<li><a href='sign-up.php'>Sign-up</a></li>";
          }
          ?>
        </ul>
      </div>
    </nav>
    <aside id='search-bar'>
      <form id='search-bar-form' action='search.php' post='get'>
        <div class='inline'>
          <input type='search' name='search' <?php if(isset($_GET["search"])) echo "value='" . $_GET["search"] . "'" ?> placeholder='Enter a query...' required>
          <input type='submit' value='Search'>
        </div>
      </form>
    </aside>
