<?php
$title = "User";
require_once("head.php");

if(!isset($_GET["name"])) {
  mysqli_close($connection);
  redirect("404.html");
}

$name = $_GET["name"];
$select = mysqli_query($connection, "SELECT * FROM users WHERE name='{$name}'");
if(mysqli_num_rows($select) == "1") {
  $fetch = mysqli_fetch_array($select);
  $id = $fetch["id"];
  $created = $fetch["created"];
  $email = $fetch["email"];
  $can_email = $fetch["can_email"];
  $picture = $fetch["picture"];
  $banner = $fetch["banner"];
} else {
  mysqli_close($connection);
  redirect("404.html");
};

if(isset($_POST["send-email"])) {
  if($is_localhost == false) send_email($email, $_POST["subject"], $_POST["message"], $my_name, $_POST["email-address"], true);
  else echo "You cannot send an email on localhost.";
}
?>
<main>
  <section>
    <img class='banner' src='<?php echo $banner; ?>' alt='Banner'/>
    <img class='picture' src='<?php echo $picture; ?>' alt='Picture'/>
    <h1><?php echo $name; ?></h1>
    <p><?php echo "User since {$created}."; ?></p>
    <?php
    echo $can_email;
    if(isset($my_id) and $can_email == true) {
      echo "
      <form action='contact.php' method='POST'>
        <fieldset>
          <legend>Contact</legend>
          <div class='inline'>
            <label for='sender'>Name</label>
            <input id='sender' type='text' name='sender' value='{$my_name}' disabled/>
          </div>
          <div class='inline'>
            <label for='email-address'>Return Email*</label>
            <input id='email-address' type='email' name='email-address' value='{$my_email}' required disabled/>
          </div>
          <div class='inline'>
            <label for=email-subject>Subject*</label>
            <input id='email-subject' type='text' name='subject' placeholder='' required/>
          </div>
          <div class='inline'>
            <label for='email-message'>Message*</label>
            <textarea id='email-message' name='message' min='10' required></textarea>
          </div>
          <input type='submit' name='send-email' value='Send Email'/>
        </fieldset>
      </form>";
    } else if(isset($my_id)) echo "<p>This user has disabled contact..</p>";
    ?>
  </section>
  <!--section>
    <h2><?php echo "{$name} is Playing"; ?></h2>
    <div id='track'>
      <div id='track-art'>
        <img id='track-cover' title='Rammstein Album Cover' src='images/rammstein.jpg' alt='Rammstein Album Cover'/>
      </div>
      <div id='track-information'>
        <h3 id='track-artist'>Rammstein by Rammstein</h3>
      </div>
    </div>
  </section-->
</main>
<?php
require_once("foot.php");
?>
