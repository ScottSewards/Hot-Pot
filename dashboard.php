<?php
$title = "Dashboard";
require_once("head.php");

if(!isset($my_id)) redirect("sign-in.php");

if(isset($_POST["change-signature-image"])) {
  //DELETE OLD IMAGE
  //unlink($my_picture);
  //unlink($my_banner);
  //RENAME IMAGE AS ID
  //$file_name;
  //rename($file_name, "{$my_id}.{$file_extension}");
  //UPLOAD NEW IMAGE
  //REFRESH
  redirect("dashboard.php");
} else if(isset($_POST["change-signature"])) {
  //CHECK IF SIGNATURE EXISTS
  $sign = htmlspecialchars(addslashes($_POST["signature"]));
  mysqli_query($connection, "UPDATE signatures SET signature='{$sign}' WHERE id='{$my_id}'");
  $select = mysqli_query($connection, "SELECT signature FROM signatures WHERE id='{$my_id}'");
  $fetch = mysqli_fetch_array($select);
  $_SESSION["signature"] = $fetch["signature"];
  redirect("dashboard.php");
} else if(isset($_POST["change-email"])) {
  //CHECK IF EMAIL EXISTS
  $email = htmlspecialchars(addslashes($_POST["email"]));
  mysqli_query($connection, "UPDATE signatures SET email='{$email}' WHERE id='{$my_id}'");
  $select = mysqli_query($connection, "SELECT email FROM signatures WHERE id='{$my_id}'");
  $fetch = mysqli_fetch_array($select);
  $_SESSION["email"] = $fetch["email"];
  redirect("dashboard.php");
} else if(isset($_POST["change-password"])) {
  $old_password = htmlspecialchars(addslashes($_POST["old-password"]));
  $select = mysqli_query($connection, "SELECT password FROM signatures WHERE id='{$my_id}'");
  $fetch = mysqli_fetch_array($select);
  if(password_verify($old_password, $fetch['password'])) {
    $new_password = htmlspecialchars(addslashes($_POST["new-password"]));
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    mysqli_query($connection, "UPDATE signatures SET password='{$password_hash}' WHERE id='{$my_id}'");
    redirect("dashboard.php");
  } else echo "Your old password was incorrect.";
}
?>
<main>
  <section>
    <h1>Dashboard</h1>
    <div class='hide'>
      <form action='dashboard.php' method='POST' enctype='multipart/form-data'>
        <fieldset>
          <legend>Change Banner</legend>
          <div class='inline'>
            <label for='sign-banner'>Banner image*</label>
            <input id='sign-banner' type='file' name='sign-banner' accept='image/jpeg, image/png' required/>
          </div>
          <input type='submit' name='change-banner' value='Upload Image'/>
        </fieldset>
      </form>
    </div>
    <div>
      <form action='dashboard.php' method='POST' enctype='multipart/form-data'>
        <fieldset>
          <legend>Change Picture</legend>
          <div class='inline-equal'>
            <figure id='old-picture-figure'>
              <figcaption>Active Picture</figcaption>
              <img id='old-picture' src='images/pictures/george.jpeg' alt='Active Image'/>
            </figure>
            <figure id='new-picture-figure' class='hide'>
              <figcaption>New Picture</figcaption>
              <img id='new-picture'/>
            </figure>
          </div>
          <div class='inline'>
            <label for='picture'>Signature image*</label>
            <input id='picture' type='file' name='picture' accept='image/jpeg, image/gif, image/png' required/>
          </div>
          <input type='submit' name='change-picture' value='Change Picture' disabled/>
        </fieldset>
      </form>
      <script type='text/javascript'>
      $("#picture").addEventListener('change', function() { //t.ly/fijM
        if(this.files[0]) {
          var reader = new FileReader();
          reader.onload = e => {
            $('#new-picture-figure').classList.remove('hide');
            $('#new-picture').src = e.target.result;
          }
          reader.readAsDataURL(this.files[0]);
          //COMPRESS IMAGE
        }
      });
      </script>
    </div>
    <div>
      <form action='dashboard.php' method='POST'>
        <fieldset>
          <legend>Change Signature</legend>
          <div class='inline'>
            <label for='real-name'>Real Name</label>
            <input id='real-name' type='text' name='real-name' disabled/>
          </div>
          <div class='inline'>
            <label for='signature'>Signature*</label>
            <input id='signature' type='text' name='signature' placeholder='<?php echo $my_sign ?>' required/>
          </div>
          <input type='submit' name='change-signature' value='Change Signature' disabled/>
        </fieldset>
      </form>
    </div>
    <div>
      <form action='dashboard.php' method='POST'>
        <fieldset>
          <legend>Change Email</legend>
          <div class='inline'>
            <label for='email'>Email*</label>
            <input id='email' type='email' name='email' placeholder='<?php echo $my_email ?>' required/>
          </div>
          <input type='submit' name='change-email' value='Change Email' disabled/>
        </fieldset>
      </form>
    </div>
    <div>
      <form action='dashboard.php' method='POST'>
        <fieldset>
          <legend>Change Password</legend>
          <div class='inline'>
            <label for='old-password'>Old Password*</label>
            <input id='old-password' type='password' name='old-password' placeholder='' required/>
            <input type='button' value='Show' name='show-password'>
          </div>
          <div class='inline'>
            <label for='new-password'>New Password*</label>
            <input id='new-password' type='password' name='new-password' placeholder='' required/>
            <input type='button' value='Show' name='show-password'>
          </div>
          <div class='inline'>
            <input type='submit' name='change-password' value='Change Password'/>
            <input type='submit' name='reset-password' value='Reset Password' disabled/>
          </div>
        </fieldset>
      </form>
    </div>
  </section>
</main>
<?php
require_once("foot.php");
?>
