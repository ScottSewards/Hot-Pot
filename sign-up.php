<?php
$title = "Sign-up";
require_once("head.php");
if($signed_in) direct_to("user-dashboard.php");

if(isset($_POST["sign-up"])) {
  $created = date("Y-m-d G:i:s");
  $name = htmlspecialchars(addslashes($_POST['name']));
  $email = htmlspecialchars(addslashes($_POST['email']));
  $password = htmlspecialchars(addslashes($_POST['password']));
  $select_name = mysqli_query($connection, "SELECT id FROM users WHERE name='{$name}'");
  $select_email = mysqli_query($connection, "SELECT id FROM signatures WHERE email='{$email}'");
  if(mysqli_num_rows($select_name) == "1") $error = "You cannot use the username {$name}.";
  else if(mysqli_num_rows($select_email) == "1") $error = "You cannot use the email {$email}.";
  else {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $token = rand(100000, 999999);
    mysqli_query($connection, "INSERT INTO users (created, name, email, token, password) VALUES ('{$created}', '{$name}', '{$email}', '{$token}', '{$password_hash}')");
    $select_user_by_name = mysqli_query($connection, "SELECT * FROM users WHERE name='{$name}'");
    $fetch_user_by_name = mysqli_fetch_assoc($select_user_by_name);
    $_SESSION["signed_in"] = true;
    $_SESSION["id"] = $fetch_user_by_name["id"];
    $_SESSION["created"] = $fetch_user_by_name["created"];
    $_SESSION["name"] = $fetch_user_by_name["name"];
    $_SESSION["description"] = $fetch_user_by_name["description"];
    $_SESSION["email"] = $fetch_user_by_name["email"];
    $_SESSION["verified"] = $fetch_user_by_name["verified"];
    $_SESSION["newsletter_subscription"] = $fetch_user_by_name["newsletter_subscription"];
    $_SESSION["picture"] = $fetch_user_by_name["picture"];
    $_SESSION["banner"] = $fetch_user_by_name["banner"];
    $user_id = $_SESSION["id"];
    mysqli_query($connection, "INSERT INTO user_sign_ins (signed_in, user_id, ip_address) VALUES ('{$datetime}', '{$user_id}', '{$ip_address}')");
    head_to("user-dashboard.php");
  }
}
?>
<main>
  <section>
    <h1>Sign-up</h1>
    <form method='POST' autocomplete='off'>
      <div class='inline'>
        <label for='sign-up-name'>Username*</label>
        <input id=sign-up-name type='text' pattern='[a-z\A-Z\0-9]{5}' name='name' placeholder='CharlieChaplin' <?php if(isset($name)) echo "value='{$name}'"; ?> autocomplete='off' autofocus required>
      </div>
      <div class='inline'>
        <label for='sign-up-email'>Email*</label>
        <input id=sign-up-email type='email' name='email' placeholder='charles@chaplin.co.uk' <?php if(isset($email)) echo "value='{$email}'"; ?> required>
      </div>
      <div class='inline'>
        <label for='sign-up-password'>Password*</label>
        <input id='sign-up-password' type='password' name='password' placeholder='CityLights1931' <?php if(isset($password)) echo "value='{$password}'"; ?> autocomplete='new-password' required>
        <input type='button' value='Show' name='show-password'>
      </div>
      <div class='inline'>
        <input id='sign-up' type='submit' name='sign-up' value='Sign-up'>
        <?php if(isset($error)) echo "<output name='sign-up-output'>{$error}</output>"?>
      </div>
    </form>
    <p>If you already have an account, you can <a href='sign-in.php'>sign-in here</a>.</p>
  </section>
</main>
<?php
require_once("foot.php");
?>
