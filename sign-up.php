<?php
$title = "Sign-up";
require_once("head.php");

if(isset($my_id)) redirect("dashboard.php");

if(isset($_POST["sign-up"])) {
  $created = date("Y-m-d");
  $name = htmlspecialchars(addslashes($_POST['name']));
  $email = htmlspecialchars(addslashes($_POST['email']));
  $password = htmlspecialchars(addslashes($_POST['password']));
  $select_name = mysqli_query($connection, "SELECT id FROM users WHERE name='{$name}'");
  $select_email = mysqli_query($connection, "SELECT id FROM signatures WHERE email='{$email}'");
  if(mysqli_num_rows($select_name) == "1") echo "You cannot use this signature.";
  else if(mysqli_num_rows($select_email) == "1") echo "You cannot use this email address.";
  else {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($connection, "INSERT INTO users (created, name, email, password) VALUES ('{$created}', '{$name}', '{$email}', '{$password_hash}')");
    $select = mysqli_query($connection, "SELECT * FROM users WHERE name='{$name}'");
    $fetch = mysqli_fetch_array($select);
    $_SESSION["created"] = $fetch["created"];
    $_SESSION["verified"] = $fetch["verified"];
    $_SESSION["id"] = $fetch["id"];
    $_SESSION["name"] = $fetch["name"];
    $_SESSION["email"] = $fetch["email"];
    $_SESSION["can_email"] = $fetch["can_email"];
    $_SESSION["picture"] = $fetch["picture"];
    $_SESSION["banner"] = $fetch["banner"];
    redirect("dashboard.php");
  }
}
?>
<main>
  <section>
    <h1>Sign-up</h1>
    <form action='sign-up.php' method='POST' autocomplete='off'>
      <div class='inline'>
        <label for='sign-up-name'>Username*</label>
        <input id=sign-up-name type='text' name='name' placeholder='CharlieChaplin' autocomplete='off' autofocus required/>
      </div>
      <div class='inline'>
        <label for='sign-up-email'>Email*</label>
        <input id=sign-up-email type='email' name='email' placeholder='charles@chaplin.co.uk' require/>
      </div>
      <div class='inline'>
        <label for='sign-up-password'>Password*</label>
        <input id='sign-up-password' type='password' name='password' placeholder='CityLights1931' autocomplete='new-password' required/>
        <input type='button' value='Show' name='show-password'/>
      </div>
      <input type='submit' name='sign-up' value='Sign-up'/>
    </form>
  </section>
</main>
<?php
require_once("foot.php");
?>
