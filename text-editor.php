<?php
$title = "Text Processor";
require "php/top.php";
?>
<main>
  <section>
    <header>
      <h1>Content Management System</h1>
      <h2>Text Processor</h2>
    </header>
    <div id='text-processor'>
      <form action="text-processor.php" method="post">
        <textarea name="name" rows="8" cols="80"><?php echo file_get_contents('text/htdae.txt'); ?></textarea>
      </form>
    </div>
  </section>
</main>
<?php require "php/bottom.php"; ?>
<!--
  https://developer.spotify.com/documentation/web-api/
-->
