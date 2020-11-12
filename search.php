<?php
if(isset($_GET["search"])) {
  $query = $_GET["search"];
  $title = "Search for '$query'";
} else $title = "Search";

require_once("head.php");
?>
<main>
  <section>
    <form id='search-bar-form' action='search.php' post='get'>
      <fieldset>
        <legend>Search</legend>
        <div class='inline'>
          <label class='hide' for='search-bar'>Search</label>
          <input id='search-bar' type='search' name='search' <?php if(isset($_GET["search"])) echo "value='" . $_GET["search"] . "'" ?> placeholder='Enter a query...' required>
          <input type='submit' value='Search'>
        </div>
      </fieldset>
    </form>
  </section>
  <section>
    <h1>Search <?php if(isset($_GET["search"])) echo "for '$query'"?></h1>
    <div>
      <?php
      if(isset($_GET["search"])) {
        $result = mysqli_query($connection, "SELECT * FROM signatures WHERE signature LIKE '%$query%'");
        $rows = mysqli_num_rows($result);
        echo "<p>$rows result(s)</p>";

        while($fetch = mysqli_fetch_array($result)) {
          $link = "signature.php?id=" . $fetch['id'];
          echo "<hr>";
          echo "Visit <a href='$link'>" . $fetch['signature'] . "</a>";
        }
      } else echo "<p>Input a search query to find a signature.</p>";
      ?>
    </div>
  </section>
</main>
<?php
require_once("foot.php");
?>
