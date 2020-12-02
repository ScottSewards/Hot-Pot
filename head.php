<?php
$datetime = date("Y-m-d G:i:s");
$ip_address = $_SERVER["REMOTE_ADDR"];
if(!in_array($ip_address, array("127.0.0.1", "::1"))) {
  $is_localhost = false;
  $connection = mysqli_connect("localhost", "hotpoton_scott", "CaptainTommy1997", "hotpoton_hotpot");
} else {
  $is_localhost = true;
  $connection = mysqli_connect("localhost", "root", "", "hotpot") or die; //DO NOT die IN PRODUCTION
}

function head_to($location) {
  header("Location: {$location}");
  exit;
}
function head_to_self() {
  head_to($_SERVER["PHP_SELF"]);
}

function email($recipient, $subject, $message, $name, $sender) {
  if($is_localhost == true) $error = "You cannot send email on localhost.";
  else {
    $header = "From: $name <$sender> \r\n Reply-To: $sender \r\n X-Mailer: PHP/" . phpversion();
    mail($recipient, $subject, $message, $header);
  }

  /*
  if(isset($my_id) and $user_shows_contact_form == true) {
    echo "
    <hr>
    <h2>Contact</h2>
    <form method='POST'>
      <div class='inline'>
        <label for=email-subject>Subject*</label>
        <input id='email-subject' type='text' name='subject' placeholder='' required>
      </div>
      <div class='inline'>
        <label for='email-message'>Message*</label>
        <textarea id='email-message' name='message' min='10' required></textarea>
      </div>
      <input type='submit' name='send-email' value='Send Email'>
    </form>";
  } else if(isset($my_id)) echo "<p>{$user_name} has chose to not show a contact form.</p>";
  */
}
function email_verification() {
  $email_title = "Titleless";
  $user_id;
  $select_user = mysqli_query($connection, "SELECT * FROM users WHERE id='{$user_id}'");
  $message = "
  <!DOCTYPE html>
  <html lang='en' dir='ltr'>
    <head>
      <meta charset='utf-8'>
      <title>{$email_title}</title>
      <style>
      </style>
      <script>
      </script>
    </head>
    <body>
      <nav>
        <a href='https://hotpot.one/'>Visit HotPot</a>
      </nav>
      <main>
        <button onclick=''>Visit HotPot</button>
      </main>
      <footer>
        <p>© 2020 Scott Sewards</p>
      </footer>
    </body>
  </html>";
  //email();
}

if(isset($_POST["sign-out"])) {
  session_destroy();
  session_start();
  $_SESSION["signed_in"] = false;
  $user_id = $_SESSION["id"];
  mysqli_query($connection, "INSERT INTO user_sign_outs (signed_out, user_id, ip_address) VALUES ('{$datetime}', '{$user_id}', '{$ip_address}')");
  head_to_self();
} else session_start();

if(isset($_SESSION["signed_in"]) and $_SESSION["signed_in"] == "1") {
  $signed_in = true;
  $my_id = $_SESSION["id"];
  $my_name = $_SESSION["name"];
  $my_description = $_SESSION["description"];
  $my_email = $_SESSION["email"];
  $my_newsletter_subscription = $_SESSION["newsletter_subscription"];
  $my_verified = $_SESSION["verified"];
  $my_picture = $_SESSION["picture"];
  $my_banner = $_SESSION["banner"];
} else $signed_in = false;

//date_default_timezone_get(); //DEFAULT TIMEZONE IS 'Europe/Berlin'
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
        if($signed_in) {
          echo "<a id='' href='user.php?name={$my_name}'>My Profile</a>";
          echo "<a id='' href='community-dashboard.php'>Community Dashboard</a>";
          echo "<a id='' href='user-dashboard.php'>User Dashboard</a>";
        } else {
          echo "<a id='sign-in-link' href='sign-in.php'>Sign-in</a>";
          echo "<a id='sign-up-link' href='sign-up.php'>Sign-up</a>";
        }
        ?>
        <a id='settings-link' href='settings.php'>Settings</a>
      </div>
    </nav>
