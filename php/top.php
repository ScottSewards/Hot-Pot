<?php
require("php/velleity.php");
$message;
$ipAddress = $_SERVER['REMOTE_ADDR'];
$isLocalHost = true;
$connection;
if(!in_array($ipAddress, array('127.0.0.1', '::1'))) {
  $isLocalHost = false;
  $connection = mysqli_connect("localhost", "sewardsm_admin", "CaptainTommy1997", "sewardsm_signature");
} else $connection = mysqli_connect("localhost", "root", "", "sme");

if(mysqli_connect_error()) die();

session_start();
if(isset($_SESSION["id"])) $id = $_SESSION["id"];
if(isset($_SESSION["signature"])) $signature = $_SESSION["signature"];
if(isset($_SESSION["email"])) $email = $_SESSION["email"];

$themeColour = isset($_COOKIE["themeColour"]) ? $_COOKIE["themeColour"] : "#712B2B";
$darkMode = isset($_COOKIE["darkMode"]) ? $_COOKIE["darkMode"] : "off";
$systemOfUnits = isset($_COOKIE["systemOfUnits"]) ? $_COOKIE["systemOfUnits"] : 1; //METRIC IS DEFAULT
$familyTreeView = isset($_COOKIE["familyTreeView"]) ? $_COOKIE["familyTreeView"] : 3; //TILES IS DEFAULT
?>
<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <?php echo $isLocalHost ? "<base href='http://localhost/sewards.me/'>" : "<base href='http://sewards.me/'>"; ?>
    <meta charset='UTF-8'>
    <meta name="description" content="No description.">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <meta name="theme-color" content="<?php echo $themeColour; ?>">
    <!--meta http-equiv="Content-Security-Policy" content=""/> <PREVENT CLICKBAIT-->
    <title>s.me <?php if(!empty($title)) echo " - " . $title; ?></title>
    <!--link rel="shortcut icon" href=""-->
    <!--link rel='manifest' href='manifest.webmanifest'-->
    <link rel='stylesheet' type="text/css" href="./css/velleity.min.css">
    <link rel='stylesheet' type="text/css" href="css/sewards.min.css">
    <style>
    :root{
      <?php
        echo "--theme-colour: $themeColour !important;";
        if($darkMode == "on") echo"--lightest-colour: var(--dark-static) !important; --darkest-colour: var(--light-static) !important;";
      ?>
    }
    </style>
    <script src="js/jquery.js"></script>
    <script src="js/sewards.js"></script>
  </head>
  <body>
    <nav class="tabs">
      <ul>
        <li>s.me</li>
        <li>Other</li>
      </ul>
      <div id='primary'>
        <ul>
          <li><a href='index.php'>Index</a></li>
          <li><a href='search.php'>Search</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="settings.php">Settings</a></li>
          <ul>
            <?php
            if(isset($signature)) {
              echo "<li><a href='dashboard.php'>Dashboard</a></li>";
              echo "<li><a href='signature.php?sign-out'>Sign-out</a></li>";
            } else {
              echo "<li><a href='signature.php'>Sign-in</a></li>";
              echo "<li><a href='signature.php'>Sign-up</a></li>";
            }
            ?>
          </ul>
        </ul>
      </div>
      <div id='secondary'>
        <p>Menu</p>
      </div>
    </nav>
    <div id="search-bar" class="hide">
      <form id="search-form" action="search.php" post="get">
        <input type="search" name="search" <?php if(isset($_GET["search"])) echo "value='" . $_GET["search"] . "'" ?> placeholder='Enter a query...' required>
        <input type="submit" value="Search!">
      </form>
    </div>
