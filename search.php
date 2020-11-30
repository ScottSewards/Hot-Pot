<?php
if(isset($_GET["search"])) {
  $search = $_GET["search"];
  $title = "Search for '{$search}'";
} else $title = "Search";

require_once("head.php");
?>
<main>
  <section>
    <h1><?php echo $title; ?></h1>
    <form id='search-bar-form' post='GET'>
      <div class='inline'>
        <label for='search-bar'>Search</label>
        <input id='search-bar' type='search' name='search' placeholder='Search communities, users, posts, and replies' <?php if(isset($_GET["search"])) echo "value='{$search}'" ?> autofocus required>
        <input id='search-bar-submit' type='submit' value='Search'>
      </div>
    </form>
    <article id='users'>
      <?php
      if(isset($_GET["search"])) {
        $select_users = mysqli_query($connection, "SELECT * FROM users WHERE name LIKE '%{$search}%'");
        $number_of_users_found = mysqli_num_rows($select_users);
        echo "<h2>Users ({$number_of_users_found})</h2>";
        if($number_of_users_found > "0") {
          echo "<div class='users'>";
          while($fetch_user = mysqli_fetch_assoc($select_users)) {
            $user_name = $fetch_user["name"];
            $user_picture = $fetch_user['picture'];
            echo "
            <div class='user'>
              <img src='{$user_picture}' alt='Picture for {$user_name}' height='100%' width='100%'>
              <div class='meta'>
                <span><a href='user.php?name={$user_name}'>{$user_name}</a></span>
              </div>
            </div>";
          }
          echo "</div>";
        } else echo "<p>There are no users that match your search.</p>";
      }
      ?>
    </article>
    <article id='communities'>
      <?php
      if(isset($_GET["search"])) {
        $select_communities = mysqli_query($connection, "SELECT * FROM communities WHERE name LIKE '%{$search}%'");
        $number_of_communities_found = mysqli_num_rows($select_communities);
        echo "<h2>Communities ({$number_of_communities_found})</h2>";
        if($number_of_communities_found > "0") {
          echo "<div class='communities'>";
          while($fetch_community = mysqli_fetch_assoc($select_communities)) {
            $community_name = $fetch_community["name"];
            $community_picture = $fetch_community['picture'];
            echo "
            <div class='community'>
              <img src='{$community_picture}' alt='Picture for {$community_name}' height='100%' width='100%'>
              <div class='meta'>
                <span><a href='community.php?name={$community_name}'>{$community_name}</a></span>
              </div>
            </div>";
          }
          echo "</div>";
        } else echo "<p>There are no communities that match your search.</p>";
      }
      ?>
    </article>
    <article id='posts'>
      <?php
      if(isset($_GET["search"])) {
        $select_posts = mysqli_query($connection, "SELECT * FROM posts WHERE title LIKE '%{$search}%'");
        $number_of_posts_found = mysqli_num_rows($select_posts);
        echo "<h2>Posts ({$number_of_posts_found})</h2>";
        if($number_of_posts_found > "0") {
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
        } else echo "<p>There are no posts that match your search.</p>";
      }
      ?>
    </article>
  </section>
  <?php
  if($is_localhost) {
    echo "
    <section>
      <h2>Command Line</h2>
      <div>
        <form id='command-line-form' method='POST'>
          <div class='inline'>
            <label for='mysql-command-line'>Command:</label>
            <input id='mysql-command-line' type='text' name='command-line' required/>
          </div>
          <input id='submit-mysqli-command-line' type='submit' value='Run Command'/>
        </form>
      </div>
    </section>";
    if(isset($_POST["mysql-command-line"])) {
      $select = mysqli_query($connection, $_POST["command-line"]);
      while($fetch = mysqli_fetch_assoc($select)) {
        print_r($fetch);
      }
    }
  }
  ?>
</main>
<?php
require_once("foot.php");
?>
