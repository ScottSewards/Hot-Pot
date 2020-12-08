<?php
$title = "Community";
require_once("head.php");

if(!isset($_GET["name"])) head_to("404.html");
else $get_community_name = $_GET["name"];

$select_community = mysqli_query($connection, "SELECT * FROM communities WHERE name='{$get_community_name}'");
if(mysqli_num_rows($select_community) == "1") {
  $fetch_community = mysqli_fetch_array($select_community);
  $community_id = $fetch_community["id"];
  //$community_created = $fetch_community["created"];
  $community_created_by = $fetch_community["created_by_id"];
  $select_community_created_by_name = mysqli_query($connection, "SELECT name FROM users WHERE id='{$community_created_by}'");
  $fetch_community_created_by_name = mysqli_fetch_array($select_community_created_by_name);
  $community_created_by_name = $fetch_community_created_by_name["name"];
  $community_moderated_by = "1";
  if($community_created_by == $community_moderated_by) $community_moderated_by_name = $community_created_by_name;
  else {
    $select_community_moderated_by_name = mysqli_query($connection, "SELECT name FROM users WHERE id='{$community_moderated_by}'");
    $fetch_community_moderated_by_name = mysqli_fetch_array($select_community_moderated_by_name);
    $community_moderated_by_name = $fetch_community_moderated_by_name["name"];
  }
  $community_description = $fetch_community["description"];
  $community_picture = $fetch_community["picture"];
  $community_banner = $fetch_community["banner"];
  //SUBSCRIBERS
} else {
  head_to("404.html");
}

if(isset($_POST["pin-post"])) {
  //CHECK IF pinned
  $is_pinned;
  if($is_pinned) {
    mysqli_query($connection, "UPDATE posts SET pinned='{$post_pinned_date}', pinned_by='{$my_id}' WHERE id='{$post_pinned_id}'");
  } else {
    $post_pinned_id = $_POST["post-id"];
    mysqli_query($connection, "UPDATE posts SET pinned='{$datetime}', pinned_by='{$my_id}' WHERE id='{$post_pinned_id}'");
  }
}

if($signed_in) {
  $select_follower = mysqli_query($connection, "SELECT following FROM community_follows WHERE follow_from_id='{$my_id}' AND follow_to_id='{$community_id}'");
  $follower_exists = mysqli_num_rows($select_follower);
  if($follower_exists == "1") {
    $fetch_follower = mysqli_fetch_array($select_follower);
    $follower_following = $fetch_follower["following"];
  } else $follower_following = 0;
  $follow_value = $follower_following == "1" ? "Unfollow" : "Follow";

  if(isset($_POST["submit-follow"])) {
    if($follower_exists == "1") {
      if($follower_following == "1") mysqli_query($connection, "UPDATE community_follows SET following='0', unfollowed_date='{$datetime}'");
      else mysqli_query($connection, "UPDATE community_follows SET following='1', followed_date='{$datetime}'");
    } else mysqli_query($connection, "INSERT INTO community_follows (follow_from_id, follow_to_id, followed_date) VALUES ('{$my_id}', '{$community_id}', '{$datetime}')");
    head_to_self();
  }
}
?>
<main>
  <section>
    <?php
    echo "<img class='banner' src='{$community_banner}' alt='Banner for {$get_community_name}' height='100%' width='100%'>";
    echo "<img class='picture' src='{$community_picture}' alt='Picture for {$get_community_name}' height='100%' width='100%'>";
    echo "<h1>{$get_community_name}</h1>";

    if($community_description != null) echo "<p class='centre'>{$community_description}</p>";
    else echo "<p class='centre'>{$get_community_name} has no description.</p>";

    //$community_created_to_new_date = date("jS F Y", strtotime($community_created));
    //echo "<p class='centre'>Community since {$community_created_to_new_date}</p>";

    if($signed_in) echo "
    <form class='less' method='POST'>
      <input class='centre' type='submit' name='submit-follow' value='{$follow_value}'>
    </form>";
    ?>
  </section>
  <section id='posts'>
    <h2>Posts</h2>
    <?php
    if(isset($_GET["spb"])) $sort_posts_by = $_GET["spb"];
    else $sort_posts_by = "newest";

    switch($sort_posts_by) {
      case "oldest":
        show_content("posts", $connection, "SELECT * FROM posts ORDER BY post_in_id='{$community_id}' ASC LIMIT 10");
        break;
      default:
        show_content( "posts", $connection, "SELECT * FROM posts ORDER BY post_in_id='{$community_id}' DESC LIMIT 10");
        break;
    }
    ?>
  </section>
  <?php
  if($signed_in) include_once("templates/create-post.php");
  ?>
</main>
<?php
require_once("foot.php");
?>
