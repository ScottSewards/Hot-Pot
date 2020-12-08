<?php
$title = "User";
require_once("head.php");

if(!isset($_GET["name"])) head_to("404.html");
else $get_user_name = $_GET["name"];

$select_user = mysqli_query($connection, "SELECT * FROM users WHERE name='{$get_user_name}'");
if(mysqli_num_rows($select_user) == "1") {
  $fetch_user = mysqli_fetch_assoc($select_user);
  $user_id = $fetch_user["id"];
  $user_description = $fetch_user["description"];
  $user_description = trim($user_description);
  $user_picture = $fetch_user["picture"];
  $user_banner = $fetch_user["banner"];
} else head_to("404.html");

if($signed_in) {
  $select_follower = mysqli_query($connection, "SELECT following FROM user_follows WHERE follow_from_id='{$my_id}' AND follow_to_id='{$user_id}'");
  $follower_exists = mysqli_num_rows($select_follower);
  if($follower_exists == "1") {
    $fetch_follower = mysqli_fetch_array($select_follower);
    $follower_following = $fetch_follower["following"];
  } else $follower_following = 0;
  $follow_value = $follower_following == "1" ? "Unfollow" : "Follow";

  if(isset($_POST["submit-follow"])) {
    if($follower_exists == "1") {
      if($follower_following == "1") mysqli_query($connection, "UPDATE user_follows SET following='0', unfollowed_date='{$datetime}'");
      else mysqli_query($connection, "UPDATE user_follows SET following='1', followed_date='{$datetime}'");
    } else mysqli_query($connection, "INSERT INTO user_follows (follow_from_id, follow_to_id, followed_date) VALUES ('{$my_id}', '{$user_id}', '{$datetime}')");
    head_to_self();
  }
  /*
  SEND FRIEND REQUESTS
  $select_friend = mysqli_query($connection, "SELECT friends FROM user_friends WHERE (friend_a_id='{$my_id}' AND friend_b_id='{$user_id}') OR (friend_a_id='{$user_id}' AND friend_b_id='{$my_id}')");
  $friend_exists = mysqli_num_rows($select_friend);
  if($friend_exists == "1") {
    $fetch_friend = mysqli_fetch_array($select_friend);
    $friend_friends = $fetch_friend["friends"];
  } else $friend_friends = 0;
  $friend_value = $friend_friends == "1" ? "Unfriend" : "Friend";

  if(isset($_POST["submit-friend"])) {
    if($friend_exists == "1") {
      if($friend_friends == "1") mysqli_query($connection, "UPDATE user_friends SET following='0', unfollowed_on='{$datetime}'");
      else mysqli_query($connection, "UPDATE user_friends SET following='1', followed_date='{$datetime}'");
    } else mysqli_query($connection, "INSERT INTO user_friends (follow_from_id, follow_to_id, followed_date) VALUES ('{$my_id}', '{$user_id}', '{$datetime}')");
    head_to_self();
  }
  */
}
?>
<main>
  <section id='user-information'>
    <?php
    echo "<img class='banner' src='{$user_banner}' alt='Banner for {$get_user_name}' height='100%' width='100%'>";
    echo "<img class='picture' src='{$user_picture}' alt='Picture for {$get_user_name}' height='100%' width='100%'>";
    echo "<h1>{$get_user_name}</h1>";

    if($user_description != null) echo "<p class='centre'>{$user_description}</p>";
    else echo "<p class='centre'>{$get_user_name} has no description.</p>";

    //$user_created_to_new_date = date("jS F Y", strtotime($user_created));
    //echo "<p class='centre'>User since {$user_created_to_new_date}</p>";

    if($signed_in and $my_id != $user_id) {
      echo "
      <form class='less' method='POST'>
        <input class='centre' type='submit' name='submit-follow' value='{$follow_value}'>
      </form>";
      /*
      echo "
      <form class='less' method='POST'>
        <input class='centre' type='submit' name='submit-friend' value='{$friend_value}'>
      </form>";
      */
    }
    ?>
  </section>
  <section id='user-friends' class='hide'>
    <h2>Friends</h2>
    <?php
    //show_content("friends", $connection, "SELECT * FROM  WHERE post_by_id='{$user_id}' ORDER BY id DESC");
    ?>
  </section>
  <section id='user-posts'>
    <h2>Posts</h2>
    <?php
    show_content("posts", $connection, "SELECT * FROM posts WHERE post_by_id='{$user_id}' ORDER BY id DESC");
    ?>
  </section>
  <section id='user-comments'>
    <h2>Comments</h2>
    <?php
    show_content("comments", $connection, "SELECT * FROM comments WHERE comment_by_id='$user_id' ORDER BY id DESC");
    ?>
  </section>
</main>
<?php require_once("foot.php"); ?>
