<?php
$title = "Settings";
require "php/top.php";
?>
<main>
  <section>
    <h1>Settings</h1>
    <article>
      <form id='theme-colour-form'>
        <fieldset>
          <legend>Change Theme Colour</legend>
          <div>
            <div class='inline'>
              <label for='theme-colour'>Theme colour</label>
              <output id='theme-colour-output' name='theme-colour-output'></output>
            </div>
            <input id='theme-colour-hue' type='range' name='theme-colour-hue' min='0' max='359' style='background: -webkit-linear-gradient(left, #F00 0%, #FF0 16.66%, #0F0 33.33%, #0FF 50%, #00F 66.66%, #F0F 83.33%, #F00 100%); border: 0.6rem solid white;'>
          </div>
        </fieldset>
      </form>
      <script type="text/javascript">
      $('#theme-colour-hue').value = getComputedStyle(document.documentElement).getPropertyValue('--col-theme-hue');
      $('#theme-colour-output').value = getComputedStyle(document.documentElement).getPropertyValue('--col-theme-hue');
      $('#theme-colour-hue').addEventListener('change', function() {
        document.documentElement.style.setProperty("--col-theme-hue", this.value);
        $('#theme-colour-output').value = this.value.toUpperCase();
        setCookie('themeColourHue', this.value);
      });
      </script>
  </section>
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
