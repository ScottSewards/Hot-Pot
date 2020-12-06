<?php
$title = "User";
require_once("head.php");

if(!isset($_GET["name"])) head_to("404.html");
else $user_name = $_GET["name"];

$select_user = mysqli_query($connection, "SELECT * FROM users WHERE name='{$user_name}'");
if(mysqli_num_rows($select_user) == "1") {
  $fetch_user = mysqli_fetch_assoc($select_user);
  $user_id = $fetch_user["id"];
  //$user_created = $fetch_user["created"];
  $user_description = $fetch_user["description"];
  $user_email = $fetch_user["email"];
  $user_picture = $fetch_user["picture"];
  $user_banner = $fetch_user["banner"];
} else {
  mysqli_close($connection);
  head_to("404.html");
}

if($signed_in) {
  // $select_follower = mysqli_query($connection, "SELECT * FROM user_follows WHERE follow_from_id='{$my_id}' AND follow_to_id='{$user_id}'");
  // $select_follower_exists = mysqli_num_rows($select_follower);
  // if($select_follower_exists == "1") {
  //   $fetch_follower = mysqli_fetch_array($select_follower);
  //   $select_is_following = $fetch_follower["followed"];
  // } else $select_is_following = 0;
  // $follow_value = $select_is_following > "0" ? "Unfollow" : "Follow";
  // if(isset($_POST["follow"])) {
  //   if($select_follower_exists > "0") {
  //     if($select_is_following == "1") mysqli_query($connection, "UPDATE user_follows SET followed='0', unfollowed_on='{$datetime}'");
  //     else mysqli_query($connection, "UPDATE user_follows SET followed='1', followed_on='{$datetime}'");
  //   } else mysqli_query($connection, "INSERT INTO user_follows (followed_on, follower, following) VALUES ('{$datetime}', '{$my_id}', '{$user_id}')");
  //   head_to("user.php?name={$user_name}");
  // }
  //
  // if(isset($_POST["friend"])) {
  //   //COPY FOLLOW CODE
  // }
}
?>
<main>
  <section id='user-information'>
    <?php
    echo "<img class='banner' src='{$user_banner}' alt='Banner for {$user_name}' height='100%' width='100%'>";
    echo "<img class='picture' src='{$user_picture}' alt='Picture for {$user_name}' height='100%' width='100%'>";
    echo "<h1>{$user_name}</h1>";

    // if($user_description != null) echo "<p class='centre'>{$user_description}</p>";
    // else echo "<p class='centre'>{$user_name} has not written a description.</p>";

    //$user_created_to_new_date = date("jS F Y", strtotime($user_created));
    //echo "<p class='centre'>User since {$user_created_to_new_date}</p>";

    if($signed_in and $my_id != $user_id) {
      echo "
      <form class='less' method='POST'>
        <input class='centre' type='submit' name='follow' value='{$follow_value}'>
      </form>";
      echo "
      <form class='less' method='POST'>
        <input class='centre' type='submit' name='friend' value='Friend'>
      </form>";
    }
    ?>
  </section>
  <section id='user-friends'>
    <h2>Friends</h2>
    <?php
    echo "<p>{$user_name} has not made any friends yet.</p>";
    echo "<div class='users hide'>";
    echo "</div>";
    ?>
  </section>
  <section id='user-communities-created'>
    <?php
    $select_creations = mysqli_query($connection, "SELECT * FROM communities WHERE created_by_id='{$user_id}'");
    $number_of_creations = mysqli_num_rows($select_creations);
    echo "<h2>Communities({$number_of_creations})</h2>";
    if($number_of_creations > "0") {
      echo "<div class='communities'>";
      // while($fetch_created_communities = mysqli_fetch_array($select_created_communities)) {
      //   $created_community_created = $fetch_created_communities["created"];
      //   $created_community_created_to_new_date = date("M Y", strtotime($created_community_created));
      //   $created_community_name = $fetch_created_communities["name"];
      //   $created_community_picture = $fetch_created_communities["picture"];
      //   echo "
      //   <div class='community'>
      //   <img src='{$created_community_picture}' alt='Picture for {$created_community_name}' height='0' width='100%'>
      //   <div class='meta'>
      //   <span><a href='community.php?name={$created_community_name}'>{$created_community_name}</a></span>
      //   <span>created {$created_community_created_to_new_date}</span>
      //   </div>
      //   </div>";
      // }
      echo "</div>";
    } else echo "<p>{$user_name} has not created any communities.</p>";
    ?>
  </section>
  <section id='user_community_moderations'>
    <?php
    $select_moderations = mysqli_query($connection, "SELECT * FROM community_moderators WHERE user_id='{$user_id}'");
    $number_of_moderations = mysqli_num_rows($select_moderations);
    echo "<h2>Communities Moderated ({$number_of_moderations})</h2>";
    if($number_of_moderations > "0") {
      echo "<div class='communities'>";
      // while($fetch_moderated_communities = mysqli_fetch_array($select_moderated_communities)) {
      //   $moderated_community_created = $fetch_moderated_communities["created"];
      //   $moderated_community_created_to_new_date = date("M Y", strtotime($moderated_community_created));
      //   $moderated_community_name = $fetch_moderated_communities["name"];
      //   $moderated_community_picture = $fetch_moderated_communities["picture"];
      //   echo "
      //   <div class='community'>
      //     <img src='{$moderated_community_picture}' alt='Picture for {$moderated_community_picture}' height='' width='100%'>
      //     <div class='meta'>
      //       <span><a href='community.php?name={$moderated_community_name}'>{$moderated_community_name}</a></span>
      //       <span>created {$moderated_community_created_to_new_date}</span>
      //     </div>
      //   </div>";
      // }
      echo "</div>";
    } else echo "<p>{$user_name} does not moderate any communities.</p>";
    ?>
  </section>
  <section id='user-posts'>
    <?php
    $select_posts = mysqli_query($connection, "SELECT * FROM posts WHERE posted='1' AND post_by_id='{$user_id}' ORDER BY id DESC");
    $number_of_posts = mysqli_num_rows($select_posts);
    echo "<h2>Posts ({$number_of_posts})</h2>";
    if($number_of_posts > "0") {
      echo "<div class='posts'>";
      while($fetch_post = mysqli_fetch_array($select_posts)) {
        //$post_id = $fetch_post["id"];
        //$posted = $fetch_post["posted"];
        //$posted_in = $fetch_post["posted_in"];
        //$select_posted_in = mysqli_query($connection, "SELECT name FROM communities WHERE id='{$posted_in}'");
        //$fetch_posted_by = mysqli_fetch_array($select_posted_in);
        //$posted_in = $fetch_posted_by["name"];
        //$title = $fetch_post["title"];
        //$content = $fetch_post["content"];
        echo "
        <div class='post'>
          <span><a href='post.php?id={$post_id}&title={$title}'>{$title}</a> posted in <a href='community.php?name={$posted_in}'>{$posted_in}</a> on {$posted}.</span>
        </div>";
      }
      echo "</div>";
    } else echo "<p>{$user_name} has not posted in any communities.</p>";
    ?>
  </section>
  <section id='user-comments'>
    <?php
    $select_comments = mysqli_query($connection, "SELECT * FROM comments WHERE comment_by_id='$user_id' ORDER BY id DESC");
    $number_of_comments = mysqli_num_rows($select_comments);
    echo "<h2>Comments ({$number_of_comments})</h2>";
    if($number_of_comments > "0") {
      echo "<div class='comments'>";
      while($fetch_comment = mysqli_fetch_assoc($select_comments)) { }
      echo "</div>";
    } else echo "<p>{$user_name} has not commented on any posts.</p>";
    /*
    $select_replies = mysqli_query($connection, "SELECT * FROM replies WHERE reply_by='{$user_id}' ORDER BY id DESC");
    if(mysqli_num_rows($select_replies) > "0") {
      echo "<div class='replies'>";
      while($fetch_replies = mysqli_fetch_array($select_replies)) {
        $replied = $fetch_replies["replied"];
        $reply_id = $fetch
        $replied_in = $fetch_replies["replied_in"];
        $select_replied_in = mysqli_query($connection, "SELECT * FROM posts WHERE id='{$replied_in}'");
        $fetch_replied_in = mysqli_fetch_array($select_replied_in);
        $replied_in_name = $fetch_replied_in["title"];
        $posted_in = $fetch_replied_in["posted_in"];
        $select_posted_in = mysqli_query($connection, "SELECT name FROM communities WHERE id='{$posted_in}'");
        $fetch_posted_in = mysqli_fetch_array($select_posted_in);
        $posted_in_name = $fetch_posted_in["name"];
        $content = $fetch_replies["content"];
        echo "
        <div class='reply'>
          <span>Replied in <a href='post.php?id='{$reply_id}'&title={$replied_in_name}'>{$replied_in_name}</a> on <a href='community.php?name={$posted_in_name}'>{$posted_in_name}</a> on {$replied}.</span>
          <span>{$content}</span>
        </div>";
      }
      echo "</div>";
    } else echo "<p>{$user_name} has not replied to any posts.</p>";
    */
    ?>
  </section>
</main>
<?php require_once("foot.php"); ?>
