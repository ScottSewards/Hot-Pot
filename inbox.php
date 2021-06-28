<?php
$title = "Inbox";
require_once("head.php");
?>
<main>
  <h1>Inbox</h1>
  <section>
    <?php
    $select_friends = mysqli_query($connection, "SELECT * FROM user_messages WHERE user_id_a='{$my_id}' OR user_id_b='{$my_id}'");

    //echo mysqli_num_rows($select_friends);
    //$select_message = mysqli_query($connection, "SELECT * FROM");
    ?>


    <div id='inbox'>
      <ul id='inbox-friends-list'>
        <li class='inbox-friend'>User #1</li>
        <li class='inbox-friend'>User #2</li>
      </ul>
      <div id='inbox-messages'>
        <div class='inbox-message'>
          <p>There are no messages.</p>
          <p class='right'>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p>There are no messages.</p>
        </div>
      </div>
    </div>
    <form class='less' method='POST'>
      <div class='inline'>
        <input type='text' name='message' min='1' required>
        <input type='submit' name='send-message' value='Send'>
      </div>
    </form>
  </section>
</main>
<?php
require_once("foot.php");
?>
