<?php
$title = "Contact";
require "php/top.php";

if(isset($_GET["redirected"])) {
  $message = "You have been redirected to this webpage from home until the webpage features are complete.";
}

if(isset($_POST["submit-email"])) {
  SendEmail(
    "scotttsewards@hotmail.com",
    $_POST["subject"],
    $_POST["message"],
    isset($_POST["sender"]) ? $_POST["sender"] : isset($signature) ? $signature : "Unknown",
    $_POST["email-address"],
    true
  );
}
?>
<main>
  <section>
    <header>
      <h1>Contact</h1>
      <h2>Contact Me Form</h2>
    </header>
    <form action="contact.php" method="post">
      <fieldset>
        <div>
          <label for="sender">Name</label>
          <input id="sender" type="text" name="sender" placeholder="Buster Keaton">
        </div>
        <div>
          <label for="email-address">Email*</label>
          <input id="email-address" type="email" name="email-address" placeholder="BusterKeaton@gmail.com" <?php if(isset($signature)) echo "value='$email'"; ?> required>
        </div>
        <div>
          <label for="email-subject">Subject*</label>
          <input id="email-subject" type="text" name="subject" placeholder="I can't sign-in" required>
        </div>
        <div>
          <label for="email-message">Message*</label>
          <textarea id="email-message" name="message" placeholder="Write a message." min="10" required></textarea>
        </div>
        <input type="submit" name="submit-email" value="Submit Email">
      </fieldset>
    </form>
  </section>
  <article id='faq'>
    <h2>Frequently Asked Questions</h2>
  </article>
</main>
<?php
require "php/bottom.php";
?>
