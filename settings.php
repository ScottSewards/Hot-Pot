<?php
$title = "Settings";
require_once("head.php");
?>
<main>
  <section>
    <h1>Settings</h1>
    <article id='theme-colour'>
      <form id='theme-colour-form'>
        <fieldset>
          <legend>Change Theme Colour</legend>
          <div>
            <div class='inline'>
              <label for='theme-colour-hue'>Theme colour hue:</label>
              <output id='theme-colour-output' name='theme-colour-output'></output>
            </div>
            <input id='theme-colour-hue' type='range' name='theme-colour-hue' min='0' max='359' style='background: -webkit-linear-gradient(left, #F00 0%, #FF0 16.66%, #0F0 33.33%, #0FF 50%, #00F 66.66%, #F0F 83.33%, #F00 100%);'>
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
      </script>
    </article>
    <article id='colour-scheme'>
      <h2>Colour Scheme</h2>
      <form id='colour-scheme-form'>
        <fieldset>
          <legend>Change Colour Scheme</legend>
          <p>Choose a colour scheme:</p>
          <div class='inline'>
            <input id='colour-scheme-light' type='radio' name='colour-scheme' value='0' checked required/>
            <label for='colour-scheme-light'>Light (default)</label>
          </div>
          <div class='inline'>
            <input id='colour-scheme-dark' type='radio' name='colour-scheme' value='0' required/>
            <label for='colour-scheme-dark'>Dark</label>
          </div>
          <div class='inline'>
            <input id='colour-scheme-system' type='radio' name='colour-scheme' value='0' required/>
            <label for='colour-scheme-system'>System</label>
          </div>
        </fieldset>
      </form>
      <script type='text/javascript'>
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
    </article>
  </section>
</main>
<?php
require_once("foot.php");
?>
