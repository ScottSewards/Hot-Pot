<?php
$title = "Contact";
require "php/top.php";

if(isset($_POST["submit-email"])) {
  send_email(
    "scott.sewards@outlook.com",
    $_POST["subject"],
    $_POST["message"],
    isset($_POST["sender"]) ? $_POST["sender"] : isset($signature) ? $signature : "Signature-less",
    $_POST["email-address"],
    true
  );
}
?>
<main>
  <section>
    <h1>Contact</h1>
    <form action="contact.php" method="post">
      <fieldset>
        <legend>Contact</legend>
        <div class='inline'>
          <label for="sender">Name</label>
          <input id="sender" type="text" name="sender" placeholder="Buster Keaton">
        </div>
        <div class='inline'>
          <label for="email-address">Email*</label>
          <input id="email-address" type="email" name="email-address" placeholder="BusterKeaton@gmail.com" <?php if(isset($signature)) echo "value='$email'"; ?> required>
        </div>
        <div class='inline'>
          <label for="email-subject">Subject*</label>
          <input id="email-subject" type="text" name="subject" placeholder="I can't sign-in" required>
        </div>
        <div class='inline'>
          <label for="email-message">Message*</label>
          <textarea id="email-message" name="message" placeholder="Write a message." min="10" required></textarea>
        </div>
        <input type="submit" name="submit-email" value="Submit Email">
      </fieldset>
    </form>
  </section>
</main>
<?php
require "php/bottom.php";
?>
