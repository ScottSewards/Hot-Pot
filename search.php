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
    <p>You can visit users, but not communities or posts yet. However, you can search for them still.</p>
    <hr>
    <form id='search-bar-form' action='search.php' post='GET'>
      <div class='inline'>
        <label class='hide' for='search-bar'>Search</label>
        <input id='search-bar' type='search' name='search' <?php if(isset($_GET["search"])) echo "value='{$search}'" ?> autofocus required/>
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
              <img src='{$picture}'/>
              <span class='name'><a href='{$link}'>{$name}</a></span>
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
            $name = $fetch["name"];
            $picture = $fetch['picture'];
            echo "
            <div class='community'>
            <img src='{$picture}'/>
            <span class='name'>{$name}</span>
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
        $select = mysqli_query($connection, "SELECT * FROM posts WHERE title LIKE '%{$search}%'");
        $rows = mysqli_num_rows($select);
        echo "<h2>Posts ({$rows})</h2>";
        if($rows > 0) {
          echo "<div class='posts'>";
          while($fetch = mysqli_fetch_assoc($select)) {
            $name = $fetch["title"];
            echo "<p>{$name}</p>";
          }
          echo "</div>";
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
