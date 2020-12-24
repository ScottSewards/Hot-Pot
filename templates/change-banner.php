



<?php



if(isset($_POST["submit-change-banner"])) {
 if(!empty($_FILES["banner"])) {
   $file_name = $_FILES["banner"]["name"];
   if(move_uploaded_file($_FILES["banner"]["tmp_name"], "images/banners/{$file_name}")) {
     if($my_banner != "images/banner.png") {
       $my_banner_name = explode("/", $my_banner);
       rename($my_banner, "images/_bin/" . end($my_banner_name));
     }
     $file_extension = end(explode(".", $file_name));
     $path_and_file_name = "images/banners/{$my_id}-1.{$file_extension}";
     rename("images/banners/{$file_name}", "{$path_and_file_name}");
     $update = mysqli_query($connection, "UPDATE users SET banner='{$path_and_file_name}' WHERE id='{$my_id}'");
     $_SESSION["banner"] = $path_and_file_name;
     head_to_self();
   } else echo "Your file was not uploaded.";
 }
}

function echo_change_image($image) {
  echo "
  <section>
    <h2>Change Banner</h2>
    <form method='POST' enctype='multipart/form-data'>
      <figure id='my-banner-figure'>
        <figcaption>My Banner</figcaption>
        <img id='my-banner' src='<?php echo $my_banner; ?>' alt='My Banner'>
      </figure>
      <div class='inline'>
        <label for='banner'>Image*</label>
        <input id='banner' type='file' name='banner' accept='image/jpeg, image/gif, image/png' required>
      </div>
      <input type='submit' name='submit-change-banner' value='Change' disabled>
    </form>
    <script type='text/javascript'>
    $('#banner').addEventListener('change', function() {
      if(this.files[0].size > 4194304) {
        alert('The image you uploaded is too large. It must be no larger than 2 megabytes.');
        this.value = '';
      } else if(this.files[0]) {
        var reader = new FileReader();
        reader.onload = e => {
          $('#my-banner').src = e.target.result;
        }
        reader.readAsDataURL(this.files[0]);
      }
    });
    </script>
  </section>
  ";
}
?>
