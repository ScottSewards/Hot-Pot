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
    <p>There is no functionality here yet.</p>
    <?php
    if(isset($_GET["moderate"])) {

    }
    ?>
    <form class='less'>
      <div class='inline'>
        <label for='community-select'>Community</label>
        <select id='' class='' name='comm' required>
          <?php
          $index = 0;
          while($fetch_community_moderated = mysqli_fetch_assoc($select_community_moderations)) {
            //$community_modereated_name = $fetch_community_moderated[""]
            $index++;
            echo "<option value='{$index}'>{$index}</option>";
          }
          ?>
        </select>
        <input type='submit' name='moderate' aria-label='moderate' value='Moderate'>
      </div>
    </form>

    <form>
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
