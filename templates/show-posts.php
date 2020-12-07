<section id='posts'>
  <h2>Posts</h2>
  <?php
  if(isset($_GET["spb"])) $sort_posts_by = $_GET["spb"];
  else $sort_posts_by = "newest";

  echo "<div class='sorters'>";
  switch($sort_posts_by) {
    case "newest":
      $select_posts = mysqli_query($connection, "SELECT * FROM posts WHERE post_in_id='{$community_id}' ORDER BY id DESC");
      //echo "<p><a class='sorter' href='{$full_url}&sort=oldest'>Sort by oldest</a></p>";
      break;
    case "oldest":
      $select_posts = mysqli_query($connection, "SELECT * FROM posts WHERE post_in_id='{$community_id}' ORDER BY id");
      //echo "<p><a class='sorter' href='{$full_url}&sort=newest'>Sort by newest</a></p>";
      break;
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
