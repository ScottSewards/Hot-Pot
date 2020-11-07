<?php
$title = "Leaves";
require "php/top.php";

if(isset($_GET["leaf"])) {
  $seed = $_GET["leaf"];
  $query = mysqli_query($connection, "SELECT * FROM persons WHERE id='$seed'");
  $fetch = mysqli_fetch_array($query);

  $subject = $fetch["given-name"];
  //if(isset($fetch["nickname"])) $subject .= " " . $fetch["nickname"];
  //if(isset($fetch["middle-name"])) $subject .= " " . $fetch["middle-name"];
  if(isset($fetch["last-name"])) $subject .= " " . $fetch["last-name"];
  //if(isset($fetch["maiden-name"])) $subject .= " née " . $fetch["maiden-name"];

  $birthDate = array_reverse(explode("-", $fetch["birth-date"]));
  $father;
  $mother;
}

if(isset($_POST["add-person"])) {
  $givenName = htmlspecialchars(addslashes($_POST['given-name']));
  $lastName = htmlspecialchars(addslashes($_POST['last-name']));
  $maidenName = htmlspecialchars(addslashes($_POST['maiden-name']));
  $insert = mysqli_query($connection, "INSERT INTO persons (`given-name`, `last-name`, `maiden-name`) VALUES ('$givenName', '$lastName', '$maidenName')");
  $select = mysqli_query($connection, "SELECT id FROM persons WHERE `given-name`='$givenName' AND `last-name`='$lastName'");
  $fetch = mysqli_fetch_array($select);
  $id = $fetch['id'];
  $message = "Added person. <a href='leaves.php?leaf=$id'>Click here to see person</a>.";
}
?>
<main>
  <section>
    <header>
      <h1>Leaves</h1>
      <h2>Registar - Featured</h2>
    </header>
    <div>
      <p>Featured profile here.</p>
    </div>
  </section>
  <section>
    <h2>Register Person</h2>
    <form id="register-person" action="leaves.php" method="post">
      <fieldset>
        <div>
          <label for="given-name">Given Name*</label>
          <input type="text" name="given-name" placeholder="John" required>
        </div>
        <div>
          <label for="nick-name">Nickname</label>
          <input type="text" name="nick-name" placeholder="Johnny">
        </div>
        <div>
          <label for="middle-name">Middle Name(s)</label>
          <input type="text" name="middle-name" placeholder="James">
        </div>
        <div>
          <label for="last-name">Last Name*</label>
          <input type="text" name="last-name" placeholder="Smith" required>
        </div>
        <div>
          <label for="maiden-name">Maiden Name</label>
          <input type="text" name="maiden-name" placeholder="Jones">
        </div>
        <p>You may write an unlisted gender.</p>
        <div>
          <label for="gender">Gender*</label>
          <input list="gender" name="gender" value="Male">
        </div>
        <datalist id="gender" name="gender">
          <option value="Male">
          <option value="Male-to-Female">
          <option value="Female">
          <option value="Female-to-Male">
        </datalist>
        <div>
          <label for="date-of-birth">Date of Birth</label>
          <input type="date" name="date-of-birth">
        </div>
        <div>
          <label for="time-of-birth">Time of Birth</label>
          <input type="time" name="time-of-birth">
        </div>
        <div class="hide">
          <label for="place-of-birth">Place of Birth</label>
          <input type="text" name="place-of-birth">
        </div>
        <div>
          <label for="date-of-death">Date of Death</label>
          <input type="date" name="date-of-death">
        </div>
        <div>
          <label for="time-of-death">Time of Death</label>
          <input type="time" name="time-of-death">
        </div>
        <div class="hide">
          <label for="place-of-death">Place of Death</label>
          <input type="text" name="place-of-death">
        </div>
        <div class="hide">
          <label for="is-private">Private</label>
          <input type="checkbox" name="is-private">
        </div>
        <input type="submit" name="add-person" value="Add Person">
      </fieldset>
    </form>
  </section>
  <section>
    <?php
    if(isset($_GET["leaf"])) {
      echo "<p>$subject was born";

      $ordinal = GetOrdinal($birthDate[0]);
      $date = date("F", mktime(0, 0, 0, $birthDate[1], 10));
      if(isset($birthDate)) echo " on the " . $birthDate[0] . "<sup>$ordinal</sup> of $date " . $birthDate[2];

      //IF BOTH HAVE LAST SAME NAME JUST BRENDAN AND LESLEY BARR
      if(isset($father) and isset($mother)) echo " to $father and $mother.";
      else if(isset($father) and !isset($mother)) echo " to $father.";
      else if(!isset($father) and isset($mother)) echo " to $mother.";
      echo ".</p>";
    }
    ?>
  </section>
  <section id="parents" class="hide">
    <header>
      <h2>Parents</h2>
    </header>
    <div>
      <p>This person has no parents :(</p>
      <?php
      /*
      function RenderPerson($id) {
        $newRenderQuery = mysqli_query($connection, "SELECT * FROM persons WHERE id='$id'");
        $renderFetch = mysqli_fetch_array($newRenderQuery);
        return $renderFetch["given-name"];
      }

      if(isset($father)) {
        $temp = RenderPerson(1);
        echo "$temp";
      }
      */
      ?>

      <!--div id='father-father' class="person">
        <header>
          <h3>Paternal Grandfather</h3>
        </header>
        <p><?php //echo $father; ?></p>
        <img src="https://www.lrcb.nl/resources/uploads/2017/09/unknown_person-1024x1024.png" alt="Person Placeholder">
      </div>
      <div id='father-mother' class="person">
        <header>
          <h3>Paternal Grandmother</h3>
        </header>
        <p>
        <?php
        /*
        if(isset($paternalGrandmother)) {
          echo $paternalGrandmother;
        } else {
          echo "YOOO";
        }
        */
        ?>
        </p>
        <img src="https://www.lrcb.nl/resources/uploads/2017/09/unknown_person-1024x1024.png" alt="Person Placeholder">
      </div-->
    </div>
  </section>
  <section class="hide">
    <header>
      <h2>Gallery</h2>
    </header>
    <?php
    $hasSlideshow = false;
    if($hasSlideshow) {
      echo "
      <div class='slideshow'>
        <figure>
          <figcaption class='slide-caption'>Caption</figcaption>
          <img class='slide-image' src='https://horsevets.co.uk/wp-content/uploads/2013/10/placeholder.jpg' alt='Placeholder Image'/>
        </figure>
        <p class='slide-number'>Slide <span class='slide-number-current'>1</span> of <span class='slide-number-total'>2</span></p>
      </div>";
    } else echo "<p>There are no images :(</p>";
    ?>
  </section>
</main>
<?php
require "php/bottom.php";
?>
