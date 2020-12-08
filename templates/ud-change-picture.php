<?php
if(isset($_POST["submit-change-picture"])) {
 if(!empty($_FILES["picture"])) {
   $file_name = $_FILES["picture"]["name"];
   if(move_uploaded_file($_FILES["picture"]["tmp_name"], "images/pictures/{$file_name}")) { //UPLOAD PICTURE
     if($my_picture != "images/picture.png") { //IF PICTURE IS NOT DEFAULT
       $my_picture_name = explode("/", $my_picture); //GET FILE NAME
       rename($my_picture, "images/_bin/" . end($my_picture_name)); //MOVE FILE TO BIN
     }
     $file_extension = end(explode(".", $file_name));
     $path_and_file_name = "images/pictures/{$my_id}-1.{$file_extension}";
     rename("images/pictures/{$file_name}", "{$path_and_file_name}");
     mysqli_query($connection, "UPDATE users SET picture='{$path_and_file_name}' WHERE id='{$my_id}'");
     $_SESSION["picture"] = $path_and_file_name;
     head_to_self();
   } else echo "Your file was not uploaded.";
 }
}
?>
<article class='hide'>
  <h3>Change Picture</h3>
  <form method='POST' enctype='multipart/form-data'>
    <figure id='my-picture-figure'>
      <figcaption>My Picture</figcaption>
      <img id='my-picture' src='<?php echo $my_picture; ?>' alt='My Picture'>
    </figure>
    <div class='inline'>
      <label for='picture'>Image*</label>
      <input id='picture' type='file' name='picture' accept='image/jpeg, image/gif, image/png' required>
    </div>
    <input type='submit' name='submit-change-picture' value='Change' disabled>
  </form>
  <script type='text/javascript'>
  $('#picture').addEventListener('change', function() { //t.ly/fijM
    if(this.files[0].size > 2097152) {
      alert('The image you uploaded is too large. It must be no larger than 1 megabyte.');
      this.value = '';
    } else if(this.files[0]) {
      var reader = new FileReader();
      reader.onload = e => {
        $('#my-picture').src = e.target.result;
      }
      reader.readAsDataURL(this.files[0]);
    }
  });
  </script>
</article>
