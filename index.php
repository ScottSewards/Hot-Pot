<?php
require_once("head.php");
?>
<template id="post">
  <img src='images/picture.png' alt='Placeholder' style='width: 100px !important;'/>
  <span>img</span>
  <span>title</span>
  <span>likes</span>
  <span>dislikes</span>
  <span>postee</span>
  <span>created</span>
  <span>pot</span>
</template>
<main>
  <section>
    <h1>Index</h1>
    <p>This website is in-development. While updated bi-daily, it is live for demonstrations. The next update focuses on security and submittable content to be displayed on this page.</p>
    <h2>Posts</h2>
    <div class='inline'>
      <img src='images/picture.png' alt='Placeholder' style='width: 100px !important;'/>
      <span>img</span>
      <span>title</span>
      <span>likes</span>
      <span>dislikes</span>
      <span>postee</span>
      <span>created</span>
      <span>pot</span>
    </div>
    <h2>New Users</h2>
    <div class='inline'>
    <?php
    $select = mysqli_query($connection, "SELECT * FROM users ORDER BY id DESC LIMIT 2");
    while($fetch = mysqli_fetch_assoc($select)) {
      $name = $fetch['name'];
      $picture = $fetch['picture'];
      $link = "user.php?name={$name}";
      echo "
      <div class='user'>
        <img src='{$picture}'/>
        <span class='name' style='text-align: center; display: block;'><a href='{$link}'>Visit {$name}</a>.</span>
      </div>";
    }
    ?>
    </div>
  </section>
</main>
<?php
require_once("foot.php");
?>
