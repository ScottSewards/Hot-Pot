<?php
require_once("head.php");
?>
<main>
  <h1>Index</h1>
  <section id='posts'>
    <h2>Posts</h2>
    <article id='new-posts'>
      <?php
      $select_posts = mysqli_query($connection, "SELECT * FROM posts ORDER BY id DESC LIMIT 3");
      if(mysqli_num_rows($select_posts) > "0") {
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
            <p><a href='post.php?title={$title}'>{$title}</a> posted by <a href='user.php?name={$posted_by}'>{$posted_by}</a> in <a href='community.php?name={$posted_in}'>{$posted_in}</a> on {$posted}.</p>
            <p>{$likes} likes and {$dislikes} dislikes.</p>
          </div>";
        }
        echo "</div>";
      } else echo "<p>There are no posts here.</p>";
      ?>
    </article>
  </section>
  <section id='communities'>
    <h2>Communities</h2>
    <article id='new-posts'>
      <div class='communities'>
        <?php
        $select = mysqli_query($connection, "SELECT * FROM communities ORDER BY id DESC LIMIT 5");
        while($fetch = mysqli_fetch_array($select)) {
          $name = $fetch["name"];
          $picture = $fetch["picture"];
          $subscribers = $fetch["subscribers"];
          $link = "community.php?name={$name}";
          echo "
          <div class='community'>
            <img src='{$picture}' alt='Picture for {$name}' height='100%' width='100%'/>
            <div class='meta'>
              <p><a href='{$link}'>{$name}</a></p>
            </div>
          </div>";
        }
        ?>
      </div>
    </article>
  </section>
  <section id='users'>
    <h2>Users</h2>
    <article id='new-users'>
      <h4>New</h3>
      <div class='users'>
        <?php
        $select = mysqli_query($connection, "SELECT * FROM users ORDER BY id DESC LIMIT 3");
        while($fetch = mysqli_fetch_assoc($select)) {
          $name = $fetch['name'];
          $picture = $fetch['picture'];
          $link = "user.php?name={$name}";
          echo "
          <div class='user'>
            <img src='{$picture}' alt='Picture for {$name}' height='100%' width='100%'/>
            <div class='meta'>
              <p><a href='{$link}'>{$name}</a></p>
            </div>
          </div>";
        }
        ?>
      </div>
    </article>
  </section>
</main>
<?php
require_once("foot.php");
?>
