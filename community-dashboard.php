<?php
$title = "Community Dashboard";
require_once("head.php");

//GET MY COMMUNITIES

if(!isset($my_id)) direct_to("sign-in.php");

$select_moderated_communities = mysqli_query($connection, "SELECT * FROM communities WHERE moderated_by='{$my_id}'");
if(mysqli_num_rows($select_moderated_communities) > "0") {

} else echo "<p>You do not moderate any communities yet.</p>";
?>
<main>
  <h1>Community Dashboard</h1>
  <article>
    <h2>Banned Users</h2>
    <?php
    $community_id = 0;
    $select_community_bans = mysqli_query($connection, "SELECT * FROM community_bans WHERE banned_from='{$community_id}'");

    if(mysqli_num_rows($select_community_bans) > "0") {
      echo "<div class='users'>";

      //CREATE SEARCH TO SEARCH BANNED USERS

      while($fetch_community_ban = mysqli_fetch_assoc($select_community_bans)) {

      }
      echo "</div>";
    } else echo "<p>There are no banned users.</p>";
    ?>
  </article>
  <article id='pinned-posts'>
    <h2>Pinned Posts</h2>
    <p>There are no pinned posts.</p>
  </article>
</main>
<?php
require_once("foot.php");
?>
