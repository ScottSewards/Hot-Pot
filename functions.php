<?php
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

function sign_in($fetch_sign_in) {
  $_SESSION["signed_in"] = true;
  $_SESSION["id"] = $fetch_sign_in["id"];
  $_SESSION["created"] = $fetch_sign_in["created"];
  $_SESSION["name"] = $fetch_sign_in["name"];
  $_SESSION["description"] = $fetch_sign_in["description"];
  $_SESSION["email"] = $fetch_sign_in["email"];
  $_SESSION["verified"] = $fetch_sign_in["verified"];
  $_SESSION["newsletter_subscription"] = $fetch_sign_in["newsletter_subscription"];
  $_SESSION["picture"] = $fetch_sign_in["picture"];
  $_SESSION["banner"] = $fetch_sign_in["banner"];
  //$user_id = $fetch_sign_in["id"];
  //mysqli_query($connection, "INSERT INTO user_sign_ins (signed_in, user_id, ip_address) VALUES ('{$datetime}', '6', '{$ip_address}')");
  //mysqli_query($connection, "INSERT INTO users (created, name, email, password) VALUES ('{$created}', '{$name}', '{$email}', '{$password_hash}')");
  head_to("user-dashboard.php");
}
function sign_out() {
  session_destroy();
  session_start();
  $_SESSION["signed_in"] = false;
  head_to_self();
}
?>
