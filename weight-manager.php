<?php
$title = "Weight Manager";
require "php/top.php";
?>
<main>
  <section>
    <h1>Weight Manager</h1>
    <?php //echo date("jS F Y", mktime(0, 0, 0, date("m"), date("d"), date("y"))); ?>
  </section>
  <section>
    <form action="weight-manager.php" method="post">
      <fieldset>
        <legend>Calculate RMR</legend>
        <p>Sex*</p>
        <div>
          <label for='sex-male'>Male</label>
          <input id='sex-male' type='radio' name='sex' value='0' required checked>
        </div>
        <div>
          <label for='sex-female'>Female</label>
          <input id='sex-female' type='radio' name='sex' value='1' required>
        </div>
        <hr>
        <div>
          <label for='age'>Age*</label>
          <input id='age' type='number' name='age' placeholder='23' min='15' max='100' required>
        </div>
        <?php
        if($systemOfUnits == 0) { //IMPERIAL
          echo "
          <div>
            <label for='height-foot'>Height (ft)*</label>
            <input id='height-foot' type='number' name='height-feet' placeholder='5' min='3' max='7' required>
          </div>
          <div>
            <label for='height-inches'>Height (in)*</label>
            <input id='height-inches' type='number' name='height-inches' placeholder='8' min='0' max='12' required>
          </div>
          <div>
            <label for='weight'>Weight (lbs)*</label>
            <input id='weight' type='number' name='weight-pounds' placeholder='232' min='60' max='800' required>
          </div>";
        } else { //METRIC
          echo "
          <div>
            <label for='height'>Height (cm)*</label>
            <input id='height' type='number' name='height-centimetres' placeholder='160' min='80' max='300' required>
          </div>
          <div>
            <label for='weight'>Weight (kg)*</label>
            <input id='weight' type='number' name='weight-kilograms' placeholder='103.6' min='30' max='400' required>
          </div>";
        }
        ?>
        <div>
          <label for='body-fat'>Body Fat (%)</label>
          <input id='body-fat' type='number' name='body-fat' placeholder='15' min='0' max='100'>
        </div>
        <input type="submit" name="submit-measurements" value="Submit Measurements">
      </fieldset>
    </form>
    <hr>
    <?php
    if(isset($_POST["submit-measurements"])) {
      $sex = $_POST["sex"];
      $age = $_POST["age"];

      if($systemOfUnits == 0) { //IMPERIAL
        $heightInFeet = $_POST["height-feet"];
        $heightInInches = $_POST["height-inches"];
        $weightInPounds = $_POST["weight-pounds"];
        $weightInPartPounds = $weightInPounds % 14;
        $weightInPartStone = round(($weightInPounds - $weightInPartPounds) / 14);

        //$rmr = round(9.99 * $weightInKilograms + 6.25 * $heightInCentimetres - 4.92 * $ageInYears + $sex == 0 ? 5 : -161);
        $bmr = ($weightInPounds / 2.205) * 20;
      } else { //METRICS
        $heightInCentimetres = $_POST["height-centimetres"];
        $weightInKilograms = $_POST["weight-kilograms"];

        $rmr = round(9.99 * $weightInKilograms + 6.25 * $heightInCentimetres - 4.92 * $age + $sex == 0 ? 5 : -161);
        $bmr = $weightInKilograms * 20;
      }

      //$rmr = 9.99 * $weightInKilograms + 6.25 * $heightInCentimetres - 4.92 * $ageInYears - 161;
      //$activityLevel = 1.2;
      //$tdee = $rmr * $activityLevel;
      //$tef = $bmr * 0.1;

      if($systemOfUnits == 0) { //IMPERIAL
        echo "Feet : $heightInFeet | Inches : $heightInInches | Pounds : $weightInPounds or $weightInPartStone stone and $weightInPartPounds pounds | RMR : $rmr.";
        //echo "Feet : $heightInFeet | Inches : $heightInInches | Pounds : $weightInPounds or $weightInPartStone stone and $weightInPartPounds pounds | BMR : $bmr | TDEE : $tdee | TEF : $tef.";
      } else { //METRICS
        echo "Centimetres : $heightInCentimetres | Kilograms : $weightInKilograms | BMR : $bmr | TDEE : $tdee | TEF : $tef.";
        //echo "Centimetres : $heightInCentimetres | Kilograms : $weightInKilograms | BMR : $bmr | TDEE : $tdee | TEF : $tef.";
      }
    }
    ?>
    <p>You can <a href='settings.php#units'>change the system of unit in settings</a>. Presently, the calculator will calculate RMR. BMR, TDEE and TEF are in development as I am adding multiple BMR estimation formulae.</p>
  </section>
</main>
<?php
require "php/bottom.php";
?>
<!--
https://developer.edamam.com/food-database-api-docs
https://www.programmableweb.com/api/can-i-eat-it-barcode
-->
