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
    <form id='search-bar-form' class='less' post='GET'>
      <div class='inline'>
        <label for='search-bar'>Search</label>
        <input id='search-bar' type='search' name='search' placeholder='Search communities, users, posts, and replies' <?php if(isset($_GET["search"])) echo "value='{$search}'" ?> autofocus required>
        <input id='search-bar-submit' type='submit' value='Search'>
      </div>
    </form>

    <article id='users'>
      <h2>Users</h2>
      <?php
      if(isset($_GET["search"])) show_content("users", $connection, "SELECT * FROM users WHERE name LIKE '%{$search}%'");
      ?>
    </article>

    <article id='communities'>
      <h2>Communities</h2>
      <?php
      if(isset($_GET["search"])) show_content("communities", $connection, "SELECT * FROM communities WHERE name LIKE '%{$search}%'");
      ?>
    </article>

    <article id='posts'>
      <h2>Posts</h2>
      <?php
      if(isset($_GET["search"])) show_content("posts", $connection, "SELECT * FROM posts WHERE title LIKE '%{$search}%'");
      ?>
    </article>
  </section>
  <?php if($is_localhost) include_once("templates/command-line.php"); ?>
</main>
<?php require_once("foot.php"); ?>
