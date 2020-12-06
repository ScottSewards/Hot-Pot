<?php
$title = "Inbox";
require_once("head.php");
?>
<main>
  <h1>Inbox</h1>
  <section>
    <?php
    $select_friends = mysqli_query($connection, "SELECT * FROM user_friends WHERE user_id_a='{$my_id}' OR user_id_b='{$my_id}'");
    echo mysqli_num_rows($select_friends);
    //$select_message = mysqli_query($connection, "SELECT * FROM");
    ?>
    <div id='inbox'>
    </div>
  </section>
</main>
<?php
require_once("foot.php");
?>
