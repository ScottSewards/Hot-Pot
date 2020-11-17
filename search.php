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
      <fieldset>
        <legend>Search</legend>
        <div class='inline'>
          <label class='hide' for='search-bar'>Search</label>
          <input id='search-bar' type='search' name='search' <?php if(isset($_GET["search"])) echo "value='{$search}'" ?> autofocus required/>
          <input id='search-bar-submit' type='submit' value='Search'/>
        </div>
      </fieldset>
    </form>
    <div>
      <?php
      if(isset($_GET["search"])) {
        $select = mysqli_query($connection, "SELECT * FROM users WHERE name LIKE '%{$search}%'");
        $rows = mysqli_num_rows($select);
        echo "<p>{$rows} user(s) found.</p>";
        while($fetch = mysqli_fetch_assoc($select)) { //t.ly/rJON
          $name = $fetch["name"];
          $link = "user.php?name={$name}";
          echo "<p><a href='{$link}'>Visit {$name}</a>.</p>";
        }
      };
      ?>
    </div>
  </section>
  <section>
    <div>
      <?php
      if($is_localhost) {
        echo"
        <form id='command-line-form' action='search.php' method='POST'>
          <fieldset>
            <legend>Command Line</legend>
            <div class='inline'>
              <label for='mysql-command-line'>Command:</label>
              <input id='mysql-command-line' type='text' name='command-line' required/>
            </div>
            <input id='submit-mysqli-command-line' type='submit' value='Run Command'/>
          </fieldset>
        </form>";
        if(isset($_POST["mysql-command-line"])) {
          $select = mysqli_query($connection, $_POST["command-line"]);
          while($fetch = mysqli_fetch_assoc($select)) {
            print_r($fetch);
          }
        }
      }
      ?>
    </div>
  </section>
</main>
<?php
require_once("foot.php");
?>
