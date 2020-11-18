<?php
$title = "Community";
require_once("head.php");

if(!isset($_GET["name"])) {
  mysqli_close($connection);
  redirect("404.html");
}

$name = $_GET["name"];
$select = mysqli_query($connection, "SELECT * FROM communities WHERE name='{$name}'");
if(mysqli_num_rows($select) == "1") {
  $fetch = mysqli_fetch_array($select);
  $id = $fetch["id"];
  $created = $fetch["created"];
  $created_by = $fetch["created_by"];
  $select_created_by = mysqli_query($connection, "SELECT name FROM users WHERE id='{$created_by}'");
  $fetch_created_by = mysqli_fetch_array($select_created_by);
  $created_by_name = $fetch_created_by["name"];
  $admin = $fetch["admin"];
  if($created_by == $admin) $admin_name = $created_by_name;
  else {
    $select_admin = mysqli_query($connection, "SELECT name FROM users WHERE id='{$admin}'");
    $fetch_admin = mysqli_fetch_array($select_created_by);
    $admin_name = $fetch_admin["name"];
  }
  $description = $fetch["description"];
  $picture = $fetch["picture"];
  $banner = $fetch["banner"];
  $subscribers = $fetch["subscribers"];
} else {
  mysqli_close($connection);
  redirect("404.html");
}

if(isset($_POST["submit-post"])) {
  $posted = date("Y-m-d");
  $posted_by = $my_id;
  $posted_in = $id;
  $title = htmlspecialchars(addslashes($_POST["title"]));
  $content = htmlspecialchars(addslashes($_POST["content"]));
  mysqli_query($connection, "INSERT INTO posts (posted, posted_by, posted_in, title, content) VALUES ('{$posted}', '{$posted_by}', '{$posted_in}', '{$title}', '{$content}')");
  redirect("community.php?name={$name}");
}
?>
<main>
  <section>
    <img class='banner' <?php echo "src='{$banner}' alt='Banner for {$name}'"; ?> height='100%' width='100%'/>
    <img class='picture' <?php echo "src='{$picture}' alt='Picture for {$name}'"; ?> height='100%' width='100%'/>
    <h1><?php echo $name; ?></h1>
    <p><?php echo "{$description}"; ?></p>
    <p><?php echo "Created by <a href='user.php?name={$created_by_name}'>{$created_by_name}</a> on {$created}."; ?></p>
    <p><?php echo "Administrated by <a href='user.php?name={$admin_name}'>{$admin_name}</a>."; ?></p>
  </section>
  <section id='posts'>
    <h2>Posts</h2>
    <?php
    $select_posts = mysqli_query($connection, "SELECT * FROM posts WHERE posted_in='{$id}' ORDER BY id DESC");
    if(mysqli_num_rows($select_posts) > "0") {
      echo "<div class='posts'>";
      while($fetch_posts = mysqli_fetch_array($select_posts)) {
        $posted = $fetch_posts["posted"];
        $posted_by = $fetch_posts["posted_by"];
        $select_posted_by = mysqli_query($connection, "SELECT name FROM users WHERE id='{$posted_by}'");
        $fetch_posted_by = mysqli_fetch_array($select_posted_by);
        $posted_by = $fetch_posted_by["name"];
        $title = $fetch_posts["title"];
        $content = $fetch_posts["content"];
        $likes = $fetch_posts["likes"];
        $dislikes = $fetch_posts["dislikes"];
        echo "
        <div class='post'>
          <p><a href='post.php?title={$title}'>{$title}</a> posted by <a href='user.php?name={$posted_by}'>{$posted_by}</a> on {$posted}.</p>
          <p>{$likes} likes and {$dislikes} dislikes.</p>
        </div>";
      }
      echo "</div>";
    } else echo "<p>There are no posts here.</p>";
    ?>
  </section>
  <section>
  <h2>Create Post</h2>
  <?php
  if(isset($my_id)) {
    echo "
    <form action='community.php?name={$name}' method='POST'>
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
