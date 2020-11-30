<?php
if(!isset($_GET["name"])) {
  mysqli_close($connection);
  direct_to("404.html");
} else $community_name = $_GET["name"];

$title = "{$community_name} Community";
require_once("head.php");

$select_community = mysqli_query($connection, "SELECT * FROM communities WHERE name='{$community_name}'");
if(mysqli_num_rows($select_community) == "1") {
  $fetch_community = mysqli_fetch_array($select_community);
  $community_id = $fetch_community["id"];
  $community_created = $fetch_community["created"];
  $community_created_by = $fetch_community["created_by"];
  $select_community_created_by_name = mysqli_query($connection, "SELECT name FROM users WHERE id='{$community_created_by}'");
  $fetch_community_created_by_name = mysqli_fetch_array($select_community_created_by_name);
  $community_created_by_name = $fetch_community_created_by_name["name"];
  $community_moderated_by = $fetch_community["moderated_by"];
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
  mysqli_close($connection);
  direct_to("404.html");
}

if(isset($_POST["post"])) {
  $new_post_posted = date("Y-m-d G:i:s");
  $new_post_posted_by = $my_id;
  $new_post_posted_in = $community_id;
  $new_post_title = htmlspecialchars(addslashes($_POST["title"]));
  $new_post_content = htmlspecialchars(addslashes($_POST["content"]));
  mysqli_query($connection, "INSERT INTO posts (posted, posted_by, posted_in, title, content) VALUES ('{$new_post_posted}', '{$new_post_posted_by}', '{$new_post_posted_in}', '{$new_post_title}', '{$new_post_content}')");
  direct_to("community.php?name={$community_name}");
}

if(isset($_POST["pin-post"])) {
  //CHECK IF pinned
  $is_pinned;
  if($is_pinned) {
    mysqli_query($connection, "UPDATE posts SET pinned='{$post_pinned_date}', pinned_by='{$my_id}' WHERE id='{$post_pinned_id}'");
  } else {
    $post_pinned_date = date("Y-m-d G:i:s");
    $post_pinned_id = $_POST["post-id"];
    mysqli_query($connection, "UPDATE posts SET pinned='{$post_pinned_date}', pinned_by='{$my_id}' WHERE id='{$post_pinned_id}'");
  }
}

$select_subscriber = mysqli_query($connection, "SELECT * FROM user_subscriptions WHERE subscribed='{$community_id}', subscriber='{$my_id}'");
$select_exists = mysqli_num_rows($select_subscriber);
$select_is_subscribed = 0;
$subscribe_value = $select_is_subscriber > "0" ? "Unsubscribe" : "Subscribe";
$fetch_subscriber = mysqli_fetch_array($select_subscriber);
if(isset($_POST["subscribe"])) {
  if($select_is_subscribed > "0") { //UNSUBSCRIBE

  } else { //SUBSCRIBE

  }
}
?>
<main>
  <section>
    <?php
    echo "<img class='banner' src='{$community_banner}' alt='Banner for {$community_name}' height='100%' width='100%'>";
    echo "<img class='picture' src='{$community_picture}' alt='Picture for {$community_name}' height='100%' width='100%'>";
    echo "<h1>{$community_name}</h1>";

    if($community_description != null) echo "<p class='centre'>{$community_description}</p>";
    else echo "<p class='centre'>{$community_name} has no description.</p>";

    $community_created_to_new_date = date("jS F Y", strtotime($community_created));
    echo "<p class='centre'>Community since {$community_created_to_new_date}</p>";
    //
    echo "
    <form class='less' method='POST'>
      <input class='centre' type='submit' name='subscribe' value='{$subscribe_value}'>
    </form>";
    ?>
  </section>
  <section id='posts'>
    <h2>Posts</h2>
    <?php
    if(isset($_GET["sort"])) $sort_posts_by = $_GET["sort"];
    else $sort_posts_by = "newest";
    echo "<div class='sorters'>";
    if($sort_posts_by == "newest") {
      $select_posts = mysqli_query($connection, "SELECT * FROM posts WHERE posted_in='{$community_id}' ORDER BY id DESC");
      echo "<p><a class='sorter' href='{$full_url}&sort=oldest'>Sort by oldest</a></p>";
    } else if($sort_posts_by = "oldest") {
      $select_posts = mysqli_query($connection, "SELECT * FROM posts WHERE posted_in='{$community_id}' ORDER BY id");
      echo "<p><a class='sorter' href='{$full_url}&sort=newest'>Sort by newest</a></p>";
    }
    echo "</div>";

    if(mysqli_num_rows($select_posts) > "0") {
      echo "<div class='posts'>";
      while($fetch_post = mysqli_fetch_array($select_posts)) {
        $post_id = $fetch_post["id"];
        $post_posted = $fetch_post["posted"];
        $post_posted_by = $fetch_post["posted_by"];
        $select_post_posted_by_name = mysqli_query($connection, "SELECT name FROM users WHERE id='{$post_posted_by}'");
        $fetch_post_posted_by_name = mysqli_fetch_array($select_post_posted_by_name);
        $post_posted_by_name = $fetch_post_posted_by_name["name"];
        $post_title = $fetch_post["title"];
        $post_content = $fetch_post["content"];
        //LIKES, DISLIKES
        echo "
        <div class='post'>
          <span><a href='post.php?id={$post_id}&title={$post_title}'>{$post_title}</a> by <a href='user.php?name={$post_posted_by_name}'>{$post_posted_by_name}</a> on {$post_posted}</span>
          <span class='post-content'>{$post_content}</span>
          <form class='less hide' method='POST'>
            <input type='hidden' name='post-id' value='{$post_id}'>
            <input type='submit' name='pin-post' value='Pin Post' disabled>
          </form>
        </div>";
      }
      echo "</div>";
    } else echo "<p>There are no posts here.</p>";
    ?>
  </section>
  <section id='submit-a-post'>
    <h2>Submit a Post</h2>
    <?php
    if(isset($my_id)) {
      echo "
      <form method='POST'>
        <div>
          <label for='title'>Title</label>
          <input id='title' type='text' name='title' required>
        </div>
        <div>
          <label for='content'>Content</label>
          <textarea id='content' name='content' required></textarea>
        </div>
        <input type='submit' name='post' value='Post'>
      </form>";
    } else echo "<p>Sign-in to submit a post.</p>";
    ?>
  </section>
</main>
<?php
require_once("foot.php");
?>
