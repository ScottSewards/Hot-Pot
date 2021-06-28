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

  if(isset($get_community_id)) {
    include_once("templates/cd-community-bans.php");
    include_once("templates/cd-posts.php");
  }

  $select_community_moderations = mysqli_query($connection, "SELECT * FROM community_moderators WHERE user_id='{$my_id}'");
  ?>

  <section>
    <?php
    if(isset($_GET["moderate"])) {
      $community_selected = $_GET["community-select"];
    }
    ?>
    <form class='less'>
      <div class='inline'>
        <label for='community-select'>Community</label>
        <select id='community-select' name='community-select' required>
          <?php
          $index = 0;
          while($fetch_community_moderated = mysqli_fetch_assoc($select_community_moderations)) {
            $index++;
            $select_community_moderations_by_id = mysqli_query($connection, "SELECT * FROM community_moderators AS cm JOIN communities AS c ON cm.community_id=c.id WHERE cm.community_id='$index'");
            $fetch_community_moderations_by_id = mysqli_fetch_assoc($select_community_moderations_by_id);
            $fetch_name = $fetch_community_moderations_by_id["name"];

            if($community_selected == $index) echo "<option value='{$index}' selected>{$fetch_name}</option>";
            else echo "<option value='{$index}'>{$fetch_name}</option>";
          }
          ?>
        </select>
        <input type='submit' name='moderate' aria-label='moderate' value='Moderate'>
      </div>
    </form>

    <form class='hide'>
      <div class='inline'>
        <label for=''>Name</label>
        <input id='' type='text' name='' placeholder=''>
      </div>
      <div>
        <label for='community-description'>Description</label>
        <textarea id='community-description' name=''><?php //echo $community_description; ?></textarea>
      </div>
      <div>
        <input type='submit' name='submit-change-name' value='Save'>
      </div>
    </form>
  </section>
  <?php
  if($signed_in) include_once("templates/create-community.php");
  ?>
</main>
<?php
require_once("foot.php");
?>
