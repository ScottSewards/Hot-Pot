<?php
$title = "Codechart";
require "php/top.php";
?>
<aside id="menu">
  <div>
    <p>Scene : Flowchart</p>
  </div>
  <div>
    <p onclick="AddObject()">Add Object</p>
  </div>
</aside>
<main>
  <section>
    <h1>Codechart</h1>
    <canvas id="codechart" style="width: 100%;">
      Your browser does not support the <code>canvas</code> element.
    </canvas>
    <button type="button" name="button" onclick="addObject()">Add Object</button>
    <script>
    function main() {
        const canvas = document.getElementById("codechart");
        var drawing = canvas.getContext("2d");

        if(drawing === null) {
            window.alert("dfinfoir");
            return;
        }

        drawing.fillStyle = 'green';
        drawing.fillRect(10, 10, 150, 100);

        drawing.fillStyle = "red";
        drawing.fillRect(20, 20, 100, 100);

        addObject(drawing);
    }

    function addObject(drawing) {
      drawing.fillStyle = "yellow";
      drawing.fillRect(10, 10, 100, 100);
    }
    window.onload = main;
    </script>
  </section>
</main>
<?php
require "php/bottom.php";
?>
