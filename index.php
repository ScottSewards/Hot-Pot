<?php
require_once("head.php");

if(isset($_POST["submit-post"])) {
  $posted = date("Y-m-d");
  $posted_by = $my_id;
  $posted_in = 0;
  $title = htmlspecialchars(addslashes($_POST["title"]));
  $content = htmlspecialchars(addslashes($_POST["content"]));
  mysqli_query($connection, "INSERT INTO posts (posted, posted_by, posted_in, title, content) VALUES ('{$posted}', '{$posted_by}', '{$posted_in}', '{$title}', '{$content}')");
  redirect("index.php");
}
?>
<main>
  <section>
    <h1>Index</h1>
    <h2>Featured Users</h2>
    <div class='users'>
      <?php
      $select = mysqli_query($connection, "SELECT * FROM users ORDER BY id ASC LIMIT 3");
      while($fetch = mysqli_fetch_assoc($select)) {
        $name = $fetch['name'];
        $picture = $fetch['picture'];
        $link = "user.php?name={$name}";
        echo "
        <div class='user'>
          <img src='{$picture}'/>
          <span class='name'><a href='{$link}'>{$name}</a></span>
        </div>";
      }
      ?>
    </div>
  </section>
  <section>
    <h2>New Users</h2>
    <div class='users'>
      <?php
      $select = mysqli_query($connection, "SELECT * FROM users ORDER BY id DESC LIMIT 3");
      while($fetch = mysqli_fetch_assoc($select)) {
        $name = $fetch['name'];
        $picture = $fetch['picture'];
        $link = "user.php?name={$name}";
        echo "
        <div class='user'>
          <img src='{$picture}'/>
          <span class='name'><a href='{$link}'>{$name}</a></span>
        </div>";
      }
      ?>
    </div>
  </section>
  <section>
    <h2>New Posts</h2>
    <p>This section will show the newest posts.</p>
    <hr>
    <div id='posts'>
      <?php
      $select = mysqli_query($connection, "SELECT * FROM posts ORDER BY id DESC LIMIT 5");
      while($fetch = mysqli_fetch_array($select)) {
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
          <img src='images/picture.png' alt='Placeholder'/>
          <div>
            <div>
              <p><span>{$title}</span> posted by <span>{$posted_by}</span> in <span>{$posted_in}</span> on <span>{$posted}</span>. <span>{$likes}</span> likes and <span>{$dislikes}</span> dislikes.</p>
            </div>
            <div class='inline'>
            <button type='button' name='like' disabled>Like</button>
            <button type='button' name='dislike' disabled>Dislike</button>
            </div>
          </div>
        </div>";
      }
      ?>
    </div>
  </section>
  <section>
    <h2>Create Post</h2>
    <?php
    if(isset($my_id)) {
      echo "
      <p>This feature is in-development. If you post, it will be posted in the HotPot community until creating communities is supported. Soon you will be able to post pictures too.</p>
      <hr>
      <form action='index.php' method='POST'>
        <div class='inline'>
          <label for='title'>Title*</label>
          <input id='title' type='text' name='title' required>
        </div>
        <div>
          <label for='content'>Content*</label>
          <textarea id='content' name='content' required></textarea>
        </div>
        <input type='submit' name='submit-post' value='Submit Post'/>
      </form>";
    } else echo "Sign-in to create a post.";
    ?>
  </section>
</main>
<?php
require_once("foot.php");
?>
