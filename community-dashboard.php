<?php
$title = "Community Dashboard";
require_once("head.php");

if(!$signed_in) head_to("404.html");
else if(isset($_GET["id"])) $get_community_id = $_GET["id"];

if(isset($get_community_id)) {
  $select_community = mysqli_query($connection, "SELECT * FROM communities WHERE id='$get_community_id'");
  if(mysqli_num_rows($select_community) == "1") {
    $fetch_community = mysqli_fetch_array($select_community);
    $community_name = $fetch_community["name"];
    $community_description = $fetch_community["description"];
    $community_picture = $fetch_community["picture"];
    $community_banner = $fetch_community["banner"];
  }
}
?>
<main>
  <?php
  if(isset($community_name)) echo "<h1>{$community_name} Dashboard</h1>";
  else echo "<h1>Community Dashboard</h1>";

  if($signed_in) include_once("templates/create-community.php");

  if(isset($get_community_id)) {
    include_once("templates/cd-community-bans.php");
    include_once("templates/cd-posts.php");
  }
  ?>
</main>
<?php
require_once("foot.php");
?>
