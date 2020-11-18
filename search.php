<?php
if(isset($_GET["search"])) {
  $search = $_GET["search"];
  $title = "Search for '{$search}'";
} else $title = "Search";

require_once("head.php");
?>
<main>
  <section>
    <h1>Search <?php if(isset($_GET["search"])) echo "for '{$search}'"?></h1>
    <form id='search-bar-form' action='search.php' post='GET'>
      <div class='inline'>
        <label class='hide' for='search-bar'>Search</label>
        <input id='search-bar' type='search' name='search' placeholder='Search communities, users, posts or comments' <?php if(isset($_GET["search"])) echo "value='{$search}'" ?> autofocus required/>
        <input id='search-bar-submit' type='submit' value='Search'/>
      </div>
    </form>
    <article>
      <?php
      if(isset($_GET["search"])) {
        $select = mysqli_query($connection, "SELECT * FROM users WHERE name LIKE '%{$search}%'");
        $rows = mysqli_num_rows($select);
        echo "<h2>Users ({$rows})</h2>";
        if($rows > 0) {
          echo "<div class='users'>";
          while($fetch = mysqli_fetch_assoc($select)) { //t.ly/rJON
            $name = $fetch["name"];
            $picture = $fetch['picture'];
            $link = "user.php?name={$name}";
            echo "
            <div class='user'>
              <img src='{$picture}' alt='Picture for {$name}' height='100%' width='100%'/>
              <div class='meta'>
                <span><a href='{$link}'>{$name}</a></span>
              </div>
            </div>";
          }
          echo "</div>";
        }
      };
      ?>
    </article>
    <article>
      <?php
      if(isset($_GET["search"])) {
        $select = mysqli_query($connection, "SELECT * FROM communities WHERE name LIKE '%{$search}%'");
        $rows = mysqli_num_rows($select);
        echo "<h2>Communities ({$rows})</h2>";
        if($rows > 0) {
          echo "<div class='communities'>";
          while($fetch = mysqli_fetch_assoc($select)) {
            $created = $fetch["created"];
            $name = $fetch["name"];
            $picture = $fetch['picture'];
            $subscribers = $fetch["subscribers"];
            echo "
            <div class='community'>
              <img src='{$picture}' alt='Picture for {$name}' height='100%' width='100%'/>
              <div class='meta'>
                <p><a href='community.php?name={$name}'>{$name}</a></p>
              </div>
            </div>";
          }
          echo "</div>";
        }
      };
      ?>
    </article>
    <article>
      <?php
      if(isset($_GET["search"])) {
        $select_posts = mysqli_query($connection, "SELECT * FROM posts WHERE title LIKE '%{$search}%'");
        $rows = mysqli_num_rows($select_posts);
        echo "<h2>Posts ({$rows})</h2>";
        if($rows > 0) {
          echo "<div class='posts'>";
          while($fetch = mysqli_fetch_array($select_posts)) {
            $posted = $fetch["posted"];
            $posted_by = $fetch["posted_by"];
            $select_posted_by = mysqli_query($connection, "SELECT name FROM users WHERE id='{$posted_by}'");
            $fetch_posted_by = mysqli_fetch_array($select_posted_by);
            $posted_by = $fetch_posted_by["name"];
            $posted_in = $fetch["posted_in"];
            $select_posted_in = mysqli_query($connection, "SELECT name FROM communities WHERE id='{$posted_in}'");
            $fetch_posted_by = mysqli_fetch_array($select_posted_in);
            $posted_in = $fetch_posted_by["name"];
            $title = $fetch["title"];
            $content = $fetch["content"];
            $likes = $fetch["likes"];
            $dislikes = $fetch["dislikes"];
            echo "
            <div class='post'>
              <img src='images/picture.png' alt='Picture for {$title}' height='100%' width='100%'/>
              <div>
                <p><a href='post.php?title={$title}'>{$title}</a> posted by <a href='user.php?name={$posted_by}'>{$posted_by}</a> in <a href='community.php?name={$posted_in}'>{$posted_in}</a> on {$posted}. {$likes} likes and {$dislikes} dislikes.</p>
              </div>
            </div>";
            echo "</div>";
          }
        }
      };
      ?>
    </article>
  </section>
  <?php
  if($is_localhost) {
    echo "
    <section>
      <h2>Command Line</h2>
      <div>
        <form id='command-line-form' action='search.php' method='POST'>
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
