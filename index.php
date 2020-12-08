<?php
require_once("head.php");
?>
<main>
  <h1>Index</h1>
  <section id='posts'>
    <h2>Posts</h2>
    <!--form class='less hide' method='POST'>
      <div class='inline'>
        <label for='sort-posts-by'>Sort By</label>
        <select id='sort-posts-by' name='sort-by'>
          <option value='newest'>Newest</option>
          <option value='oldest'>Oldest</option>
        </select>
        <input type='submit' name='spb' value='Sort'>
      </div>
    </form-->
    <?php
    if(isset($_GET["spb"])) $sort_posts_by = $_GET["spb"];
    else $sort_posts_by = "newest";

    switch($sort_posts_by) {
      case "oldest":
        show_content("posts", $connection, "SELECT * FROM posts ORDER BY id ASC LIMIT 10");
        break;
      default:
        show_content( "posts", $connection, "SELECT * FROM posts ORDER BY id DESC LIMIT 10");
        break;
    }
    ?>
  </section>
  <section id='communities'>
    <h2>Communities</h2>
    <?php
    show_content("communities", $connection, "SELECT * FROM communities ORDER BY id DESC LIMIT 6");
    ?>
  </section>
  <section id='users'>
    <h2>Users</h2>
    <?php
    show_content("users", $connection, "SELECT * FROM users ORDER BY id DESC LIMIT 6");
    ?>
  </section>
</main>
<?php
require_once("foot.php");
?>
