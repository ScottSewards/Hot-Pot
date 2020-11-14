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
          <input id='search-bar' type='search' name='search' <?php if(isset($_GET["search"])) echo "value='{$search}'" ?> required/>
          <input id='search-bar-submit' type='submit' value='Search'/>
        </div>
      </fieldset>
    </form>
    <div>
      <?php
      if(isset($_GET["search"])) {
        $select = mysqli_query($connection, "SELECT * FROM signatures WHERE signature LIKE '%{$search}%'");
        $rows = mysqli_num_rows($select);
        echo "<p>{$rows} signature(s) found.</p>";
        while($fetch = mysqli_fetch_assoc($select)) { //t.ly/rJON
          $sign = $fetch['signature'];
          $link = "signature.php?sign={$sign}";
          echo "<hr><p><a href='{$link}'>Visit {$sign}</a>.</p>";
        }
      };
      ?>
    </div>
  </section>
  <section>
    <div>
      <?php
      if(IS_LOCALHOST) {
        echo"
        <form id='mysql-command-line-form' action='search.php' method='POST'>
          <fieldset>
            <legend>MySQL Command Line</legend>
            <div class='inline'>
              <label for='mysql-command-line'>Command:</label>
              <input id='mysql-command-line' type='text' name='mysql-command-line' required/>
            </div>
            <input id='submit-mysqli-command-line' type='submit' value='Run Command'/>
          </fieldset>
        </form>";
        if(isset($_POST["mysql-command-line"])) {
          $select = mysqli_query($connection, $_POST["mysql-command-line"]);
          while($fetch = mysqli_fetch_assoc($select)) { //t.ly/rJON
            $sign = $fetch['signature'];
            $link = "signature.php?sign={$sign}";
            echo "<hr><p><a href='{$link}'>Visit {$sign}</a>.</p>";
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
