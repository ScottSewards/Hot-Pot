<?php
$title = "Community Dashboard";
require_once("head.php");
if(!$signed_in) head_to("404.html");
//$community_id = $_GET["id"];
$community_id = 3;
$select_community = mysqli_query($connection, "SELECT * FROM communities WHERE id='$community_id'");
if(mysqli_num_rows($select_community) == "1") {
  $fetch_community = mysqli_fetch_array($select_community);
  $community_id = $fetch_community["id"];
  $community_name = $fetch_community["name"];
  $community_created = $fetch_community["created"];
  $community_created_by = $fetch_community["created_by"];
  $select_community_created_by_name = mysqli_query($connection, "SELECT name FROM users WHERE id='{$community_created_by}'");
  $fetch_community_created_by_name = mysqli_fetch_array($select_community_created_by_name);
  $community_created_by_name = $fetch_community_created_by_name["name"];
  $community_moderated_by = "1";
  if($community_created_by == $community_moderated_by) $community_moderated_by_name = $community_created_by_name;
  else {
    $select_community_moderated_by_name = mysqli_query($connection, "SELECT name FROM users WHERE id='{$community_moderated_by}'");
    $fetch_community_moderated_by_name = mysqli_fetch_array($select_community_moderated_by_name);
    $community_moderated_by_name = $fetch_community_moderated_by_name["name"];
  }
  $community_description = $fetch_community["description"];
  $community_picture = $fetch_community["picture"];
  $community_banner = $fetch_community["banner"];
} //else head_to("404.html");

//GET MY COMMUNITIES

//if(!isset($my_id)) direct_to("sign-in.php");

//$select_moderated_communities = mysqli_query($connection, "SELECT * FROM communities WHERE moderated_by='{$my_id}'");
//if(mysqli_num_rows($select_moderated_communities) > "0") {

//} else echo "<p>You do not moderate any communities yet.</p>";
?>
<main>
  <?php
  if(isset($community_name)) echo "<h1>{$community_name} Dashboard</h1>";
  else echo "<h1>Community Dashboard</h1>";

  if($signed_in) include_once("templates/create-community.php");
  ?>

  <section id='user-bans'>
    <h2>User Bans</h2>
    <form class='less' method='GET'>
      <div class='inline'>
        <label for='search-user-bans'>Search</label>
        <input id='search-user-bans' type='search' name='search-user-bans' placeholder='Search user bans...' required>
        <input type='submit' name='submit-search-user-bans' value='Search'>
      </div>
    </form>
    <?php
    if(isset($_POST["submit-search-user-bans"])) {
      $search_user_bans = htmlspecialchars(addslashes($_POST["search-user-bans"]));
      //NEED TO GET USERNAME USING JOIN
      //https://blog.jooq.org/2016/07/05/say-no-to-venn-diagrams-when-explaining-joins/
      //$select_user_bans = mysqli_query($connection, "SELECT * FROM user_bans WHERE banned_from='{$community_id}', ");
      //$select_users = mysqli_query($connection, "SELECT * FROM users WHERE name LIKE '%{$search}%'");
    } else $select_user_bans = mysqli_query($connection, "SELECT * FROM user_bans WHERE banned_from='{$community_id}'");

    if(mysqli_num_rows($select_user_bans) > "0") {
      echo "<div class='users'>";
      while($fetch_user_bans = mysqli_fetch_assoc($select_user_bans)) {
        //SHOW USER
        //SHOW UNBAN
      }
      echo "</div>";
    } else echo "<p>There are no banned users.</p>";
    ?>
  </section>

  <section>
    <h2>Pinned Posts</h2>
    <p>There are no pinned posts.</p>
  </section>
</main>
<?php require_once("foot.php"); ?>
