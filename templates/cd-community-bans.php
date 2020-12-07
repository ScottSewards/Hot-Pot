<?php
if(isset($_POST["submit-search-community-bans"])) {
  $search_community_bans = htmlspecialchars(addslashes($_POST["search-community-bans"]));
  //$select_users = mysqli_query($connection, "SELECT * FROM users WHERE name LIKE '%{$search}%'");
  unset($_POST["submit-search-community-bans"]);
}
?>

<section id='community-bans'>
  <?php
  $select_community_bans = mysqli_query($connection, "SELECT * FROM community_bans WHERE community_id='{$get_community_id}'");
  $number_of_community_bans = mysqli_num_rows($select_community_bans);
  echo "<h2>Bans ({$number_of_community_bans})</h2>";
  ?>

  <form method='GET'>
    <div class='inline'>
      <input id='show-all-users' type='checkbox' name='show-all-users'>
      <label for='show-all-users'>Show all users</label>
    </div>
    <div class='inline'>
      <label for='search-community-bans'>Search</label>
      <input id='search-community-bans' type='search' name='search-community-bans' placeholder='Search community bans...' required>
      <input type='submit' name='submit-search-community-bans' value='Search'>
    </div>
  </form>

  <?php
  if($number_of_community_bans > "0") {
    echo "<div class='users'>";
    while($fetch_community_ban = mysqli_fetch_assoc($select_community_bans)) { }
    echo "</div>";
  } else echo "<p>There are no banned users.</p>";
  ?>
</section>
