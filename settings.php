<?php
$title = "Settings";
require_once("head.php");
?>
<main>
  <section>
    <h1>Settings</h1>
    <form>
      <fieldset>
        <legend>Theme Colour</legend>
        <div class='inline'>
          <label for='theme-colour-hue'>Theme colour hue:</label>
          <output id='theme-colour-output' name='theme-colour-output'></output>
        </div>
        <div>
          <input id='theme-colour-hue' class='colour-picker' type='range' name='theme-colour-hue' min='0' max='359'>
        </div>
      </fieldset>
      <fieldset>
        <legend>Colour Scheme</legend>
        <div class='inline'>
          <input id='colour-scheme-light' type='radio' name='colour-scheme' value='0' checked/>
          <label for='colour-scheme-light'>Light (default)</label>
        </div>
        <div class='inline'>
          <input id='colour-scheme-dark' type='radio' name='colour-scheme' value='0'/>
          <label for='colour-scheme-dark'>Dark</label>
        </div>
        <div class='inline'>
          <input id='colour-scheme-system' type='radio' name='colour-scheme' value='0'/>
          <label for='colour-scheme-system'>System</label>
        </div>
      </fieldset>
    </form>
    <script type='text/javascript'>
    $('#theme-colour-hue').value = getComputedStyle(document.documentElement).getPropertyValue('--col-theme-hue');
    $('#theme-colour-output').value = getComputedStyle(document.documentElement).getPropertyValue('--col-theme-hue');
    $('#theme-colour-hue').addEventListener('change', function() {
      document.documentElement.style.setProperty("--col-theme-hue", this.value);
      $('#theme-colour-output').value = this.value.toUpperCase();
      setCookie('themeColourHue', this.value);
    });
    $('#theme-colour-hue').addEventListener('input', function() {
      document.documentElement.style.setProperty("--col-theme-hue", this.value);
      $('#theme-colour-output').value = this.value.toUpperCase();
    });
    switch(parseInt(getCookie('colourScheme'))) {
      case 1:
        $('#colour-scheme-dark').checked = true;
        break;
      case 2:
        $('#colour-scheme-system').checked = true;
        break;
      default:
        $('#colour-scheme-light').checked = true;
    }
    $('#colour-scheme-light').addEventListener('change', function() {
      setCookie('colourScheme', 0);
      setColourScheme(0);
    });
    $('#colour-scheme-dark').addEventListener('change', function() {
      setCookie('colourScheme', 1);
      setColourScheme(1);
    });
    $('#colour-scheme-system').addEventListener('change', function() {
      setCookie('colourScheme', 2);
      setColourScheme(2);
    });
    </script>
  </section>
</main>
<?php
require_once("foot.php");
?>
