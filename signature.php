<?php
$title = "Signature";
require_once("head.php");

if(isset($_GET["sign"])) {
  $sign = $_GET["sign"];
  $select = mysqli_query($connection, "SELECT * FROM signatures WHERE signature='{$sign}'");
  if(mysqli_num_rows($select) == "1") {
    $fetch = mysqli_fetch_assoc($select);
    $email = $fetch["email"];
  } else {
    mysqli_close($connection);
    exit;
    return;
  };
} else redirect("404.html");

if(isset($_POST["send-email"])) {
  if($is_localhost == false)
    send_email(
      $email,
      $_POST["subject"],
      $_POST["message"],
      isset($_POST["sender"]) ? $_POST["sender"] : isset($my_sign) ? $my_sign : "Nameless",
      $_POST["email-address"],
      true
    );
  else echo "Cannot send email on localhost.";
}
?>
<main>
  <section>
    <img class='banner' src='images/banner.png' alt='Banner'/>
    <img class='picture' src='images/pictures/elephant.jpeg' alt='Image'/>
    <h1><?php echo "@{$sign}"; ?></h1>
    <?php
    if(isset($my_id)) { echo "
      <form action='contact.php' method='POST'>
        <fieldset>
          <legend>Contact</legend>
          <div class='inline'>
            <label for='sender'>Name</label>
            <input id='sender' type='text' name='sender' value='{$my_sign}' disabled/>
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
    } else echo "<p>Sign-in to contact this signature.</p>";
    ?>
  </section>
  <!--section>
    <h2><?php echo "@{$sign} is Playing"; ?></h2>
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
