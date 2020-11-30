<?php
$ip_address = $_SERVER["REMOTE_ADDR"];
if(!in_array($ip_address, array("127.0.0.1", "::1"))) {
  $is_localhost = false;
  $connection = mysqli_connect("localhost", "hotpoton_scott", "CaptainTommy1997", "hotpoton_hotpot");
} else {
  $is_localhost = true;
  $connection = mysqli_connect("localhost", "root", "", "hotpot") or die; //DO NOT die IN PRODUCTION
}

require_once("functions.php");

//date_default_timezone_get(); //DEFAULT TIMEZONE IS 'Europe/Berlin'

session_start();

$signed_in = false;

if(isset($_GET["sign-out"])) session_destroy();
else {
  if(isset($_SESSION["id"])) $my_id = $_SESSION["id"];
  if(isset($_SESSION["name"])) $my_name = $_SESSION["name"];
  if(isset($_SESSION["description"])) $my_description = $_SESSION["description"];
  if(isset($_SESSION["email"])) $my_email = $_SESSION["email"];
  if(isset($_SESSION["verified"])) $my_verified = $_SESSION["verified"];
  if(isset($_SESSION["show_contact_form"])) $my_show_contact_form = $_SESSION["show_contact_form"];
  if(isset($_SESSION["picture"])) $my_picture = $_SESSION["picture"];
  if(isset($_SESSION["banner"])) $my_banner = $_SESSION["banner"];
}
//header("Cache-Control: max-age=84600");
?>
<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <base href='<?php echo $is_localhost ? "http://localhost/hotpot/" : "https://hotpot.one/"; ?>'>
    <meta charset='UTF-8'>
    <meta name='description' content='A free-speech community-based forum.'>
    <meta name='viewport' content='width = device-width, initial-scale = 1.0'>
    <meta name='theme-color' content='#222222'>
    <!--meta http-equiv='Content-Security-Policy' content=''/-->
    <title><?php if(isset($title)) echo "{$title} | "; ?> HotPot</title>
    <link rel='shortcut icon' href='images/favicon.png'>
    <link rel='manifest' href='manifest.webmanifest'>
    <link rel='stylesheet' type='text/css' href='css/variables.min.css'>
    <link rel='stylesheet' type='text/css' href='css/content.min.css'>
    <link rel='stylesheet' type='text/css' href='css/layouts.min.css'>
    <link rel='stylesheet' type='text/css' href='css/components.min.css'>
    <link rel='stylesheet' type='text/css' href='css/custom.min.css'>
    <script type='text/javascript' src='js/simple.js'></script>
  </head>
  <body>
    <script type='text/javascript'>
      $('body').style.opacity = 0;
    </script>
    <nav>
      <div>
        <a id='index-link' href='index.php'>Index</a>
        <a id='search-link' href='search.php'>Search</a>
      </div>
      <div>
        <?php
        if(isset($my_name)) {
          echo "<a id='dashboard-link' href='user.php?name={$my_name}'>My Profile</a>";
          echo "<a id='dashboard-link' href='community-dashboard.php'>Community Dashboard</a>";
          echo "<a id='dashboard-link' href='user-dashboard.php'>User Dashboard</a>";
          //$url = str_replace("?sign-out", "", $_SERVER['REQUEST_URI']);
          //echo "<a id='sign-out-link' href='{$url}?sign-out'>Sign-out</a>";
        } else {
          echo "<a id='sign-in-link' href='sign-in.php'>Sign-in</a>";
          echo "<a id='sign-up-link' href='sign-up.php'>Sign-up</a>";
        }
        ?>
        <a id='settings-link' href='settings.php'>Settings</a>
      </div>
    </nav>
