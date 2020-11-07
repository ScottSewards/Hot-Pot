<?php
$title = "Dashboard";
require "php/top.php";

if(!isset($signature)) header("location:signature.php");

if(isset($_POST["send-verification"])) {
  send_email(
    $email,
    "$signature, Verify Your Signature",
    "<a href='sewards.me/dashboard.php?verify=true'>Click here to verify your email.</a>",
    "Email Verifier",
    "noreply@sewards.me",
    false
  );
} else if(isset($_POST["change-signature"])) {
  $update = htmlspecialchars(addslashes($_POST["signature"]));
  mysqli_query($connection, "UPDATE signatures SET signature='$update' WHERE id='$id'");
  $select = mysqli_query($connection, "SELECT signature FROM signatures WHERE id='$id'");
  $fetch = mysqli_fetch_array($select);
  $_SESSION["signature"] = $fetch["signature"];
  header("location: dashboard.php");
} else if(isset($_POST["change-email"])) {
  $update = htmlspecialchars(addslashes($_POST["email"]));
  mysqli_query($connection, "UPDATE signatures SET email='$update' WHERE id='$id'");
  $select = mysqli_query($connection, "SELECT email FROM signatures WHERE id = '$id'");
  $fetch = mysqli_fetch_array($select);
  $_SESSION["email"] = $fetch["email"];
  header("location: dashboard.php");
} else if(isset($_POST["change-password"])) {
  $oldPassword = htmlspecialchars(addslashes($_POST["old-password"]));
  $newPassword = htmlspecialchars(addslashes($_POST["new-password"]));

  $select = mysqli_query($connection, "SELECT password FROM signatures WHERE id='$id'");
  $fetch = mysqli_fetch_array($select);
  $password = $fetch['password'];

  if(password_verify($oldPassword, $password)) {
    $hash = password_hash($newPassword, PASSWORD_DEFAULT);
    mysqli_query($connection, "UPDATE signatures SET password='$hash' WHERE id='$id'");
    $message = "Password changed.";
  } else $message = "Password was not changed.";
} else if(isset($_POST["set-wallet-addresses"])) {
  //
  $message = "Ethereum address added.";
}
?>
<main>
  <section>
    <header>
      <h1>Dashboard</h1>
      <h2>Account</h2>
    </header>
    <!--div>
        <form action="dashboard.php" method="post">
        <input type="submit" name="send-verification" value="Send Verification Email">
      </form>
    </div-->
    <div>
      <form action='dashboard.php' method='post'>
        <fieldset>
          <div>
            <label for='real-name'>Real Name</label>
            <input id='real-name' type='text' name='real-name' placeholder='Scott Sewards'>
          </div>
          <div>
            <label for='signature'>Signature*</label>
            <input id='signature' type='text' name='signature' placeholder='<?php echo $signature ?>' required>
          </div>
          <!--div>
            <label for='password'>Password</label>
            <input id='password' type='password' name='password' placeholder='TitaniumTitanic2020' required>
            <input class="show-password" type='button' value='Show'>
          </div-->
          <input type='submit' name='change-signature' value='Change Signature'>
        </fieldset>
      </form>
    </div>
    <div>
      <form action='dashboard.php' method='post'>
        <fieldset>
          <div>
            <label for='email'>Email*</label>
            <input id='email' type='email' name='email' placeholder='<?php echo $email ?>' required>
          </div>
          <!--div>
            <label for='password'>Password</label>
            <input id='password' type='password' name='password' placeholder='TitaniumTitanic2020' required>
            <input class="show-password" type='button' value='Show'>
          </div-->
          <input type='submit' name='change-email' value='Change Email'>
        </fieldset>
      </form>
    </div>
    <div>
      <form action='dashboard.php' method='post'>
        <fieldset>
          <div>
            <label for='old-password'>Old Password</label>
            <input id='old-password' type='password' name='old-password' placeholder='TitaniumTitanic2020' required>
            <input type='button' value='Show' name='show-password'>
          </div>
          <div>
            <label for='new-password'>New Password</label>
            <input id='new-password' type='password' name='new-password' placeholder='TitaniumTitanic2020' required>
            <input type='button' value='Show' name='show-password'>
          </div>
          <input type='submit' name='change-password' value='Change Password'>
        </fieldset>
      </form>
    </div>
    <div>
      <form action='dashboard.php' method='post'>
        <fieldset>
          <div>
            <label for='bitcoin-address'>Bitcoin Address</label>
            <input id='bitcoin-address' type='text' name='bitcoin-address' placeholder='' <?php if(isset($bitcoinWallet)) echo "value='$bitcoinWallet'"; ?>>
          </div>
          <div>
            <label for='bcash-address'>BCash Address</label>
            <input id='bcash-address' type='text' name='bcash-address' placeholder='' <?php if(isset($bcashWallet)) echo "value='$bcashWallet'"; ?>>
          </div>
          <div>
            <label for='ethereum-address'>Ethereum Address</label>
            <input id='ethereum-address' type='text' name='ethereum-address' placeholder='0xA14Ae9BC94005A93934a027024EB7421215853Af' <?php if(isset($ethereumWallet)) echo "value='$ethereumWallet'"; ?>>
          </div>
          <div>
            <label for='litecoin-address'>Litecoin Address</label>
            <input id='litecoin-address' type='text' name='litecoin-address' placeholder='' <?php if(isset($litecoinWallet)) echo "value='$litecoinWallet'"; ?>>
          </div>
          <input type='submit' name='set-wallet-addresses' value='Set Wallet Addresses'>
        </fieldset>
      </form>
    </div>
    <div>
      <form action='dashboard.php' method='post'>
        <fieldset>
          <div>
            <label for='facebook'>Facebook</label>
            <input id='facebook' type='text' name='facebook' placeholder='scott.sewards.97'>
          </div>
          <div>
            <label for='snapchat'>Snapchat</label>
            <input id='snapchat' type='text' name='snapchat' placeholder="scottsewards">
          </div>
          <div>
            <label for='twitter'>Twitter</label>
            <input id='twitter' type='text' name='twitter' placeholder="@ScottSewards">
          </div>
          <input type='submit' name='set-social-media' value='Set Social Media'>
        </fieldset>
      </form>
    </div>
  </section>
  <section id="notifications">
    <header>
      <h2>Notifications</h2>
    </header>
    <?php
    //GET VERIFIED STATUS FROM SQL DATABASE
    echo "You need to verify your email.";
    ?>
  </section>
</main>
<?php
require "php/bottom.php";
?>
