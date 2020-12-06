<?php
if(isset($_POST["submit-update-email-settings"])) {
  $newsletter_subscription = htmlspecialchars(addslashes($_POST["newsletter-subscription"]));
  $newsletter_subscription = $newsletter_subscription == "on" ? 1 : 0;
  mysqli_query($connection, "UPDATE users SET newsletter_subscription='{$newsletter_subscription}' WHERE id='{$my_id}'");
  $_SESSION["newsletter_subscription"] = $newsletter_subscription;

  head_to_self();
}
?>
<article class='hide'>
  <h3>Change Email Settings</h3>
  <form method='POST'>
    <div class='inline'>
      <input id='newsletter-subscription' type='checkbox' name='newsletter-subscription' <?php //if($my_newsletter_sub == "1") echo "checked"; ?>>
      <label for='newsletter-subscription'>Subscribe to newsletter</label>
    </div>
    <input type='submit' name='submit-update-email-settings' value='Update'>
  </form>
</article>
