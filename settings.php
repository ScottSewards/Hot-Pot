<?php
$title = "Settings";
require "php/top.php";

if(isset($_POST["submit-colours"])) {
  setcookie("themeColour", $_POST["theme-colour"], time() + (86400 * 30), "/");
  setcookie("darkMode", $_POST["dark-mode"], time() + (86400 * 30), "/");
  //header("location: settings.php");
} else if(isset($_POST["submit-system-of-units"])) {
  setcookie("systemOfUnits", $_POST["system-of-unit"], time() + (86400 * 30), "/");
  //header("location: settings.php");
} else if(isset($_POST["submit-family-tree-view"])) {
  setcookie("familyTreeView", $_POST["family-tree-view"], time() + (86400 * 30), "/");
  //header("location: settings.php");
}
?>
<main>
  <!--section id='colours'>
    <header>
      <h1>Settings</h1>
      <h2>Colours</h2>
    </header>
    <form action="settings.php" method="post">
      <fieldset>
        <div>
          <label for="theme-colour-picker">Theme</label>
          <input id="theme-colour-picker" type="color" name="theme-colour" value="<?php echo $themeColour; ?>">
        </div>
        <p>Dark mode is in-development; you may encounter some issues.</p>
        <div>
          <label for="dark-mode-checkbox">Dark Mode</label>
          <input type="hidden" name="dark-mode" value="off">
          <input id="dark-mode-checkbox" type="checkbox" name="dark-mode" <?php if($darkMode == "on") echo "checked"; ?>>
        </div>
        <input type="reset" name="reset-colours" value="Reset Settings">
        <input type="submit" name="submit-colours" value="Save Settings">
      </fieldset>
    </form>
  </section>
  <section id='units'>
    <h2>Units</h2>
    <form action="settings.php" method="post">
      <fieldset>
        <div>
          <label for="imperial">Imperial</label>
          <input type="radio" name="system-of-unit" value="0" <?php if($systemOfUnits == 0) echo "checked"; ?>>
        </div>
        <div>
          <label for="metric">Metric</label>
          <input type="radio" name="system-of-unit" value="1" <?php if($systemOfUnits == 1) echo "checked"; ?>>
        </div>
        <input type="reset" name="reset-system-of-units" value="Reset Settings">
        <input type="submit" name="submit-system-of-units" value="Save Settings">
      </fieldset>
    </form>
  </section>
  <section class="hide">
    <header>
      <h2>Family Tree</h2>
    </header>
    <form action="settings.php" method="post">
      <fieldset>
        <div class="hide">
          <label for="genogram">Genogram</label>
          <input type="radio" name="family-tree-view" value="0" <?php if($familyTreeView == 0) echo "checked"; ?> disabled>
        </div>
        <div class="">
          <label for="list">List</label>
          <input type="radio" name="family-tree-view" value="1" <?php if($familyTreeView == 1) echo "checked"; ?>>
        </div>
        <div class="hide">
          <label for="pedigree">Pedigree</label>
          <input type="radio" name="family-tree-view" value="2" <?php if($familyTreeView == 2) echo "checked"; ?> disabled>
        </div>
        <div>
          <label for="tiles">Tiles</label>
          <input type="radio" name="family-tree-view" value="3" <?php if($familyTreeView == 3) echo "checked"; ?>>
        </div>
        <input type="reset" name="reset-family-tree-view" value="Reset Settings">
        <input type="submit" name="submit-family-tree-view" value="Save Settings">
      </fieldset>
    </form>
  </section-->
</main>
<?php
require "php/bottom.php";
?>
