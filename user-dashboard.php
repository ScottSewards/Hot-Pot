<?php
$title = "Dashboard";
require_once("head.php");
if(!$signed_in) head_to("sign-in.php");
?>
<main>
  <?php echo "<h1>{$my_name} Dashboard</h1>"; ?>
  <section>
    <?php
    if($my_verified == "0") include_once("templates/ud-verify-email.php");
    include_once("templates/ud-change-name.php");
    include_once("templates/ud-change-email.php");
    //include_once("templates/ud-change-email-settings.php");
    include_once("templates/ud-change-password.php");
    //include_once("templates/ud-change-picture.php");
    //include_once("templates/ud-change-banner.php");
    ?>
  </section>
</main>
<?php
require_once("foot.php");
?>
