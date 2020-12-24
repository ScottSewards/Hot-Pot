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
$location;

function head_to($location) {
  header("Location: {$location}");
  exit;
}
function head_to_self() {
  if(strlen($_SERVER["QUERY_STRING"]) > 0) head_to($_SERVER["PHP_SELF"] . "?" . $_SERVER['QUERY_STRING']);
  else head_to($_SERVER["PHP_SELF"]);
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

function send_notification($notification, $connection, $user, $datetime) {
  switch($notification) {
    case "friend request":
      mysqli_query($connection, $query);
      break;
  }

}

function show_content($content, $connection, $query) {
  $select_content = mysqli_query($connection, $query);
  $content_count = mysqli_num_rows($select_content);
  if($content_count > "0") {
    echo "<div class='{$content}'>";
    while($fetch_content = mysqli_fetch_assoc($select_content)) {
      switch($content) {
        case "communities":
          echo_community($fetch_content);
          break;
        case "posts":
          echo_post($connection, $fetch_content);
          break;
        case "comments":
          echo_comment($connection, $fetch_content);
          break;
        case "users":
        case "follower":
        case "friends":
          echo_user($fetch_content);
          break;
      }
    }
    echo "</div>";
  } else echo "<p>There are no {$content}.</p>";
  return $content_count;
}
function echo_community($fetch) {
  $community_name = $fetch["name"];
  $community_picture = $fetch["picture"];
  echo "
  <div class='community'>
    <img src='{$community_picture}' alt='Picture for {$community_name}' height='100%' width='100%'>
    <div class='meta'>
      <span><a href='community.php?name={$community_name}'>{$community_name}</a></span>
    </div>
  </div>";
}
function echo_post($connection, $fetch) {
  $post_id = $fetch["id"];

  $post_by_id = $fetch["post_by_id"];
  $select_user_by_post_by_id = mysqli_query($connection, "SELECT * FROM users WHERE id='{$post_by_id}'");
  $fetch_user_by_post_by_id = mysqli_fetch_assoc($select_user_by_post_by_id);
  $post_by_name = $fetch_user_by_post_by_id["name"];

  $post_in_id = $fetch["post_in_id"];
  $select_community_by_post_in_id = mysqli_query($connection, "SELECT * FROM communities WHERE id='{$post_in_id}'");
  $fetch_community_by_post_in_id = mysqli_fetch_assoc($select_community_by_post_in_id);
  $post_in_name = $fetch_community_by_post_in_id["name"];

  $post_date = $fetch["post_date"];
  $post_title = $fetch["title"];
  $post_content = $fetch["content"];
  echo "
  <div class='post'>
    <span><a href='post.php?id={$post_id}&title={$post_title}'>{$post_title}</a> by <a href='user.php?name={$post_by_name}'>{$post_by_name}</a> in <a href='community.php?name={$post_in_name}'>{$post_in_name}</a> on {$post_date}</span>
    <span>{$post_content}</span>
  </div>";
}
function echo_comment($connection, $fetch) {
  $comment_by_id = $fetch["comment_by_id"];
  $select_user_by_comment_by_id = mysqli_query($connection, "SELECT * FROM users WHERE id='{$comment_by_id}'");
  $fetch_user_by_comment_by_id = mysqli_fetch_assoc($select_user_by_comment_by_id);
  $comment_by_user_name = $fetch_user_by_comment_by_id["name"];
  $comment_date = $fetch["comment_date"];
  $comment_content = $fetch["content"];
  $comment_edited = $fetch["edited"];
  $comment_deleted = $fetch["deleted"];

  if($comment_deleted == "1") echo "
    <div class='comment'>
      <p>Reply by <a href='user.php?name={$comment_by_user_name}'>{$comment_by_user_name}</a> on {$comment_date}</p>
      <p>This comment is deleted.</p>
    </div>";
  else if($comment_edited == "1") echo "
    <div class='comment'>
      <p>Reply by <a href='user.php?name={$comment_by_user_name}'>{$comment_by_user_name}</a> on {$comment_date}</p>
      <p>This comment is edited.</p>
    </div>";
  else echo "
    <div class='comment'>
      <p>Reply by <a href='user.php?name={$comment_by_user_name}'>{$comment_by_user_name}</a> on {$comment_date}</p>
      <p>{$comment_content}</p>
    </div>";
}
function echo_user($fetch) {
  $user_name = $fetch["name"];
  $user_picture = $fetch['picture'];
  echo "
  <div class='user'>
    <img src='{$user_picture}' alt='Picture for {$user_name}' height='100%' width='100%'>
    <div class='meta'>
      <span><a href='user.php?name={$user_name}'>{$user_name}</a></span>
    </div>
  </div>";
}

session_start();
if(isset($_POST["sign-out"])) {
  $_SESSION["signed_in"] = false;
  $my_id = $_SESSION["user"]["id"];
  mysqli_query($connection, "INSERT INTO user_sign_outs (user_id, sign_out_date, ip_address) VALUES ('{$my_id}', '{$datetime}', '{$ip_address}')");
  head_to_self();
} else

if(isset($_SESSION["signed_in"]) and $_SESSION["signed_in"] == "1") {
  $signed_in = true;
  $my_id = $_SESSION["user"]["id"];
  $my_name = $_SESSION["user"]["name"];
  $my_email = $_SESSION["user"]["email"];
  //$my_newsletter_sub = $_SESSION["user"]["newsletter_subs"];
  $my_verified = $_SESSION["user"]["verified"];
  $my_picture = $_SESSION["user"]["picture"];
  $my_banner = $_SESSION["user"]["banner"];
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
          echo "<a id='inbox-link' href='inbox.php'>Inbox</a>";
          echo "<a id='my-profile-link' href='user.php?name={$my_name}'>My Profile</a>";
          echo "<a id='community-dashboard-link' href='community-dashboard.php'>Community Dashboard</a>";
          echo "<a id='user-dashboard-link' href='user-dashboard.php'>User Dashboard</a>";
        } else {
          echo "<a id='sign-in-link' href='sign-in.php'>Sign-in</a>";
          echo "<a id='sign-up-link' href='sign-up.php'>Sign-up</a>";
        }
        ?>
        <a id='settings-link' href='settings.php'>Settings</a>
      </div>
    </nav>
