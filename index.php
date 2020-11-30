<?php
require_once("head.php");
?>
<main>
  <h1>Index</h1>
  <section id='posts'>
    <h2>Posts</h2>
    <form class='less hide' method='POST'>
      <div class='inline'>
        <label for='sort-posts-by'>Sort By</label>
        <select id='sort-posts-by' name='sort-by'>
          <option value='newest'>Newest</option>
          <option value='oldest'>Oldest</option>
        </select>
        <input type='submit' name='sort-posts' value='Sort'>
      </div>
    </form>
    <?php
    if(isset($_GET["sort"])) $sort_posts_by = $_GET["sort"];
    else $sort_posts_by = "newest";
    echo "<div class='sorters'>";
    if($sort_posts_by == "newest") {
      $select_posts = mysqli_query($connection, "SELECT * FROM posts ORDER BY id DESC LIMIT 10");
      echo "<p><a class='sorter' href='?sort=oldest'>Sort by oldest</a></p>";
    } else if($sort_posts_by = "oldest") {
      $select_posts = mysqli_query($connection, "SELECT * FROM posts ORDER BY id LIMIT 10");
      echo "<p><a class='sorter' href='?sort=newest'>Sort by newest</a></p>";
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
        $post_posted_in = $fetch_post["posted_in"];
        $select_post_posted_in_name = mysqli_query($connection, "SELECT name FROM communities WHERE id='{$post_posted_in}'");
        $fetch_post_posted_by_name = mysqli_fetch_array($select_post_posted_in_name);
        $post_posted_in_name = $fetch_post_posted_by_name["name"];
        $post_title = $fetch_post["title"];
        $post_content = $fetch_post["content"];
        //LIKES, DISLIKES
        echo "
        <div class='post'>
          <span><a href='post.php?id={$post_id}&title={$post_title}'>{$post_title}</a> by <a href='user.php?name={$post_posted_by_name}'>{$post_posted_by_name}</a> in <a href='community.php?name={$post_posted_in_name}'>{$post_posted_in_name}</a> on {$post_posted}</span>
          <span>{$post_content}</span>
        </div>";
      }
    } else echo "<p>There are no posts yet.</p>";
    ?>
  </section>
  <section id='communities'>
    <h2>Communities</h2>
    <div class='communities'>
      <?php
      $select_communities = mysqli_query($connection, "SELECT * FROM communities ORDER BY id DESC LIMIT 6");
      while($fetch_community = mysqli_fetch_array($select_communities)) {
        $community_name = $fetch_community["name"];
        $community_picture = $fetch_community["picture"];
        echo "
        <div class='community'>
          <img src='{$community_picture}' alt='Picture for {$community_name}' height='100%' width='100%'>
          <div class='meta'>
            <span><a href='community.php?name={$community_name}'>{$community_name}</a></span>
          </div>
        </div>";
      }
      ?>
    </div>
  </section>
  <section>
    <h2>Create a Community</h2>
    <?php
    if(isset($_POST["create-community"])) {
      $new_community_created = date("Y-m-d G:i:s");
      $new_community_created_by = $my_id;
      $new_community_moderated_by = $new_community_created_by;
      $new_community_name = htmlspecialchars(addslashes($_POST["community-name"]));
      $new_community_description = htmlspecialchars(addslashes($_POST["community-description"]));
      mysqli_query($connection, "INSERT INTO communities (created, created_by, moderated_by, name, description) VALUES ('{$new_community_created}', '{$new_community_created_by}', '{$new_community_moderated_by}', '{$new_community_name}', '{$new_community_description}')");
      direct_to("community.php?name={$new_community_name}");
    }

    if(isset($my_id)) {
      echo "
      <form method='POST'>
        <div>
          <label for='community-name'>Community Name</label>
          <input id='community-name' type='text' name='community-name' required>
        </div>
        <div>
          <label for='community-description'>Content</label>
          <textarea id='community-description' name='community-description' required></textarea>
        </div>
        <input type='submit' name='create-community' value='Create Community'>
      </form>";
    } else echo "<p>Sign-in to create a community.</p>";
    ?>
  </section>
</main>
<?php
require_once("foot.php");
/*
$select = mysqli_query($connection, "SELECT * FROM users ORDER BY id DESC LIMIT 6");
while($fetch = mysqli_fetch_assoc($select)) {
  $name = $fetch['name'];
  $picture = $fetch['picture'];
  $link = "user.php?name={$name}";
  echo "
  <div class='user'>
    <img src='{$picture}' alt='Picture for {$name}' height='' width='100%'/>
    <div class='meta'>
      <span><a href='{$link}'>{$name}</a></span>
    </div>
  </div>";
}
*/
?>
