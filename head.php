<?php
function send_email($recipient, $subject, $message, $name, $sender, $reply) {
  if($reply) $header = "From: $name <$sender> \r\n Reply-To: $sender \r\n X-Mailer: PHP/" . phpversion();
  else $header = "From: $name <$sender> \r\n X-Mailer: PHP/" . phpversion();
  mail($recipient, $subject, $message, $header);
  $message = "Email sent.";
}

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
    <link rel='stylesheet' type='text/css' href='css/variables.min.css'/>
    <link rel='stylesheet' type='text/css' href='css/content.min.css'/>
    <link rel='stylesheet' type='text/css' href='css/layouts.min.css'/>
    <link rel='stylesheet' type='text/css' href='css/components.min.css'/>
    <script type='text/javascript' src='js/simple.js'></script>
  </head>
  <body class='light'>
    <nav>
      <div>
        <a id='index-link' href='index.php'>Index</a>
        <a id='search-link' href='search.php'>Search</a>
        <a id='contact-link' href='contact.php'>Contact</a>
        <a id='settings-link' href='settings.php'>Settings</a>
        <ul>
        </ul>
      </div>
      <div>
        <p>MySign</p>
        <div>
          <?php
          if(isset($signature)) {
            echo "<a id='dashboard-link' href='dashboard.php'>Dashboard</a>";
            echo "<a id='sign-out-link' href='signature.php?sign-out'>Sign-out</a>";
          } else {
            echo "<a id='sign-in-link' href='sign-in.php'>Sign-in</a>";
            echo "<a id='sign-up-link' href='sign-up.php'>Sign-up</a>";
          }
          ?>
        </div>
      </div>
    </nav>
