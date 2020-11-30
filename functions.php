<?php
function head_to($location) {
  header("Location: {$location}");
  exit;
}

function email($recipient, $subject, $message, $name, $sender, $reply) {
  if($is_localhost == true) {

  } else {
    if($reply) $header = "From: $name <$sender> \r\n Reply-To: $sender \r\n X-Mailer: PHP/" . phpversion();
    else $header = "From: $name <$sender> \r\n X-Mailer: PHP/" . phpversion();
    mail($recipient, $subject, $message, $header);
  }
}

function email_verification() {
  $user_id;
  $select_user = mysqli_query($connection, "SELECT * FROM users WHERE id='{$user_id}'");
  $message = "
  <!DOCTYPE html>
  <html lang='en' dir='ltr'>
    <head>
      <meta charset='utf-8'>
      <title>Email Title</title>
      <style>
      </style>
    </head>
    <body>
      <nav>
        <a href='https://hotpot.one/'>Visit HotPot</a>
      </nav>
      <main>

      </main>
      <footer>
        <p>© 2020 Scott Sewards</p>
      </footer>
    </body>
  </html>";
  email();
}

function sign_in($fetch_sign_in) {
  $_SESSION["id"] = $fetch_sign_in["id"];
  $_SESSION["created"] = $fetch_sign_in["created"];
  $_SESSION["name"] = $fetch_sign_in["name"];
  $_SESSION["description"] = $fetch_sign_in["description"];
  $_SESSION["email"] = $fetch_sign_in["email"];
  $_SESSION["token"] = $fetch_sign_in["token"];
  $_SESSION["verified"] = $fetch_sign_in["verified"];
  $_SESSION["newsletter"] = $fetch_sign_in["newsletter"];
  $_SESSION["show_contact_form"] = $fetch_sign_in["show_contact_form"];
  $_SESSION["picture"] = $fetch_sign_in["picture"];
  $_SESSION["banner"] = $fetch_sign_in["banner"];

  $signed_in = date("Y-m-d G:i:s");
  $user_id = $fetch["id"];
  mysqli_query($connection, "INSERT INTO user_sign_ins(signed_in, user_id, ip_address) VALUES ('{$signed_in}', '{$user_id}', '{$ip_address}')");
  head_to("user-dashboard.php");
}

function sign_up() {
  sign_in();
}

function sign_out() {
  $_SESSOIN["signed_in"] = false;
}
?>
