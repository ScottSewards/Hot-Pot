<?php
$title = "Hexadoku";
require "php/top.php";
?>
<main>
  <article>
    <header>
      <h1>Hexadoku</h1>
      <h2>How to Play</h2>
    </header>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  </article>
  <div id="hexadoku">
    <?php
    $hexadoku = true;
    $cols = $hexadoku ? 16 : 9;
    $rows = $hexadoku ? 16 : 9;
    $cells = array();
    ?>
    <div id="board" style="grid-template-columns: repeat(<?php echo $cols; ?>, 1fr); grid-template-rows: repeat(<?php echo $rows; ?>, 1fr);">
      <?php
      for($i = 0; $i < $cols * $rows; $i++) {
        array_push($cells, rand(1, 9));
      }

      for($i = 0; $i < $cols; $i++) {
        for($j = 0; $j < $rows; $j++) {
          $cellNumber = $i * 9 + $j;
          echo("<div id='hexa-cell-$cellNumber' class='hexa-cell'>$cells[$cellNumber]</div>");
        }
      }
      ?>
    </div>
  </div>
  <section>
    <header>
      <h2>Settings</h2>
      <h3>Numerical System</h3>
    </header>
    <ul>
      <li>Decimal</li>
      <li>Hexadecimal</li>
    </ul>
    <header>
      <h3>Input System</h3>
    </header>
    <ul>
      <li>Pick</li>
      <li>Tap</li>
      <li>Type</li>
    </ul>
  </section>
</main>
<script type="text/javascript">
/*
//SEPERATE FUNCTIONALITY ACCORDING TO ENUMS
$().ready(function(){
  const PuzzleTypes = {
    HEXDOKU: "Hexdoku",
    SUDOKU: "Sudoku"
  };

  let puzzleType = PuzzleTypes.SUDOKU;
  var cells = [];

  switch(puzzleType) {
    case PuzzleTypes.HEXDOKU:
      cells = CreatePuzzle(16, 16);
      break;
    case PuzzleTypes.SUDOKU:
      cells = CreatePuzzle(9, 9);
      break;
  }
});

function CreatePuzzle(rows, cols) {
  for(var i = 0; i < cols; i++) {
    $("#hexdoku-board").append("<div id='row-" + i + "' class='row'></div>");

    for(var j = 0; j < rows; j++) {
      //$("#row-" + i + "").append("<div id='cell-" + ((i * 9) + j) + "' class='cell'>"+ cells[(i * 9) + j] +"</div>");
      /*
      if(((i * 9) + j) < 9 || (((i * 9) + j) >= 27 && ((i * 9) + j) < 36) || (((i * 9) + j) >= 54 && ((i * 9) + j) < 63)) $("[id='cell-" + ((i * 9) + j) + "']").addClass("cell-border-top");
      if(((i * 9) + j) % 9 == 2 || ((i * 9) + j) % 9 == 5 || ((i * 9) + j) % 9 == 8) $("[id='cell-" + ((i * 9) + j) + "']").addClass("cell-border-right");
      if((((i * 9) + j) >= 18 && ((i * 9) + j) < 27) || (((i * 9) + j) >= 45 && ((i * 9) + j) < 54) || ((i * 9) + j) > 71) $("[id='cell-" + ((i * 9) + j) + "']").addClass("cell-border-bottom");
      if(((i * 9) + j) % 9 == 0 || ((i * 9) + j) % 9 == 3 || ((i * 9) + j) % 9 == 6) $("[id='cell-" + ((i * 9) + j) + "']").addClass("cell-border-left");

    }
  }

  return cells;
}

  /*
  const inputs = {
    DROP: "drop",
    TAP: "tap"
  };

  let input = inputs.DROP;
  switch(input) {
    //set to not change cell if value is correct by comparing it to the array
    case inputs.DROP:
      var picked = 1;
      $("[id='pick-1']").addClass("active");
      $("[id*='pick-']").click(function(){
        picked = $(this).text();
        $("[id*='pick-']").removeClass("active");
        $(this).addClass("active");
      });
      $("[id*='cell-']").click(function(){
        $(this).text(picked);
      });
      break;
    case inputs.TAP:
      var cellected = null;
      $("[id*='cell-']").click(function(){
        cellected = $(this).attr("id");
        //MUST SHOW AND HIDE NUMBER TAPPER
        $("[id='number-tapper']").css("opacity", "100");
      });
      $("[id*='tap-']").click(function(){
        if(cellected !== null) {
          //SET ARRAY VALUE
          //GET ARRAY VALUE TO THIS
        $("[id='" + cellected + "']").text($(this).text());
          var text = $(this).text();
            //MUST ENTER VALUE INTO ARRAY
          $("[id='number-tapper']").css("opacity", "0");
        }
      });
      break;
  }
</script>
<?php
require "php/bottom.php";
?>
