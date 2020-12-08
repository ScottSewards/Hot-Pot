<section>
  <h2>Command Line</h2>
  <div>
    <form id='command-line-form' class='less' method='POST'>
      <div class='inline'>
        <label for='command-line'>Command</label>
        <input id='command-line' type='text' name='command-line' required/>
        <input type='submit' name='run-command' value='Run'/>
      </div>
    </form>
  </div>
  <div id='commend-line-results'>
    <?php
    if(isset($_POST["run-command"])) {
      $command = $_POST["command-line"];
      $select = mysqli_query($connection, $command);
      while($fetch = mysqli_fetch_assoc($select)) print_r($fetch);
    }
    ?>
  </div>
</section>
