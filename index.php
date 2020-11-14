<?php
$title = "Index";
require_once("head.php");
?>
<main>
  <section>
    <h1>Index</h1>
    <h2>Newest Signatures</h2>
    <?php
    $select = mysqli_query($connection, "SELECT * FROM signatures ORDER BY id DESC LIMIT 3");
    while($fetch = mysqli_fetch_assoc($select)) {
      $sign = $fetch['signature'];
      $link = "signature.php?sign={$sign}";
      echo "<p><a href='{$link}'>Visit {$sign}</a>.</p>";
    }
    ?>
  </section>
</main>
<?php
require_once("foot.php");
?>
