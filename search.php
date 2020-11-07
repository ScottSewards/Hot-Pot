<?php
if(isset($_GET["search"])) {
  $query = $_GET["search"];
  $title = "Search for '$query'";
} else {
  $title = "Search";
}

require "php/top.php";
?>
<main>
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
require "php/bottom.php";
?>
