<?php
$title = "Dashboard";
require_once("head.php");

if(!isset($my_id)) direct_to("sign-in.php");

if(isset($_POST["change-name"])) {
  $name = htmlspecialchars(addslashes($_POST["name"]));
  $select = mysqli_query($connection, "SELECT name FROM users WHERE name='{$name}'");
  if(mysqli_num_rows($select) == 1) echo "You cannot use this name.";
  else {
    $update = mysqli_query($connection, "UPDATE users SET name='{$name}' WHERE id='{$my_id}'");
    $_SESSION["name"] = $name;
    direct_to("user-dashboard.php");
  }
} else if(isset($_POST["change-email"])) {
  $email = htmlspecialchars(addslashes($_POST["email"]));
  $select = mysqli_query($connection, "SELECT email FROM users WHERE email='{$email}'");
  if(mysqli_num_rows($select) == "1") echo "You cannot use this email.";
  else {
    $update = mysqli_query($connection, "UPDATE users SET email='{$email}' WHERE id='{$my_id}'");
    $_SESSION["email"] = $email;
    direct_to("user-dashboard.php");
  }
} else if(isset($_POST["update-email-settings"])) {
  $show_contact_form = htmlspecialchars(addslashes($_POST["show-contact-form"]));
  $show_contact_form = $show_contact_form == "on" ? 1 : 0;
  mysqli_query($connection, "UPDATE users SET show_contact_form='{$show_contact_form}' WHERE id='{$my_id}'");
  $_SESSION["show_contact_form"] = $show_contact_form;
  direct_to("user-dashboard.php");
} else if(isset($_POST["change-password"])) {
  $old_password = htmlspecialchars(addslashes($_POST["old-password"]));
  $select = mysqli_query($connection, "SELECT password FROM users WHERE id='{$my_id}'");
  $fetch = mysqli_fetch_array($select);
  if(password_verify($old_password, $fetch['password'])) {
    $new_password = htmlspecialchars(addslashes($_POST["new-password"]));
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    mysqli_query($connection, "UPDATE users SET password='{$password_hash}' WHERE id='{$my_id}'");
    direct_to("user-dashboard.php");
  } else echo "Your old password was incorrect.";
} else if(isset($_POST["change-picture"])) {
  if(!empty($_FILES["picture"])) {
    $file_name = $_FILES["picture"]["name"];
    if(move_uploaded_file($_FILES["picture"]["tmp_name"], "images/pictures/{$file_name}")) { //UPLOAD PICTURE
      if($my_picture != "images/picture.png") { //IF PICTURE IS NOT DEFAULT
        $my_picture_name = explode("/", $my_picture); //GET FILE NAME
        rename($my_picture, "images/_bin/" . end($my_picture_name)); //MOVE FILE TO BIN
      }
      $file_extension = end(explode(".", $file_name));
      $path_and_file_name = "images/pictures/{$my_id}-1.{$file_extension}";
      rename("images/pictures/{$file_name}", "{$path_and_file_name}");
      mysqli_query($connection, "UPDATE users SET picture='{$path_and_file_name}' WHERE id='{$my_id}'");
      $_SESSION["picture"] = $path_and_file_name;
      direct_to("user-dashboard.php");
    } else echo "Your file was not uploaded.";
  }
} else if(isset($_POST["change-banner"])) {
  if(!empty($_FILES["banner"])) {
    $file_name = $_FILES["banner"]["name"];
    if(move_uploaded_file($_FILES["banner"]["tmp_name"], "images/banners/{$file_name}")) {
      if($my_banner != "images/banner.png") {
        $my_banner_name = explode("/", $my_banner);
        rename($my_banner, "images/_bin/" . end($my_banner_name));
      }
      $file_extension = end(explode(".", $file_name));
      $path_and_file_name = "images/banners/{$my_id}-1.{$file_extension}";
      rename("images/banners/{$file_name}", "{$path_and_file_name}");
      $update = mysqli_query($connection, "UPDATE users SET banner='{$path_and_file_name}' WHERE id='{$my_id}'");
      $_SESSION["banner"] = $path_and_file_name;
      direct_to("user-dashboard.php");
    } else echo "Your file was not uploaded.";
  }
}
?>
<main>
  <h1>Dashboard</h1>
  <section>
    <h2>User Settings</h2>
    <article>
      <h3>Change Name</h3>
      <form method='POST'>
        <div class='inline'>
          <label for='name'>Name*</label>
          <input id='name' type='text' name='name' placeholder='<?php echo $my_name; ?>' required>
        </div>
        <input type='submit' name='change-name' value='Change Name'>
      </form>
    </article>
    <article>
      <h3>Change Email</h3>
      <form method='POST'>
        <div class='inline'>
          <label for='email'>Email*</label>
          <input id='email' type='email' name='email' placeholder='<?php echo $my_email ?>' required>
        </div>
        <input type='submit' name='change-email' value='Change Email'>
      </form>
    </article>
    <article>
      <h3>Change Email Settings</h3>
      <form method='POST'>
        <div class='inline'>
          <label for='show-contact-form'>Accept contact from other users</label>
          <input id='show-contact-form' type='checkbox' name='show-contact-form' <?php if($my_show_contact_form == true) echo "checked"; ?>>
        </div>
        <div class='inline hide'>
          <label for='send-newsletter'>Subscribe to the Hot Pot newsletter</label>
          <input id='send-newsletter' type='checkbox' name='send-newsletter' disabled>
        </div>
        <input type='submit' name='update-email-settings' value='Update Email Settings'>
      </form>
    </article>
    <article>
      <h3>Change Password</h3>
      <form method='POST'>
        <div class='inline'>
          <label for='old-password'>Old Password*</label>
          <input id='old-password' type='password' name='old-password' autocomplete='off' required>
          <input type='button' value='Show' name='show-old-password'>
        </div>
        <div class='inline'>
          <label for='new-password'>New Password*</label>
          <input id='new-password' type='password' name='new-password' autocomplete='off' required>
          <input type='button' value='Show' name='show-new-password'>
        </div>
        <div class='inline'>
          <input type='submit' name='change-password' value='Change Password'>
          <input type='submit' name='reset-password' value='Reset Password' disabled>
        </div>
      </form>
    </article>
    <article>
      <h3>Change Picture</h3>
      <form method='POST' enctype='multipart/form-data'>
        <figure id='my-picture-figure'>
          <figcaption>My Picture</figcaption>
          <img id='my-picture' src='<?php echo $my_picture; ?>' alt='My Picture'>
        </figure>
        <div class='inline'>
          <label for='picture'>Image*</label>
          <input id='picture' type='file' name='picture' accept='image/jpeg, image/gif, image/png' required>
        </div>
        <input type='submit' name='change-picture' value='Change Picture'>
      </form>
      <script type='text/javascript'>
      $('#picture').addEventListener('change', function() { //t.ly/fijM
        if(this.files[0].size > 2097152) {
          alert('The image you uploaded is too large. It must be no larger than 1 megabyte.');
          this.value = '';
        } else if(this.files[0]) {
          var reader = new FileReader();
          reader.onload = e => {
            $('#my-picture').src = e.target.result;
          }
          reader.readAsDataURL(this.files[0]);
        }
      });
      </script>
    </article>
    <article>
      <h3>Change Banner</h3>
      <form method='POST' enctype='multipart/form-data'>
        <figure id='my-banner-figure'>
          <figcaption>My Banner</figcaption>
          <img id='my-banner' src='<?php echo $my_banner; ?>' alt='My Banner'>
        </figure>
        <div class='inline'>
          <label for='banner'>Image*</label>
          <input id='banner' type='file' name='banner' accept='image/jpeg, image/gif, image/png' required>
        </div>
        <input type='submit' name='change-banner' value='Change Banner'>
      </form>
      <script type='text/javascript'>
      $("#banner").addEventListener('change', function() {
        if(this.files[0].size > 4194304) {
          alert('The image you uploaded is too large. It must be no larger than 2 megabytes.');
          this.value = '';
        } else if(this.files[0]) {
          var reader = new FileReader();
          reader.onload = e => {
            $('#my-banner').src = e.target.result;
          }
          reader.readAsDataURL(this.files[0]);
        }
      });
      </script>
    </article>
  </section>
</main>
<?php
require_once("foot.php");
?>
